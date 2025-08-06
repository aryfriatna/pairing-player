<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Set Pairing') }}
        </h2>
    </x-slot>

    <div x-data="{ selectedRegion: '' }" class="py-6 px-4">
        @php
            $unpaired = $event->players->filter(fn($p) => !$pairings->contains('player_id', $p->id));
        @endphp

        {{-- Region Selector --}}
        <div class="mb-6">
            <label for="region-select" class="block font-semibold mb-2">Pilih Region:</label>
            <select id="region-select" x-model="selectedRegion" class="rounded border-gray-300">
                <option value="">-- Pilih Region --</option>
                @foreach ($event->regions as $region)
                    <option value="{{ $region->id }}">{{ $region->region_name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Modal --}}
        <div id="player-select-modal"
            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
            <div class="bg-white p-6 rounded shadow-md w-full max-w-md">
                <h3 class="text-lg font-bold mb-4">Pilih Pemain</h3>
                <select id="player-select" class="w-full border-gray-300 rounded mb-4">
                    <option value="">-- Pilih Pemain --</option>
                    @foreach ($unpaired as $u)
                        <option value="{{ $u->id }}">{{ $u->player_name }}</option>
                    @endforeach
                </select>
                <div class="flex justify-end gap-2">
                    <button id="modal-cancel-btn"
                        class="bg-gray-500 text-white px-3 py-1 rounded hover:bg-gray-600">Batal</button>
                    <button id="modal-place-btn"
                        class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">Pasang</button>
                </div>
            </div>
        </div>

        {{-- Pairing Tables --}}
        @foreach ($event->regions as $region)
            @php
                $courses = match ($region->region_name) {
                    'WEST-NORTH' => ['WEST', 'NORTH'],
                    'NORTH-SOUTH' => ['NORTH', 'SOUTH'],
                    'SOUTH-WEST' => ['SOUTH', 'WEST'],
                    default => [],
                };
            @endphp

            <div x-show="selectedRegion == '{{ $region->id }}'" x-cloak>
                @foreach ($courses as $course)
                    <h4 class="font-bold mt-6 mb-2">{{ $course }} ({{ $region->region_name }})</h4>
                    <table class="w-full text-sm border border-gray-300">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border px-2 py-1">Tee</th>
                                <th class="border px-2 py-1">Flight A</th>
                                <th class="border px-2 py-1">Flight B</th>
                                <th class="border px-2 py-1">Flight C</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($tee = 1; $tee <= 9; $tee++)
                                @for ($slot = 1; $slot <= 4; $slot++)
                                    <tr>
                                        <td class="border px-2 py-1">Tee
                                            {{ str_pad($tee, 2, '0', STR_PAD_LEFT) }}</td>
                                        @foreach (['A', 'B', 'C'] as $flight)
                                            @php
                                                $pair = $pairings->firstWhere(
                                                    fn($p) => $p->region_id == $region->id &&
                                                        $p->course_name == $course &&
                                                        $p->teebox == str_pad($tee, 2, '0', STR_PAD_LEFT) &&
                                                        $p->slot_number == $slot &&
                                                        $p->flight == $flight,
                                                );
                                            @endphp
                                            <td class="border px-2 py-1 cell-slot" data-region="{{ $region->id }}"
                                                data-course="{{ $course }}"
                                                data-tee="{{ str_pad($tee, 2, '0', STR_PAD_LEFT) }}"
                                                data-slot="{{ $slot }}" data-flight="{{ $flight }}">
                                                @if ($pair)
                                                    <div class="player-card bg-blue-100 px-2 py-1 rounded flex justify-between items-center"
                                                        data-player="{{ $pair->player_id }}"
                                                        data-pairing="{{ $pair->id }}">
                                                        {{ $pair->player->player_name }}
                                                        <button class="menu-toggle text-xs text-gray-600">⋮</button>
                                                        <ul
                                                            class="menu hidden absolute bg-white border rounded shadow text-sm mt-1">
                                                            <li onclick="editPlayer({{ $pair->id }})"
                                                                class="px-3 py-1 hover:bg-gray-100 cursor-pointer">Edit
                                                            </li>
                                                            <li onclick="removePlayer({{ $pair->id }})"
                                                                class="px-3 py-1 hover:bg-red-100 text-red-600 cursor-pointer">
                                                                Hapus</li>
                                                        </ul>
                                                    </div>
                                                @else
                                                    <button class="btn-add text-blue-500 text-xs hover:underline">+
                                                        Pilih</button>
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                @endfor
                            @endfor
                        </tbody>
                    </table>
                @endforeach
            </div>
        @endforeach
    </div>

    <style>
        [x-cloak] {
            display: none !important;
        }

        .modal {
            display: flex !important;
        }

        .player-card {
            position: relative;
            cursor: grab;
        }

        .menu-toggle:hover+.menu,
        .menu:hover {
            display: block !important;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script>
        let currentCell = null;

        // Setup drag n drop
        document.querySelectorAll('.cell-slot').forEach(el => {
            new Sortable(el, {
                group: 'players',
                animation: 150,
                handle: '.player-card',
                filter: '.menu-toggle, .menu li',
                onEnd(evt) {
                    sendPairing(evt.item.dataset.player, evt.to);
                }
            });
        });

        // Pilih tombol '+ Pilih'
        document.querySelectorAll('.btn-add').forEach(btn =>
            btn.addEventListener('click', () => {
                currentCell = btn.closest('.cell-slot');
                document.getElementById('player-select-modal').classList.remove('hidden');
            })
        );

        // Modal tombol batal
        document.getElementById('modal-cancel-btn').addEventListener('click', () =>
            document.getElementById('player-select-modal').classList.add('hidden')
        );

        // Modal tombol pasang
        document.getElementById('modal-place-btn').addEventListener('click', () => {
            const val = document.getElementById('player-select').value;
            if (!val) return;
            sendPairing(val, currentCell);
            document.getElementById('player-select-modal').classList.add('hidden');
        });

        // Remove player
        function removePlayer(pairingId) {
            fetch('{{ route('pairing.remove') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    pairing_id: pairingId
                })
            }).then(() => location.reload());
        }

        // Kirim pairing ke backend
        function sendPairing(playerId, cell) {
            const payload = {
                event_id: {{ $event->id }},
                player_id: playerId,
                region_id: parseInt(cell.dataset.region),
                course_name: cell.dataset.course,
                teebox: cell.dataset.tee,
                slot_number: parseInt(cell.dataset.slot),
                flight: cell.dataset.flight
            };
            fetch('{{ route('pairing.set') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(payload)
            }).then(() => location.reload());
        }

        // Optional: editPlayer function
        function editPlayer(pairingId) {
            alert('Edit pairing masih dalam pengembangan.');
        }
    </script>
</x-app-layout>

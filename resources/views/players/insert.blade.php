<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Players') }}
        </h2>
    </x-slot>

    <div class="py-8 px-4">
        <div class="max-w-7xl mx-auto space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow rounded-lg">
                <form action="{{ route('player.store', ['event' => $event_id]) }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="event_id" value="{{ $event_id }}">
                    @php
                        $inputClass =
                            'w-full p-2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm';
                        $labelClass = 'w-64 font-semibold text-gray-700';
                        $labelTitikDua = 'w-2 font-semibold text-gray-700';
                    @endphp

                    <div class="flex flex-row flex-wrap justify-between items-center gap-2 mb-6">
                        <h2 class="text-xl sm:text-2xl font-semibold text-gray-700">Player Management</h2>
                        {{-- <a href="{{ route('player.create') }}"
                            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm sm:text-base">
                            Add Player
                        </a> --}}
                        <button type="button" id="addPlayerRow"
                            class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 text-sm">
                            Add Player
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto text-sm text-left border border-gray-300">
                            <thead class="bg-gray-100 text-gray-700">
                                <tr>
                                    <th class="border px-3 py-2 text-center">No</th>
                                    <th class="border px-3 py-2">Name</th>
                                    <th class="border px-3 py-2">HCP</th>
                                    <th class="border px-3 py-2">Tag</th>
                                    <th class="border px-3 py-2 w-20 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="playerFormContainer">
                                <tr class="player-row">
                                    <td class="border px-3 py-2 text-center">1</td>
                                    <td class="border px-3 py-2">
                                        <input type="text" name="players[0][name]"
                                            class="w-full border-gray-300 rounded" required>
                                    </td>
                                    <td class="border px-3 py-2">
                                        <input type="text" name="players[0][hcp]"
                                            class="w-full border-gray-300 rounded" required>
                                    </td>
                                    <td class="border px-3 py-2">
                                        <input type="text" name="players[0][tag]"
                                            class="w-full border-gray-300 rounded" required>
                                    </td>
                                    <td class="border px-3 py-2 text-center">
                                        <button type="button"
                                            class="remove-player text-red-600 hover:text-red-800 text-sm font-bold">X</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="flex justify-between items-center mt-4">
                        <a href="{{ route('player.index', ['event' => $event_id]) }}"
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm">
                            back
                        </a>
                        <button type="submit"
                            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm">
                            Submit All Player
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let playerIndex = 1;

        document.getElementById('addPlayerRow').addEventListener('click', function() {
            const tbody = document.getElementById('playerFormContainer');
            const row = document.querySelector('.player-row').cloneNode(true);

            // update input name attributes
            row.querySelectorAll('input').forEach(input => {
                const name = input.getAttribute('name');
                const newName = name.replace(/\d+/, playerIndex);
                input.setAttribute('name', newName);
                input.value = '';
            });

            // update row number
            row.querySelector('td').innerText = playerIndex + 1;

            tbody.appendChild(row);
            playerIndex++;
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-player')) {
                const rows = document.querySelectorAll('.player-row');
                if (rows.length > 1) {
                    e.target.closest('tr').remove();
                    // update row numbers
                    document.querySelectorAll('.player-row').forEach((row, index) => {
                        row.querySelector('td').innerText = index + 1;
                    });
                    playerIndex--;
                } else {
                    alert('Minimal satu player harus diisi.');
                }
            }
        });
    </script>
</x-app-layout>

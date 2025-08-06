<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Players') }}
        </h2>
    </x-slot>

    <div class="py-8 px-4">
        <div class="max-w-7xl mx-auto space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow rounded-lg">
                <div class="flex flex-row flex-wrap justify-between items-center gap-2 mb-6">
                    <h2 class="text-xl sm:text-2xl font-semibold text-gray-700">Player Management</h2>
                    <a href="{{ route('player.create', ['event' => $event_id]) }}"
                        class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm sm:text-base">
                        Add Player
                    </a>
                </div>

                @if (session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded text-sm">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('info'))
                    <div class="mb-4 p-3 bg-blue-100 text-blue-800 rounded text-sm">
                        {{ session('info') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table id="search-table">
                        <thead>
                            <tr>
                                <th>
                                    <span class="flex items-center">
                                        No
                                    </span>
                                </th>
                                <th>
                                    <span class="flex items-center">
                                        Player Name
                                    </span>
                                </th>
                                <th>
                                    <span class="flex items-center">
                                        Handicap
                                    </span>
                                </th>
                                <th>
                                    <span class="flex items-center">
                                        Bagtag
                                    </span>
                                </th>
                                <th>
                                    <span class="flex items-center">
                                        Action
                                    </span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($player as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->player_name }}</td>
                                    <td>{{ $item->hcp }}</td>
                                    <td>{{ $item->bagtag }}</td>
                                    <td>
                                        <button
                                            class="bg-blue-600 text-white px-4 py-1 rounded hover:bg-blue-700 text-sm">Edit</button>
                                        <a href=""
                                            class="bg-red-600 text-white px-4 py-1 rounded hover:bg-red-700 text-sm">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <a href="{{ route('event.index') }}"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm">Back to Event</a>

                <a href="{{ route('pairing.index', ['event' => $event_id]) }}"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm">Set Pairing</a>
            </div>
        </div>
    </div>

</x-app-layout>

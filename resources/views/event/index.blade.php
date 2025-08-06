<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Event') }}
        </h2>
    </x-slot>

    <div class="py-8 px-4">
        <div class="max-w-7xl mx-auto space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow rounded-lg">
                <div class="flex flex-row flex-wrap justify-between items-center gap-2 mb-6">
                    <h2 class="text-xl sm:text-2xl font-semibold text-gray-700">Event Management</h2>
                    <a href="{{ route('event.create') }}"
                        class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm sm:text-base">
                        Add Event
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
                                        Event Name
                                    </span>
                                </th>
                                <th>
                                    <span class="flex items-center">
                                        Event Date
                                    </span>
                                </th>
                                <th>
                                    <span class="flex items-center">
                                        Method
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
                            @foreach ($events as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->event_name }}</td>
                                    <td>{{ $item->event_date }}</td>
                                    <td>{{ $item->method }}</td>
                                    <td>
                                        <button
                                            class="bg-blue-600 text-white px-4 py-1 rounded hover:bg-blue-700 text-sm">Edit</button>
                                        <a href="{{ route('player.index', ['event' => $item->id]) }}"
                                            class="bg-green-600 text-white px-4 py-1 rounded hover:bg-green-700 text-sm">Player</a>
                                        <form action="{{ route('event.destroy', ['event' => $item->id]) }}"
                                            method="POST" onsubmit="return confirm('Yakin ingin menghapus event ini?')"
                                            style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-600 text-white px-4 py-1 rounded hover:bg-red-700 text-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

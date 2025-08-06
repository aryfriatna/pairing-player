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
                    <a href="{{ route('dashboard') }}"
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
                    <table id="search-table" class="min-w-full table-auto text-sm text-left border border-gray-200">
                        <thead class="bg-gray-100">
                            <tr class="text-center text-gray-700">
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
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

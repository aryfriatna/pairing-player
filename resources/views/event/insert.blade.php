<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Event') }}
        </h2>
    </x-slot>

    <div class="py-8 px-4">
        <div class="max-w-7xl mx-auto space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow rounded-lg">
                <form action="{{ route('event.store') }}" method="POST" class="space-y-6">
                    @csrf
                    @php
                        $inputClass =
                            'w-full p-2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm';
                        $labelClass = 'w-64 font-semibold text-gray-700';
                        $labelTitikDua = 'w-2 font-semibold text-gray-700';
                    @endphp

                    <div id="productFormsContainer">
                        <div class="product-form space-y-4 p-4 mb-6 border border-gray-200 rounded-md bg-gray-50">
                            <div class="flex items-center gap-4">
                                <label class="{{ $labelClass }}">Event Name</label>
                                <label class="{{ $labelTitikDua }}">:</label>
                                <input type="text" name="event_name" class="{{ $inputClass }}" required>
                            </div>

                            <div class="flex items-center gap-4">
                                <label class="{{ $labelClass }}">Event Date</label>
                                <label class="{{ $labelTitikDua }}">:</label>
                                <input type="date" name="event_date" class="{{ $inputClass }}" required>
                            </div>

                            <div class="flex items-center gap-4">
                                <label class="{{ $labelClass }}">Method of Event</label>
                                <label class="{{ $labelTitikDua }}">:</label>
                                <select name="method" class="{{ $inputClass }}" id="method">
                                    <option value="Online">Online</option>
                                    <option value="Offline">Offline</option>
                                </select>
                            </div>

                            <div class="flex items-center gap-4">
                                <label class="{{ $labelClass }}">Region</label>
                                <label class="{{ $labelTitikDua }}">:</label>
                                <select name="region_name[]" class="{{ $inputClass }} bg-white text-gray-900"
                                    multiple>
                                    @foreach ($regions as $region)
                                        <option value="{{ $region->id }}" class="text-black">
                                            {{ $region->region_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end items-center">
                        <button type="submit"
                            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

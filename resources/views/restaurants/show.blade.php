<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {!! __('Restaurants &raquo; Show') !!}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white sm:rounded-md shadow-sm p-6 mb-4">
                <div class="grid sm:grid-cols-2 gap-5">
                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full px-3">
                            <p class="block uppercase text-indigo-500 text-xs font-bold mb-1">
                                Restaurant Name
                            </p>
                            <p>{{ $restaurant->restaurant_name }}</p>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full px-3">
                            <p class="block uppercase text-indigo-500 text-xs font-bold mb-1">
                                Address
                            </p>
                            <p>{{ $restaurant->address }}</p>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full px-3">
                            <p class="block uppercase text-indigo-500 text-xs font-bold mb-1">
                                Description
                            </p>
                            <p>{{ $restaurant->description }}</p>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full px-3">
                            <p class="block uppercase text-indigo-500 text-xs font-bold mb-1">
                                Created At
                            </p>
                            <p>{{ $restaurant->created_at->format('d F Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

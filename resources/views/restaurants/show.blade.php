<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {!! __('Restaurants &raquo; Show') !!}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-lg mb-3 mx-3 sm:mx-0 text-gray-800 font-semibold">Restaurant Detail</h1>
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

        <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
            <h1 class="text-lg mb-3 text-gray-800 font-semibold">List Foods</h1>
            <div class="grid sm:grid-cols-3 gap-5">
                @foreach($restaurant->foods as $food)
                    <div class="bg-white sm:rounded-md shadow-sm flex items-center">
                        <img src="{{ $food->image_url }}" alt="{{ $food->food_name }}" class="sm:rounded-bl-md sm:rounded-tl-md object-cover h-32 w-32">
                        <div class="p-5 w-full">
                            <h1 class="text-xl font-medium">
                                <a href="{{ route('foods.show', $food) }}" class="hover:text-indigo-500">
                                    {{ $food->food_name }}
                                </a>
                            </h1>
                            <p class="text-gray-500 mb-2">{{ $food->description ?? $food->category }}</p>
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-bold">{{ $food->formatted_price }}</h3>
                                <div class="flex items-center text-yellow-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z"/>
                                    </svg>
                                    <strong class="ml-1">{{ $food->rating }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>

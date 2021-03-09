<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {!! __('Foods &raquo; Create') !!}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <x-jet-form-section actionUrl="{{ route('foods.store') }}" formMethod="post" enctype="multipart/form-data">
            <x-slot name="title">
                {{ __('Create Food') }}
            </x-slot>

            <x-slot name="description">
                {{ __('Create new food of restaurant.') }}
            </x-slot>

            <x-slot name="form">
                @csrf
                @method('post')

                <div class="col-span-6">
                    <x-jet-label for="restaurant_id" value="{{ __('Restaurant') }}" />
                    <select name="restaurant_id" id="restaurant_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        @foreach($restaurants as $restaurant)
                            <option value="{{ $restaurant->id }}"{{ old('restaurant_id') == $restaurant->id ? ' selected' : '' }}>
                                {{ $restaurant->restaurant_name }}
                            </option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="restaurant_id" class="mt-2" />
                </div>
                <div class="col-span-6">
                    <x-jet-label for="food_name" value="{{ __('Food Name') }}" />
                    <x-jet-input id="food_name" name="food_name" type="text" class="mt-1 block w-full" value="{{ old('food_name') }}" autocomplete="food_name" placeholder="Food name" />
                    <x-jet-input-error for="food_name" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <x-jet-label for="price" value="{{ __('Price') }}" />
                    <x-jet-input id="price" name="price" type="text" class="mt-1 block w-full" value="{{ old('price') }}" autocomplete="price" placeholder="Food price" />
                    <x-jet-input-error for="price" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <x-jet-label for="category" value="{{ __('Category') }}" />
                    <x-jet-input id="category" name="category" type="text" class="mt-1 block w-full" value="{{ old('category') }}" autocomplete="category" placeholder="Category" />
                    <x-jet-input-error for="category" class="mt-2" />
                </div>
                <div class="col-span-6">
                    <x-jet-label for="description" value="{{ __('Description') }}" />
                    <x-jet-input id="description" name="description" type="text" class="mt-1 block w-full" value="{{ old('description') }}" autocomplete="description" placeholder="Detail about cuisine" />
                    <x-jet-input-error for="description" class="mt-2" />
                </div>
                <div class="col-span-6">
                    <x-jet-label for="ingredients" value="{{ __('Ingredients') }}" />
                    <x-jet-input id="ingredients" name="ingredients" type="text" class="mt-1 block w-full" value="{{ old('ingredients') }}" autocomplete="ingredients" placeholder="Food ingredients" />
                    <x-jet-input-error for="ingredients" class="mt-2" />
                </div>
                <div class="col-span-6">
                    <x-jet-label for="image" value="{{ __('Image') }}" />
                    <x-jet-input id="image" name="image" type="file" class="mt-1 block w-full" value="{{ old('image') }}" autocomplete="image" placeholder="Food image" />
                    <x-jet-input-error for="image" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="actions">
                <x-jet-button type="submit">
                    {{ __('Save') }}
                </x-jet-button>
            </x-slot>
        </x-jet-form-section>
    </div>
</x-app-layout>

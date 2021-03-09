<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {!! __('Restaurants &raquo; Edit') !!}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <x-jet-form-section actionUrl="{{ route('restaurants.update', $restaurant->id) }}" formMethod="post">
            <x-slot name="title">
                {{ __('Edit Restaurant') }}
            </x-slot>

            <x-slot name="description">
                {{ __('Update restaurant account to manage.') }}
            </x-slot>

            <x-slot name="form">
                @csrf
                @method('put')
                <div class="col-span-6">
                    <x-jet-label for="restaurant_name" value="{{ __('Restaurant Name') }}" />
                    <x-jet-input id="restaurant_name" name="restaurant_name" type="text" class="mt-1 block w-full" value="{{ old('restaurant_name', $restaurant->restaurant_name) }}" autocomplete="restaurant_name" placeholder="Restaurant name" />
                    <x-jet-input-error for="restaurant_name" class="mt-2" />
                </div>
                <div class="col-span-6">
                    <x-jet-label for="description" value="{{ __('Description') }}" />
                    <x-jet-input id="description" name="description" type="text" class="mt-1 block w-full" value="{{ old('description', $restaurant->description) }}" autocomplete="description" placeholder="About restaurant" />
                    <x-jet-input-error for="description" class="mt-2" />
                </div>
                <div class="col-span-6">
                    <x-jet-label for="address" value="{{ __('Address') }}" />
                    <x-jet-input id="address" name="address" type="text" class="mt-1 block w-full" value="{{ old('address', $restaurant->address) }}" autocomplete="address" placeholder="Restaurant location" />
                    <x-jet-input-error for="address" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="actions">
                <x-jet-button type="submit">
                    {{ __('Update') }}
                </x-jet-button>
            </x-slot>
        </x-jet-form-section>
    </div>
</x-app-layout>

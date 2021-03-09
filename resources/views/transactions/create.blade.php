<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {!! __('Transactions &raquo; Create') !!}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <x-jet-form-section actionUrl="{{ route('transactions.store') }}" formMethod="post" enctype="multipart/form-data">
            <x-slot name="title">
                {{ __('Create Transaction') }}
            </x-slot>

            <x-slot name="description">
                {{ __('Create new food transaction.') }}
            </x-slot>

            <x-slot name="form">
                @csrf
                @method('post')
                <div class="col-span-6 md:col-span-3">
                    <x-jet-label for="user_id" value="{{ __('User') }}" />
                    <select name="user_id" id="user_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        @foreach($users as $user)
                            <option value="{{ $user->id }}"{{ old('user_id') == $user->id ? ' selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="user_id" class="mt-2" />
                </div>
                <div class="col-span-6 md:col-span-3">
                    <x-jet-label for="food_id" value="{{ __('Food') }}" />
                    <select name="food_id" id="food_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        @foreach($foods as $food)
                            <option value="{{ $food->id }}"{{ old('food_id') == $food->id ? ' selected' : '' }}>
                                {{ $food->food_name }}
                            </option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="food_id" class="mt-2" />
                </div>
                <div class="col-span-6">
                    <x-jet-label for="quantity" value="{{ __('Quantity') }}" />
                    <x-jet-input id="quantity" name="quantity" type="text" class="mt-1 block w-full" value="{{ old('quantity', 1) }}" autocomplete="price" placeholder="Order quantity" />
                    <x-jet-input-error for="quantity" class="mt-2" />
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

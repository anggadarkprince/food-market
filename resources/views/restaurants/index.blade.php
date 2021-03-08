<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Restaurants') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-5">
                <a href="{{ route('restaurants.create') }}" class="inline-flex items-center px-4 py-2 rounded bg-green-500 text-white hover:bg-green-600 text-sm font-semibold tracking-wide">
                    Create Restaurant
                </a>
            </div>
            <div class="bg-white sm:rounded-md shadow p-4 mb-4">
                <table class="table-auto w-full">
                    <thead>
                    <tr>
                        <th class="border px-6 py-2 text-center">No</th>
                        <th class="border px-6 py-2">Restaurant Name</th>
                        <th class="border px-6 py-2">Address</th>
                        <th class="border px-6 py-2">Description</th>
                        <th class="border px-6 py-2 w-32">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($restaurants as $index => $restaurant)
                    <tr>
                        <td class="border px-6 py-2 w-20 text-center">{{ $restaurants->firstItem() + $index }}</td>
                        <td class="border px-6 py-2">{{ $restaurant->restaurant_name }}</td>
                        <td class="border px-6 py-2">{{ $restaurant->address }}</td>
                        <td class="border px-6 py-2">{{ $restaurant->description }}</td>
                        <td class="border px-6 py-2">
                            <div class="relative">
                                <x-jet-dropdown align="right" width="40">
                                    <x-slot name="trigger">
                                        <div class="inline-flex rounded-md">
                                            <button type="button" class="text-white inline-flex items-center px-4 py-2 border border-transparent leading-4 text-sm font-semibold tracking-wide rounded-md bg-blue-500 hover:bg-blue:600 focus:outline-none transition ease-in-out duration-150">
                                                Action
                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </div>
                                    </x-slot>

                                    <x-slot name="content">
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Manage Restaurant') }}
                                        </div>
                                        <x-jet-dropdown-link href="{{ route('restaurants.show', $restaurant->id) }}">
                                            {{ __('Show') }}
                                        </x-jet-dropdown-link>

                                        <x-jet-dropdown-link href="{{ route('restaurants.edit', $restaurant->id) }}">
                                            {{ __('Edit') }}
                                        </x-jet-dropdown-link>
                                        <div class="border-t border-gray-100"></div>
                                        <form action="{{ route('restaurants.destroy', $restaurant->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <x-jet-dropdown-link href="{{ route('restaurants.destroy', $restaurant->id) }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                                {{ __('Delete') }}
                                            </x-jet-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-jet-dropdown>
                            </div>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center p-4">
                                No data available
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="text-center">
                {{ $restaurants->links() }}
            </div>
        </div>
    </div>
</x-app-layout>

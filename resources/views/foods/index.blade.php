<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Foods') }}
        </h2>
        <div>
            <div class="inline-block relative">
                <x-jet-dropdown align="right" width="auto" dropdownClasses="text-left">
                    <x-slot name="trigger">
                        <div class="inline-flex rounded-md">
                            <button type="button" class="text-white inline-flex items-center px-2 py-2 border border-transparent leading-4 text-sm font-semibold tracking-wide rounded bg-red-500 hover:bg-red:600 focus:outline-none transition ease-in-out duration-150">
                                Sort
                                <svg class="ml-1 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </x-slot>

                    <x-slot name="content">
                        <form action="{{ url()->current() }}" method="get">
                            <input type="hidden" name="sort" id="filter-sort" value="relevant">
                            <x-jet-dropdown-link href="#" class="{{ request()->get('sort') == 'relevant' ? 'bg-indigo-100' : '' }}" onclick="event.preventDefault(); document.getElementById('filter-sort').value = 'relevant'; this.closest('form').submit();">
                                {{ __('Most Relevant') }}
                            </x-jet-dropdown-link>
                            <x-jet-dropdown-link href="#" class="{{ request()->get('sort') == 'highest-price' ? 'bg-indigo-100' : '' }}" onclick="event.preventDefault(); document.getElementById('filter-sort').value = 'highest-price'; this.closest('form').submit();">
                                {{ __('Highest Price') }}
                            </x-jet-dropdown-link>
                            <x-jet-dropdown-link href="#" class="{{ request()->get('sort') == 'lowest-price' ? 'bg-indigo-100' : '' }}" onclick="event.preventDefault(); document.getElementById('filter-sort').value = 'lowest-price'; this.closest('form').submit();">
                                {{ __('Lowest Price') }}
                            </x-jet-dropdown-link>
                            <x-jet-dropdown-link href="#" class="{{ request()->get('sort') == 'recommendation' ? 'bg-indigo-100' : '' }}" onclick="event.preventDefault(); document.getElementById('filter-sort').value = 'recommendation'; this.closest('form').submit();">
                                {{ __('Most Recommended') }}
                            </x-jet-dropdown-link>
                        </form>
                    </x-slot>
                </x-jet-dropdown>
            </div>
            <a href="{{ route('foods.create') }}" class="inline-flex items-center px-4 py-2 rounded bg-green-500 text-white hover:bg-green-600 text-sm font-semibold tracking-wide">
                Create Food
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="text-right">

            </div>
            <div class="bg-white sm:rounded-md shadow mb-4">
                <table class="table-auto w-full">
                    <thead>
                    <tr class="bg-indigo-500 text-white">
                        <th class="px-6 py-4 text-center">No</th>
                        <th class="px-6 py-4 text-left">Food Name</th>
                        <th class="px-6 py-4 text-left">Restaurant</th>
                        <th class="px-6 py-4 text-left">Description</th>
                        <th class="px-6 py-4">Price</th>
                        <th class="px-6 py-4">Rating</th>
                        <th class="px-6 py-4 w-32">Action</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y">
                    @forelse($foods as $index => $food)
                        <tr>
                            <td class="px-6 py-2 w-20 text-center">{{ $foods->firstItem() + $index }}</td>
                            <td class="px-6 py-2">
                                <img src="{{ url($food->image_url) }}" class="w-8 h-8 object-cover rounded-md inline-block mr-2" alt="Image">
                                {{ $food->food_name }}
                            </td>
                            <td class="px-6 py-2">
                                <a href="{{ route('restaurants.show', $food->restaurant_id) }}" class="hover:text-indigo-500">
                                    {{ $food->restaurant->restaurant_name }}
                                </a>
                            </td>
                            <td class="px-6 py-2">{{ $food->description ?: $food->category ?: '-' }}</td>
                            <td class="px-6 py-2 text-center">{{ $food->formatted_price }}</td>
                            <td class="px-6 py-2 text-center">{{ $food->rating }}</td>
                            <td class="px-6 py-2 text-center">
                                <div class="relative">
                                    <x-jet-dropdown align="right" width="40" dropdownClasses="text-left">
                                        <x-slot name="trigger">
                                            <div class="inline-flex rounded-md">
                                                <button type="button" class="text-white inline-flex items-center px-4 py-2 border border-transparent leading-4 text-sm font-semibold tracking-wide rounded bg-blue-500 hover:bg-blue:600 focus:outline-none transition ease-in-out duration-150">
                                                    Action
                                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </x-slot>

                                        <x-slot name="content">
                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                {{ __('Manage Food') }}
                                            </div>
                                            <x-jet-dropdown-link href="{{ route('foods.show', $food->id) }}">
                                                {{ __('Show') }}
                                            </x-jet-dropdown-link>

                                            <x-jet-dropdown-link href="{{ route('foods.edit', $food->id) }}">
                                                {{ __('Edit') }}
                                            </x-jet-dropdown-link>
                                            <div class="border-t border-gray-100"></div>
                                            <form action="{{ route('foods.destroy', $food->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <x-jet-dropdown-link href="{{ route('foods.destroy', $food->id) }}" onclick="event.preventDefault(); this.closest('form').submit();">
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
                {{ $foods->links() }}
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transactions') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-5">
                <a href="{{ route('transactions.create') }}" class="inline-flex items-center px-4 py-2 rounded bg-green-500 text-white hover:bg-green-600 text-sm font-semibold tracking-wide">
                    Create Transaction
                </a>
            </div>
            <div class="bg-white sm:rounded-md shadow mb-4">
                <table class="table-auto w-full">
                    <thead>
                    <tr class="bg-indigo-500 text-white">
                        <th class="border-b-2 px-6 py-4 text-center">No</th>
                        <th class="border-b-2 px-6 py-4 text-left">Food</th>
                        <th class="border-b-2 px-6 py-4 text-left">User</th>
                        <th class="border-b-2 px-6 py-4">Quantity</th>
                        <th class="border-b-2 px-6 py-4">Total</th>
                        <th class="border-b-2 px-6 py-4">Status</th>
                        <th class="border-b-2 px-6 py-4 w-32">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($transactions as $index => $transaction)
                        <tbody class="divide-y">
                            <td class="px-6 py-2 w-20 text-center">{{ $transactions->firstItem() + $index }}</td>
                            <td class="px-6 py-2">{{ $transaction->food->food_name }}</td>
                            <td class="px-6 py-2">{{ $transaction->user->name }}</td>
                            <td class="px-6 py-2 text-center">{{ $transaction->quantity }}</td>
                            <td class="px-6 py-2 text-center">{{ $transaction->formatted_total }}</td>
                            <td class="px-6 py-2 text-center">{{ $transaction->status }}</td>
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
                                                {{ __('Manage Transaction') }}
                                            </div>
                                            <x-jet-dropdown-link href="{{ route('transactions.show', $transaction->id) }}">
                                                {{ __('Show') }}
                                            </x-jet-dropdown-link>

                                            <x-jet-dropdown-link href="{{ route('transactions.edit', $transaction->id) }}">
                                                {{ __('Edit') }}
                                            </x-jet-dropdown-link>
                                            <div class="border-t border-gray-100"></div>
                                            <form action="{{ route('transactions.destroy', $transaction->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <x-jet-dropdown-link href="{{ route('transactions.destroy', $transaction->id) }}" onclick="event.preventDefault(); this.closest('form').submit();">
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
                {{ $transactions->links() }}
            </div>
        </div>
    </div>
</x-app-layout>

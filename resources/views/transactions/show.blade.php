<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {!! __('Transactions &raquo; Show') !!}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-lg mb-3 mx-3 sm:mx-0 text-gray-800 font-semibold">Transaction</h1>
            <div class="bg-white sm:rounded-md shadow-sm p-6 mb-4">
                <div class="grid sm:grid-cols-2 gap-5">
                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full px-3">
                            <p class="block uppercase text-indigo-500 text-xs font-bold mb-1">
                                Restaurant Name
                            </p>
                            <p>{{ $transaction->food->restaurant->restaurant_name }}</p>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full px-3">
                            <p class="block uppercase text-indigo-500 text-xs font-bold mb-1">
                                Food Name
                            </p>
                            <p>{{ $transaction->food->food_name }}</p>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full px-3">
                            <p class="block uppercase text-indigo-500 text-xs font-bold mb-1">
                                User
                            </p>
                            <p>{{ $transaction->user->name }}</p>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full px-3">
                            <p class="block uppercase text-indigo-500 text-xs font-bold mb-1">
                                Total Price
                            </p>
                            <p>{{ $transaction->formatted_total }}</p>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full px-3">
                            <p class="block uppercase text-indigo-500 text-xs font-bold mb-1">
                                Status
                            </p>
                            <p>{{ $transaction->status }}</p>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full px-3">
                            <p class="block uppercase text-indigo-500 text-xs font-bold mb-1">
                                Created At
                            </p>
                            <p>{{ \Carbon\Carbon::parse($transaction->created_at)->format('d F Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <h1 class="text-lg mb-3 mx-3 sm:mx-0 text-gray-800 font-semibold">Transaction</h1>
            <div class="bg-white sm:rounded-md shadow-sm mb-4">
                <table class="table-auto w-full">
                    <thead>
                    <tr class="bg-indigo-500 text-white">
                        <th class="px-6 py-4 text-center">No</th>
                        <th class="px-6 py-4 text-left">Food Name</th>
                        <th class="px-6 py-4 text-left">Item Price</th>
                        <th class="px-6 py-4 text-left">Quantity</th>
                        <th class="px-6 py-4 text-left">Discount</th>
                        <th class="px-6 py-4 text-right">Total Price</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y">
                    @forelse($transaction->transactionDetails as $index => $transactionDetail)
                        <tr>
                            <td class="px-6 py-2 w-20 text-center">{{ $index + 1 }}</td>
                            <td class="px-6 py-2">{{ $transactionDetail->food_name }}</td>
                            <td class="px-6 py-2">{{ $transactionDetail->formatted_price }}</td>
                            <td class="px-6 py-2">{{ $transactionDetail->quantity }}</td>
                            <td class="px-6 py-2">{{ $transactionDetail->formatted_discount_amount }}</td>
                            <td class="px-6 py-2 text-right font-bold">{{ $transactionDetail->formatted_total_price }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No detail available</td>
                        </tr>
                    @endforelse
                    <tr class="text-indigo-500">
                        <th colspan="5" class="px-6 py-2 text-left">Transaction Total</th>
                        <th class="px-6 py-2 text-right">{{ $transaction->formatted_total }}</th>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

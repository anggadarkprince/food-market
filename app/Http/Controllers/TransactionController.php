<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Models\Food;
use App\Models\Transaction;
use App\Models\User;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class TransactionController extends Controller
{
    /**
     * Display a listing of the transaction.
     *
     * @return Response|View
     */
    public function index()
    {
        $transactions = Transaction::paginate(10);

        return view('transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new transaction.
     *
     * @return Response|View
     */
    public function create()
    {
        $users = User::all();
        $foods = Food::all();

        return view('transactions.create', compact('users', 'foods'));
    }

    /**
     * Store a newly created transaction in storage.
     *
     * @param TransactionRequest $request
     * @return Response|RedirectResponse
     */
    public function store(TransactionRequest $request)
    {
        $food = Food::findOrFail($request->input('food_id'));
        $request->merge([
            'status' => 'PENDING',
            'total' => $request->input('quantity') * $food->price
        ]);

        Transaction::create($request->input());

        return redirect()->route('transactions.index');
    }

    /**
     * Display the specified transaction.
     *
     * @param Transaction $transaction
     * @return Response|View
     */
    public function show(Transaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified transaction.
     *
     * @param Transaction $transaction
     * @return Response|View
     */
    public function edit(Transaction $transaction)
    {
        $users = User::all();
        $foods = Food::all();

        return view('transactions.edit', compact('transaction', 'users', 'foods'));
    }

    /**
     * Update the specified transaction in storage.
     *
     * @param TransactionRequest $request
     * @param Transaction $transaction
     * @return Response|RedirectResponse
     */
    public function update(TransactionRequest $request, Transaction $transaction)
    {
        $food = Food::findOrFail($request->input('food_id'));
        $request->merge(['total' => $request->input('quantity') * $food->price]);

        $transaction->update($request->input());

        return redirect()->route('transactions.index');
    }

    /**
     * Remove the specified transaction from storage.
     *
     * @param Transaction $transaction
     * @return Response|RedirectResponse
     * @throws Exception
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('transactions.index');
    }
}

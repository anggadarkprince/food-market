<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class TransactionController extends Controller
{
    /**
     * Get all transactions api.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit', 6);
        $foodId = $request->input('food_id');
        $status = $request->input('status');

        if ($id) {
            $transaction = Transaction::with(['food', 'user'])->find($id);
            if ($transaction) {
                return ResponseFormatter::success($transaction, 'Transaction Fetched');
            } else {
                return ResponseFormatter::error(null, "Transaction Not Found", 404);
            }
        }

        $food = Transaction::with(['food', 'user', 'transactionDetails'])->where('user_id', $request->user()->id);
        if ($foodId) {
            $food->where('food_id', $foodId);
        }
        if ($status) {
            $food->where('status', $status);
        }

        return ResponseFormatter::success($food->paginate($limit), 'Transaction Fetched');
    }

    /**
     * Update transaction api.
     *
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->update($request->all());

        return ResponseFormatter::success($transaction, 'Transaction Updated');
    }

    /**
     * Checkout transaction api.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function checkout(Request $request)
    {
        $request->validate([
            'food_id' => 'required|exists:foods,id',
            'user_id' => 'required|exists:users,id',
            'quantity' => 'required|max:100',
            'total' => 'required',
            'status' => 'required'
        ]);

        $transaction = Transaction::create([
            'food_id' => $request->food_id,
            'user_id' => $request->user_id,
            'quantity' => $request->quantity,
            'total' => $request->total,
            'status' => $request->status,
            'payment_url' => '',
        ]);

        Config::$serverKey = \config('services.midtrans.serverKey');
        Config::$isProduction = \config('services.midtrans.isProduction');
        Config::$isSanitized = \config('services.midtrans.isSanitized');
        Config::$is3ds = \config('services.midtrans.is3ds');

        $transaction = Transaction::with(['food', 'user'])->find($transaction->id);

        $midtrans = [
            'transaction_details' => [
                'order_id' => $transaction->id,
                'gross_amount' => (int)$transaction->total,
            ],
            'customer_details' => [
                'first_name' => $transaction->user->name,
                'email' => $transaction->user->email,
            ],
            'enabled_payments' => ['gopay', 'bank_transfer'],
            'vtweb' => []
        ];

        try {
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;
            $transaction->payment_url = $paymentUrl;
            $transaction->save();

            return ResponseFormatter::success($transaction, 'Transaction Success');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 'Transaction Failed');
        }
    }
}

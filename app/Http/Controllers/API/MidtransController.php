<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Notification;
use function config as configApp;

class MidtransController extends Controller
{
    /**
     * Callback to redirect after payment.
     *
     * @param Request $request
     */
    public function callback(Request $request)
    {
        Config::$serverKey = configApp('services.midtrans.serverKey');
        Config::$isProduction = configApp('services.midtrans.isProduction');
        Config::$isSanitized = configApp('services.midtrans.isSanitized');
        Config::$is3ds = configApp('services.midtrans.is3ds');

        $notification = new Notification();

        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $orderId = $notification->order_id;

        $transaction = Transaction::findOrFail($orderId);

        if ($status == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $transaction->status = 'PENDING';
                } else {
                    $transaction->status = 'SUCCESS';
                }
            }
        } elseif ($status == 'settlement') {
            $transaction->status = 'SUCCESS';
        } elseif ($status == 'pending') {
            $transaction->status = 'PENDING';
        } elseif ($status == 'deny') {
            $transaction->status = 'CANCELLED';
        } elseif ($status == 'expire') {
            $transaction->status = 'CANCELLED';
        } elseif ($status == 'cancel') {
            $transaction->status = 'CANCELLED';
        }

        $transaction->save();
    }

    public function success()
    {
        return view('midtrans.success');
    }

    public function unfinished()
    {
        return view('midtrans.unfinished');
    }

    public function error()
    {
        return view('midtrans.error');
    }
}

<?php

namespace App\Http\Controllers;

use App\Support\Payment\Transaction;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct(private Transaction $transaction)
    {

    }

    public function verify(Request $request)
    {
        return $this->transaction->verify()
            ? $this->sendSuccessResponse()
            : $this->sendErrorResponse();
    }

    private function sendErrorResponse()
    {
        return redirect()->route('products.index')->with('error', __('payment.error'));
    }

    private function sendSuccessResponse()
    {
        return redirect()->route('products.index')->with('success', __('payment.success'));
    }
}

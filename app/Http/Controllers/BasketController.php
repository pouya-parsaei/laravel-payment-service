<?php

namespace App\Http\Controllers;

use App\Exceptions\QuantityExceededException;
use App\Http\Requests\CheckoutRequest;
use App\Models\Product;
use App\Support\Basket\Basket;
use App\Support\Payment\Transaction;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function __construct(private Basket $basket, private Transaction $transaction)
    {

    }

    public function add(Product $product)
    {
        try {
            $this->basket->add($product, 1);
            return back()->with('success', __('payment.added to basket'));
        } catch (QuantityExceededException $e) {
            return back()->with('error', __('payment.quantity exceeded'));
        }
    }

    public function index()
    {
        $items = $this->basket->all();

        return view('basket.index',compact('items'));
    }

    public function update(Request $request, Product $product)
    {
        $this->basket->update($product,$request->quantity);
        return back();
    }

    public function checkoutForm()
    {
        return view('basket.checkout');
    }

    public function checkout(CheckoutRequest $request)
    {
        $order = $this->transaction->checkout();

        return redirect()->route('products.index')->with('success', __('payment.your order has been registered',['orderNum'=>$order->id]));

    }
}

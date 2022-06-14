<?php

namespace App\Support\Payment;

use App\Events\OrderRegistered;
use App\Models\Order;
use App\Models\Payment;
use App\Support\Basket\Basket;
use App\Support\Payment\Gateways\GatewayInterface;
use App\Support\Payment\Gateways\Pasargad;
use App\Support\Payment\Gateways\Saman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Transaction
{

    public function __construct(private Request $request, private Basket $basket)
    {

    }

    public function checkout()
    {
        DB::beginTransaction();

        try {

            $order = $this->makeOrder();

            $payment = $this->makePayment($order);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return null;
        }

        if ($payment->isOnline()) {
            return $this->gatewayFactory()->pay($order);
        }

        $this->normalizeQuantity($order);

        event(new OrderRegistered($order));

        $this->basket->clear();

        return $order;
    }

    private function makeOrder()
    {
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'code' => bin2hex(Str::random(16)),
            'amount' => $this->basket->subTotal()
        ]);

        $order->products()->attach($this->products());

        return $order;
    }

    private function makePayment($order)
    {
        return Payment::create([
            'order_id' => $order->id,
            'method' => $this->request->method,
            'amount' => $order->amount
        ]);
    }

    private function gatewayFactory()
    {
        $gateway = [
            'saman' => Saman::class,
            'pasargad' => Pasargad::class
        ][$this->request->gateway];

        return resolve($gateway);
    }

    private function products()
    {
        foreach ($this->basket->all() as $product) {
            $products[$product->id] = ['quantity' => $product->quantity];
        }

        return $products;
    }

    public function verify()
    {
        $result = $this->gatewayFactory()->verify($this->request);

        if ($result['status'] === GatewayInterface::TRANSACTION_FAILED) return false;

        $this->confirmPayment($result);

        $this->normalizeQuantity($result['order']);

        $this->basket->clear();

        return true;
    }

    private function normalizeQuantity($order)
    {
        foreach ($order->products as $product) {
            $product->decrementStock($product->pivot->quantity);
        }
    }

    private function confirmPayment($result)
    {
        return $result['order']->payment->confirm($result['refNum'], $result['gateway']);
    }


}

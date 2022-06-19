<?php

namespace App\Support\Payment\Gateways;

use App\Models\Order;
use Symfony\Component\HttpFoundation\Request;

class Pasargad implements GatewayInterface
{

    public function pay(Order $order, int $amount)
    {
        dd('pasargad pay');
    }

    public function verify(Request $request)
    {
        // TODO: Implement verify() method.
    }

    public function getName(): string
    {
        return 'pasargad';
    }
}

<?php

namespace App\Support\Cost;

use App\Support\Basket\Basket;
use App\Support\Cost\Contracts\CostInterface;

class BasketCost implements CostInterface
{

    public function __construct(private Basket $basket)
    {

    }

    public function getCost()
    {
        return $this->basket->subTotal();
    }

    public function getTotalCost()
    {
        return $this->getCost();
    }

    public function persianDescription()
    {
        return 'سبد خرید';
    }

    public function getSummary()
    {
        return [
            $this->persianDescription() => $this->getCost()
        ];
    }
}

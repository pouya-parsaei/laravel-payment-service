<?php

namespace App\Support\Cost;

use App\Support\Cost\Contracts\CostInterface;

class ShippingCost implements Contracts\CostInterface
{
    const SHIPPING_COST = 20000;

    public function __construct(private CostInterface $cost)
    {

    }

    public function getCost()
    {
        return self::SHIPPING_COST;
    }

    public function getTotalCost()
    {
        return $this->cost->getTotalCost() + $this->getCost();
    }

    public function persianDescription()
    {
        return 'هزینه حمل و نقل';
    }

    public function getSummary()
    {
        return array_merge($this->cost->getSummary(), [$this->persianDescription() => $this->getCost()]);
    }
}

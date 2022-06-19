<?php

namespace App\Support\Cost;

use App\Support\Cost\Contracts\CostInterface;
use App\Support\Discount\DiscountManager;

class DiscountCost implements Contracts\CostInterface
{

    public function __construct(private CostInterface $cost, private DiscountManager $discountManager)
    {

    }

    public function getCost()
    {
        return $this->discountManager->calculateUserDiscount();
    }

    public function getTotalCost()
    {
        return $this->cost->getTotalCost() - $this->getCost();
    }

    public function persianDescription()
    {
        return 'میزان تخفیف';
    }

    public function getSummary()
    {
        return array_merge($this->cost->getSummary(), [$this->persianDescription() => $this->getCost()]);
    }
}

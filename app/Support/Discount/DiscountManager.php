<?php

namespace App\Support\Discount;

use App\Support\Cost\BasketCost;

class DiscountManager
{
    public function __construct(private BasketCost $basketCost, private DiscountCalculator $discountCalculator)
    {

    }

    public function calculateUserDiscount()
    {
        if(!session()->has('coupon')) return 0;

        return $this->discountCalculator->discountAmount(session()->get('coupon'),$this->basketCost->getTotalCost());

    }
}

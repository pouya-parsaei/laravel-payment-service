<?php

namespace App\Support\Discount\Coupon\Validator;

use App\Exceptions\CouponExpiredException;
use App\Models\Coupon;
use App\Support\Discount\Coupon\Validator\Contracts\AbstractCouponValidator;

class IsExpired extends AbstractCouponValidator
{
    public function validate(Coupon $coupon)
    {
        if($coupon->isExpired()){
            throw new CouponExpiredException();
        }

        return parent::validate($coupon);
    }
}

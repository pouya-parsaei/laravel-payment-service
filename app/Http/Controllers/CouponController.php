<?php

namespace App\Http\Controllers;

use App\Http\Requests\Coupon\CheckRequest;
use App\Models\Coupon;
use App\Support\Discount\Coupon\CouponValidator;

class CouponController extends Controller
{
    public function __construct(private CouponValidator $validator)
    {

    }

    public function check(CheckRequest $request)
    {
        try {
            $coupon = Coupon::where('code', $request->coupon)->firstOrFail();

            $this->validator->isValid($coupon);

            session()->put(['coupon' => $coupon]);

            return redirect()->back()->withSuccess('کد تخفیف اعمال شد');

        } catch (\Exception $e) {
            return redirect()->back()->withError('کد تخفیف نامعتبر است');
        }
    }

    public function destroy()
    {
        session()->forget('coupon');
        return back();
    }
}

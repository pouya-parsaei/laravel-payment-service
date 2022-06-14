<?php

namespace App\View\Components;

use App\Support\Basket\Basket;
use Illuminate\View\Component;

class BasketSummary extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public Basket $basket)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.basket-summary');
    }
}

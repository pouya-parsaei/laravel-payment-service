<?php

namespace App\Listeners;

use App\Events\OrderRegistered;
use App\Jobs\SendEmail;
use App\Mail\OrderDetail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendOrderDetail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\OrderRegistered  $event
     * @return void
     */
    public function handle(OrderRegistered $event)
    {
        SendEmail::dispatch($event->order->user, new OrderDetail($event->order));
    }
}

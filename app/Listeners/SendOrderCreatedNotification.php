<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Models\Admin;
use App\Notifications\OrderCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendOrderCreatedNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCreated $event): void
    {
        //send to one admin
        $admin = Admin::where('store_id' , $event->order->store_id)->first();
        $admin->notify(new OrderCreatedNotification($event->order));

        //send to multiple admins
        // $admins = Admin::where('store_id' , $event->order->store_id)->get(); // collection
        // Notification::send($admins , new OrderCreatedNotification($event->order));
    }
}

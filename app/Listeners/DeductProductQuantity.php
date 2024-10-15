<?php

namespace App\Listeners;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class DeductProductQuantity
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //if u need to use object from service contianer it will be here

    }

    /**
     * Handle the event.
     */
    public function handle($event): void
    {
        // {
        //     foreach (Cart::get() as $item) {
        //         Product::where('id', '=', $item->product_id)
        //             ->update([
        //                 'quantity' => DB::raw("quantity - {$item->quantity}")
        //             ]);
        //     }
        // }

        $order = $event->order;
        foreach ($order->products as $product) {
            $product->decrement('quantity' , $product->pivot->quantity);
        }
    }
}

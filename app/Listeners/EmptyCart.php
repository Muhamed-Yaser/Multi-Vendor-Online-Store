<?php

namespace App\Listeners;

use App\Facades\Cart as FacadesCart;
use App\Facades\Cart;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EmptyCart
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
    public function handle(): void
    {
        Cart::empty();
    }
}

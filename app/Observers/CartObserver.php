<?php

namespace App\Observers;

use App\Models\Cart;
use App\Helpers\cartHelper;


class CartObserver
{
    public function created(Cart $cart): void
    {
        
    }

    public function updated(Cart $cart): void
    {
        //
    }

    public function deleted(Cart $cart): void
    {

        // Cart products
        $cart->products()->delete();

        // Extra services
        $cart->extraServices()->delete();

        // Meta
        $cart->meta()->delete();

        // Field values
        $cart->fieldValues()->delete();

    }

    public function restored(Cart $cart): void
    {
        //
    }

    public function forceDeleted(Cart $cart): void
    {
        //
    }
}

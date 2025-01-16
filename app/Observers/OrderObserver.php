<?php

namespace App\Observers;

use App\Models\Order;
use App\Helpers\orderHelper;


class OrderObserver
{
    public function created(Order $order): void
    {
        orderHelper::SendMailOrderCreated($order);
    }

    public function updated(Order $order): void
    {
        //
    }

    public function deleted(Order $order): void
    {
        // Meta
        $order->meta()->delete();

        // Travellers
        $order->travellers()->detach();

        // Cart products
        $order->cartProducts()->delete();

        // Payments
        $order->payments()->delete();

        // History
        $order->history()->delete();

        // Extra services
        $order->extraServices()->delete();

        // Certificates
        $order->certificates()->delete();

        // Field values
        $order->fieldValues()->delete();

    }

    public function restored(Order $order): void
    {
        //
    }

    public function forceDeleted(Order $order): void
    {
        //
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\GlobalsService;

class isUserCart
{

    public function handle($request, Closure $next)
    {
        $cart = $request->cart;

        // Get carts
        $carts = GlobalsService::getCarts();

        // Check if cart exists in Cookies, it means the cart is attached to the device
        if( !isset($carts[ $request->cart ]) ) {
            abort(404);
        } 

        return $next($request);

    }

}

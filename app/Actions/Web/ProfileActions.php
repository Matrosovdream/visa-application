<?php
namespace App\Actions\Web;

use Illuminate\Support\Facades\Auth;
use App\Models\Country;
use App\Models\Product;
use App\Models\TravelDirection;
use App\Services\CurrencyConverterService;


class ProfileActions {


    public function edit($request)
    {
        return [
            'user' => $request->user()
        ];
    }

    public function update($request)
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

    }

}
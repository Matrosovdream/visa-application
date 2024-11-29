<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Metaable;
use Illuminate\Support\Str;

class Cart extends Model
{

    use Metaable;

    protected $fillable = [
        'user_id',
        'order_id',
        'session_id',
        'hash',
        'currency',
    ];

    public static function boot()
    {
        parent::boot();

        
        static::creating(function ($model) {

            // Create a unique hash for the cart
            $model->hash = Str::random(15);;
            while (Cart::where('hash', $model->hash)->exists()) {
                $model->hash = Str::random(15);;
            }

            // Set session_id from the session
            $model->session_id = session()->getId();

        });

    }

    public function products()
    {
        return $this->hasMany(CartProduct::class);
    }

    public function total()
    {
        return $this->products->sum('total');
    }

    public function meta()
    {
        return $this->hasMany(CartMeta::class);
    }

    public function totalQuantity()
    {
        return $this->products->sum('quantity');
    }

    public function totalItems()
    {
        return $this->products->count();
    }

    public function getCartBySession($sessionId)
    {
        return $this->where('session_id', $sessionId)->first();
    }

    public function getCartByCountries($countrie_from_id, $countrie_to_id)
    {
        // Search in meta table


    }

}

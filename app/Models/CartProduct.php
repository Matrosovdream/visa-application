<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{

    protected $table = 'cart_products';

    protected $fillable = [
        'cart_id',
        'order_id',
        'product_id',
        'offer_id',
        'quantity',
        'price',
        'total',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function offer()
    {
        return $this->belongsTo(ProductOffers::class);
    }

}

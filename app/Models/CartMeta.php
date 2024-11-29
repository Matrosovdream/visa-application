<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartMeta extends Model
{
    
    protected $table = "cart_meta";

    protected $fillable = [
        'cart_id',
        'key',
        'value'
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

}

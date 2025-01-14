<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartExtraService extends Model
{
    
    protected $table = 'cart_extra_services';
    protected $fillable = ['item_id', 'service_id'];
    public $timestamps = false;

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
    
    public function service()
    {
        return $this->belongsTo(ProductExtra::class);
    }

}

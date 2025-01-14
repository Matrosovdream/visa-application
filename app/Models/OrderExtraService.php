<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderExtraService extends Model
{
    
    protected $table = 'order_extra_services';
    protected $fillable = ['item_id', 'service_id'];
    public $timestamps = false;

    public function order()
    {
        return $this->belongsTo(Order::class, 'item_id');
    }
    
    public function service()
    {
        return $this->belongsTo(ProductExtras::class);
    }

}

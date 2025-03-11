<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderFieldValue extends Model
{
    
    protected $table = 'order_field_values';
    
    protected $fillable = [
        'order_id',
        'field_id',
        'value',
    ];
    
    public $timestamps = false;

    public function field()
    {
        return $this->belongsTo('App\Models\ReferenceFormField', 'field_id');
    }
    
   

}

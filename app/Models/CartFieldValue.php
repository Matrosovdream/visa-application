<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartFieldValue extends Model
{
    
    protected $table = 'cart_field_values';

    public $timestamps = false;
    
    protected $fillable = [
        'cart_id',
        'field_id',
        'value',
    ];


    
    

}

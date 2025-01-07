<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductFieldReference extends Model
{
    
    protected $table = 'product_fields_reference';

    protected $fillable = [
        'field_id',
        'product_id',
        'entity',
        'section',
        'required',
        'default_value',
        'is_email',
        'is_phone',
        'is_fullname'
    ];

    public function field()
    {
        return $this->belongsTo(OrderField::class, 'field_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}

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
        'placeholder',
        'required',
        'default_value',
        'classes',
    ];

    public function field()
    {
        return $this->belongsTo(ProductFieldReference::class, 'field_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}

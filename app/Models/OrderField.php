<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderField extends Model
{

    protected $table = 'order_fields';

    protected $fillable = [
        'title',
        'slug',
        'type',
        'placeholder',
        'tooltip',
        'description',
        'default_value',
        'reference_code',
    ];

}

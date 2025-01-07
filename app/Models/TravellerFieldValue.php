<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TravellerFieldValue extends Model
{
    
    protected $table = 'traveller_field_values';
    
    protected $fillable = [
        'traveller_id',
        'field_id',
        'value',
    ];

    // Turn off timestamps
    public $timestamps = false;

}

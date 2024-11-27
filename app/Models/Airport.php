<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{

    protected $table = "airports";
    
    protected $fillable = [
        'ref_id',
        'identity',
        'type',
        'name',
        'country_id',
        'continent',
        'iso_country',
        'iso_region',
        'municipality',
        'wiki_link',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

}

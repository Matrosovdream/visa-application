<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Airport;

class Country extends Model
{
    protected $table = 'countries';

    protected $fillable = [
        'name',
        'code',
    ];

    public function airports()
    {
        return $this->hasMany(Airport::class);
    }

    // Search
    public function scopeSearch($query, $s)
    {
        // Search in name and description, content
        if ( $s != '' ) {
            $query->where('name', 'like', '%'.$s.'%')
                ->orWhere('code', 'like', '%'.$s.'%');
        }

        return $query;
    }

}

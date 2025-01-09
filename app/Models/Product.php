<?php

namespace App\Models;

use App\Traits\Metaable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{

    use softDeletes;
    use Metaable;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'content',
        'image',
        'price'
    ];

    public function countries()
    {
        return $this->belongsToMany(Country::class, 'product_countries', 'product_id', 'country_id');
    }

    public function meta()
    {
        return $this->hasMany(ProductMeta::class);
    }

    public function offers()
    {
        return $this->hasMany(ProductOffers::class);
    }

    public function extras()
    {
        return $this->hasMany(ProductExtras::class);
    }

    public function getRequiredExtras()
    {
        return $this->extras()->where('required', 1)->get();
    }

    public function getOptionalExtras()
    {
        return $this->extras()->where('required', 0)->get();
    }
    
    public function priceFrom()
    {
        if( $this->offers()->count() == 0 ) {
            return 0;
        }
        return $this->offers()->get()->sortBy(function ($offer) {
            return $offer->price;
        })->first()->price;
    }

    // Search by fields
    public function scopeSearch($query, $s)
    {
        // Search in name and description, content
        if ( $s != '' ) {
            $query->where('name', 'like', '%'.$s.'%')
                ->orWhere('description', 'like', '%'.$s.'%')
                ->orWhere('content', 'like', '%'.$s.'%');
        }

        return $query;
    }

    // Cast a slug from name using Str::slug
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    // Format price field to 2 decimal places
    public function getPriceAttribute($value) {
        return number_format($value, 0);
    }

}

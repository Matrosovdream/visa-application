<?php

namespace App\Models;

use App\Helpers\TravellerHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Metaable;

class Traveller extends Model
{

    use Metaable;

    protected $fillable = [
        'full_name',
        'name',
        'lastname',
        'birthday',
        'passport',
    ];

    public function meta()
    {
        return $this->hasMany(TravellerMeta::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'traveller_orders');
    }

    public function documents()
    {
        return $this->hasMany(TravellerDocuments::class);
    }

    public function fieldValues()
    {
        return $this->hasMany(TravellerFieldValue::class, 'traveller_id');
    }

    public function getFieldValues()
    {
        return $this->fieldValues->pluck('value', 'field_id')->toArray();
    }

    public function isCompletedForm()
    {
        return TravellerHelper::isCompletedForm($this);
    }

    public function getFieldCategories() {
        return TravellerHelper::getTravellerFieldCategories();
    }

    public function getFieldList() {
        return TravellerHelper::getTravellerFieldList( $this->id );
    }

    // Cast full_name when the model is created
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->full_name = $model->name . ' ' . $model->lastname;
        });
    }




}

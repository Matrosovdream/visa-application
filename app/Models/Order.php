<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Helpers\orderHelper;
use App\Models\Traveller;
use App\Models\User;
use App\Models\OrderCertificate;
use App\Traits\Metaable;

class Order extends Model
{

    use Metaable;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $order->hash = Str::random(32);
        });
    }

    protected $fillable = [
        'hash',
        'user_id',
        'total_price',
        'payment_method_id',
        'status_id',
        'is_paid'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function meta()
    {
        return $this->hasMany(OrderMeta::class);
    }

    public function travellers()
    {
        return $this->belongsToMany(Traveller::class, 'traveller_orders');
    }

    public function cartProducts()
    {
        return $this->hasMany(CartProduct::class);
    }

    public function getProduct() {
        return $this->cartProducts()->first()->product;
    }

    public function getOffer() {
        return $this->cartProducts()->first()->offer;
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentGateway::class);
    }

    public function payments()
    {
        return $this->hasMany(OrderPayment::class);
    }

    public function status()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function history()
    {
        return $this->hasMany(OrderHistory::class);
    }

    public function extraServices()
    {
        return $this->hasMany(OrderExtraService::class, 'item_id');
    }

    public function getExtraServices()
    {
        $raw = $this->extraServices;

        $services = [];
        foreach( $raw as $service ) {
            $services[ $service->service_id ] = $service->service;
        }
        return $services;

    }

    public function certificates() {
        return $this->hasMany(OrderCertificate::class);
    }

    public function fieldValues() {
        return $this->hasMany(OrderFieldValue::class, 'order_id');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->whereHas('user', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
            });
        });
    }

    public function isCompletedForm()
    {
        // Check travellers
        $travellers = $this->travellers;
        foreach( $travellers as $traveller ) {
            if( !$traveller->isCompletedForm() ) {
                return false;
            }
        }
        return true;
    }

    public function setStatus($status_id) {
        $this->status_id = $status_id;
        $this->save();
    }

    public function customerFields()
    {
        
        $metafields = $this->getListCustomerFields();

        foreach( $metafields as $field ) {
            $meta = $this->meta->where('key', $field)->first();
            if( $meta ) {
                $fields[$field] = $meta->value;
            } else {
                $fields[$field] = '';
            }
        }
        return $fields;
    }

    public function getTotal()
    {

        $total = 0;
        $travellerCount = $this->getMeta('travellers_count');

        // Offer
        $total += $this->getOffer()->price * $travellerCount;

        // Fees
        $total += $this->getProduct()->getRequiredExtras()->sum('price') * $travellerCount;

        // Extra services
        $extraServices = $this->extraServices;
        foreach( $extraServices as $extraService ) {
            $total += $extraService->service->price * $travellerCount;
        }

        return $total;
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function getProgress() {
        return orderHelper::getProgress($this);
    }

    public function getCart() {
        return orderHelper::getCart($this);
    }

    public function countryFrom()
    {
        $country_id = $this->meta->where('key', 'country_from_id')->first()->value;
        return Country::find($country_id);
    }

    public function countryTo()
    {
        $country_id = $this->meta->where('key', 'country_to_id')->first()->value;
        return Country::find($country_id);
    }

    public function getListCustomerFields()
    {
        return ['full_name', 'email', 'phone', 'time_arrival'];
    }

    public static function getByHash($hash)
    {
        return static::where('hash', $hash)->first();
    }

    public static function getOrdersByUser($user_id)
    {
        return static::where('user_id', $user_id);
    }

    public static function checkUserAccess($user_id, $order_id)
    {
        return static::where('user_id', $user_id)->where('id', $order_id)->exists();
    }

    public function getTotalPriceAttribute($value) {
        return number_format($value, 0);
    }

    public function isPaid() {
        return $this->is_paid;
    }

    public function setPaid() {
        $this->is_paid = 1;
        $this->save();
    }

    public function setUnpaid() {
        $this->is_paid = 0;
        $this->save();
    }

}

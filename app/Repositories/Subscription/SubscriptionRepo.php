<?php
namespace App\Repositories\Subscription;

use App\Repositories\AbstractRepo;
use App\Models\EmailSubscription;

class SubscriptionRepo extends AbstractRepo
{

    protected $model;
    protected $fields = [];

    protected $withRelations = [];

    public function __construct() {

        $this->model = new EmailSubscription();

    }

    public function mapItem($item)
    {

        if( empty($item) ) {
            return null;
        }

        $res = [
            'id' => $item->id,
            'email' => $item->email,
            'is_subscribed' => $item->is_subscribed,
            'Model' => $item
        ];

        return $res;
    }

    public function getByEmail( $email ) {

        $item = $this->model->where('email', $email)->first();
        return $this->mapItem($item);

    }

}
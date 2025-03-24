<?php
namespace App\Actions\Web;

use App\Repositories\Subscription\SubscriptionRepo;



class SubscriptionActions
{

    protected $subRepo;

    public function __construct()
    {

        $this->subRepo = new SubscriptionRepo();

    }

    public function subscribe($email)
    {

        $exists = $this->subRepo->getByEmail( $email );

        if ($exists) {

            return [
                'status' => 'error',
                'message' => __('Email already subscribed')
            ];

        } else {

            $this->subRepo->create([
                'email' => $email,
                'is_subscribed' => 1
            ]);

            return [
                'status' => 'success',
                'message' => __('Email subscribed successfully')
            ];

        }

    }

}
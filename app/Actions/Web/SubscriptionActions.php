<?php
namespace App\Actions\Web;

use App\Repositories\Subscription\SubscriptionRepo;



class SubscriptionActions {

    protected $subRepo;

    public function __construct() {

        $this->subRepo = new SubscriptionRepo();

    }

    public function subscribe( $request ) {

       

    }

}
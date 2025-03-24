<?php
namespace App\Actions\Web;

use App\Repositories\Subscription\SubcriptionRepo;



class SubscriptionActions {

    protected $subRepo;

    public function __construct() {

        $this->subRepo = new SubcriptionRepo();

    }

    public function subscribe( $request ) {

       

    }

}
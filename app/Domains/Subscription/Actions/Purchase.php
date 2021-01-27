<?php

namespace App\Domains\Subscription\Actions;

use App\Domains\Subscription\DTO\PurchaseDto;
use App\Domains\Subscription\Services\Verification\Factory;
use App\Domains\Subscription\Services\Verification\IverificationPurchase;

class Purchase
{
    private IverificationPurchase $verificationHandler ;

    public function __construct( PurchaseDto $data)
    {

        $this->verificationHandler = Factory::create($data->os);
        dd($this->verificationHandler->verify($data->token));
//        $verificationHandler->verify
    }
}

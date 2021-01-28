<?php

namespace App\Domains\Subscription\Actions;

use App\Domains\Device\Actions\FindDeviceByToken;
use App\Domains\Device\Entities\Device;
use App\Domains\Subscription\DTO\PurchaseDto;
use App\Domains\Subscription\Entities\Subscription;
use App\Domains\Subscription\Services\Verification\Factory;
use App\Domains\Subscription\Services\Verification\IverificationPurchase;
use Carbon\Carbon;

class Purchase
{
    private IverificationPurchase $verificationHandler ;
    private Device $device;

    public function __construct(PurchaseDto $data, Subscription $subscription)
    {

        $device = app()->make(FindDeviceByToken::class,[
            'token' => $data->token
        ]);
        $this->device = $device->get();
        $this->verificationHandler = Factory::create($this->device->os);
        $response = $this->verificationHandler->verify($data->token);
        $this->createSubscription($this->device,$subscription,$response['expired_at']);
    }

    private function createSubscription(Device $device, Subscription $subscription,Carbon $expiryDate )
    {
        $subscription->fill([
          'device_id' => $this->device->id,
          'expired_at' => $expiryDate->setTimezone('UTC')
        ]);

        $subscription->saveOrFail();
    }
}


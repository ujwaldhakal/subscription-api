<?php

namespace App\Domains\Subscription\Actions;

use App\Domains\Device\Actions\FindDeviceByToken;
use App\Domains\Subscription\Entities\Subscription;

class FindSubscriptionByDeviceToken
{
    private Subscription $subscription;
    public function __construct(string $token, Subscription $subscription)
    {
        $device = app()->make(FindDeviceByToken::class,[
            'token' => $token
        ]);
        $subscription = $subscription->where('device_id',$device->get()->id)->firstOrFail();
        $this->subscription = $subscription;
    }

    public function get() {
        return $this->subscription;
    }
}

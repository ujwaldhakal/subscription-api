<?php

namespace App\Domains\Subscription\Actions;

use App\Domains\Device\Actions\FindDeviceByToken;
use App\Domains\Device\Actions\FindDeviceExceptIds;
use App\Domains\Subscription\Entities\Subscription;

class FindPendingSubscriptions
{
    private $subscription;
    public function __construct(Subscription $subscription)
    {

        $deviceIds = $subscription->groupBy('device_id')->pluck('device_id');

        $device = app()->make(FindDeviceExceptIds::class,[
            'excludeIds' => $deviceIds->toArray()
        ]);

        // now we have pending device now we can verify them in google or ios using the same re usable module
    }

    public function get() {
        return $this->subscription;
    }
}

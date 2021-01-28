<?php

namespace App\Domains\Subscription\Actions;

use App\Domains\Device\Actions\FindDeviceByToken;
use App\Domains\Device\Actions\FindDeviceExceptIds;
use App\Domains\Subscription\Entities\Subscription;

class FindPendingSubscriptions
{
    private $devices;

    public function __construct(Subscription $subscription)
    {

        $deviceIds = $subscription->groupBy('device_id')->pluck('device_id');

        $devices = app()->make(FindDeviceExceptIds::class, [
            'excludeIds' => $deviceIds->toArray()
        ]);

        $this->devices = $devices->get();
    }

    public function get()
    {
        return $this->devices;
    }
}

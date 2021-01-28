<?php

namespace App\Domains\Device\Actions;

use App\Domains\Device\Entities\Device;
use App\Domains\Device\Exceptions\InvalidDeviceToken;

class FindDeviceExceptIds
{
    private $device;

    public function __construct(array $excludeIds, Device $device)
    {
        $this->device = $device->whereNotIn('id', $excludeIds)->get();

    }

    public function get(): ?Device
    {
        return $this->device;
    }
}

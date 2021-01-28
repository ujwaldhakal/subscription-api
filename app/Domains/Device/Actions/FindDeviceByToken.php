<?php

namespace App\Domains\Device\Actions;

use App\Domains\Device\Entities\Device;
use App\Domains\Device\Exceptions\InvalidDeviceToken;

class FindDeviceByToken
{
    private Device $device;

    public function __construct(string $token, Device $device)
    {
        $device = $device->where('token', $token)->first();

        if (!$device) {
            throw new InvalidDeviceToken();
        }
        $this->device = $device;
    }

    public function get(): ?Device
    {
        return $this->device;
    }
}

<?php

namespace App\Domains\Device\Actions;

use App\Domains\Core\Crypt\Crypt;
use App\Domains\Device\DTO\RegisterDeviceDto;
use App\Domains\Device\Entities\Device;

class RegisterDevice
{
    private string $token;

    public function __construct(RegisterDeviceDto $data, Device $device)
    {
        $existingDevice = $device->where('u_id', $data->uid)->first();

//        if ($existingDevice) {
//            $this->token = $existingDevice->token;
//            return;
//        } // one can create multiple device

        $device = $this->registerDevice($data, $device);
        $this->token = $device->token;
        return;
    }

    private function registerDevice(RegisterDeviceDto $data, Device $device): Device
    {
        $token = Crypt::generateRandomString();
        $device = $device->fill([
            'token' => $token,
            'os' => $data->os,
            'app_id' => $data->appid,
            'u_id' => $data->uid
        ]);
        $device->saveOrFail();
        return $device;
    }

    public function getDeviceToken(): string
    {
        return $this->token;
    }
}

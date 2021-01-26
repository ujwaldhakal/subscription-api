<?php

namespace App\Domains\Device\Actions;

use App\Domains\Core\Crypt\Crypt;
use App\Domains\Device\DTO\RegisterDeviceDto;
use App\Domains\Device\Entities\Device;

class RegisterDevice
{
    public function __construct(RegisterDeviceDto $data, Device $device)
    {
        $existingDevice = $device->where('uID',$data->uid)->first();
        if(!$existingDevice) {
            $device->fill([
                'token' => Crypt::generateRandomString(),
                'os' => $data->os,
                'appID' => $data->appid,
                'uID' => $data->uid
            ]);
            $device->saveOrFail();
        }
    }
}

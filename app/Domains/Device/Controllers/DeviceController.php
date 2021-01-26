<?php

namespace App\Domains\Device\Controllers;

use App\Domains\Core\Response\HttpResponseTrait;
use App\Domains\Device\Actions\RegisterDevice;
use App\Domains\Device\DTO\RegisterDeviceDto;
use App\Domains\Device\Entities\Device;
use App\Domains\Device\Requests\CreateDeviceRequest;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Application;

class DeviceController extends Controller
{
    use HttpResponseTrait;

    public function register(CreateDeviceRequest $request, Application $application, Device $device)
    {
        $application->make(RegisterDevice::class, [
            'data' => new RegisterDeviceDto($request->validated()),
            'device' => $device
        ]);
        return $this->ok();
    }
}

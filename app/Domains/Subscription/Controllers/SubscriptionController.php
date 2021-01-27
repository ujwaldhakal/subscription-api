<?php

namespace App\Domains\Subscription\Controllers;

use App\Domains\Core\Response\HttpResponseTrait;
use App\Domains\Device\Actions\RegisterDevice;
use App\Domains\Subscription\Actions\FindSubscriptionByDeviceToken;
use App\Domains\Subscription\DTO\PurchaseDto;
use App\Domains\Device\DTO\RegisterDeviceDto;
use App\Domains\Device\Entities\Device;
use App\Domains\Device\Requests\CreateDeviceRequest;
use App\Domains\Subscription\Actions\Purchase;
use App\Domains\Subscription\Requests\SubscriptionPurchaseRequest;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Application;

class SubscriptionController extends Controller
{
    use HttpResponseTrait;

    public function purchase(SubscriptionPurchaseRequest $request, Application $application)
    {
        $application->make(Purchase::class, [
            'data' => new PurchaseDto($request->validated())
        ]);

        return $this->created([]);
    }

    public function check(SubscriptionPurchaseRequest $request, Application $application)
    {
        $subscription = $application->make(FindSubscriptionByDeviceToken::class, [
            'token' => $request->get('token')
        ]);

        return $this->created($subscription->get());
    }
}

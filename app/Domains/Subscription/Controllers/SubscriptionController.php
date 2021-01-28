<?php

namespace App\Domains\Subscription\Controllers;

use App\Domains\Core\Response\HttpResponseTrait;
use App\Domains\Subscription\Actions\FindSubscriptionByDeviceToken;
use App\Domains\Subscription\DTO\PurchaseDto;
use App\Domains\Subscription\Actions\Purchase;
use App\Domains\Subscription\Requests\SubscriptionPurchaseRequest;
use App\Domains\Subscription\Resources\SubscriptionResource;
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

        return new SubscriptionResource($subscription->get());
//        return $this->created(new SubscriptionResource($subscription->get()));
    }
}

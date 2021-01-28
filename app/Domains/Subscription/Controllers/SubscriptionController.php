<?php

namespace App\Domains\Subscription\Controllers;

use App\Domains\Core\Response\HttpResponseTrait;
use App\Domains\Subscription\Actions\FindSubscriptionByDeviceToken;
use App\Domains\Subscription\Actions\FindSubscriptionByType;
use App\Domains\Subscription\DTO\PurchaseDto;
use App\Domains\Subscription\Actions\Purchase;
use App\Domains\Subscription\DTO\SubscriptionByTypeDto;
use App\Domains\Subscription\Requests\SubscriptionPurchaseRequest;
use App\Domains\Subscription\Resources\SubscriptionResource;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

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
    }

    public function list(Request $request, Application $application)
    {
        $subscriptions = $application->make(FindSubscriptionByType::class, [
            'filters' => new SubscriptionByTypeDto($request->all())
        ]);

        return SubscriptionResource::collection($subscriptions->get());
    }
}

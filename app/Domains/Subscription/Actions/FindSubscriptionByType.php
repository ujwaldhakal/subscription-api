<?php


namespace App\Domains\Subscription\Actions;


use App\Domains\Subscription\DTO\SubscriptionByTypeDto;
use App\Domains\Subscription\Entities\Subscription;

class FindSubscriptionByType
{
    private $subscriptions;

    public function __construct(SubscriptionByTypeDto $filters, Subscription $subscription)
    {
        if ($filters->expired) {
//            $subscription = $subscription->expired();
        }

        if($filters->renewed) {
            $subscription = $subscription->renewed();
        }

        $this->subscriptions = $subscription->get();
    }

    public function get()
    {
        return $this->subscriptions;
    }
}

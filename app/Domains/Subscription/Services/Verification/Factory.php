<?php

namespace App\Domains\Subscription\Services\Verification;

class Factory
{
    public static function create(string $os) : IverificationPurchase
    {
        switch ($os) {
            case "ios":
                return new Ios();
            default:
                return new Android();
        }
    }
}

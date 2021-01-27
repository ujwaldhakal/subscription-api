<?php

namespace App\Domains\Subscription\Services\Verification;

class Factory
{
    public static function create(string $os) : IverificationPurchase
    {
        switch ($os) {
            case "ios":
                return new Android();
            default:
                return new Ios();
        }
    }
}

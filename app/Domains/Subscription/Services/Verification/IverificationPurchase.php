<?php

namespace App\Domains\Subscription\Services\Verification;

interface IverificationPurchase
{
    public function verify(string $token);
}

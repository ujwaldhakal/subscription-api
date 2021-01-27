<?php


namespace App\Domains\Subscription\Services\Verification;


use App\Domains\Subscription\Exceptions\VerificationFailed;
use Carbon\Carbon;

class Android implements IverificationPurchase
{
    public function verify(string $token) : array
    {
        $lastDigit = substr($token, '-1');
        if ($lastDigit % 2 == 0) {
            throw new VerificationFailed('Verification failed in android platform');
        }

        return [
            'success' => true,
            'expired_at' => Carbon::now()->addDays(5)->setTimezone('GMT')
        ];
    }
}

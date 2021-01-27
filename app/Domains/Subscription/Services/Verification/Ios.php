<?php


namespace App\Domains\Subscription\Services\Verification;


use App\Domains\Device\Actions\FindDeviceByToken;
use App\Domains\Subscription\Exceptions\VerificationFailed;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;

class Ios implements IverificationPurchase
{
    public function verify(string $token)
    {
        $lastDigit = substr($token, '-1');
        if ($lastDigit % 2 == 0) {
            throw new VerificationFailed('Verification failed in ios platform');
        }

        return [
            'success' => true,
            'expired_at' => Carbon::now()->addDays(5)->setTimezone('GMT+6')
        ];

    }
}

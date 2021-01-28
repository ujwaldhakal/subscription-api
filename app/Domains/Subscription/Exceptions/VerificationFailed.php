<?php

namespace App\Domains\Subscription\Exceptions;

use App\Exceptions\CustomException;

class VerificationFailed extends CustomException
{
    public $code = 400;
}

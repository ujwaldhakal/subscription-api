<?php

namespace App\Domains\Device\Exceptions;

use App\Exceptions\CustomException;

class InvalidDeviceToken extends CustomException
{
    public $code = 401;
    public $message = 'Invalid token';
}

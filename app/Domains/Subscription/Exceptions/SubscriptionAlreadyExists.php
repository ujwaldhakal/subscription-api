<?php


namespace App\Domains\Subscription\Exceptions;


use App\Exceptions\CustomException;

class SubscriptionAlreadyExists extends CustomException
{
    public $code= 422;
    public $message = 'Subscription already exists';
}

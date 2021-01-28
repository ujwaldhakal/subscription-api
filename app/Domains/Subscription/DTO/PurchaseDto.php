<?php

namespace App\Domains\Subscription\DTO;

use App\Domains\Core\DTO\AbstractDTO;

class PurchaseDto extends AbstractDTO
{
    public $token;
    public $os;
}

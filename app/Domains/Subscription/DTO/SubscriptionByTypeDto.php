<?php

namespace App\Domains\Subscription\DTO;

use App\Domains\Core\DTO\AbstractDTO;

class SubscriptionByTypeDto extends AbstractDTO
{
    public $expired;
    public $renewed;

}

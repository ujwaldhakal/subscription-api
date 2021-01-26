<?php

namespace App\Domains\Device\DTO;

use Illuminate\Support\Str;

class RegisterDeviceDto
{
    public $uid;
    public $os;
    public $appid;

    public function __construct(array $data)
    {
        foreach($data as $key => $value) {
            $this->{strtolower($key)} = $value;
        }
    }
}

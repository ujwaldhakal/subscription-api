<?php

namespace App\Domains\Core\DTO;

abstract class AbstractDTO
{
    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            $this->{strtolower($key)} = $value;
        }
    }
}

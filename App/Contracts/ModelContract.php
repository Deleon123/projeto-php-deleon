<?php

namespace App\Contracts;

interface ModelContract
{
    
    public function __get(string $attribute);

    public function __set(string $attribute, $value);
}

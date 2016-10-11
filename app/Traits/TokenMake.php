<?php

namespace App\Traits;

trait TokenMake
{
    public function makeToken()
    {
        return  str_random(32);
    }

}
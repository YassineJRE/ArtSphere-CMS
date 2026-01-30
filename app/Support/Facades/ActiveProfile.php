<?php

namespace App\Support\Facades;

use App\Support\Contracts\ActiveProfileInterface;
use Illuminate\Support\Facades\Facade;

class ActiveProfile extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ActiveProfileInterface::class;
    }
}

<?php

namespace App\Exceptions;

use Exception;

class ModelNotFoundException extends Exception
{
    public function __construct($model)
    {
        parent::__construct('The '.$model.' was not found.');
    }
}

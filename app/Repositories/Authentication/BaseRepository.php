<?php

namespace App\Repositories\Authentication;

use App\Enums\LogName;
use App\Repositories\BaseRepository as Repository;
use Illuminate\Database\Eloquent\Model;

class BaseRepository extends Repository
{
    protected $logName = LogName::USER;

    /**
     * get instance Model.
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    public function getModel()
    {
        return new Model();
    }
}

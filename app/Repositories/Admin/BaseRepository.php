<?php

namespace App\Repositories\Admin;

use App\Enums\LogName;
use App\Repositories\BaseRepository as Repository;
use Illuminate\Database\Eloquent\Model;

class BaseRepository extends Repository
{
    protected $logName = LogName::ADMIN;

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

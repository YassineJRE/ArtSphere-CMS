<?php

namespace App\Repositories\Web;

use App\Models\Comment;
use Exception;

class ExhibitCommentRepository extends BaseRepository
{
    /**
     * get instance Comment Model.
     *
     * @return App\Models\Comment
     */
    public function getModel()
    {
        return new Comment();
    }
}

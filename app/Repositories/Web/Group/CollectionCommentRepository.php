<?php

namespace App\Repositories\Web\Group;

use App\Models\Comment;
use App\Repositories\Web\BaseRepository;

class CollectionCommentRepository extends BaseRepository
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

<?php

namespace App\Repositories\Web\Profile;

use App\Models\Comment;
use App\Repositories\Web\BaseRepository;

class CollectionItemCommentRepository extends BaseRepository
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

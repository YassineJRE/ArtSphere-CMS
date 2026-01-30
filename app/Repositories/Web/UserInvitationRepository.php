<?php

namespace App\Repositories\Web;

use App\Models\UserInvitation;
use App\Exceptions\RepositoryException;
use Exception;

class UserInvitationRepository extends BaseRepository
{
    /**
     * get instance UserInvitation Model.
     *
     * @return App\Models\UserInvitation
     */
    public function getModel()
    {
        return new UserInvitation();
    }

    /**
     * findByToken.
     *
     * @param mixed $token
     *
     * @return App\Models\UserInvitation|null
     */
    public function findByToken(string $token): UserInvitation|null
    {
        try {
            return UserInvitation::where('token', $token)->first();
        } catch (Exception $e) {
            throw new RepositoryException($e->getMessage());
        }
    }
}

<?php

namespace App\Repositories\Web;

use App\Enums\ProfileType;
use App\Exceptions\RepositoryException;
use App\Models\User;
use App\Models\UserProfile;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class MyAccountRepository extends BaseRepository
{
    /**
     * get instance User Model.
     *
     * @return App\Models\User
     */
    public function getModel()
    {
        return new User();
    }

    /**
     * update My User.
     *
     * @param int|App\Models\User $user
     * @param array               $data    Attributes
     *
     * @return App\Models\User
     */
    public function update($user, array $data): User
    {
        try {
            if (isset($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            }

            return parent::update($user, $data);
        } catch (Exception $e) {
            throw new RepositoryException($e->getMessage());
        }
    }

    /**
     * Change password of My User.
     *
     * @param App\Models\User $user
     * @param string          $password
     *
     * @return App\Models\User
     */
    public function changePassword(User $user, string $password): User
    {
        try {
            $data['password'] = Hash::make($password);

            return parent::update($user, $data);
        } catch (Exception $e) {
            throw new RepositoryException($e->getMessage());
        }
    }
}

<?php

namespace App\Repositories\Admin;

use App\Exceptions\RepositoryException;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class MyProfileRepository extends BaseRepository
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
     * @param int|App\Models\User $profile
     * @param array               $data    Attributes
     *
     * @return App\Models\User
     */
    public function update($profile, array $data): User
    {
        try {
            if (isset($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            }

            return parent::update($profile, $data);
        } catch (Exception $e) {
            throw new RepositoryException($e->getMessage());
        }
    }

    /**
     * Change password of My User.
     *
     * @param App\Models\User $profile
     * @param string          $password
     *
     * @return App\Models\User
     */
    public function changePassword(User $profile, string $password): User
    {
        try {
            $data['password'] = Hash::make($password);

            return parent::update($profile, $data);
        } catch (Exception $e) {
            throw new RepositoryException($e->getMessage());
        }
    }
}

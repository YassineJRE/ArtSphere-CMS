<?php

namespace App\Repositories\Admin;

use App\Exceptions\RepositoryException;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class MemberRepository extends BaseRepository
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
     * create new Member.
     *
     * @param array $data Attributes
     *
     * @return App\Models\User
     */
    public function create(array $data): User
    {
        try {
            $data['password'] = Hash::make($data['password']);

            return parent::create($data);
        } catch (Exception $e) {
            throw new RepositoryException($e->getMessage());
        }
    }

    /**
     * update Member.
     *
     * @param int|App\Models\User $user
     * @param array               $data Attributes
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
     * Change password of Member.
     *
     * @param App\Models\User $user
     * @param string          $password
     *
     * @return App\Models\User
     */
    public function changePassword($user, $password): User
    {
        try {
            $data['password'] = Hash::make($password);

            return parent::update($user, $data);
        } catch (Exception $e) {
            throw new RepositoryException($e->getMessage());
        }
    }
}

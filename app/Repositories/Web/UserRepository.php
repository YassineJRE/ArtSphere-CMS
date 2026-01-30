<?php

namespace App\Repositories\Web;

use App\Exceptions\RepositoryException;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository
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
     * create new User.
     *
     * @param array $data Attributes
     *
     * @return App\Models\User
     */
    public function create(array $data): User
    {
        try {
            $user = DB::transaction(function () use ($data) {
                if (isset($data['password'])) {
                    $data['password'] = Hash::make($data['password']);
                }

                $roles = $data['roles'] ?? [];
                unset($data['roles']);
                $user = parent::create($data);
                $user->assignRole($roles);

                return $user;
            });

            return $user;
        } catch (Exception $e) {
            throw new RepositoryException($e->getMessage());
        }
    }

    /**
     * update User.
     *
     * @param int|App\Models\User $user
     * @param array               $data Attributes
     *
     * @return App\Models\User
     */
    public function update($user, array $data): User
    {
        try {
            $user = DB::transaction(function () use ($user, $data) {
                if (isset($data['password'])) {
                    $data['password'] = Hash::make($data['password']);
                }

                $roles = $data['roles'] ?? [];
                unset($data['roles']);
                $user = parent::update($user, $data);
                $user->syncRoles($roles);

                return $user;
            });

            return $user;
        } catch (Exception $e) {
            throw new RepositoryException($e->getMessage());
        }
    }
}

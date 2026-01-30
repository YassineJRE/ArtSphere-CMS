<?php

namespace App\Repositories\Authentication;

use App\Exceptions\RepositoryException;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RegisterRepository extends BaseRepository
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

                $user = parent::create($data);

                if ($user) {
                    $memberWebRole = Role::firstOrCreate([
                        'name' => 'Member',
                        'guard_name' => 'web',
                    ]);
                    $user->assignRole($memberWebRole);
                }

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

                $user = parent::update($user, $data);

                if ($user) {
                    $memberWebRole = Role::firstOrCreate([
                        'name' => 'Member',
                        'guard_name' => 'web',
                    ]);
                    $user->assignRole($memberWebRole);
                }

                return $user;
            });

            return $user;
        } catch (Exception $e) {
            throw new RepositoryException($e->getMessage());
        }
    }

    /**
     * Finalize registration. Add profile to User
     *
     * @param int|App\Models\User $user
     * @param array               $data Attributes of Profile
     *
     * @return App\Models\User
     * 
     * @throws RepositoryException
     */
    public function finalize($user, array $data): User
    {
        try {
            $user = DB::transaction(function () use ($user, $data) {
                if (is_numeric($user)) {
                    $userId = $user;
                    $user = $this->read($userId);
                }

                if ($user && !$user->hasVerifiedProfile() && isset($data['type'])) {
                    $profile = $user->profiles()->create($data);

                    if ($profile) {
                        $userRole = Role::firstOrCreate([
                            'name' => $profile->type,
                            'guard_name' => 'web',
                        ]);
                        $user->assignRole($userRole);
                        
                        $profileRole = Role::firstOrCreate([
                            'name' => $profile->type,
                            'guard_name' => 'profiles',
                        ]);
                        $profile->assignRole($profileRole);
                    }
                    
                    return parent::update($user, [
                        'pronoun' => $data['pronoun'] ?? NULL,
                        'address' => $data['address'] ?? NULL,
                        'city' => $data['city'] ?? NULL,
                        'country' => $data['country'] ?? NULL,
                        'ethnicity' => $data['ethnicity'] ?? NULL,
                    ]);
                }
                
                return $user;
            });

            return $user;
        } catch (Exception $e) {
            throw new RepositoryException($e->getMessage());
        }
    }
}

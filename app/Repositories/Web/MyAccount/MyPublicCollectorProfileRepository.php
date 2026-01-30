<?php

namespace App\Repositories\Web\MyAccount;

use App\Enums\ProfileType;
use App\Exceptions\RepositoryException;
use App\Models\UserProfile;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Repositories\Web\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class MyPublicCollectorProfileRepository extends BaseRepository
{
    /**
     * get instance UserProfile Model.
     *
     * @return App\Models\UserProfile
     */
    public function getModel()
    {
        return new UserProfile();
    }

    /**
     * create new UserProfile.
     *
     * @param array $data Attributes
     *
     * @return App\Models\UserProfile
     */
    public function create(array $data): UserProfile
    {
        try {
            $profile = DB::transaction(function () use ($data) {
                $user = Auth::user();
                $data['type'] = ProfileType::PUBLIC_COLLECTOR;

                if ($user && !$user->hasProfilePublicCollector()) {
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
                    
                    return $profile;
                }

                return $this->update($user->profilePublicCollector(), $data);                 
            });

            return $profile;
        } catch (Exception $e) {
            throw new RepositoryException($e->getMessage());
        }
    }
}

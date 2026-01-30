<?php

namespace App\Repositories\Web\MyProfile;

use App\Enums\MemberType as EnumMemberType;
use App\Enums\GroupType as EnumGroupType;
use App\Enums\Status as EnumStatus;
use App\Exceptions\RepositoryException;
use App\Models\Group;
use App\Models\UserProfile;
use App\Models\UserHasGroup;
use App\Repositories\Web\BaseRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MyArtistRunCenterGalleryRepository extends BaseRepository
{
    /**
     * get instance Group Model.
     *
     * @return App\Models\Group
     */
    public function getModel()
    {
        return new Group();
    }

    /**
     * create new Group.
     *
     * @param array $data Attributes
     *
     * @return App\Models\Group
     */
    public function create(array $data): Group
    {
        try {
            $group = DB::transaction(function () use ($data) {
                if (isset($data['profile']) && $data['profile'] instanceof UserProfile) {
                    $profile = $data['profile'];
                    unset($data['profile']);
                    $data['type'] = EnumGroupType::ARTIST_RUN_CENTER_ORG;
                    $data['status'] = EnumStatus::DISABLED;
                    $group = parent::create($data);
    
                    if ($group && $profile) {
                        UserHasGroup::create([
                            'user_id' => $profile->user_id,
                            'user_profile_id' => $profile->id,
                            'group_id' => $group->id,
                            'role' => EnumMemberType::ADMINISTRATOR,
                        ]);
                    }
    
                    return $group;
                }

                throw new RepositoryException('Missing profile in data');
            });

            return $group;
        } catch (Exception $e) {
            throw new RepositoryException($e->getMessage());
        }
    }
    public function createTemp(array $data): Group {
        try {
            $group = DB::transaction(function () use ($data) {
                if(isset($data['profile'])){unset($data['profile']);}
                $data['type'] = EnumGroupType::ARTIST_RUN_CENTER_ORG;
                $data['status'] = EnumStatus::DRAFT;
                $group = parent::create($data);

                return $group;
            });

            return $group;
        } catch (Exception $e) {
            throw new RepositoryException($e->getMessage());
        }
    }
}

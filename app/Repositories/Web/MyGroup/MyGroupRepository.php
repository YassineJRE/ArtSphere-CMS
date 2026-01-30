<?php

namespace App\Repositories\Web\MyGroup;

use App\Enums\MemberType as EnumMemberType;
use App\Enums\GroupType as EnumGroupType;
use App\Exceptions\RepositoryException;
use App\Models\Group;
use App\Models\UserHasGroup;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Repositories\Web\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class MyGroupRepository extends BaseRepository
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
                $user = Auth::user();
                $data['type'] = EnumGroupType::ARTIST;
                $group = parent::create($data);

                if ($group && $user && $user->hasProfileArtist()) {
                    UserHasGroup::create([
                        'user_id' => $user->id,
                        'user_profile_id' => $user->profileArtist()->id,
                        'group_id' => $group->id,
                        'role' => EnumMemberType::ADMINISTRATOR,
                    ]);
                }

                return $group;
            });

            return $group;
        } catch (Exception $e) {
            throw new RepositoryException($e->getMessage());
        }
    }
	
	//GALLERY INVITATION FEATURE
	public function updateUserProfileGallery($data, $groupId, $userId)
{
		try {
			$group = DB::transaction(function () use ($data, $groupId, $userId) {
				$user = Auth::user();

				$data['type'] = EnumGroupType::ARTIST;

				UserHasGroup::where('group_id', $groupId)
					->update([
						'user_profile_id' => $userId,
						'role' => EnumMemberType::ADMINISTRATOR,
					]);

				return true;
			});

        return $group;
		} catch (Exception $e) {
			throw new RepositoryException($e->getMessage());
		}
	}

}

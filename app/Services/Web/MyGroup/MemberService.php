<?php

namespace App\Services\Web\MyGroup;

use Exception;
use App\Enums\ProfileType as EnumProfileType;
use App\Enums\GroupType as EnumGroupType;
use App\Exceptions\RepositoryException;
use App\Exceptions\ServiceException;
use App\Events\Web\InvitationWasCreated;
use App\Http\Requests\Web\IndexRequest;
use App\Models\Group;
use App\Models\UserProfile;
use App\Models\UserInvitation;
use App\Services\BaseService;
use App\Repositories\Web\MyGroup\MemberRepository;
use App\Repositories\Web\UserInvitationRepository;
use App\Http\Requests\Web\MyGroup\Member\InviteRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class MemberService extends BaseService
{
    /**
     * invitationRepo.
     *
     * @var mixed
     */
    private $invitationRepo;

    public function __construct(MemberRepository $repository, UserInvitationRepository $invitationRepo)
    {
        $this->repository = $repository;
        $this->invitationRepo = $invitationRepo;
    }

    public function index(Request $request): ResourceCollection
    {
        return collect([]);
    }

    public function setFilter(IndexRequest $request, Builder $query): void
    {
        $this->filter = [
        ];
    }

    /**
     * Invite someone to artolog.
     *
     * @param array $data Attributes of UserInvitation
     *
     * @return App\Models\UserInvitation
     *
     * @throws ServiceException
     */
    public function processInvite(array $data): UserInvitation
    {
        try {
			
            $invitation = $this->invitationRepo->create($data);

            event(new InvitationWasCreated($invitation));

            return $invitation;
        } catch (Exception $e) {
            throw new ServiceException($e->getMessage());
        }
    }

    /**
     * Display list of Profiles from Group Type
     *
     * @param App\Models\Group $myGroup
     *
     * @return Illuminate\Support\Collection Array<UserProfile>
     */
    public static function getListProfiles(Group $group): Collection
    {
        switch ($group->type) {
            case EnumGroupType::CURATOR :
                $type = EnumProfileType::CURATOR;
                break;

            case EnumGroupType::ARTIST :
            case EnumGroupType::ARTIST_RUN_CENTER_ORG :
            default:
                $type = EnumProfileType::ARTIST;
                break;            
        }

        $selectedOptionValuesID = UserProfile::join('users', 'users.id', '=', 'user_profiles.user_id')
            ->whereNotNull('user_profiles.artist_name')
            ->whereNotIn('user_profiles.id', $group->members->pluck('user_profile_id'))
            ->where('user_profiles.type', $type)
            ->orderBy('users.first_name')
            ->orderBy('users.last_name')
            ->orderBy('user_profiles.artist_name')
            ->pluck('user_profiles.id')
            ->toArray();

        if (count($selectedOptionValuesID) > 0) {
            $selectedOptionValuesIDSort = implode(',',$selectedOptionValuesID);

            return UserProfile::whereIn('id',$selectedOptionValuesID)
                ->orderByRaw(DB::raw("FIELD(id, $selectedOptionValuesIDSort)"))->get();
        }

        return collect([]);
    }
}

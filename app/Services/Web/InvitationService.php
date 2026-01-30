<?php

namespace App\Services\Web;

use App\Repositories\Web\MyProfile\MyArtistRunCenterGalleryRepository;
use App\Repositories\Web\MyProfile\MyProfileRepository;
use Exception;
use App\Exceptions\ServiceException;
use App\Http\Requests\Web\IndexRequest;
use App\Enums\Status as EnumStatus;
use App\Models\User;
use App\Models\UserInvitation;
use App\Models\Group;
use App\Models\UserProfile;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Repositories\Web\UserInvitationRepository;
use App\Repositories\Web\UserRepository;
use App\Events\Web\UserWasRegistered;
use Carbon\Carbon;
use Illuminate\Support\Str;


class InvitationService extends BaseService
{
    /**
     * userRepo.
     *
     * @var mixed
     */
    private $userRepo;
    /**
     * galleryRepo.
     *
     * @var mixed
     */
    private $galleryRepo;
    private $profileRepo;

    public function __construct(UserInvitationRepository $repository, UserRepository $userRepo, MyArtistRunCenterGalleryRepository $galleryRepo)
    {
        $this->repository = $repository;
        $this->userRepo = $userRepo;
        $this->galleryRepo = $galleryRepo;
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
     * findByToken.
     *
     * @param string $token UserInvitation's token
     *
     * @return App\Models\UserInvitation|null
     *
     * @throws ServiceException
     */
    public function findByToken(string $token): UserInvitation|null
    {
        try {
            return $this->repository->findByToken($token);
        } catch (Exception $e) {
            throw new ServiceException($e->getMessage());
        }
    }    

    /**
     * Store a newly created resource in storage.
     *
     * @param array $data Attributes of User
     * @param App\Models\UserInvitation $invitation Invitation
     *
     * @return App\Models\User
     *
     * @throws ServiceException
     */
    public function register(array $data, UserInvitation $invitation): User
    {
        try {
            $user = $this->userRepo->create($data);
            $user->forceFill([
                'email_verified_at' => Carbon::now(),
                'email_verification_token' => '',
                'status' => EnumStatus::ENABLED,
            ])
            ->setRememberToken(Str::random(60));
            $user->save();
            $user = $this->userRepo->read($user->id);

            $invitation->forceFill([
                'guest_id' => $user->id,
                'token' => '',
            ]);
            $invitation->save();

            event(new UserWasRegistered($user));

            return $user;
        } catch (Exception $e) {
            throw new ServiceException($e->getMessage());
        }
    }
     /**
     * creates a gallery.
     *
     * @param array $data Attributes of User
     *
     * @return App\Models\Group
     *
     * @throws ServiceException
     */
    public function createGallery(array $data): Group {
        return $this->galleryRepo->createTemp($data);
    }
}

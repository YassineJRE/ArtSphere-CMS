<?php

namespace App\Services\Web\MyGroup;

use App\Models\Exhibit;
use App\Models\UserInvitation;
use App\Exceptions\RepositoryException;
use App\Exceptions\ServiceException;
use App\Events\Web\InvitationWasCreated;
use App\Events\Web\ExhibitWasTransferredToArtist;
use App\Http\Requests\Web\IndexRequest;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Repositories\Web\MyGroup\MyExhibitRepository;
use App\Repositories\Web\UserInvitationRepository;


class MyExhibitService extends BaseService
{
    /**
     * invitationRepo.
     *
     * @var mixed
     */
    private $invitationRepo;

    public function __construct(MyExhibitRepository $repository, UserInvitationRepository $invitationRepo)
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
     * Transfer to Artist Profile
     *
     * @param App\Models\Exhibit $exhibit
     * @param array              $data  Atributes of Exhibit
     *
     * @return App\Models\Exhibit
     *
     * @throws ServiceException
     */
    public function transferTo(Exhibit $exhibit, array $data): Exhibit
    {
        try {
            $exhibit = $this->repository->transferTo($exhibit, $data);

            event(new ExhibitWasTransferredToArtist($exhibit));

            return $exhibit;
        } catch (Exception $e) {
            throw new ServiceException($e->getMessage());
        }
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
     * Change position
     *
     * @param App\Models\Exhibit $exhibit
     * @param int              $position  New position
     *
     * @return App\Models\Exhibit
     *
     * @throws ServiceException
     */
    public function changePosition(Exhibit $exhibit, int $position): Exhibit
    {
        try {
            return $this->repository->changePosition($exhibit, $position);
        } catch (Exception $e) {
            throw new ServiceException($e->getMessage());
        }
    }
}

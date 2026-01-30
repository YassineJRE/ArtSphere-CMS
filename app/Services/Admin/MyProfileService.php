<?php

namespace App\Services\Admin;

use App\Exceptions\RepositoryException;
use App\Exceptions\ServiceException;
use App\Http\Requests\Web\IndexRequest;
use App\Models\User;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Repositories\Admin\MyProfileRepository;

class MyProfileService extends BaseService
{
    public function __construct(MyProfileRepository $repository)
    {
        $this->repository = $repository;
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
     * Update details of my profile.
     *
     * @return App\Models\User
     */
    public function updateDetails(User $user, array $data): User
    {
        try {
            return $this->repository->update($user, $data);
        } catch (RepositoryException $e) {
            throw new ServiceException($e->getMessage());
        }
    }

    /**
     * Change my password of my profile.
     *
     * @param App\Models\User
     */
    public function changePassword(User $user, string $password): User
    {
        try {
            return $this->repository->changePassword($user, $password);
        } catch (RepositoryException $e) {
            throw new ServiceException($e->getMessage());
        }
    }
}

<?php

namespace App\Services\Web\MyProfile;

use App\Exceptions\RepositoryException;
use App\Exceptions\ServiceException;
use App\Http\Requests\Web\IndexRequest;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Repositories\Web\MyProfile\MyCollectionRepository;
use App\Models\Collection;

class MyCollectionService extends BaseService
{
    public function __construct(MyCollectionRepository $repository)
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
     * Change position
     *
     * @param App\Models\Collection $collection
     * @param int              $position  New position
     *
     * @return App\Models\Collection
     *
     * @throws ServiceException
     */
    public function changePosition(Collection $collection, int $position): Collection
    {
        try {
            return $this->repository->changePosition($collection, $position);
        } catch (Exception $e) {
            throw new ServiceException($e->getMessage());
        }
    } 
}

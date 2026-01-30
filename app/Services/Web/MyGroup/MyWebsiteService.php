<?php

namespace App\Services\Web\MyGroup;

use App\Exceptions\RepositoryException;
use App\Exceptions\ServiceException;
use App\Http\Requests\Web\IndexRequest;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Repositories\Web\MyGroup\MyWebsiteRepository;
use App\Models\Website;

class MyWebsiteService extends BaseService
{
    public function __construct(MyWebsiteRepository $repository)
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
     * @param App\Models\Website $website
     * @param int              $position  New position
     *
     * @return App\Models\Website
     *
     * @throws ServiceException
     */
    public function changePosition(Website $website, int $position): Website
    {
        try {
            return $this->repository->changePosition($website, $position);
        } catch (Exception $e) {
            throw new ServiceException($e->getMessage());
        }
    }      
}

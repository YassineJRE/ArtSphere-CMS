<?php

namespace App\Services\Web\MyGroup;

use App\Exceptions\RepositoryException;
use App\Exceptions\ServiceException;
use App\Http\Requests\Web\IndexRequest;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Repositories\Web\MyGroup\MyWebsiteGroupRepository;
use App\Models\WebsiteGroup;

class MyWebsiteGroupService extends BaseService
{
    public function __construct(MyWebsiteGroupRepository $repository)
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
     * @param App\Models\WebsiteGroup $websiteGroup
     * @param int              $position  New position
     *
     * @return App\Models\WebsiteGroup
     *
     * @throws ServiceException
     */
    public function changePosition(WebsiteGroup $websiteGroup, int $position): WebsiteGroup
    {
        try {
            return $this->repository->changePosition($websiteGroup, $position);
        } catch (Exception $e) {
            throw new ServiceException($e->getMessage());
        }
    }
}

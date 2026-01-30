<?php

namespace App\Services\Web\MyGroup;

use App\Exceptions\RepositoryException;
use App\Exceptions\ServiceException;
use App\Http\Requests\Web\IndexRequest;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Repositories\Web\MyGroup\MyCollectionItemRepository;
use App\Models\CollectionItem;

class MyCollectionItemService extends BaseService
{
    public function __construct(MyCollectionItemRepository $repository)
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
     * @param App\Models\CollectionItem $item
     * @param int              $position  New position
     *
     * @return App\Models\CollectionItem
     *
     * @throws ServiceException
     */
    public function changePosition(CollectionItem $item, int $position): CollectionItem
    {
        try {
            return $this->repository->changePosition($item, $position);
        } catch (Exception $e) {
            throw new ServiceException($e->getMessage());
        }
    }    
}

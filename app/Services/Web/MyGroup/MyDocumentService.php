<?php

namespace App\Services\Web\MyGroup;

use App\Exceptions\RepositoryException;
use App\Exceptions\ServiceException;
use App\Http\Requests\Web\IndexRequest;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Repositories\Web\MyGroup\MyDocumentRepository;
use App\Models\Document;

class MyDocumentService extends BaseService
{
    public function __construct(MyDocumentRepository $repository)
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
     * @param App\Models\Document $document
     * @param int              $position  New position
     *
     * @return App\Models\Document
     *
     * @throws ServiceException
     */
    public function changePosition(Document $document, int $position): Document
    {
        try {
            return $this->repository->changePosition($document, $position);
        } catch (Exception $e) {
            throw new ServiceException($e->getMessage());
        }
    }
}

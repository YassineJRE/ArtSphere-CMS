<?php

namespace App\Services\Web\MyProfile;

use App\Models\Artwork;
use App\Exceptions\RepositoryException;
use App\Exceptions\ServiceException;
use App\Http\Requests\Web\IndexRequest;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Repositories\Web\MyProfile\MyArtworkRepository;

class MyArtworkService extends BaseService
{
    public function __construct(MyArtworkRepository $repository)
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
     * Transfer to another Exhibit
     *
     * @param App\Models\Artwork $artwork
     * @param array              $data  Atributes of Artwork
     *
     * @return App\Models\Artwork
     *
     * @throws ServiceException
     */
    public function transferTo(Artwork $artwork, array $data): Artwork
    {
        try {
            return $this->repository->transferTo($artwork, $data);
        } catch (Exception $e) {
            throw new ServiceException($e->getMessage());
        }
    }

    /**
     * Change position
     *
     * @param App\Models\Artwork $artwork
     * @param int              $position  New position
     *
     * @return App\Models\Artwork
     *
     * @throws ServiceException
     */
    public function changePosition(Artwork $artwork, int $position): Artwork
    {
        try {
            return $this->repository->changePosition($artwork, $position);
        } catch (Exception $e) {
            throw new ServiceException($e->getMessage());
        }
    }
}

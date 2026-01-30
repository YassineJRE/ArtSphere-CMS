<?php

namespace App\Services;

use App\Exceptions\ModelNotFoundException;
use App\Exceptions\ServiceException;
use App\Http\Requests\Web\IndexRequest;
use App\Services\Traits\DatatableParams;
use App\Services\Traits\DatatableTrait;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseService
{
    use DatatableTrait;

    /**
     * Filter of Search.
     *
     * @var array
     */
    protected $filter;

    /**
     * Sorting of Search.
     *
     * @var array
     */
    protected $sorting;

    /**
     * Params of Datatable.
     *
     * @var App\Services\Traits\DatatableParams
     */
    protected $dtParams;

    /**
     * repository.
     *
     * @var mixed
     */
    protected $repository;

    /**
     * dt_withTrashed. Including Soft Deleted Models.
     *
     * @var bool
     */
    protected $dt_withTrashed = false;

    /**
     * index.
     *
     * @param App\Http\Requests\Web\IndexRequest $request
     *
     * @return Illuminate\Http\Resources\Json\ResourceCollection
     */
    abstract protected function index(IndexRequest $request): object;

    /**
     * setFilter.
     *
     * @param Illuminate\Database\Eloquent\Builder $query
     * @param App\Http\Requests\Web\IndexRequest   $request
     */
    abstract protected function setFilter(IndexRequest $request, Builder $query): void;

    public function __construct()
    {
        $this->dtParams = new DatatableParams();
        $this->dtParams->columnsSearcheable = $this->dt_columnsSearcheable;
        $this->dtParams->with = $this->dt_with;
        $this->dtParams->queries = $this->dt_queries;
        $this->dtParams->urlParamsAccepted = $this->dt_urlParamsAccepted;
        $this->dtParams->withTrashed = $this->dt_withTrashed;
    }

    /**
     * getFilter.
     *
     * @return Illuminate\Database\Eloquent\Collection Filter of Search
     */
    public function getFilter(): Collection
    {
        return $this->filter;
    }

    /**
     * setSorting.
     */
    protected function setSorting(): void
    {
    }

    /**
     * getSorting.
     *
     * @return Illuminate\Database\Eloquent\Collection Sorting of Search
     */
    public function getSorting(): Collection
    {
        return $this->sorting;
    }

    /**
     * Show the specified resource.
     *
     * @param int|Illuminate\Database\Eloquent\Model $model
     *
     * @return Illuminate\Database\Eloquent\Model
     *
     * @throws ServiceException
     */
    public function show(Model|int $model): Model
    {
        try {
            if (is_numeric($model)) {
                $modelId = $model;
                $model = $this->repository->read($modelId);
            }

            if (!$model instanceof Model) {
                throw new ModelNotFoundException($model);
            }

            return $model;
        } catch (Exception $e) {
            throw new ServiceException($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param array $data Attributes of Model
     *
     * @return Illuminate\Database\Eloquent\Model
     *
     * @throws ServiceException
     */
    public function store(array $data): Model
    {
        try {
            return $this->repository->create($data);
        } catch (Exception $e) {
            throw new ServiceException($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Illuminate\Database\Eloquent\Model $model
     * @param array                              $data  Atributes of Model
     *
     * @return Illuminate\Database\Eloquent\Model
     *
     * @throws ServiceException
     */
    public function update(Model $model, array $data): Model
    {
        try {
            return $this->repository->update($model, $data);
        } catch (Exception $e) {
            throw new ServiceException($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int|Illuminate\Database\Eloquent\Model $model
     *
     * @return bool TRUE if it's deleted
     *
     * @throws ServiceException
     */
    public function destroy(Model|int $model): bool
    {
        try {
            return $this->repository->delete($model);
        } catch (Exception $e) {
            throw new ServiceException($e->getMessage());
        }
    }

    /**
     * Restore the specified resource in storage.
     *
     * @param int|Illuminate\Database\Eloquent\Model $model
     *
     * @return Illuminate\Database\Eloquent\Model
     *
     * @throws ServiceException
     */
    public function restore(Model|int $model): Model
    {
        try {
            return $this->repository->restore($model);
        } catch (Exception $e) {
            throw new ServiceException($e->getMessage());
        }
    }

    /**
     * Toggle status enable the specified resource from storage.
     *
     * @param Illuminate\Database\Eloquent\Model $model
     *
     * @return Illuminate\Database\Eloquent\Model
     *
     * @throws ServiceException
     */
    public function toggleEnable(Model|int $model): Model
    {
        try {
            return $this->repository->toggleEnable($model);
        } catch (Exception $e) {
            throw new ServiceException($e->getMessage());
        }
    }
}

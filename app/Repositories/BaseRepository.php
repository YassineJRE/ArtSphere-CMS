<?php

namespace App\Repositories;

use App\Enums\LogName;
use App\Enums\Status as EnumStatus;
use App\Exceptions\ModelNotFoundException;
use App\Exceptions\RepositoryException;
use App\Services\Traits\DatatableParams;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

abstract class BaseRepository
{
    protected $model;

    protected $logName = LogName::DEFAULT;

    abstract protected function getModel();

    final public function __construct()
    {
        $this->model = $this->getModel();
        $this->model->logName = $this->logName;
    }

    /**
     * get rows of Model.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function get(): Collection
    {
        return $this->model->get();
    }

    /**
     * Returns a specific object by $id. throws exception if not found!
     *
     * @param int $id The object ID
     *
     * @return Illuminate\Database\Eloquent\Model
     *
     * @throws RepositoryException
     */
    public function read(int $id): Model
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new RepositoryException($e->getMessage());
        } catch (Exception $e) {
            throw new RepositoryException($e->getMessage());
        }
    }

    /**
     * insert row in table of Model.
     *
     * @param array $data Attributes of Model
     *
     * @return Illuminate\Database\Eloquent\Model
     *
     * @throws RepositoryException
     */
    public function create(array $data): Model
    {
        try {
            $data = $this->snake_keys($data);
            $this->model->fill($data)->save();

            return $this->model;
        } catch (Exception $e) {
            throw new RepositoryException($e->getMessage());
        }
    }

    /**
     * insert many rows in table of Model.
     *
     * @param array $data Atributes of Models
     *
     * @return void
     */
    public function insert(array $data)
    {
        try {
            return $this->model->insert($data);
        } catch (Exception $e) {
            throw new RepositoryException($e->getMessage());
        }
    }

    /**
     * update Model.
     *
     * @param int|Illuminate\Database\Eloquent\Model $model
     * @param array                                  $data  Attributes of Model
     *
     * @return Illuminate\Database\Eloquent\Model
     *
     * @throws RepositoryException
     */
    public function update(Model|int $model, array $data): Model
    {
        try {
            if (is_numeric($model)) {
                $modelId = $model;
                $model = $this->read($modelId);
            }

            if (!$model instanceof Model) {
                throw new ModelNotFoundException($model);
            }

            $model->logName = $this->logName;

            $data = $this->snake_keys($data);
            $model->update($data);

            return $model;
        } catch (ModelNotFoundException $e) {
            throw new RepositoryException($e->getMessage());
        } catch (Exception $e) {
            throw new RepositoryException($e->getMessage());
        }
    }

    /**
     * delete Model.
     *
     * @param int|Illuminate\Database\Eloquent\Model $model
     *
     * @return bool TRUE if deleted
     *
     * @throws RepositoryException
     */
    public function delete(Model|int $model): bool
    {
        try {
            if (is_numeric($model)) {
                $modelId = $model;
                $model = $this->read($modelId);
            }

            if (!$model instanceof Model) {
                throw new ModelNotFoundException($model);
            }

            $model->logName = $this->logName;

            return $model->delete();
        } catch (ModelNotFoundException $e) {
            throw new RepositoryException($e->getMessage());
        } catch (Exception $e) {
            throw new RepositoryException($e->getMessage());
        }
    }

    /**
     * restore Model.
     *
     * @param int|Illuminate\Database\Eloquent\Model $model
     *
     * @return Illuminate\Database\Eloquent\Model
     *
     * @throws RepositoryException
     */
    public function restore(Model|int $model): Model
    {
        try {
            if (is_numeric($model)) {
                $modelId = $model;
                $model = $this->read($modelId);
            }

            if (!$model instanceof Model) {
                throw new ModelNotFoundException($model);
            }

            $model->logName = $this->logName;
            $model->restore();

            return $model;
        } catch (ModelNotFoundException $e) {
            throw new RepositoryException($e->getMessage());
        } catch (Exception $e) {
            throw new RepositoryException($e->getMessage());
        }
    }

    /**
     * Toggle status Model.
     *
     * @param int|Illuminate\Database\Eloquent\Model $model
     *
     * @return Illuminate\Database\Eloquent\Model
     *
     * @throws RepositoryException
     */
    public function toggleEnable(Model|int $model): Model
    {
        try {
            if (is_numeric($model)) {
                $modelId = $model;
                $model = $this->read($modelId);
            }

            if (!$model instanceof Model) {
                throw new ModelNotFoundException($model);
            }

            $model->logName = $this->logName;

            return $this->update($model, [
                'status' => $model->isEnabled() ? EnumStatus::DISABLED : EnumStatus::ENABLED,
            ]);
        } catch (ModelNotFoundException $e) {
            throw new RepositoryException($e->getMessage());
        } catch (Exception $e) {
            throw new RepositoryException($e->getMessage());
        }
    }

    /**
     * Returns all the objects for the main model.
     *
     * @param array  $with    Relationship's Models
     * @param array  $options Array of options to cutomize the search
     * @param array  $orderBy array of field names to order the result set by
     * @param string $order   asc|desc
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function index(array $with = [], array $options = [], array $orderBy = [], string $order = 'asc'): Collection
    {
        $query = $this->model->query();

        if (!empty($options)) {
            $query->where($options);
        }

        if (!empty($orderBy)) {
            $query->orderBy(implode(',', $orderBy), $order);
        }

        if (!empty($with)) {
            $query->with($with);
        }

        DB::enableQueryLog();
        $results = $query->get();
        DB::disableQueryLog();

        return $results;
    }

    /**
     * Returns all the objects for the main model.
     *
     * @param string $route   Route name
     * @param array  $with    Relationship's Models
     * @param array  $options Array of options to cutomize the search
     * @param array  $orderBy array of field names to order the result set by
     * @param string $order   asc|desc
     *
     * @return Illuminate\Database\Eloquent\Collection
     *
     * @throws RepositoryException
     */
    public function indexPaged(string $route = 'javascript:;', array $with = [], array $options = [], array $orderBy = [], string $order = 'asc', int $paginate = 10, int $page = 1): object
    {
        try {
            $query = $this->model->query();

            if (!empty($options)) {
                $query->where($options);
            }

            if (!empty($orderBy)) {
                $query->orderBy(implode(',', $orderBy), $order);
            }

            if (!empty($with)) {
                $query->with($with);
            }

            DB::enableQueryLog();
            $results = $query->paginate($paginate, ['*'], 'page', $page)
                ->setPath($route);
            DB::disableQueryLog();

            return $results;
        } catch (Exception $e) {
            throw new RepositoryException($e->getMessage());
        }
    }

    /**
     * Get records of Datatable.
     *
     * @param App\Services\Traits\DatatableParams $params
     *
     * @return Illuminate\Database\Eloquent\Collection;
     *
     * @throws RepositoryException
     */
    public function dt_records(DatatableParams $params): Collection
    {
        try {
            $query = $this->model->query();

            if ($params->hasWith()) {
                $query->with($params->with);
            }

            if ($params->withTrashed()) {
                $query->withTrashed();
            }

            if ($params->hasQueries()) {
                $query->where($params->queries);
            }

            if ($params->hasSearchValue()) {
                $query->where(function ($q) use ($params) {
                    foreach ($params->columnsSearcheable as $columnName) {
                        $q->orWhere($columnName, 'like', '%'.$params->searchValue.'%');
                    }
                });
            }

            if ($params->hasOrderBy()) {
                $query->orderBy($params->orderBy, $params->order);
            }

            DB::enableQueryLog();
            $results = $query->skip($params->start)
                            ->take($params->length)
                            ->get();
            DB::disableQueryLog();

            return $results;
        } catch (Exception $e) {
            throw new RepositoryException($e->getMessage());
        }
    }

    /**
     * Get total records of Datatable.
     *
     * @param App\Services\Traits\DatatableParams $params
     *
     * @return int Total Records
     *
     * @throws RepositoryException
     */
    public function dt_totalRecords(DatatableParams $params): int
    {
        try {
            $query = $this->model->query();

            if ($params->hasWith()) {
                $query->with($params->with);
            }

            if ($params->withTrashed()) {
                $query->withTrashed();
            }

            DB::enableQueryLog();
            $results = $query->count();
            DB::disableQueryLog();

            return $results;
        } catch (Exception $e) {
            throw new RepositoryException($e->getMessage());
        }
    }

    /**
     * Get total records with filter of Datatable.
     *
     * @param App\Services\Traits\DatatableParams $params
     *
     * @return int Total Records with Filter
     *
     * @throws RepositoryException
     */
    public function dt_totalRecordsWithFilter(DatatableParams $params): int
    {
        try {
            $query = $this->model->query();

            if ($params->hasWith()) {
                $query->with($params->with);
            }

            if ($params->withTrashed()) {
                $query->withTrashed();
            }

            if ($params->hasQueries()) {
                $query->where($params->queries);
            }

            if ($params->hasSearchValue()) {
                $query->where(function ($q) use ($params) {
                    foreach ($params->columnsSearcheable as $columnName) {
                        $q->orWhere($columnName, 'like', '%'.$params->searchValue.'%');
                    }
                });
            }

            DB::enableQueryLog();
            $results = $query->count();
            DB::disableQueryLog();

            return $results;
        } catch (Exception $e) {
            throw new RepositoryException($e->getMessage());
        }
    }

    /**
     * Convert array keys to snake case recursively.
     *
     * @param array  $array     Array
     * @param string $delimiter Delimiter
     */
    public function snake_keys(array $array, string $delimiter = '_'): array
    {
        $result = [];
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $value = $this->snake_keys($value, $delimiter);
            }
            $result[Str::snake($key, $delimiter)] = $value;
        }

        return $result;
    }

    /**
     * Convert array keys to camel case recursively.
     *
     * @param array $array Array
     */
    public function camel_keys(array $array): array
    {
        $result = [];
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $value = $this->camel_keys($value);
            }
            $result[Str::camel($key)] = $value;
        }

        return $result;
    }
}

<?php

namespace App\Services\Traits;

use App\Exceptions\ServiceException;
use Exception;
use App\Http\Requests\Admin\DatatableRequest;

class DatatableParams
{
    /**
     * draw.
     *
     * @var int
     */
    public $draw;

    /**
     * start.
     *
     * @var int
     */
    public $start;

    /**
     * length.
     *
     * @var int
     */
    public $length;

    /**
     * orderBy.
     *
     * @var string
     */
    public $orderBy;

    /**
     * order [asc|desc].
     *
     * @var string
     */
    public $order = 'asc';

    /**
     * searchValue.
     *
     * @var mixed
     */
    public $searchValue;

    /**
     * columnsSearcheable Column names searchable.
     *
     * @var array
     */
    public $columnsSearcheable;

    /**
     * with Models Relationship loaded.
     *
     * @var array
     */
    public $with;

    /**
     * queries Columns searchable.
     *
     * @var array
     */
    public $queries;

    /**
     * urlParamsAccepted Keys of url parameters accepted.
     *
     * @var array
     */
    public $urlParamsAccepted = [];

    /**
     * withTrashed. Including Soft Deleted Models.
     *
     * @var bool
     */
    public $withTrashed = false;

    public function hasQueries(): bool
    {
        return !empty($this->queries);
    }

    public function hasWith(): bool
    {
        return !empty($this->with);
    }

    public function hasSearchValue(): bool
    {
        return !empty($this->columnsSearcheable) && !empty($this->searchValue);
    }

    public function hasOrderBy(): bool
    {
        return !empty($this->orderBy);
    }

    public function withTrashed(): bool
    {
        return $this->withTrashed;
    }
}

trait DatatableTrait
{
    /**
     * dt_columnsSearcheable Column names searchable.
     *
     * @var array
     */
    protected $dt_columnsSearcheable = [];

    /**
     * dt_with Models Relationship loaded.
     *
     * @var array
     */
    protected $dt_with = [];

    /**
     * dt_queries Columns searchable.
     *
     * @var array
     */
    protected $dt_queries = [];

    /**
     * dt_urlParamsAccepted Keys of url parameters accepted.
     *
     * @var array
     */
    protected $dt_urlParamsAccepted = [];

    /**
     * dt_totalRecords.
     *
     * @var int
     */
    protected $dt_totalRecords = 0;

    /**
     * dt_totalRecordsWithFilter.
     *
     * @var int
     */
    protected $dt_totalRecordsWithFilter = 0;

    /**
     * dt_records.
     *
     * @var Illuminate\Database\Eloquent\Collection
     */
    protected $dt_records = [];

    /**
     * dt_array.
     *
     * @var array
     */
    protected $dt_array = [];

    /**
     * Set variables of Datatable.
     *
     * @param App\Http\Requests\Admin\DatatableRequest $request
     */
    protected function setVariables(DatatableRequest $request): void
    {
        $this->dtParams->draw = $request->get('draw', 1);
        $this->dtParams->start = $request->get('start', 0);
        $this->dtParams->length = $request->get('length', 10);
        $columnIndex = $request->get('order')[0]['column'];
        $this->dtParams->orderBy = $request->get('columns')[$columnIndex]['data'];
        $this->dtParams->order = $request->get('order')[0]['dir'];
        $this->dtParams->searchValue = $request->get('search')['value'] ?? '';
    }

    /**
     * Add url params accepted to queries of Datatable.
     *
     * @param App\Http\Requests\Admin\DatatableRequest $request
     */
    protected function addUrlParamsAcceptedToQueries(DatatableRequest $request): void
    {
        foreach ($request->only($this->dtParams->urlParamsAccepted) as $paramKey => $paramValue) {
            foreach (array_keys($this->dtParams->urlParamsAccepted, $paramKey) as $column) {
                $this->dtParams->queries[$column] = $paramValue;
            }
        }
    }

    /**
     * Find results of Datatable.
     */
    protected function findResults(): void
    {
        $this->dt_totalRecords = $this->repository->dt_totalRecords($this->dtParams);
        $this->dt_totalRecordsWithFilter = $this->repository->dt_totalRecordsWithFilter($this->dtParams);
        $this->dt_records = $this->repository->dt_records($this->dtParams);
    }

    /**
     * Construct Array of Datatable $this->dt_array {aaData}.
     */
    protected function constructDtArray(): void
    {
        /*
         * Must be implemented in the Service that uses Datatable
         */
    }

    /**
     * Get datatable.
     *
     * @param App\Http\Requests\Admin\DatatableRequest $request
     *
     * @return array Datatables Array
     *
     * @throws ServiceException
     */
    public function datatable(DatatableRequest $request): array
    {
        try {
            $this->dt_array = [];
            $this->setVariables($request);
            $this->addUrlParamsAcceptedToQueries($request);
            $this->findResults();
            $this->constructDtArray();

            return [
                'draw' => intval($this->dtParams->draw),
                'iTotalRecords' => $this->dt_totalRecords,
                'iTotalDisplayRecords' => $this->dt_totalRecordsWithFilter,
                'aaData' => $this->dt_array,
            ];
        } catch (Exception $e) {
            throw new ServiceException($e->getMessage());
        }
    }
}

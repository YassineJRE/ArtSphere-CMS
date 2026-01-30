<?php

namespace App\Services\Admin;

use App\Enums\LogName;
use App\Exceptions\ServiceException;
use App\Http\Requests\Web\IndexRequest;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Builder;
use App\Repositories\Admin\UserLogRepository;

class UserLogService extends BaseService
{
    /**
     * dt_columnsSearcheable Column names searchable of Datatable.
     *
     * @var array
     */
    protected $dt_columnsSearcheable = [
    ];

    /**
     * dt_with Models Relationship loaded for Datatable records.
     *
     * @var array
     */
    protected $dt_with = [
    ];

    /**
     * dt_queries Columns searchable for build queries of Datatable records.
     *
     * @example 'column_name' => 'param_url_key'
     *
     * @var array
     */
    protected $dt_queries = [
    ];

    /**
     * dt_urlParamsAccepted key of url parameters accepted to build the queries of Datatable records.
     *
     * @example 'column_name' => 'param_url_key'
     *
     * @var array
     */
    protected $dt_urlParamsAccepted = [
    ];

    public function __construct(UserLogRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

    public function index(IndexRequest $request): object
    {
        try {
            return $this->repository->indexPaged(
                route('admin.user-logs.index'),
                [],
                [
                    'log_name' => LogName::USER,
                ],
                $request->get('order_by', ['created_at']),
                $request->get('order', 'desc'),
                $request->get('per_page', 10),
                $request->get('page', 1)
            );
        } catch (Exception $e) {
            throw new ServiceException($e->getMessage());
        }
    }

    public function setFilter(IndexRequest $request, Builder $query): void
    {
        $this->filter = [
        ];
    }
}

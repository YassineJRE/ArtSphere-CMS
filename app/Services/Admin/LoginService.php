<?php

namespace App\Services\Admin;

use App\Http\Requests\Web\IndexRequest;
use App\Models\User;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Repositories\Admin\UserRepository;

class LoginService extends BaseService
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

    public function __construct(UserRepository $repository)
    {
        parent::__construct();
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
     * Construct Array of Datatable {aaData}.
     */
    protected function constructDtArray(): void
    {
    }

    /**
     * findUserByEmail.
     *
     * @param string $email User's email
     *
     * @return App\Models\User|null
     *
     * @throws ServiceException
     */
    public function findUserByEmail(string $email): User|null
    {
        try {
            return $this->repository->findByEmail($email);
        } catch (Exception $e) {
            throw new ServiceException($e->getMessage());
        }
    }
}

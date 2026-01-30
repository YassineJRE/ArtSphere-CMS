<?php

namespace App\Services\Authentication;

use App\Http\Requests\Web\IndexRequest;
use App\Models\User;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Repositories\Authentication\RegisterRepository;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Exceptions\ServiceException;

class RegisterService extends BaseService
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

    /**
     * User Object.
     *
     * @var App\Models\User
     */
    private User $user;

    /**
     * Create a new register service instance.
     *
     * @param App\Repositories\Authentication\RegisterRepository $repository
     *
     * @return void
     */
    public function __construct(RegisterRepository $repository)
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
     * Store a newly created resource in storage.
     *
     * @param array $data Attributes of User
     *
     * @return App\Models\User
     *
     * @throws ServiceException
     */
    public function store(array $data): User
    {
        try {
            return parent::store($data);
        } catch (Exception $e) {
            throw new ServiceException($e->getMessage());
        }
    }

    /**
     * Finalize registration. Add new profile to User
     *
     * @param App\Models\User $user
     * @param array           $data Attributes of Profile
     *
     * @return App\Models\User
     *
     * @throws ServiceException
     */
    public function finalize(User $user, array $data): User
    {
        try {
            return $this->repository->finalize($user, $data);
        } catch (Exception $e) {
            throw new ServiceException($e->getMessage());
        }
    }
}

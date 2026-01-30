<?php

namespace App\Services\Admin;

use App\Http\Requests\Web\IndexRequest;
use App\Models\User;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Events\Admin\UserWasCreated;
use App\Repositories\Admin\UserRepository;

class UserService extends BaseService
{
    /**
     * dt_columnsSearcheable Column names searchable of Datatable.
     *
     * @var array
     */
    protected $dt_columnsSearcheable = [
        'id',
        'first_name',
        'last_name',
        'username',
        'email',
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
        'user.status' => 'status',
    ];

    /**
     * dt_withTrashed. Including Soft Deleted Models.
     *
     * @var bool
     */
    protected $dt_withTrashed = true;

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
        foreach ($this->dt_records as $record) {
            $this->dt_array[] = [
                'id' => '<a href="'.route('admin.users.show', ['user' => $record->id]).'">'.$record->id.'</a>',
                'username' => $record->username,
                'last_name' => $record->last_name,
                'first_name' => $record->first_name,
                'email' => $record->email,
                'roles' => view('admin.user.datatable-roles', [
                    'roles' => $record->roles,
                ])->render(),
                'actions' => view('admin.user.datatable-actions', [
                    'user' => $record,
                ])->render(),
            ];
        }
    }

    /**
     * store new User.
     *
     * @param array $data Attributes
     *
     * @return App\Models\User
     *
     * @throws ServiceException
     */
    public function store(array $data): User
    {
        $user = parent::store($data);

        event(new UserWasCreated($user));

        return $user;
    }
}

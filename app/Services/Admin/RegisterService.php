<?php

namespace App\Services\Admin;

use App\Enums\Status;
use App\Http\Requests\Web\IndexRequest;
use App\Models\User;
use App\Services\BaseService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Repositories\Admin\UserRepository;

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
     * findUserByEmailVerificationToken.
     *
     * @param string $token User's email_verification_token
     *
     * @return App\Models\User
     *
     * @throws ServiceException
     */
    public function findUserByEmailVerificationToken(string $token): User
    {
        try {
            return $this->repository->findByEmailVerificationToken($token);
        } catch (Exception $e) {
            throw new ServiceException($e->getMessage());
        }
    }

    /**
     * savePassword.
     *
     * @param App\Models\User $user
     * @param string          $newPassword New password enter by user
     *
     * @return App\Models\User
     *
     * @throws ServiceException
     */
    public function savePassword(User $user, string $newPassword): User
    {
        try {
            $user->forceFill([
                'password' => Hash::make($newPassword),
                'email_verified_at' => Carbon::now(),
                'email_verification_token' => '',
                'status' => Status::ENABLED,
            ])->setRememberToken(Str::random(60));

            $user->save();

            return $this->show($user);
        } catch (Exception $e) {
            throw new ServiceException($e->getMessage());
        }
    }
}

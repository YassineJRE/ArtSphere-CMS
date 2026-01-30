<?php

namespace App\Services\Admin;

use App\Http\Requests\Web\IndexRequest;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Repositories\Admin\UserNotificationRepository;

class UserNotificationService extends BaseService
{
    /**
     * dt_columnsSearcheable Column names searchable of Datatable.
     *
     * @var array
     */
    protected $dt_columnsSearcheable = [
        'ad_id',
        'ad_comment_id',
        'user_review_id',
        'user_contact_id',
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

    public function __construct(UserNotificationRepository $repository)
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
                'id' => '<a href="'.route('admin.user-notifications.show', ['user_notification' => $record->id]).'">'.$record->id.'</a>',
                'user_id' => $record->user_id,
                'ad_id' => $record->ad_id,
                'ad_comment_id' => $record->ad_comment_id,
                'user_review_id' => $record->user_review_id,
                'user_contact_id' => $record->user_contact_id,
                'is_read' => $record->is_read,
                'actions' => view('admin.user-notification.datatable-actions', ['id' => $record->id])->render(),
            ];
        }
    }
}

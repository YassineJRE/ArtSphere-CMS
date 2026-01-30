<?php

namespace App\Services\Admin;

use App\Http\Requests\Web\IndexRequest;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Repositories\Admin\ContentRepository;
use Illuminate\Support\Facades\App;

class ContentService extends BaseService
{
    /**
     * dt_columnsSearcheable Column names searchable of Datatable.
     *
     * @var array
     */
    protected $dt_columnsSearcheable = [
        'key',
        'type',
        'status',
        'content',
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

    public function __construct(ContentRepository $repository)
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
                'id' => '<a href="'.route('admin.contents.show', ['content' => $record->id]).'">'.$record->id.'</a>',
                'key' => $record->key,
                'type' => $record->type,
                'content' => nl2br($record->content->{App::getLocale()}),
                'status' => $record->status,
                'actions' => view('admin.content.datatable-actions', [
                    'id' => $record->id,
                    'isDeleted' => $record->isDeleted(),
                ])->render(),
            ];
        }
    }
}

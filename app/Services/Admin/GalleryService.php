<?php

namespace App\Services\Admin;

use App\Enums\GroupType as EnumGroupType;
use App\Http\Requests\Web\IndexRequest;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Repositories\Admin\GalleryRepository;

class GalleryService extends BaseService
{
    /**
     * dt_columnsSearcheable Column names searchable of Datatable.
     *
     * @var array
     */
    protected $dt_columnsSearcheable = [
        'name',
        'institution_type',
        'status',
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
        'type' => EnumGroupType::ARTIST_RUN_CENTER_ORG
    ];

    /**
     * dt_urlParamsAccepted key of url parameters accepted to build the queries of Datatable records.
     *
     * @example 'column_name' => 'param_url_key'
     *
     * @var array
     */
    protected $dt_urlParamsAccepted = [
        'groups.approved_at' => 'approved_at',
    ];

    public function __construct(GalleryRepository $repository)
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
                'id' => '<a href="'.route('admin.galleries.show', ['gallery' => $record->id]).'">'.$record->id.'</a>',
                'name' => $record->name,
                'institution_type' => $record->institution_type,
                'status' => $record->status,
                'actions' => view('admin.gallery.datatable-actions', [
                    'id' => $record->id,
                    'isEnabled' => $record->isEnabled(),
                    'isDisabled' => $record->isDisabled(),
                    'isDeleted' => $record->isDeleted(),
                    'isAwaitingApproval' => $record->isAwaitingApproval(),
                ])->render(),
            ];
        }
    }
}

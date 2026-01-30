<?php

namespace App\Services\Web;

use App\Models\Exhibit;
use App\Exceptions\ServiceException;
use App\Http\Requests\Web\IndexRequest;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;
use App\Repositories\Web\ExhibitRepository;

class ExhibitService extends BaseService
{
    public function __construct(ExhibitRepository $repository)
    {
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

    public function getRandomIds(): Collection
    {
        return $this->repository->getRandomIds();
    }

    public static function getSRM(): Collection
    {
        $children = [];

        foreach (ExhibitRepository::getSRM() as $exhibitGroup) {
            $children[] = [
                "title" => __('home.views.index.see-list'),
                "value" => $exhibitGroup->count(),
                "link" => route('app.exhibits.index', [
                    'ids' => $exhibitGroup->implode(',')
                ]),
            ];
        }
        return collect([
            "name" => "",
            "link" => route('app.home'),
            "children" => count($children) > 0 ? $children : [["value" => 1]]
        ]);
    }
}

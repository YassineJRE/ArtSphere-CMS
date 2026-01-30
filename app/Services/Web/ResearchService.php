<?php

namespace App\Services\Web;

use App\Models\Artwork;
use App\Models\Collection;
use App\Models\Exhibit;
use App\Models\Group;
use App\Models\UserProfile;
use App\Models\Website;
use App\Models\WebsiteGroup;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection as SupportCollection;

class ResearchService
{
    /**
     * Get the list of searchable types and their configurations.
     *
     * @return array
     */
    public static function getTypes(): array
    {
        return [
            'profiles' => [
                'models' => [UserProfile::class, Group::class],
                'pageName' => 'profiles_page',
                'itemsPerPage' => 6,
                'view' => 'components.carousels.profiles',
            ],
            'exhibits' => [
                'model' => Exhibit::class,
                'pageName' => 'exhibits_page',
                'itemsPerPage' => 6,
                'view' => 'components.carousels.exhibits',
            ],
            'artworks' => [
                'model' => Artwork::class,
                'pageName' => 'artworks_page',
                'itemsPerPage' => 6,
                'view' => 'components.carousels.artworks',
            ],
            'collections' => [
                'model' => Collection::class,
                'pageName' => 'collections_page',
                'itemsPerPage' => 6,
                'view' => 'components.carousels.collections',
            ],
            'websites' => [
                'models' => [WebsiteGroup::class, Website::class],
                'pageName' => 'websites_page',
                'itemsPerPage' => 6,
                'view' => 'components.carousels.websites',
            ],
        ];
    }

    /**
     * Performs a global search across configured models and returns paginated results.
     * If $onlyTypes is provided, only those types will be searched.
     *
     * @param Request $request The HTTP request containing search parameters.
     * @param array $onlyTypes Optional array of type keys to limit the search.
     * @return array Associative array of paginated search results grouped by content type.
     */
    public function search(Request $request, array $onlyTypes = []): array
    {
        $search = $request->search;
        $random = empty($search);
        $results = [];

        $types = self::getTypes();

        if (!empty($onlyTypes)) {
            $types = array_intersect_key($types, array_flip($onlyTypes));
        }

        foreach ($types as $key => $config) {
            $currentPage = $request->get($config['pageName'], 1);
            $itemsPerPage = $config['itemsPerPage'];

            if (isset($config['models'])) {
                $results[$key] = $this->paginateMergedModels(
                    $config['models'],
                    $search,
                    $random,
                    $currentPage,
                    $itemsPerPage,
                    $config['pageName'],
                    $request
                );
            } elseif (isset($config['model'])) {
                $results[$key] = $this->paginateSingleModel(
                    $config['model'],
                    $search,
                    $random,
                    $currentPage,
                    $itemsPerPage,
                    $config['pageName'],
                    $request
                );
            }
        }

        $results['search'] = $search;

        return $results;
    }

    /**
     * Paginates and merges multiple model types into a single paginated result set.
     *
     * @param array $modelClasses Array of fully qualified model class names.
     * @param string|null $search Search term to filter results.
     * @param bool $random Whether to randomize the results.
     * @param int $currentPage Current pagination page number.
     * @param int $itemsPerPage Number of items per page.
     * @param string $pageName Query parameter name for pagination.
     * @param Request $request The HTTP request instance.
     * @return LengthAwarePaginator Paginated collection of model instances.
     */
    private function paginateMergedModels(
        array $modelClasses,
        ?string $search,
        bool $random,
        int $currentPage,
        int $itemsPerPage,
        string $pageName,
        Request $request
    ): LengthAwarePaginator {
        $allItems = new SupportCollection();

        foreach ($modelClasses as $modelClass) {
            $items = $modelClass::query()
                ->research($search)
                ->when($random, fn($q) => $q->inRandomOrder())
                ->get()
                ->map(function ($item) use ($random) {
                    $item->sort_key = $random ? rand() : $item->id;
                    return $item;
                });

            $allItems = $allItems->merge($items);
        }

        $sorted = $random
        ? $allItems->shuffle(12345)
        : $allItems->sortBy('sort_key');

        // Remove temporary sort_key
        $sorted->each(function ($item) {
            unset($item->sort_key);
        });

        $total = $sorted->count();
        $offset = ($currentPage - 1) * $itemsPerPage;
        $itemsForCurrentPage = $sorted->slice($offset, $itemsPerPage)->values();

        return new LengthAwarePaginator(
            $itemsForCurrentPage,
            $total,
            $itemsPerPage,
            $currentPage,
            [
                'path' => $request->url(),
                'pageName' => $pageName,
                'query' => $request->query(),
            ]
        );
    }

    /**
     * Paginates search results for a single model.
     *
     * @param string $modelClass Fully qualified model class name.
     * @param string|null $search Search term to filter results.
     * @param bool $random Whether to randomize the results.
     * @param int $currentPage Current pagination page number.
     * @param int $itemsPerPage Number of items per page.
     * @param string $pageName Query parameter name for pagination.
     * @param Request $request The HTTP request instance.
     * @return LengthAwarePaginator Paginated result set of model instances.
     */
    private function paginateSingleModel(
        string $modelClass,
        ?string $search,
        bool $random,
        int $currentPage,
        int $itemsPerPage,
        string $pageName,
        Request $request
    ): LengthAwarePaginator {
        $query = $modelClass::query()->research($search);

        if ($random) {
            $query->inRandomOrder();
        }

        return $query->paginate(
            $itemsPerPage,
            ['*'],
            $pageName,
            $currentPage
        )->withPath($request->url())
            ->appends($request->query());
    }
}

<?php

namespace App\Repositories\Web\MyProfile;

use App\Exceptions\RepositoryException;
use Exception;
use App\Models\Collection;
use App\Models\CollectionItem;
use App\Models\Exhibit;
use App\Models\Artwork;
use App\Models\Website;
use App\Models\WebsiteGroup;
use App\Repositories\Web\BaseRepository;
use Illuminate\Support\Facades\DB;

class MyCollectionRepository extends BaseRepository
{
    /**
     * get instance Collection Model.
     *
     * @return App\Models\Collection
     */
    public function getModel()
    {
        return new Collection();
    }

    /**
     * create new Collection.
     *
     * @param array $data Attributes
     *
     * @return App\Models\Collection
     */
    public function create(array $data): Collection
    {
        try {
            $collection = DB::transaction(function () use ($data) {
                $collection = parent::create($data);

                if ($collection) {
                    $itemData = [];
                    $itemData['collection_id'] = $collection->id;

                    if (isset($data['exhibit_id'])) {
                        $itemData['model_type'] = Exhibit::class;
                        $itemData['model_id'] = $data['exhibit_id'];
                        CollectionItem::firstOrCreate($itemData);
                    } elseif (isset($data['artwork_id'])) {
                        $itemData['model_type'] = Artwork::class;
                        $itemData['model_id'] = $data['artwork_id'];
                        CollectionItem::firstOrCreate($itemData);
                    } elseif (isset($data['collection_id'])) {
                        $itemData['model_type'] = Collection::class;
                        $itemData['model_id'] = $data['collection_id'];
                        CollectionItem::firstOrCreate($itemData);
                    } elseif (isset($data['collection_item_id'])) {
                        $itemData['model_type'] = CollectionItem::class;
                        $itemData['model_id'] = $data['collection_item_id'];
                        CollectionItem::firstOrCreate($itemData);
                    } elseif (isset($data['website_id'])) {
                        $itemData['model_type'] = Website::class;
                        $itemData['model_id'] = $data['website_id'];
                        CollectionItem::firstOrCreate($itemData);
                    } elseif (isset($data['website_group_id'])) {
                        $itemData['model_type'] = WebsiteGroup::class;
                        $itemData['model_id'] = $data['website_group_id'];
                        CollectionItem::firstOrCreate($itemData);
                    }
                }

                return $collection;
            });

            return $collection;
        } catch (Exception $e) {
            throw new RepositoryException($e->getMessage());
        }
    }

    /**
     * Change position
     *
     * @param App\Models\Collection $collection
     * @param int              $position  New position
     *
     * @return App\Models\Collection
     */
    public function changePosition(Collection $collection, int $position): Collection
    {
        try {
            $collection = DB::transaction(function () use ($collection, $position) {
                $collections = $collection->owner->collections()->where('id','<>',$collection->id)->orderBy('order_column')->get();
                $order_column = 1;
                $collectionsOrdered = [];
                $collectionsOrdered[$position] = $collection;
                foreach ($collections as $currentCollection) {
                    if ($order_column == $position) {
                        $order_column++;
                    }
                    $collectionsOrdered[$order_column++] = $currentCollection;
                }
                foreach ($collectionsOrdered as $currentPosition => $currentCollection) {
                    parent::update($currentCollection, ['order_column' => $currentPosition]);
                }
                return $collection;
            });

            return $collection;
        } catch (Exception $e) {
            throw new RepositoryException($e->getMessage());
        }
    }
}

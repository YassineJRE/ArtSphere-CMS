<?php

namespace App\Repositories\Web\MyProfile;

use App\Models\CollectionItem;
use App\Repositories\Web\BaseRepository;
use App\Exceptions\RepositoryException;
use Exception;
use Illuminate\Support\Facades\DB;

class MyCollectionItemRepository extends BaseRepository
{
    /**
     * get instance CollectionItem Model.
     *
     * @return App\Models\CollectionItem
     */
    public function getModel()
    {
        return new CollectionItem();
    }

    /**
     * Change position
     *
     * @param App\Models\CollectionItem $item
     * @param int              $position  New position
     *
     * @return App\Models\CollectionItem
     */
    public function changePosition(CollectionItem $item, int $position): CollectionItem
    {
        try {
            $item = DB::transaction(function () use ($item, $position) {
                $items = $item->collection->items()->where('id','<>',$item->id)->orderBy('order_column')->get();
                $order_column = 1;
                $itemsOrdered = [];
                $itemsOrdered[$position] = $item;
                foreach ($items as $currentCollectionItem) {
                    if ($order_column == $position) {
                        $order_column++;
                    }
                    $itemsOrdered[$order_column++] = $currentCollectionItem;
                }
                foreach ($itemsOrdered as $currentPosition => $currentCollectionItem) {
                    parent::update($currentCollectionItem, ['order_column' => $currentPosition]);
                }
                return $item;
            });

            return $item;
        } catch (Exception $e) {
            throw new RepositoryException($e->getMessage());
        }
    }    
}

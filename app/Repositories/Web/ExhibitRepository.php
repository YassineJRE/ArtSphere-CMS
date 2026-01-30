<?php

namespace App\Repositories\Web;

use App\Enums\Status as EnumStatus;
use App\Models\Exhibit;
use Illuminate\Support\Collection;
use Exception;

class ExhibitRepository extends BaseRepository
{
    /**
     * get instance Exhibit Model.
     *
     * @return App\Models\Exhibit
     */
    public function getModel()
    {
        return new Exhibit();
    }

    public static function getSRM(): Collection
    {
        $listExhibitsByCollectionOwner = self::getExhibitIdsByCollectionOwnerWhoHaveAtLeastTwoExhibits();
        $listClonedExhibitsByCollectionOwner = $listExhibitsByCollectionOwner;
        $exhibitGroups = collect([]);

        $listExhibitsByCollectionOwner->map(function ($listExhibitsOfOwner1, $owner1) use ($listClonedExhibitsByCollectionOwner, $exhibitGroups)
        {
            $listClonedExhibitsByCollectionOwner->forget($owner1);
            $listClonedExhibitsByCollectionOwner->map(function ($listExhibitsOfOwner2, $owner2) use ($listExhibitsOfOwner1, $owner1, $exhibitGroups)
            {
                $intersect = collect($listExhibitsOfOwner1)->intersect($listExhibitsOfOwner2);

                /**
                 * Si les 2 owners ont plus d'une exposition en commun, ajouter leur liste d'expositions en commun
                 */
                if ($intersect->count() > 1) {
                    $exhibitGroups->push($intersect);
                }
            });
        });

        return $exhibitGroups->mapWithKeys(function ($listExhibits, $key) {
            return [$listExhibits->implode('-') => $listExhibits];
        });
    }

    public static function getExhibitIdsByCollectionOwnerWhoHaveAtLeastTwoExhibits(): Collection
    {
        $exhibits = [];
        foreach (self::getExhibitIdsByOwnerCollection() as $exhibit) 
        {
            $exhibits[$exhibit->ownerCollectionKey][] = $exhibit->id;
        }

        return collect($exhibits)->filter(function ($exhibitIds) {
            return count($exhibitIds) > 1;
        });
    }

    public static function getExhibitIdsByOwnerCollection(): Collection
    {
        return Exhibit::join('collection_items', function ($join) {
                $join->on('collection_items.model_id', '=', 'exhibits.id')
                    ->where('collection_items.model_type', 'App\\Models\\Exhibit')
                    ->whereNull('collection_items.deleted_at');
            })
            ->join('collections', function ($join) {
                $join->on('collections.id', '=', 'collection_items.collection_id')
                    ->whereNull('collections.deleted_at');
            })
        ->filter()
        ->selectRaw('
            exhibits.id,
            CONCAT(LOWER(substr(collections.owner_type,12)),collections.owner_id) AS `ownerCollectionKey`
        ')
        ->groupBy(['collections.owner_type','collections.owner_id','exhibits.id'])
        ->orderBy('exhibits.id','ASC')
        ->get();
    }

    public function getRandomIds(): Collection
    {
        return $this->model
            ->filter()
            ->whereHas('artworks')
            ->inRandomOrder()
            ->limit(100)
            ->get()
            ->pluck('id');
    }
}

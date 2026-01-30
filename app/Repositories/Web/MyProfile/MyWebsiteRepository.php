<?php

namespace App\Repositories\Web\MyProfile;

use App\Models\Website;
use App\Repositories\Web\BaseRepository;
use App\Exceptions\RepositoryException;
use Exception;
use Illuminate\Support\Facades\DB;

class MyWebsiteRepository extends BaseRepository
{
    /**
     * get instance Website Model.
     *
     * @return App\Models\Website
     */
    public function getModel()
    {
        return new Website();
    }

    /**
     * Change position
     *
     * @param App\Models\Website $website
     * @param int              $position  New position
     *
     * @return App\Models\Website
     */
    public function changePosition(Website $website, int $position): Website
    {
        try {
            $website = DB::transaction(function () use ($website, $position) {
                $websites = $website->parent->websites()->where('id','<>',$website->id)->orderBy('order_column')->get();
                $order_column = 1;
                $websitesOrdered = [];
                $websitesOrdered[$position] = $website;
                foreach ($websites as $currentWebsite) {
                    if ($order_column == $position) {
                        $order_column++;
                    }
                    $websitesOrdered[$order_column++] = $currentWebsite;
                }
                foreach ($websitesOrdered as $currentPosition => $currentWebsite) {
                    parent::update($currentWebsite, ['order_column' => $currentPosition]);
                }
                return $website;
            });

            return $website;
        } catch (Exception $e) {
            throw new RepositoryException($e->getMessage());
        }
    }
}

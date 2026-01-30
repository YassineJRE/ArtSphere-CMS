<?php

namespace App\Repositories\Web\MyProfile;

use App\Models\WebsiteGroup;
use App\Repositories\Web\BaseRepository;
use App\Exceptions\RepositoryException;
use Exception;
use Illuminate\Support\Facades\DB;

class MyWebsiteGroupRepository extends BaseRepository
{
    /**
     * get instance WebsiteGroup Model.
     *
     * @return App\Models\WebsiteGroup
     */
    public function getModel()
    {
        return new WebsiteGroup();
    }

    /**
     * Change position
     *
     * @param App\Models\WebsiteGroup $websiteGroup
     * @param int              $position  New position
     *
     * @return App\Models\WebsiteGroup
     */
    public function changePosition(WebsiteGroup $websiteGroup, int $position): WebsiteGroup
    {
        try {
            $websiteGroup = DB::transaction(function () use ($websiteGroup, $position) {
                $websiteGroups = $websiteGroup->owner->websiteGroups()->where('id','<>',$websiteGroup->id)->orderBy('order_column')->get();
                $order_column = 1;
                $websiteGroupsOrdered = [];
                $websiteGroupsOrdered[$position] = $websiteGroup;
                foreach ($websiteGroups as $currentWebsiteGroup) {
                    if ($order_column == $position) {
                        $order_column++;
                    }
                    $websiteGroupsOrdered[$order_column++] = $currentWebsiteGroup;
                }
                foreach ($websiteGroupsOrdered as $currentPosition => $currentWebsiteGroup) {
                    parent::update($currentWebsiteGroup, ['order_column' => $currentPosition]);
                }
                return $websiteGroup;
            });

            return $websiteGroup;
        } catch (Exception $e) {
            throw new RepositoryException($e->getMessage());
        }
    }    
}

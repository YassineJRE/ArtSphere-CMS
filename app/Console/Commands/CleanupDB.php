<?php

namespace App\Console\Commands;

use App\Models\Artwork;
use App\Models\Collection;
use App\Models\CollectionItem;
use App\Models\Exhibit;
use App\Models\Group;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\Website;
use App\Models\WebsiteGroup;
use Illuminate\Console\Command;

class CleanupDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:cleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make cascade delete for rows who are supposed to be deleted';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Cleanup');
        // $this->restoreUsersDeleted();
        $this->deleteInCascadeFromUser();
        $this->deleteInCascadeFromUserProfile();
        $this->deleteInCascadeFromGroup();
        $this->deleteInCascadeFromCollection();
        $this->deleteInCascadeFromCollectionItem();
        $this->deleteInCascadeFromExhibit();
        $this->deleteInCascadeFromArtwork();
        $this->deleteInCascadeFromWebsite();
        $this->deleteInCascadeFromWebsiteGroup();
        $this->deleteRowsWithEmptyMorph();
    }

    protected function restoreUsersDeleted()
    {
        foreach (User::onlyTrashed()->get() as $user) 
        {
            $this->info('User '. $user->id. ' is deleted');
            $user->restore();
            $this->info('User '. $user->id. ' is restored');
        }
    }
    
    protected function deleteInCascadeFromUser()
    {
        foreach (User::onlyTrashed()->get() as $user) 
        {
            $this->info('User '. $user->id. ' is deleted');
            $user->user_notifications()->delete();
            $user->profiles()->delete();
            $user->invitations()->delete();
            $user->memberships()->delete();
            $user->groups()->delete();
            $user->modelsRemovedFromDB()->delete();
            $user->forceDelete();
        }
    }

    protected function deleteInCascadeFromUserProfile()
    {
        foreach (UserProfile::onlyTrashed()->get() as $profile) 
        {
            $this->info('Profile '. $profile->id. ' is deleted');
            $profile->exhibits()->delete();
            $profile->documents()->delete();
            $profile->websiteGroups()->delete();
            $profile->collections()->delete();
            $profile->memberships()->delete();
            $profile->modelsRemovedFromDB()->delete();
            $profile->comments()->delete();
            $profile->forceDelete();
        }
    }

    protected function deleteInCascadeFromGroup()
    {
        foreach (Group::onlyTrashed()->get() as $group) 
        {
            $this->info('Group '. $group->id. ' is deleted');
            $group->members()->delete();
            $group->guests()->delete();
            $group->exhibits()->delete();
            $group->documents()->delete();
            $group->websiteGroups()->delete();
            $group->collections()->delete();
            $group->modelsRemovedFromDB()->delete();
            $group->comments()->delete();
            $group->forceDelete();
        }
    }

    protected function deleteInCascadeFromCollection()
    {
        foreach (Collection::onlyTrashed()->get() as $collection) 
        {
            $this->info('Collection '. $collection->id. ' is deleted');
            $collection->items()->delete();
            $collection->comments()->delete();
            $collection->collectionItems()->delete();
            $collection->forceDelete();
        }
    }

    protected function deleteInCascadeFromCollectionItem()
    {
        foreach (CollectionItem::onlyTrashed()->get() as $item) 
        {
            $this->info('CollectionItem '. $item->id. ' is deleted');
            $item->comments()->delete();
            $item->collectionItems()->delete();
            $item->forceDelete();
        }
    }

    protected function deleteInCascadeFromExhibit()
    {
        foreach (Exhibit::onlyTrashed()->get() as $exhibit) 
        {
            $this->info('Exhibit '. $exhibit->id. ' is deleted');
            $exhibit->artworks()->delete();
            $exhibit->comments()->delete();
            $exhibit->collectionItems()->delete();
            $exhibit->forceDelete();
        }
    }

    protected function deleteInCascadeFromArtwork()
    {
        foreach (Artwork::onlyTrashed()->get() as $artwork) 
        {
            $this->info('Artwork '. $artwork->id. ' is deleted');
            $artwork->comments()->delete();
            $artwork->collectionItems()->delete();
            $artwork->forceDelete();
        }
    }

    protected function deleteInCascadeFromWebsiteGroup()
    {
        foreach (WebsiteGroup::onlyTrashed()->get() as $websiteGroup) 
        {
            $this->info('WebsiteGroup '. $websiteGroup->id. ' is deleted');
            $websiteGroup->websites()->delete();
            $websiteGroup->collectionItems()->delete();
            $websiteGroup->forceDelete();
        }
    }

    protected function deleteInCascadeFromWebsite()
    {
        foreach (Website::onlyTrashed()->get() as $website) 
        {
            $this->info('Website '. $website->id. ' is deleted');
            $website->collectionItems()->delete();
            $website->forceDelete();
        }
    }

    protected function deleteRowsWithEmptyMorph()
    {
        CollectionItem::where(function ($filter) {
            $filter->whereNull('model_type')
                ->orWhere('model_type', '=', '')
                ->orWhereNull('model_id')
                ->orWhere('model_id', '=', '');
        })->delete();
    }
}

<?php

namespace App\Models\Traits\Profile;

use App\Models\Artwork;
use App\Models\Collection;
use App\Models\Exhibit;
use App\Models\Group;
use App\Models\Website;
use App\Models\WebsiteGroup;

/**
 * Trait ProfileOwnership
 *
 * Provides methods to verify if the Profile owns certain models
 * or has specific roles (Member, Administrator) within groups.
 */
trait ProfileOwnership
{
    /**
     * Verify if this Profile is owner of this Exhibit.
     *
     * @param int|null|App\Models\Exhibit $exhibit
     *
     * @return bool
     */
    public function isOwnerOfThisExhibit(Exhibit | int | null $exhibit): bool
    {
        $exhibitId = null;

        if ($exhibit instanceof Exhibit) {
            $exhibitId = $exhibit->id;
        }

        if (is_numeric($exhibit)) {
            $exhibitId = $exhibit;
        }

        return $this->exhibits()
            ->where('id', $exhibitId)
            ->exists();
    }

    /**
     * Verify if this Profile is owner of this Artwork.
     *
     * @param int|App\Models\Artwork $artwork
     *
     * @return bool
     */
    public function isOwnerOfThisArtwork(Artwork | int $artwork): bool
    {
        $artworkId = null;

        if ($artwork instanceof Artwork) {
            $artworkId = $artwork->id;
        }

        if (is_numeric($artwork)) {
            $artworkId = $artwork;
        }

        return $this->artworks()
            ->where('artworks.id', $artworkId)
            ->exists();
    }

    /**
     * Verify if this Profile is owner of this WebsiteGroup.
     *
     * @param int|App\Models\WebsiteGroup $websiteGroup
     *
     * @return bool
     */
    public function isOwnerOfThisWebsiteGroup(WebsiteGroup | int $websiteGroup): bool
    {
        $websiteGroupId = null;

        if ($websiteGroup instanceof WebsiteGroup) {
            $websiteGroupId = $websiteGroup->id;
        }

        if (is_numeric($websiteGroup)) {
            $websiteGroupId = $websiteGroup;
        }

        return $this->websiteGroups()
            ->where('id', $websiteGroupId)
            ->exists();
    }

    /**
     * Verify if this Profile is owner of this Website.
     *
     * @param int|App\Models\Website $website
     *
     * @return bool
     */
    public function isOwnerOfThisWebsite(Website | int $website): bool
    {
        $websiteId = null;

        if ($website instanceof Website) {
            $websiteId = $website->id;
        }

        if (is_numeric($website)) {
            $websiteId = $website;
        }

        return $this->websites()
            ->where('id', $websiteId)
            ->exists();
    }

    /**
     * Verify if this Profile is owner of this Collection.
     *
     * @param int|App\Models\Collection $collection
     *
     * @return bool
     */
    public function isOwnerOfThisCollection(Collection | int $collection): bool
    {
        $collectionId = null;

        if ($collection instanceof Collection) {
            $collectionId = $collection->id;
        }

        if (is_numeric($collection)) {
            $collectionId = $collection;
        }

        return $this->collections()
            ->where('id', $collectionId)
            ->exists();
    }
}

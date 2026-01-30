<?php

namespace App\Models\Traits;

use App\Contracts\HasRoute;
use App\Models\Artwork;
use App\Models\Collection;
use App\Models\CollectionItem;
use App\Models\Exhibit;
use App\Models\Group;
use App\Models\UserProfile;
use App\Models\Website;
use App\Models\WebsiteGroup;

trait ModelProperties
{
    /**
     * Get the title of the associated model.
     *
     * This method delegates the title retrieval to the associated model,
     * if the model and its getTitle() method exist.
     *
     * @return string The title, name, or label of the model, or an empty string if not available.
     */
    public function getTitle(): string
    {
        return is_object($this->model) && method_exists($this->model, 'getTitle')
        ? $this->model->getTitle()
        : '';
    }

    /**
     * Get the description of the associated model.
     *
     * This method delegates the description retrieval to the associated model,
     * if the model and its getDescription() method exist.
     *
     * @return string The model description, or an empty string if not available.
     */
    public function getDescription(): string
    {
        return is_object($this->model) && method_exists($this->model, 'getDescription')
        ? $this->model->getDescription()
        : '';
    }

    /**
     * Determine if the model is an instance of Artwork.
     *
     * @return bool True if the model is an Artwork, false otherwise.
     */
    public function isArtwork(): bool
    {
        return $this->model_type === Artwork::class;
    }

    /**
     * Determine if the model is an instance of Exhibit.
     *
     * @return bool True if the model is an Exhibit, false otherwise.
     */
    public function isExhibit(): bool
    {
        return $this->model_type === Exhibit::class;
    }

    /**
     * Determine if the model is an instance of Collection.
     *
     * @return bool True if the model is a Collection, false otherwise.
     */
    public function isCollection(): bool
    {
        return $this->model_type === Collection::class;
    }

    /**
     * Determine if the model is an instance of CollectionItem.
     *
     * @return bool True if the model is a CollectionItem, false otherwise.
     */
    public function isCollectionItem(): bool
    {
        return $this->model_type === CollectionItem::class;
    }

    /**
     * Determine if the model is an instance of Website.
     *
     * @return bool True if the model is a Website, false otherwise.
     */
    public function isWebsite(): bool
    {
        return $this->model_type === Website::class;
    }

    /**
     * Determine if the model is an instance of WebsiteGroup.
     *
     * @return bool True if the model is a WebsiteGroup, false otherwise.
     */
    public function isWebsiteGroup(): bool
    {
        return $this->model_type === WebsiteGroup::class;
    }

    /**
     * Determine if the model is an instance of UserProfile.
     *
     * @return bool True if the model is a UserProfile, false otherwise.
     */
    public function isProfile(): bool
    {
        return $this->model_type === UserProfile::class;
    }

    /**
     * Determine if the model is an instance of Group.
     *
     * @return bool True if the model is a Group, false otherwise.
     */
    public function isGroup(): bool
    {
        return $this->model_type === Group::class;
    }

    /**
     * Get the route URL of the referenced model.
     *
     * @param array $query Optional query parameters to append to the URL.
     * @return string
     */
    public function getModelRoute(array $query = []): string
    {
        if ($this->model instanceof HasRoute) {
            return $this->model->getRoute($query);
        }

        return '#';
    }
}

<?php

namespace App\Models\Traits\Group;

use App\Enums\GroupType as EnumGroupType;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * Trait GroupAccessors
 *
 * Provides accessor methods to retrieve information about the Group model's
 * properties and media, including type checks and approval status.
 */
trait GroupAccessors
{
    /**
     * Get the group's email address.
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->firstAdministrator()?->getEmail() ?? '';
    }

    /**
     * Get the group's name.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the display name of the group.
     *
     * @return string The name of the group.
     */
    public function getTitle(): string
    {
        return $this->name;
    }

    /**
     * Get the group's firstname.
     *
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->name;
    }

    /**
     * Determine if the group is of type ARTIST.
     *
     * @return bool
     */
    public function isArtist(): bool
    {
        return $this->type == EnumGroupType::ARTIST;
    }

    /**
     * Determine if the group is of type CURATOR.
     *
     * @return bool
     */
    public function isCurator(): bool
    {
        return $this->type == EnumGroupType::CURATOR;
    }

    /**
     * Determine if the group is of type ARTIST_RUN_CENTER_ORG (gallery).
     *
     * @return bool
     */
    public function isArtistRunCenterOrganisation(): bool
    {
        return $this->type == EnumGroupType::ARTIST_RUN_CENTER_ORG;
    }

    /**
     * Check if the group has at least one media attached.
     *
     * @return bool
     */
    public function hasMedia(): bool
    {
        return $this->getFirstMedia() instanceof Media;
    }

    /**
     * Get the first media associated with the group's documents.
     *
     * @return Media|null
     */
    public function getFirstMedia(): ?Media
    {
        return $this->documents()->exists()
        ? $this->documents()->orderBy('order_column')->first()->getFirstMedia()
        : null;
    }

    /**
     * Check if the group has a second media attached.
     *
     * @return bool
     */
    public function hasSecondMedia(): bool
    {
        return $this->getSecondMedia() instanceof Media;
    }

    /**
     * Get the second media associated with the group's documents.
     *
     * @return Media|null
     */
    public function getSecondMedia(): ?Media
    {
        $secondDocument = $this->documents()->orderBy('order_column')->skip(1)->first();

        return $secondDocument ? $secondDocument->getFirstMedia() : null;
    }

    /**
     * Determine if the group is awaiting approval (approved_at is null).
     *
     * @return bool
     */
    public function isAwaitingApproval(): bool
    {
        return is_null($this->approved_at);
    }

    /**
     * Determine if the group is approved (approved_at is not null).
     *
     * @return bool
     */
    public function isApproved(): bool
    {
        return !$this->isAwaitingApproval();
    }

    /**
     * Determine if the group is a verified gallery (artist run center org and approved).
     *
     * @return bool
     */
    public function isVerifiedGallery(): bool
    {
        return $this->isArtistRunCenterOrganisation() && $this->isApproved();
    }

    /**
     * Get the route URL for the group.
     *
     * @param array $query Optional query parameters.
     * @return string
     */
    public function getRoute(array $query = []): string
    {
        return route('app.groups.show', [
            'group' => $this->id,
        ] + $query);
    }
}

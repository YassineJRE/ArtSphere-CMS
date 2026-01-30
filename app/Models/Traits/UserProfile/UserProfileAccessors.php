<?php

namespace App\Models\Traits\UserProfile;

use App\Enums\ProfileType;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * Trait UserProfileAccessors
 *
 * Contains accessor methods for UserProfile model.
 */
trait UserProfileAccessors
{
    /**
     * Get the email address for the profile.
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->user?->getEmail() ?? '';
    }

    /**
     * Get the full display name for the profile.
     *
     * @return string
     */
    public function getLongName(): string
    {
        if ($this->isPublicCollector()) {
            return $this->user->getName();
        }

        return $this->user->getName() . ', ' . $this->getName();
    }

    /**
     * Get the name of the profile.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->getFirstName();
    }

    /**
     * Get the display name of the user profile.
     *
     * @return string The name of the profile.
     */
    public function getTitle(): string
    {
        return $this->getName();
    }

    /**
     * Get the first name or artist name for the profile.
     *
     * @return string
     */
    public function getFirstName(): string
    {
        if ($this->isPublicCollector()) {
            return $this->user->getFirstName();
        }

        return $this->artist_name;
    }

    /**
     * Get the last name or other artist name for the profile.
     *
     * @return string
     */
    public function getLastName(): string
    {
        if ($this->isPublicCollector()) {
            return $this->user->getLastName();
        }

        return $this->other_artist_name;
    }

    /**
     * Determine if the profile is an artist.
     *
     * @return bool
     */
    public function isArtist(): bool
    {
        return ProfileType::ARTIST == $this->type;
    }

    /**
     * Determine if the profile is a curator.
     *
     * @return bool
     */
    public function isCurator(): bool
    {
        return ProfileType::CURATOR == $this->type;
    }

    /**
     * Determine if the profile is a public collector.
     *
     * @return bool
     */
    public function isPublicCollector(): bool
    {
        return ProfileType::PUBLIC_COLLECTOR == $this->type;
    }

    /**
     * Check if the profile has associated media.
     *
     * @return bool
     */
    public function hasMedia(): bool
    {
        return $this->getFirstMedia() instanceof Media;
    }

    /**
     * Get the default media associated with the profile.
     *
     * @return Media|null
     */
    public function getFirstMedia(): ?Media
    {
        if (!$this->documents()->exists()) {
            return null;
        }

        $document = $this->documents()->orderBy('order_column')->first();

        return $document?->getFirstMedia();
    }

    /**
     * Get the route URL for the user profile.
     *
     * @param array $query Optional query parameters.
     * @return string
     */
    public function getRoute(array $query = []): string
    {
        return route('app.profiles.show', [
            'profile' => $this->id,
        ] + $query);
    }
}

<?php

namespace App\Support;

use App\Models\Group;
use App\Models\User;
use App\Models\UserProfile;
use App\Support\Contracts\ActiveProfileInterface;
use App\Support\Traits\ActiveProfile\ActiveProfileAccessors;
use App\Support\Traits\ActiveProfile\ActiveProfileHelpers;
use App\Support\Traits\ActiveProfile\ActiveProfileOwnership;
use App\Support\Traits\ActiveProfile\HasActiveProfileCollections;
use App\Support\Traits\ActiveProfile\HasRemovedModelsFromDB;
use BadMethodCallException;

/**
 * Class ActiveProfile
 *
 * Manages the currently active profile (UserProfile, Group, or User) in session.
 * Loads profile from session or authenticated user fallback.
 * Allows setting the active profile or group, updating the session accordingly.
 *
 * Delegates interface methods to the underlying active profile model.
 */
class ActiveProfile implements ActiveProfileInterface
{
    use ActiveProfileAccessors;
    use ActiveProfileHelpers;
    use HasActiveProfileCollections;
    use HasRemovedModelsFromDB;
    use ActiveProfileOwnership;

    /**
     * The currently active profile, either UserProfile, Group or User.
     *
     * @var UserProfile|Group|User|null
     */
    protected UserProfile|Group|User|null $activeProfile = null;

    /**
     * The authenticated user.
     *
     * @var User|null
     */
    protected ?User $user = null;

    public function __construct()
    {
        $this->loadActiveProfile();
    }

    /**
     * Load active profile from session or authenticated user fallback.
     *
     * @return void
     */
    protected function loadActiveProfile(): void
    {
        $this->user = auth()->user();
        $this->activeProfile = null;

        if (!$this->user) {
            return;
        }

        if (session()->exists('group')) {
            $group = session('group');
            if ($group instanceof Group) {
                $this->activeProfile = $group;
                return;
            }
        }

        if (session()->exists('profile')) {
            $profile = session('profile');
            if ($profile instanceof UserProfile) {
                $this->activeProfile = $profile;
                return;
            }
        }

        if ($this->user->hasProfileArtist()) {
            $this->activeProfile = $this->user->profileArtist();
            return;
        }

        if ($this->user->hasProfileCurator()) {
            $this->activeProfile = $this->user->profileCurator();
            return;
        }

        if ($this->user->hasProfilePublicCollector()) {
            $this->activeProfile = $this->user->profilePublicCollector();
            return;
        }

        $this->activeProfile = $this->user;
    }

    /**
     * Set the active profile to the given UserProfile.
     *
     * @param UserProfile $userProfile
     * @return void
     */
    public function setProfile(UserProfile $userProfile): void
    {
        $this->resetSessionContext();

        if ($this->user && $this->user->ownsProfile($userProfile)) {
            $this->activeProfile = $userProfile;
            session(['profile' => $userProfile]);
        }
    }

    /**
     * Set the active profile to the given Group.
     *
     * @param Group $group
     * @return void
     */
    public function setGroup(Group $group): void
    {
        $this->resetSessionContext();

        if ($this->user && $this->user->isInGroup($group->id)) {
            $this->activeProfile = $group;
            session(['group' => $group]);
        }
    }

    /**
     * Reset user and clear session context for profile and group.
     *
     * @return void
     */
    protected function resetSessionContext(): void
    {
        $this->user = auth()->user();
        session()->forget('profile');
        session()->forget('group');
    }

    /**
     * Magic method to delegate calls to the active profile.
     *
     * @param string $method
     * @param array $arguments
     * @return mixed
     *
     * @throws BadMethodCallException
     */
    public function __call(string $method, array $arguments)
    {
        if ($this->activeProfile && method_exists($this->activeProfile, $method)) {
            return $this->activeProfile->$method(...$arguments);
        }

        throw new BadMethodCallException("Method [$method] does not exist on the active profile.");
    }
}

<?php

namespace App\Models\Traits\User;

use App\Emails\Admin\NotifyUserToActivateAccount;
use App\Enums\Status as EnumStatus;
use Illuminate\Support\Facades\Mail;

/**
 * Trait UserHelpers
 *
 * Provides helper methods for the User model, including status updates,
 * permission checks, and sending notifications for account activation.
 *
 * These methods assist with managing user state and admin-related workflows.
 *
 * @package App\Models\Traits\User
 */
trait UserHelpers
{
    /**
     * Determine if the active profile is a UserProfile.
     *
     * @return bool
     */
    public function isProfile(): bool
    {
        return false;
    }

    /**
     * Determine if the active profile is a Group.
     *
     * @return bool
     */
    public function isGroup(): bool
    {
        return false;
    }

    /**
     * Mark the user status as enabled and save the model.
     *
     * @return bool True if the model was successfully saved.
     */
    public function markAsEnabled(): bool
    {
        return $this->fill([
            'status' => EnumStatus::ENABLED,
        ])->save();
    }

    /**
     * Determine if the user can be safely destroyed.
     *
     * User can be destroyed if they have admin access but no associated profiles.
     *
     * @return bool True if the user can be deleted.
     */
    public function canDestroy(): bool
    {
        return $this->canAccessAdmin() && !$this->hasProfile();
    }

    /**
     * Send an email notification to the user to activate their admin account,
     * if they need one.
     *
     * @return void
     */
    public function notifyToActivateAdminAccount(): void
    {
        if ($this->needsActiveAdminAccount()) {
            Mail::to($this)->send(new NotifyUserToActivateAccount($this));
        }
    }
}

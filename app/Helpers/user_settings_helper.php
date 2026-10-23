<?php

use App\Models\FollowerModel;
// app/Helpers/user_settings_helper.php

/**
 * Helper function to check if a user's profile is visible to the current visitor
 * @param int $ownerId The ID of the profile owner
 * @return bool True if the profile is visible, owner, or Admin otherwise false
 * 
 */
if (!function_exists('user_settings')) {
    /**
     * Get a User Visibility Setting Value from the database settings 'user:{ownerId}' not set, 
     * otherwise return the default to the UserSettings.profileVisibility setting value.
     * 
     * @param int $ownerId The ID of the profile owner
     * 
     * @return bool Returns the visibility setting value for the user or the default setting if not set
     */
    function is_profile_visible(int $ownerId): bool
    {
        $visitorId = auth()->id() ?? null;// Get the current visitor's user ID (null if not logged in)
        // Check if visitor or Admin
        if (auth()->loggedIn()){
            $visitorisAdmin = auth()->user()->inGroup('admin');// Check if User is part of admin group
        } else {
            $visitorisAdmin = false;
        }
        
        // Always visible to the owner or admin
        if ($visitorId === $ownerId || $visitorisAdmin)
            return true;

        $settings = service('settings');
        // Get the profile visibility setting for the owner, defaulting to 'user:{ownerId}' if not set
        $visibility = $settings->get('UserInfo.visibility', "user:{$ownerId}");

        // echo "Is Profile Visibility: $visibility, Visitor ID: $visitorId, Owner ID: $ownerId, Is Admin: " . ($visitorisAdmin ? 'Yes' : 'No') . "\n";
        // exit;

        return match ($visibility) {
            'public' => check_if_denied($ownerId, $visitorId), // Check if User is blocked, if blocked return false (not visible), otherwise true (visible) of Public
            'private' => false, // Only owner or User in admin group (handled above)
            'friends' => check_friendship($ownerId, $visitorId),// Check if User is a friend (mutual followers), if true return true (visible), otherwise false (not visible)
            default => true, // Default to not visible if setting is unrecognized
        };
    }

    /**
     * Check is the current visitor is a friend of the profile owner by checking if they are following each other (mutual followers)
     * 
     * @param int $ownerId The ID of the profile owner
     * @param int|null $visitorId The ID of the visitor (null if not logged in)
     * 
     * @return bool Returns true if the visitor is a friend of the owner, false otherwise
     */
    function check_friendship($ownerId, $visitorId): bool
    {
        if (!$visitorId)
            return false;

        $isFollowing = model(FollowerModel::class)->isFollowing($visitorId, $ownerId, true);

        if ($isFollowing) {
            return true;
        }
        return false;
    }

    /**
     * Check if the Current logged in User is denied by the $followdId User
     * 
     * @param int $ownerId The ID of the profile owner
     * @param int|null $visitorId The ID of the visitor (null if not logged in)
     * 
     * @return bool Returns true if the visitor is not denied by the owner, false if denied or visitor is not logged in
     */
    function check_if_denied($ownerId, $visitorId): bool
    {
        // if (!$visitorId)
        //     return false;

        $isDenied = model(FollowerModel::class)->isDenied($visitorId, $ownerId);
        $isDenied = $isDenied ? true : false; // Ensure it's a boolean value

        // echo "Checking block status: Visitor ID = $visitorId, Owner ID = $ownerId, Is Blocked = " . ($isDenied ? 'Yes' : 'No') . "\n";
        // exit;
        
        return $isDenied ? false : true;// If blocked, return false (not visible), otherwise true (visible)
    }
}
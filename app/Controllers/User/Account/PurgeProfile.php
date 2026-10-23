<?php

namespace App\Controllers\User\Account;

use CodeIgniter\RESTful\ResourceController;
/**
 * Delete User and associated records from Database
 */
class PurgeProfile extends ResourceController
{
    protected $format = 'json';

    // DELETE /account/purge
    public function purgeAccount($id)
    {
        // 1. Authenticate the active user
        $userId = auth()->id();
        if (!$userId ==  $id) {
            return redirect()->back()->with('error', 'Authentication required.');
        }

        // 2. Fetch the Core Shield User Provider Model instance
        $userProvider = auth()->getProvider();
        $user = $userProvider->findById($userId);

        if (!$user) {
            return redirect()->back()->with('error', 'User profile not found.');
        }

        // 3. Optional: Revoke all active API tokens associated with this user
        $user->revokeAllAccessTokens();

        // 4. Force a Complete Database Hard Delete (Pass 'true' as 2nd parameter)
        // This removes the row from 'users' and cascades into auth_identities, 
        // auth_groups_users, auth_permissions_users, etc.
        $userProvider->delete($user->id, true);


        // 5. Clear session data and redirect to homepage with success message
        auth()->logout();
        // session()->destroy();

        return redirect()->to('login')->with('message', 'Your account has been successfully deleted.');

    }
}

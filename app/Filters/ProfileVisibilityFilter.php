<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\User\UserModel;

class ProfileVisibilityFilter implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return RequestInterface|ResponseInterface|string|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Get the profile user ID from the URI (e.g., profile/username)
        $segments = $request->getUri()->getSegments();
        
        $profileUsername = $segments[1] ?? null; // Adjust index based on the route
        
        // Return early if no username found in URI
        if (!$profileUsername) return;

        // Fetch the user ID based on the username
        $profileUserModel = model(UserModel::class);
        $profileUser = $profileUserModel->findByCredentials(['username' => $profileUsername]);
        
        // If user not found, return null
        $profileUserId = $profileUser->id ?? null;

        // Return early if user id not found
        if (!$profileUserId) return;

        // Check if the profile is visible to the current visitor
        if (!is_profile_visible($profileUserId)) {
            return redirect()->to('login')->with('message', 'This profile is restricted.');
        }


    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return ResponseInterface|void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}

<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminAuth implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should return the given $request, but may also return
     * a modified request or response.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Check if user is logged in
        if (!auth()->loggedIn()) {
            return redirect()->to('login')->with('error', 'You must be logged in to access this page.');
        }

        // Check if user is in admin group
        if (!auth()->user()->inGroup('admin')) {
            // Retrieve a custom 'group_denied' from settings
            $destination = setting('Auth.redirects')['group_denied'];
            
            return redirect()->to($destination)->with('error', 'You must have Admin permission to access that page.');
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
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}

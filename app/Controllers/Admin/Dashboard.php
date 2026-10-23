<?php
/**
 * Admin Backend Dashboard Controller
 * 
 * This controller handles all Admin-related authentication 
 * and profile management within the application.
 * 
 * @package    App\Controllers
 * @author     Andrew Nite <ngendesign@email.com.com>
 * @copyright  2026 N-Gen Design <https://ngendesign.com>
 * @license    https://opensource.org MIT License
 * @link       https://github.com/n-genesis/ngen-kumbuka-ci
 */
namespace App\Controllers\Admin;

use App\Controllers\AdminController;
use CodeIgniter\HTTP\ResponseInterface;

class Dashboard extends AdminController
{

    public function index()
    {
        // Get user stats
        $totalUsers = count($this->userModel->findAll());
        $activeUsers = count($this->userModel->where('active', 1)->findAll());
        $inactiveUsers = $totalUsers - $activeUsers;

        return $this->renderView('pages/admin/dashboard',[
            'appTitle' => setting('App.appName').' | Admin Dashboard',
            'pageHeader' => 'Admin Dashboard',
            'breadcrumbLinks' => [
                ['label' => 'Home', 'url' => site_url('home')],
                ['label' => 'User Managment', 'url' => ''],
            ],
            'totalUsers' => $totalUsers,
            'activeUsers' => $activeUsers,
            'inactiveUsers' => $inactiveUsers,
        ]);
    }
}

<?php

namespace App\Controllers\User\Network;

use App\Controllers\UserController;
use App\Models\FollowerModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\User\UserModel;

class Search extends UserController
{
    protected $userModel;

    public function __construct(){
        $this->userModel = model(UserModel::class);
    }
    public function index()
    {
        // User Search
        $search = $this->request->getGet('query') ?? '';

        // 5. Apply search filter if search terms
        if(!empty($search)){
            // Basic search across username, email, first_name, last_name
            $this->userModel
            ->join('auth_identities', 'auth_identities.user_id = users.id', 'inner')
            ->join('user_details', 'user_details.user_id = users.id', 'left')
            ->where('auth_identities.type', 'email_password')
            ->groupStart() // Groups OR logic so it doesn't break other WHERE clauses
                ->like('users.username', $search)
                ->orLike('auth_identities.secret', $search)
                ->orLike('user_details.first_name', $search)
                ->orLike('user_details.last_name', $search)
            ->groupEnd();
        }
        
        // 6. Order by created_at asc
        //$builder->orderBy('created_at','asc');

        // 7. Get user results for pagination
        $users = $this->userModel->paginate();
        $pager = $this->userModel->pager;// Pager links

        return $this->renderView('pages/search/index', [
            'appTitle' => setting('App.appName') . ' | Network Search',
            'pageHeader' => 'Recent Activity',
            'breadcrumbLinks' => [
                ['label' => 'Home', 'url' => site_url('home')],
                ['label' => 'Network', 'url' => site_url('network/following')],
                ['label' => 'User Search', 'url' => ''],
            ],
            'followerModel' => model(FollowerModel::class),
            // Query parameters
            'results' => $users,
            'pager' => $pager,
            'query' => $search,
        ]);
    }
}

<?php

namespace App\Controllers\Admin;

use App\Controllers\AdminController;
use App\Entities\User\User as UserEntity;
use App\Models\User\UserModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Shield\Models\UserIdentityModel;

/**
 * Admin User Managment Controller
 * 
 * This controller handles all user-related operations within the admin panel, 
 * and profile management within the application.
 * 
 * @package    App\Controllers
 * @author     Andrew Nite <ngendesign@email.com.com>
 * @copyright  2026 N-Gen Design <https://ngendesign.com>
 * @license    https://opensource.org MIT License
 * @link       https://github.com/n-genesis/ngen-kumbuka-ci
 */
class Users extends AdminController
{
    protected $userModel;

    public function __construct(){
        $this->userModel = model(UserModel::class);
    }
    /**
     * Show a list if current application Users
     * 
     * NOTE: When trying to Query the DB from a username and email (from auth_identities table) using Shields UserModel withIdentities() method
     * seems to clear the JOIN statment before pagination() is triggered. To fix this the Query Builder join is used to make sure the table in 
     * joined in the results 
     * 
     * @return string
     * 
     * TODO: Refactor search to use a custom Model method
     */
    public function index()
    {   
        // 1. Get search query
        $search = $this->request->getGet('search');
        $active = $this->request->getGet('active') ?? 'true';

        // 2. Get the Query Builder for the model
        $builder = $this->userModel->builder();

        // 3. Explicitly join the auth_identities table with the users table.
        // This ensures the join stays persists for BOTH queries run by the paginate() method.
        $builder->join('auth_identities', 'auth_identities.user_id = users.id', 'inner')
                ->join('user_details', 'user_details.user_id = users.id', 'left')
                ->where('auth_identities.type', 'email_password');

        // 4. Apply active filter if provided (check if the user is active or inactive)
        $userActiveStatus = $active === "false" ? false : true;
        $builder->where('users.active', $userActiveStatus);

        // 5. Apply search filter if search terms
        if(!empty($search)){
            // Basic search across username, email, first_name, last_name
            $this->userModel
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

        // Render view with users data
        return $this->renderView('pages/admin/users/index',[
            'appTitle' => setting('App.appName').' | User Managment',
            'pageHeader' => 'User Managment',
            'breadcrumbLinks' => [
                ['label' => 'Home', 'url' => site_url('home')],
                ['label' => 'User Managment', 'url' => site_url('admin/dashboard')],
                ['label'=> 'User List','url'=> ''],
            ],
            // Query parameters
            'users' => $users,
            'pager' => $pager,
            'search' => $search,
            'active'=> $active,
        ]);
    }
    /**
     * Create new User
     * @return string
     */
    public function create() {
        // Get unique groups from the auth_groups_users table
        $db = \Config\Database::connect();
        $groups = $db->table('auth_groups_users')
            ->select('`group`')
            ->distinct()
            ->get()
            ->getResultArray();

        return $this->renderView('pages/admin/users/create',[
            'appTitle' => setting('App.appName').' | Create User',
            'pageHeader' => 'Create New User',
            'breadcrumbLinks' => [
                ['label' => 'Home', 'url' => site_url('admin/dashboard')],
                ['label'=> 'User Managment', 'url' => site_url('admin/users')],
                ['label' => 'Create User', 'url' => ''],
            ],
            'groups' => $groups,
        ]);
    }

    public function store()
    {
        // 1. Get the official Shield User Provider (Model)
        $userProvider = auth()->getProvider();

        // Validate input
        $rules = [
            'username' => 'required|min_length[3]|max_length[30]|alpha_numeric_space|is_unique[users.username]',
            'email' => 'required|valid_email|is_unique[auth_identities.secret]',
            'password' => 'required|strong_password',
            'password_confirm' => 'required|matches[password]',
            'groups' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // 2. Instantiate a clean Shield User Entity
        $user = new \CodeIgniter\Shield\Entities\User([
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
        ]);

        // 3. Save the user record to the main database
        if (! $userProvider->save($user)) {
            // Returns validation errors if the email/username is already taken
            return redirect()->back()->withInput()->with('errors', $userProvider->errors());
        }

        // 4. Retrieve the fully hydrated user object with its assigned database ID
        $user = $userProvider->findById($userProvider->getInsertID());

        // 5. Assign a security role group (e.g., 'user', 'admin')
        // Add user to groups
        $groups = $this->request->getPost('groups');
        foreach ($groups as $group) {
            $user->addGroup($group);
        }

        // 6. Optional: Activate the account immediately (bypasses email validation rules)
        $user->activate();


        return redirect()->to('admin/users')->with('message', 'User created successfully.');
    }

    /**
     * Edit Current User Credecials
     * 
     * @param mixed $id
     * @return string|\CodeIgniter\HTTP\RedirectResponse
     */
    public function edit($id = null)
    {
        // Get User by ID
        $user = $this->userModel->findById($id);

        if (!$user) {
            return redirect()->to(site_url('admin/users'))->with('error', 'User not found.');
        }

        // Returns the identity record if it exists, or null
        $identityModel = model(UserIdentityModel::class);
        // Returns the identity record if it exists, or null
        $identity = $identityModel->getIdentityByType($user, 'email_activate');

        // if ($identity !== null) {
        //     // User still has a pending email activation record
        // }

        // Get unique groups from the auth_groups_users table
        $db = \Config\Database::connect();
        $groups = $db->table('auth_groups_users')
            ->select('`group`')
            ->distinct()
            ->get()
            ->getResultArray();

        // Get user groups
        $userGroups = $user->getGroups();

        return $this->renderView('pages/admin/users/edit',[
            'appTitle' => setting('App.appName').' | Edit User',
            'pageHeader' => 'Edit User: '.$user->full_name,
            'breadcrumbLinks' => [
                ['label' => 'Home', 'url' => site_url('admin/dashboard')],
                ['label' => 'User Managment', 'url' => site_url('admin/users')],
                ['label' => 'Edit User', 'url' => ''],
            ],
            'user' => $user,
            'groups' => $groups,
            'userGroups' => $userGroups,
            'pendingActivation' => $identity !== null,
        ]);
    }
    /**
     * Update User Information
     * 
     * @param mixed $id
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function update($id = null)
    {

        $userProvider = auth()->getProvider();
        // Get user
        $user = $userProvider->findById($id);

        // echo '<pre>';
        // var_dump($user);
        // echo '</pre>';
        // exit;

        // Check if user exists
        if (!$user) {
            return redirect()->to('admin/users')->with('error', 'User not found.');
        }

        // Check is User is being banned or unbanned
        $status = $this->request->getPost('status');

        // echo '<pre>';
        // var_dump($this->request->getPost());
        // echo '</pre>';
        // exit;

        if ($status === 'banned') {
            // Prevent admin from banning their own account
            if( $user->id === auth()->id()){
                return redirect()->to('admin/users')->with('error', 'You cannot ban your own account. What!? Lol.');
            }
            // Check for banning, validate status message
            if (!$this->validate([
                'status_message' => [
                    'label' => 'Status Message',
                    'rules' => 'required|min_length[3]|max_length[30]',
                    "errors" => [
                        'required' => 'The {field} is required when banning a user.',
                        'min_length' => 'The {field} must be at least {param} characters long.',
                        'max_length' => 'The {field} cannot exceed {param} characters in length.',
                    ]
                ]
            ])) {
                // Make sure a status message is provided
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $status_message = $this->request->getPost('status_message');// Get submitted message
            $user->ban($status_message);// Ban user with message
            // Redirect to user list with success message
            return redirect()->to('admin/users')->with('message', 'User has been banned');

        } elseif ($status === 'active') {
            // Unban user
            $user->unban();
        }

        // TODO: Check to activate user
        $active = $this->request->getPost('active');
        
        if ($active) {
            $user->activate();
            //Remove the forced activation screen identity
            $identityModel = model(UserIdentityModel::class);
            $identityModel->deleteIdentitiesByType($user, 'email_activate');
        } else {
            // Prevent admin from deactivating their own account
            if( $user->id === auth()->id()){
                return redirect()->to('admin/users')->with('error', 'You cannot deactivate your own account. What!? Lol.');
            }
            $user->deactivate();
        }

        // Validate input
        // TODO: Improve validation rules and error messages
        $rules = [
            'username' => [
                'label' => 'Username',
                'rules' => 'required|min_length[3]|max_length[30]|regex_match[/^[a-zA-Z0-9]+(?:\.[a-zA-Z0-9]+)?$/]|is_unique[users.username,id,'.$user->id.']',
                "errors" => [
                    'regex_match' => 'The {field} field can only contain alphanumeric characters and one(1) period.',
                    'is_unique'=> 'The {field} is already taken by another user. You must pick a unique unsername.',
                ],
            ],
            'email' => 'required|valid_email',
            'groups' => 'required',
        ];

        // Add password validation if password is provided
        if ($this->request->getPost('password')) {
            $rules['password'] = 'required|strong_password';
            $rules['password_confirm'] = 'required|matches[password]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Update user
        $userData = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
        ];

        // Add password if provided
        if ($this->request->getPost('password')) {
            $userData['password'] = $this->request->getPost('password');
        }

        $user->fill($userData);

        // Save user
        $userProvider->save($user);

        // Update user groups
        // First remove all existing groups
        foreach ($user->getGroups() as $group) {
            $user->removeGroup($group);
        }
        
        // Then add the selected groups
        $groups = $this->request->getPost('groups');
        if (is_array($groups)) {
            foreach ($groups as $group) {
                $user->addGroup($group);
            }
        }

        return redirect()->to('admin/users')->with('message', 'User updated successfully.');
    }
    
    /**
     * Soft delete User if Admin permission
     * @param mixed $id
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function delete($id = null){
        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->to('admin/users')->with('error', 'User not found.');
        }
        // Prevent admin from deleting their own account
        if( $user->id === auth()->id()){
            return redirect()->to('admin/users')->with('error', 'You cannot delete your own account.');
        }
        // If User exists, delete them
        if($user){
            $this->userModel->delete($id, true);
            log_activity("Admin Deleted user $user->username",'system','info');
            return redirect()->to('admin/users')->with('message', 'User deleted successfully.');
        }else{
            return redirect()->to('admin/users')->with('error', 'User could not be deleted.');
        }
    }

    /**
     * Activate a User Account
     * 
     * @param mixed $id
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function activate($id = null){
        // Get user
        $user = $this->userModel->find($id);

        // Check if user exists
        if (!$user) {
            return redirect()->to('admin/users')->with('error', 'User not found.');
        }

        // Activate user
        $user->activate();
        //Remove the forced activation screen identity
        $identityModel = model(UserIdentityModel::class);
        $identityModel->deleteIdentitiesByType($user, 'email_activate');

        return redirect()->to('admin/users')->with('message', 'User has been activated.');
    }
}

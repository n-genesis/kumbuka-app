<?php

namespace App\Controllers\User\Account;

use App\Controllers\UserController;
use App\Models\User\UserModel;
use App\Models\User\UserDetailsModel;

use CodeIgniter\HTTP\ResponseInterface;

class AccountSettings extends UserController
{
    protected $userModel;

    protected $userDetailModel;

    public function __construct() {
        $this->userModel = model(UserModel::class);
        $this->userDetailsModel = model(UserDetailsModel::class);
    }
    
    public function index()
    {
        $user = $this->userModel->findById($this->userId);

        return $this->renderView('pages/account/account_settings', [
            'appTitle' => setting('App.appName') . ' | Account Settings',
            'pageHeader' => 'Account Settings',
            'breadcrumbLinks' => [
                ['label' => 'Home', 'url' => site_url('home')],
                ['label' => 'Edit Profile', 'url' => site_url('account')],
                ['label' => 'Account Settings', 'url' => ''],
            ],
            'user' => $user,
        ]);
    }

    public function updateInformation()
    {

        // Check if the use exists
        $user = auth()->user();

        // Check if the logged in user is trying to update their own information
        if ($this->userId !== auth()->id()) {
            return redirect()->to('account/settings')->with('error', 'You do not have permission to edit this user');
        }

        // Validate input
        $rules = [
            'username' => [
                'lable' => 'Username',
                'rules' => 'required|min_length[3]|max_length[30]|alpha_dash|is_unique[users.username,id,' . $this->userId . ']',
                'error' => [
                    'is_unique' => 'Looks like someone already took that username. Can you think of another?'
                ]
            ],
            'email' => 'required|valid_email|is_unique[auth_identities.secret,id,' . $this->userId . ']',
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('account/settings')->with('errors', $this->validator->getErrors());
        }

        $userProvider = auth()->getProvider();

        $user->fill([
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email')
        ]);
        // 5. Commit changes to both tables safely
        if ($userProvider->save($user)) {
            return redirect()->back()->with('message', 'Userrname and email updates.');
        }

        return redirect()->to('home')->with('error', 'And error occurring. Please try again.');

    }

    public function changePassword()
    {
        // Check if the use exists
        $user = auth()->user();

        // Validate input
        $rules = [
            'current_password' => 'required',
            'password' => 'required|strong_password',
            'password_confirm' => 'required|matches[password]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $credentials = [
            'email' => $user->email,
            'password' => $this->request->getPost('current_password'),
        ];

        $userProvider = auth()->getProvider();

        $passwordCheck = auth()->check($credentials);


        // Password Check
        if (! $passwordCheck->isOK()) {
            return redirect()->back()->with('errors', 'Current password is incorrect.');
        }

        // Update password
        $user->fill([
            'password' => $this->request->getPost('password'),
        ]);

        $userProvider->save($user);

        return redirect()->to('account/settings')->with('message', 'Your password has been updated.');
    }

    public function privacy()
    {
        return $this->renderView('pages/account/privacy', [
            'appTitle' => setting('App.appName') . ' | Privacy Settings',
            'pageHeader' => 'Privacy Settings',
            'breadcrumbLinks' => [
                ['label' => 'Home', 'url' => site_url('home')],
                ['label' => 'Privacy Settings', 'url' => ''],
            ],
        ]);
    }
}

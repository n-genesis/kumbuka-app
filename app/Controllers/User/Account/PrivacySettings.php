<?php

namespace App\Controllers\User\Account;


use App\Controllers\UserController;
use App\Models\User\UserModel;
/**
 * Controller for User Privacy Settings
 * 
 */
class PrivacySettings extends UserController
{
    protected $userId;
    protected $userModel;
    protected $userChoices;
    public function __construct()
    {
        $this->userModel = model(UserModel::class);


        $this->userChoices = [// User Nottification Setting Choices
            'accountPrivacy',
            'accountActivityStatus',
            'allowFollowers',
            'profileVisibility',
        ];
    }
    /**
     * Summary of index
     * Show current User Notifications & allows user edits
     * @return string|\CodeIgniter\HTTP\RedirectResponse
     */
    public function index()
    {
        // Get Current User Model
        $user = $this->userModel->findById($this->userId);
        // Define the user-specific context
        $context = 'user:'.$this->userId;
        $settings = service('settings');

        // Dump to View
        return $this->renderView('pages/account/privacy_settings', 
        [
            'appTitle' => setting('App.appName').' | Privacy Settings',
                'pageHeader' => 'Privacy Settings',
                'breadcrumbLinks' => [
                    ['label' => 'Home', 'url' => site_url('home')],
                    ['label' => 'Privacy Settings', 'url' => ''],
                ],
                'user' => $user,
                'visibility' => $settings->get('UserInfo.visibility', $context) ?? 'public',
                'accountPrivacy' => $settings->get('UserInfo.accountPrivacy', $context),
                'allowFollowers' => $settings->get('UserInfo.allowFollowers', $context),
            ]);

    }
    /**
     * Summary of update
     * Update User Identity and User Details Tables
     * @param mixed $id User Id
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function update()
    {

        // Get user
        $user = $this->userModel->findById($this->userId);

        // Check if user exists
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        // Define the user-specific context
        $context = 'user:'.$this->userId;
        $settings = service('settings');

        // Define allowed settings keys to prevent malicious POST injections
        $allowedSettings = ['visibility', 'allowFollowers', 'accountPrivacy'];

        // Loop through allowed fields and save them if they exist in the POST data
        foreach ($allowedSettings as $key) {
            if ($this->request->getPost($key) !== null) {
                $value = $this->request->getPost($key);
                
                // Save using a common prefix namespace like 'UserInfo' or 'App'
                $settings->set("UserInfo.{$key}", $value, $context);
            }else {
                // If the setting is not present in the POST data, remove it
                $settings->forget("UserInfo.{$key}", $context);
            }
        }


        return redirect()->back()->with('message', 'Privacy Settings updated successfully.');

    }

}

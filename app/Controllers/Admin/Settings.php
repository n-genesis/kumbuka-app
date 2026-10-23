<?php

namespace App\Controllers\Admin;

use App\Controllers\AdminController;
use CodeIgniter\HTTP\ResponseInterface;

class Settings extends AdminController
{
    protected $siteSettingsOpts;

    public function __construct(){
        $this->siteSettingsOpts = [
            'allowRegistration' => service('settings')->get('Auth.allowRegistration') ? 'checked' : '',
        ];
    }
    
    public function index()
    {
        // Get site settings
       $siteSettings  = [
            "appName"=> service('settings')->get('App.appName'),
            "appDesc"=> service('settings')->get('App.appDesc'),
            "appEmail"=> service('settings')->get('App.appEmail'),
        ];

        return $this->renderView('pages/admin/settings',[
            'appTitle' => setting('App.appName').' | Site Settings',
            'pageHeader' => 'Site Settings',
            'breadcrumbLinks' => [
                ['label' => 'Home', 'url' => site_url('admin/dashboard')],
                ['label' => 'Site Settings', 'url' => ''],
            ],
            'siteSettings'=> $siteSettings,
            'siteSettingsOpts'=> $this->siteSettingsOpts,
        ]);
    }
    /**
     * Update site settings
     */
    public function update()
    {
        
        // Validate input
        $rules = [
            'appName' => 'required|min_length[3]|max_length[255]',
            'appDesc' => 'required',
            'appEmail' => 'required|valid_email',
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Update general settings
        if($this->request->getPost()){
            // Update settings
            service('settings')->set('App.appName', $this->request->getPost('appName'));
            service('settings')->set('App.appDesc', $this->request->getPost('appDesc'));
            service('settings')->set('App.appEmail', $this->request->getPost('appEmail'));
        }

        // Detirmine if New User Registration is allowed
        $allowRegistration = $this->request->getPost('allowRegistration');
        service('settings')->set('Auth.allowRegistration', $allowRegistration ? true : false);

                
        return redirect()->to('admin/settings')->with('message', 'Settings updated successfully.');
    }
}

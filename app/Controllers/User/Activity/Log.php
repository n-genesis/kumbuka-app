<?php

namespace App\Controllers\User\Activity;

use App\Controllers\BaseController;
use App\Models\ActivityLogModel;
use CodeIgniter\HTTP\ResponseInterface;

class Log extends BaseController
{
    protected $activityModel;

    public function __construct(){
        $this->activityModel = model(ActivityLogModel::class);

    }
    public function index()
    {


        return $this->renderView('pages/activity/log/index', [
            'appTitle' => setting('App.appName') . ' | Recent Activity',
            'pageHeader' => 'Activity Log',
            'breadcrumbLinks' => [
                ['label' => 'Home', 'url' => site_url('dashboard')],
                ['label' => 'Edit Profile', 'url' => site_url('account')],
                ['label' => 'Activity Log', 'url' => ''],
            ],
            // Users only see their own logs; Admins see everything
            'activities' => $this->activityModel->where('user_id', $this->userId)
                ->orderBy('created_at', 'DESC')
                ->paginate(10),
            'pager' => $this->activityModel->pager,
        ]);

    }
}

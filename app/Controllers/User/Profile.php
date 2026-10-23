<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\User\UserModel;
use App\Models\FollowerModel;
use App\Models\NoteModel;
use App\Models\NotebookModel;
use App\Models\CommentModel;

class Profile extends BaseController
{
    protected $userModel;
    protected $noteModel;
    protected $notebookModel;
    protected $commentModel;
    protected $followerModel;
    public function __construct()
    {
        // Load necessary models, libraries, etc.
        $this->userModel = model(UserModel::class);
        $this->noteModel = model(NoteModel::class);
        $this->notebookModel = model(NotebookModel::class);
        $this->commentModel = model(CommentModel::class);
        $this->followerModel = model(FollowerModel::class);
    }
    public function index()
    {
        //
    }
    public function profile(string $username = '')
    {
        if (empty($username)) {

        }

        $user = $this->userModel->findByCredentials(['username' => $username]);

        // If user not found, redirect to home with error message
        if (!$user) {
            return redirect()->to('login')->with('error', 'User not found.');
        }

        // echo '<pre>';
        // var_dump($this->commentModel->getCommentsUsing('user',$user->id));
        // echo '</pre>';
        // exit;

        return $this->renderView('pages/profile/index', [
            'appTitle' => setting('App.appName') . ' | ' . $user->username . ' Profile',
            'pageHeader' => "$user->username's Profile",
            'breadcrumbLinks' => [
                ['label' => 'Home', 'url' => site_url('home')],
                ['label' => "$user->username Profile", 'url' => ''],
            ],
            'user' => $user,
            'comments' => $this->commentModel->getCommentsUsing('user',$user->id),
            'followerModel' => $this->followerModel,
        ]);
    }
}

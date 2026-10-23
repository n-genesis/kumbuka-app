<?php

namespace App\Controllers\User\Network;

use App\Controllers\UserController;
use App\Models\FollowerModel;
use CodeIgniter\HTTP\ResponseInterface;

class UserNetwork extends UserController
{
    protected $followerModel;

    public function __construct()
    {
        // Initialize the model once for use in all methods
        $this->followerModel = model(FollowerModel::class);
    }

    public function friends()
    {
        $followers = $this->followerModel->getFollowing($this->userId);

        return $this->renderView('pages/network/follow', [
            'appTitle' => setting('App.appName') . ' | Network Friends',
            'pageHeader' => "Friends (Following)",
            'subHeader' => "You have " . count($followers) . " friend(s)",
            'breadcrumbLinks' => [
                ['label' => 'Home', 'url' => base_url('home')],
                ['label' => 'Network', 'url' => ''],
                ['label' => 'Friends', 'url' => ''],
            ],
            'followers' => $followers,
            'followerModel' => $this->followerModel,
            
        ]);
    }

    public function following()
    {
        return $this->renderView('pages/network/follow', [
            'appTitle' => setting('App.appName') . ' | Network Followers',
            'pageHeader' => 'Followers',
            'subHeader' => "You have " . count($this->followerModel->getFollowers($this->userId)) . " follower(s)",
            'breadcrumbLinks' => [
                ['label' => 'Home', 'url' => base_url('home')],
                ['label' => 'Network', 'url' => ''],
                ['label' => 'Followers', 'url' => ''],
            ],
            'followers' => $this->followerModel->getFollowers($this->userId),
            'followerModel' => $this->followerModel,
            
        ]);
    }
    
    public function followUser($followedId)
    {
        // Prevent users from following themselves
        if ($followedId == auth()->id()) {
            return redirect()->back()->with('error', 'You cannot follow yourself.');
        }

        $result = $this->followerModel->toggleFollow(auth()->id(), $followedId);

        return redirect()->back()->with('message', 'You ' . ($result === 'followed' ? 'are now following' : 'have unfollowed') . ' this user!');
    }
}

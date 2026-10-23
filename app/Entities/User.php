<?php

namespace App\Entities;

use App\Models\CommentModel;
use App\Models\NoteModel;
use CodeIgniter\Shield\Entities\User as ShieldUser;
use App\Models\FollowerModel;
use Config\UserSettings;

class User extends ShieldUser
{
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];

    public function getCoverImage(): string
    {
        // Use Default avatart image in User Config file User's not set
        $userConfig = config(UserSettings::class);

        $avatar = $this->attributes['cover_image'];

        return $avatar ?? $userConfig->defaultCoverImage;
    }

    /**
     * Custom logic to get a full name.
     * Assumes 'first_name' and 'last_name' are added to the users table.
     * is first and last name are empty, returns the username instead.
     */
    public function getFullName(): string
    {
        $first = $this->attributes['first_name'];
        $last = $this->attributes['last_name'];
        $fullname = $first . ' ' . $last;

        $fullname = $fullname ?? $this->attributes['username'];

        return $fullname;
    }

    /**
     * Get all users following this user
     * Accessible via $user->followers
     */
    public function getFollowers()
    {
        $model = model(FollowerModel::class);
        
        // Join with the users table to get full user objects
        return $model->select('users.*')
                     ->join('users', 'users.id = followers.follower_id')
                     ->where('followed_id', $this->attributes['id'])
                     ->findAll();
    }

    /**
     * Get all users this user is following
     * Accessible via $user->following
     */
    public function getFollowing()
    {
        $model = model(FollowerModel::class);
        
        return $model->select('users.*')
                     ->join('users', 'users.id = followers.followed_id')
                     ->where('follower_id', $this->attributes['id'])
                     ->findAll();
    }

    public function getCommentCount(){
        $commentModel = model(CommentModel::class);
        return $commentModel->getCommentCountByUserId($this->attributes['id']);
    }

    public function getNoteCount(){
        $noteModel = model(NoteModel::class);
        return $noteModel->getNoteCountByUserId($this->attributes['id']);
    }
}

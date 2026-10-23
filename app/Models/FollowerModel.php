<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Follower as FollowerEntity;

class FollowerModel extends Model
{
    protected $table = 'followers';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = FollowerEntity::class;
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'follower_id',
        'followed_id',
        'status',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    /**
     * Check if the Current loggined in User if already follwing the $followdId User
     * 
     * @param mixed $followerId The ID of the user who is following
     * @param mixed $followedId The ID of the user being followed
     * @param bool $acceptedOnly If true, only considers accepted follow relationships
     * 
     * @return bool Returns true if the follower is following the followed user, false otherwise
     */
    public function isFollowing($followerId, $followedId, $acceptedOnly = false)
    {
        $query = $this->where([
            'follower_id' => $followerId,
            'followed_id' => $followedId, 
        ]);

        // If $acceptedOnly is true, only consider relationships with status 'accepted'
        if ($acceptedOnly) {
            $query->where('status', 'accepted')
            ->where('status !=', 'denied');
        } else {
            $query->whereIn('status', ['denied', 'accepted']);
        }

        $result = $query->first() ? true : false; // Returns true if a follow relationship exists, false otherwise

        // echo "Checking follow status: Follower ID = $followerId, Followed ID = $followedId, Accepted Only = " . ($acceptedOnly ? 'Yes' : 'No') . " Record Found = " . ($result ? 'Yes' : 'No') . "\n";
        // exit;

        return $result;
    }

    /**
     * Check if the Current loggined in User has denied the $followdId User
     * 
     * @param mixed $followerId The ID of the user who is blocking
     * @param mixed $followedId The ID of the user being denied
     * 
     * @return bool Returns true if the follower has denied the followed user, false otherwise
     */
    public function isDenied($followerId, $followedId)
    {
        $query = $this->where([
            'follower_id' => $followerId,
            'followed_id' => $followedId,
            'status' => 'denied',
        ])->first();

        $query = $query ? true : false; // Returns true if a denied relationship exists, false otherwise

        return $query;
    }

    /**
     * Inserts or Deletes a follow relationship based on its current state (Follow/Unfollow)
     * and returns a string indicating the action taken ('followed' or 'unfollowed')
     *  
     * @param mixed $followerId The ID of the user who is following
     * @param mixed $followedId The ID of the user being followed
     * @return string Returns 'followed' if the user was followed, 'unfollowed' if the user was unfollowed
     */
    public function toggleFollow($followerId, $followedId)
    {
        $condition = [
            'follower_id' => $followerId,
            'followed_id' => $followedId,
        ];

        // Check if the relationship exists
        $existing = $this->where($condition)->first();

        if ($existing) {
            // If it exists, delete it (Unfollow)
            $this->where($condition)->delete();
            return 'unfollowed';
        } else {
            // If it doesn't exist, insert it (Follow)
            $this->insert($condition);
            return 'followed';
        }
    }
    /**
     * Get all users that the specified user is following
     *
     * @param int $userId The ID of the user
     * @return array An array of user objects that the specified user is following
     */
    public function getFollowing(int $userId)
    {
        return $this->select('users.id as user_id, users.username, user_details.first_name, user_details.last_name, user_details.avatar, user_details.bio, followers.created_at')
            ->join('users', 'users.id = followers.followed_id')
            ->join('user_details', 'user_details.user_id = followers.followed_id')
            ->where('followers.follower_id', $userId)
            ->where('followers.status', 'accepted') // Only get accepted followings
            ->orderBy('followers.created_at', 'DESC')
            ->findAll();
    }

    /**
     * Get all users that are following the specified user
     *
     * @param int $userId The ID of the user
     * @return array An array of user objects that are following the specified user
     */
    public function getFollowers(int $userId, $limit = null)
    {
        $query = $this->select('users.id as user_id, users.username, user_details.first_name, user_details.last_name, user_details.avatar, user_details.bio, followers.created_at')
            ->join('users', 'users.id = followers.follower_id')
            ->join('user_details', 'user_details.user_id = followers.follower_id')
            ->where('followers.followed_id', $userId)
            ->where('followers.status', 'accepted') // Only get accepted followers
            ->orderBy('followers.created_at', 'DESC');

        if ($limit !== null) {
            $query->limit($limit);
        }

        return $query->findAll();
    }
    
    public function getPendingFollowRequests(int $userId)
    {
        return $this->select('users.id as user_id, users.username, user_details.avatar, user_details.bio, followers.created_at')
            ->join('users', 'users.id = followers.follower_id')
            ->join('user_details', 'user_details.user_id = followers.follower_id')
            ->where('followers.followed_id', $userId)
            ->where('followers.status', 'pending') // Only get pending follow requests
            ->orderBy('followers.created_at', 'DESC')
            ->findAll();
    }

    public function getFollowRequests(int $userId)
    {
        return $this->select('users.id as user_id, users.username, user_details.avatar, user_details.bio, followers.created_at')
            ->join('users', 'users.id = followers.follower_id')
            ->join('user_details', 'user_details.user_id = followers.follower_id')
            ->where('followers.followed_id', $userId)
            ->where('followers.status', 'pending') // Only get pending follow requests
            ->orderBy('followers.created_at', 'DESC')
            ->findAll();
    }

    public function getFollowingUsersLatestNotes(int $userId, $limit = 5)
    {
        return $this->select('notes.*, notes.id as note_id, notes.created_at as note_created_at, notebooks.*, notebooks.id as notebook_id, notebooks.name as notebook_name, users.*, user_details.*')
            ->join('users', 'users.id = followers.followed_id')
            ->join('user_details', 'user_details.user_id = users.id', 'left')
            ->join('notes', 'notes.user_id = users.id', 'left')
            ->join('notebooks', 'notebooks.id = notes.notebook_id', 'left')
            ->where('followers.follower_id', $userId)
            ->where('notes.visibility', 'public') // Only public Notes
            ->where('followers.status', 'accepted') // Only get accepted followings
            ->orderBy('notes.created_at', 'DESC')
            ->limit($limit)
            ->findAll();
    }
    
}

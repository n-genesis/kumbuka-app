<?php

namespace App\Models;

use App\Entities\CommunityFeed as CommunityFeedEntity;
use CodeIgniter\Model;

class CommunityFeedModel extends Model
{
    protected $table = 'notes';
    protected $primaryKey = 'id';
    protected $returnType = CommunityFeedEntity::class;
    protected $useSoftDeletes = false;
    protected $allowedFields = [];

    /**
     * Return the latest public notes and notebooks owned by users the reader follows.
     */
    public function getFollowingActivity(int $userId, int $limit = 20, int $offset = 0): array
    {
        $limit = max(1, $limit);

        $notes = $this->db->table('notes')
            ->select("notes.id as note_id, 'note' as activity_type, notes.user_id, notes.notebook_id, notes.title, notes.content, notes.created_at, notes.updated_at, notebooks.id as notebook_id, notebooks.name as notebook_name, users.username, user_details.first_name, user_details.last_name, user_details.avatar")
            ->join('followers', 'followers.followed_id = notes.user_id')
            ->join('notebooks', 'notebooks.id = notes.notebook_id', 'left')
            ->join('users', 'users.id = notes.user_id')
            ->join('user_details', 'user_details.user_id = notes.user_id', 'left')
            ->where('followers.follower_id', $userId)
            ->where('followers.status', 'accepted')
            ->where('notes.visibility', 'public')
            ->orderBy('notes.created_at', 'DESC')
            ->limit($limit)
            ->offset($offset)
            ->get()
            ->getResultArray();

        $notebooks = $this->db->table('notebooks')
            ->select("notebooks.id as notebook_id, 'notebook' as activity_type, notebooks.user_id, notebooks.name as title, NULL as content, notebooks.created_at, notebooks.updated_at, notebooks.name as notebook_name, users.username, user_details.first_name, user_details.last_name, user_details.avatar")
            ->join('followers', 'followers.followed_id = notebooks.user_id')
            ->join('users', 'users.id = notebooks.user_id')
            ->join('user_details', 'user_details.user_id = notebooks.user_id', 'left')
            ->where('followers.follower_id', $userId)
            ->where('followers.status', 'accepted')
            ->where('notebooks.visibility', 'public')
            ->orderBy('notebooks.created_at', 'DESC')
            ->limit($limit)
            ->offset($offset)
            ->get()
            ->getResultArray();

        $entries = array_merge($notes, $notebooks);
        usort($entries, static fn (array $left, array $right): int => strcmp((string) $right['created_at'], (string) $left['created_at']));

        return array_map(fn (array $entry): CommunityFeedEntity => new CommunityFeedEntity($entry), array_slice($entries, 0, $limit));
    }

    public function getFollowingNotes(int $userId, int $limit = 20, int $offset = 0): array
    {
        return $this->getFollowingEntries('notes', $userId, $limit, $offset);
    }

    public function getFollowingNotebooks(int $userId, int $limit = 20, int $offset = 0): array
    {
        return $this->getFollowingEntries('notebooks', $userId, $limit, $offset);
    }

    private function getFollowingEntries(string $table, int $userId, int $limit, int $offset): array
    {
        $limit = max(1, $limit);
        $offset = max(0, $offset);
        $isNote = $table === 'notes';
        $builder = $this->db->table($table);

        if ($isNote) {
            $builder->select("notes.id as note_id, 'note' as activity_type, notes.user_id, notes.notebook_id, notes.title, notes.content, notes.created_at, notes.updated_at, notebooks.id as notebook_id, notebooks.name as notebook_name, users.username, user_details.first_name, user_details.last_name, user_details.avatar")
                ->join('notebooks', 'notebooks.id = notes.notebook_id', 'left')
                ->where('notes.visibility', 'public');
        } else {
            $builder->select("notebooks.id as notebook_id, 'notebook' as activity_type, notebooks.user_id, notebooks.name as title, NULL as content, notebooks.created_at, notebooks.updated_at, notebooks.name as notebook_name, users.username, user_details.first_name, user_details.last_name, user_details.avatar")
                ->where('notebooks.visibility', 'public');
        }

        return array_map(
            fn (array $entry): CommunityFeedEntity => new CommunityFeedEntity($entry),
            $builder->join('followers', "followers.followed_id = {$table}.user_id")
                ->join('users', "users.id = {$table}.user_id")
                ->join('user_details', "user_details.user_id = {$table}.user_id", 'left')
                ->where('followers.follower_id', $userId)
                ->where('followers.status', 'accepted')
                ->orderBy("{$table}.created_at", 'DESC')
                ->limit($limit)
                ->offset($offset)
                ->get()
                ->getResultArray()
        );
    }

    public function getActivityCount(int $userId, string $table): int
    {
        return $this->db->table($table)
            ->join('followers', "followers.followed_id = {$table}.user_id")
            ->where('followers.follower_id', $userId)
            ->where('followers.status', 'accepted')
            ->where("{$table}.visibility", 'public')
            ->countAllResults();
    }
}
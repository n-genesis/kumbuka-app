<?php

namespace App\Models;
use App\Entities\NotebookShare as NotebookShareEnitiy;

class NotebookShareModel extends BaseModel
{
    protected $table            = 'notebook_shares';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = NotebookShareEnitiy::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'notebook_id',
        'user_id',
        'access_level'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getShareById(int $shareId)
    {
        return $this->select('notebook_shares.*, notebook_shares.id as notebook_share_id')
                    ->where('notebook_shares.id', $shareId)
                    ->first();
    }
    /**
     * Get all notebooks shared WITH a specific user.
     */
    public function getSharedWithUser(int $userId)
    {
        return $this->select('notebooks.*, notebook_shares.id AS share_id, notebook_shares.access_level, notebook_shares.user_id AS shared_user_id')
                    ->join('notebooks', 'notebooks.id = notebook_shares.notebook_id')
                    ->where('notebook_shares.user_id', $userId)
                    ->orderBy('notebook_shares.created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Get all share records for a specific notebook.
     */
    public function getSharesForNotebook(int $notebookId)
    {
        return $this->select('notebook_shares.*, notebook_shares.id as notebook_share_id, users.username, user_details.avatar, user_details.first_name, user_details.last_name')
                    ->join('users', 'users.id = notebook_shares.user_id', 'left')
                    ->join('user_details', 'user_details.user_id = users.id', 'left')
                    ->where('notebook_shares.notebook_id', $notebookId)
                    ->orderBy('notebook_shares.created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Find a share row for a notebook and user.
     */
    public function findByNotebookAndUser(int $notebookId, int $userId)
    {
        return $this->where('notebook_id', $notebookId)
                    ->where('user_id', $userId)
                    ->first();
    }

    /**
     * Check specific access rights.
     */
    public function checkAccess(int $notebookId, int $userId, $all = false)
    {
        $query = $this->select('notebook_shares.*, notebook_shares.id as notebook_share_id')->where('notebook_id', $notebookId)
                    ->where('user_id', $userId);
        if ($all) {
            $query->where('access_level', $all);
        } else {
            $query->whereIn('access_level', ['view', 'edit']);
        }

        return $query->first();
    }

    /**
     * Toggles access permissions for a specific user on a notebook.
     * 
     * @param int $notebookId
     * @param int $targetUserId The user gaining or losing access
     * @param string $accessLevel 'view' or 'edit'
     * @return string Returns 'shared' or 'unshared' depending on the action taken
     */
    public function toggleShare(int $notebookId, int $targetUserId, string $accessLevel = 'view'): string
    {
        // 1. Look for an existing shared link record
        $existingShare = $this->where('notebook_id', $notebookId)
                              ->where('user_id', $targetUserId)
                              ->first();

        if ($existingShare) {
            // 2. If it exists, delete it (Unshare execution)
            $this->delete($existingShare['id']);
            return 'unshared';
        }

        // 3. If it does not exist, insert it (Share execution)
        $this->save([
            'notebook_id'  => $notebookId,
            'user_id'      => $targetUserId,
            'access_level' => $accessLevel
        ]);

        return 'shared';
    }
}

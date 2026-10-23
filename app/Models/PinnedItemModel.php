<?php

namespace App\Models;

use CodeIgniter\Model;

class PinnedItemModel extends Model
{
    protected $table            = 'pinned_items';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'entity_id','entity_type'];

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

    public function isPinned(int $userId, int $entityId, string $entityType): bool
    {
        return $this->where('user_id', $userId)
                    ->where('entity_id', $entityId)
                    ->where('entity_type', $entityType)
                    ->countAllResults() > 0;
    }

    public function getPinnedItemByUserId(int $userId, int $entityId, string $entityType)
    {
        return $this->where('user_id', $userId)
                    ->where('entity_id', $entityId)
                    ->where('entity_type', $entityType)
                    ->first();
    }

    /**
     * Update the Pinned status for a note or notebook.
     * 
     * @param int $userId
     * @param int $entiryId ID of a notes or notebooks row
     * @param string $entityType 'note' or 'notebook'
     * @return boolean Returns true or false depending on an exciting record
     */
    public function updatePinnedItem(int $userId, int $entiryId, string $entityType): bool
    {
        $existingPin = $this->where('user_id', $userId)
            ->where('entity_id', $entiryId)
            ->where('entity_type', $entityType)
            ->first();

        if ($existingPin) {
            // Already pinned, so unpin it
            $this->delete($existingPin->id);
            return true; // Indicate that the item was unpinned
        } else {
            // Not pinned yet, so pin it
            $this->save([
                'user_id' => $userId,
                'entity_id' => $entiryId,
                'entity_type' => $entityType
            ]);
            return false; // Indicate that the item was pinned
        }
    }

    public function getPinnedCountByEntityId(int $entityId, string $entityType): int
    {
        return $this->where('entity_id', $entityId)
                    ->where('entity_type', $entityType)
                    ->countAllResults();
    }

    public function getPinnedItemsByUserId(int $userId, string $entityType, int $limit = 10, int $offset = 0)
    {
        
        // Choose which user info to get
        switch ($entityType) {
            case 'note':
                $query = $this->select('pinned_items.*, pinned_items.created_at as pinned_created_at, notes.*, notes.id as note_id, notebooks.id as notebook_id, notebooks.name as notebook_name, users.*')
                        ->where('pinned_items.user_id', $userId)
                        ->where('pinned_items.entity_type', $entityType)
                        ->join('notes', 'notes.id = pinned_items.entity_id')
                        ->join('notebooks', 'notebooks.id = notes.notebook_id')
                        ->join('users', 'users.id = notes.user_id');
                break;
            case 'notebook':
                $query = $this->select('pinned_items.*, pinned_items.created_at as pinned_created_at, notebooks.id as notebook_id, notebooks.name as notebook_name, users.*')
                        ->where('pinned_items.user_id', $userId)
                        ->where('pinned_items.entity_type', $entityType)
                        ->join('notebooks', 'notebooks.id = pinned_items.entity_id')
                        ->join('users', 'users.id = notebooks.user_id');
                break;
        }

        return $query->orderBy('pinned_items.created_at', 'DESC')
                    ->findAll($limit, $offset);
    }

    public function getPinnedItem(int $userId, int $entityId, string $entityType)
    {
        return $this->where('user_id', $userId)
                    ->where('entity_id', $entityId)
                    ->where('entity_type', $entityType)
                    ->first();
    }

}

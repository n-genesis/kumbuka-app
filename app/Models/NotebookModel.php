<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Notebook as NotebookEntity;

class NotebookModel extends BaseModel
{
    protected $table            = 'notebooks';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = NotebookEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id',
        'name',
        'metadata',
        'theme_color',
        'image_path',
        'visibility',
        

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
    protected $beforeUpdate     = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    
    protected $beforeDelete     = [];
    protected $afterDelete    = [];

    // Fetch notebooks for a specific user
    public function getNotebooksByUserId($userId)
    {
        return $this->select('notebooks.*, notebooks.id as notebook_id')->where('user_id', $userId)
        ->orderBy('notebooks.created_at', 'DESC')
        ->findAll();
    }

    public function getNotebookById(int $notebookId)
    {
        return $this->select('notebooks.*, notebooks.id as notebook_id, user_details.*, user_details.id as user_details_id')
        ->where('notebooks.id', $notebookId)
        ->join('users','users.id = notebooks.user_id')
        ->join('user_details', 'user_details.id = users.id')
        ->orderBy('notebooks.created_at', 'DESC')
        ->first();
    }

    // Fetch notebooks that are marked as shared globally or to specific users
    public function getSharedNotebooks()
    {
        return $this->where('is_shared', 1)->findAll();
    }

    protected function deleteOldImageOnUpdate(array $data)
    {
        if (isset($data['data']['image_path'])) {
            $old = $this->find($data['id']);
            if (!empty($old['image_path']) && file_exists(FCPATH . $old['image_path'])) {
                unlink(FCPATH . $old['image_path']);
            }
        }
        return $data;
    }

    protected function deleteOldImageOnDelete(array $data)
    {
        foreach ($data['id'] as $id) {
            $old = $this->find($id);
            if (!empty($old['image_path']) && file_exists(FCPATH . $old['image_path'])) {
                unlink(FCPATH . $old['image_path']);
            }
        }
        return $data;
    }
    
}

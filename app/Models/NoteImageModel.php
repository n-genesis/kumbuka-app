<?php

namespace App\Models;

use CodeIgniter\Model;

class NoteImageModel extends Model
{
    protected $table            = 'note_image';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id',
        'note_id',
        'file_path', 
        'file_name', 
        'file_size',
        'sort_order',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
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

    public function getImagesByUserId(int $userId)
    {
        return $this->select('note_image.*')->where('user_id', $userId)->findAll();
    }

    public function getImagesByNoteId(int $noteId)
    {
        return $this->select('note_image.*')
                    ->where('note_image.note_id', $noteId)
                    ->findAll();
    }

    public function getImageById(int $imageId)
    {
        return $this->select('note_image.*')->where('id', $imageId)->first();
    }

    public function saveImage(int $noteId, string $imagePath)
    {
        $data = [
            'user_id' => auth()->id(),
            'note_id' => $noteId,
            'file_path'  => $imagePath,
            'file_name' => 'file',

        ];

        // Check if the record already exists for this notebook_id
        // if ($this->where('note_id', $noteId)->find()) {
        //     // Update the existing row
        //     return $this->where('note_id', $noteId)->set($data)->update();
        // }

        // Insert a brand new row
        return $this->insert($data);
    }
    
}

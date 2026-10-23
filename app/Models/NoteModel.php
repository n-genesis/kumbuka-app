<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Note as NoteEntity;

class NoteModel extends Model
{
    protected $table            = 'notes';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = NoteEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'user_id',
        'slug',
        'title', 
        'content',
        'color',
        'allow_comments',
        'notebook_id',
        'visibility',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [
        'allow_comments' => 'bool'
    ];
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
    protected $beforeInsert = ['generateSlug'];
    protected $afterInsert = [];
    protected $beforeUpdate = ['generateSlug'];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * Generate a slug from the title
     * Seemed easiest/best to put the mechanics here
     * @param array $data
     * @return array
     */
    protected function generateSlug(array $data)
    {
        if (isset($data['data']['title'])) {
            // Retrieve the ID(s) being updated
            // It is typically an array of IDs: [0 => 123]
            if (isset($data['id'])) {
                $id = is_array($data['id']) ? $data['id'][0] : $data['id'];
            } else {
                $id = null;
            }
            helper('url');
            $baseSlug = mb_url_title($data['data']['title'], '-', true);
            $slug = $baseSlug;
            $count = 1;

            // Check for uniqueness in the database
            // Does the slug exist and NOT the current row being updated 
            while ($this->where('id !=', $id)->where('slug', $slug)->first()) {
                $slug = $baseSlug . '-' . $count++;
            }

            $data['data']['slug'] = $slug;
        }
        return $data;
    }
    
    /**
     * Fetch notes for a specific user
     * 
     * @param int $userId The ID of the user
     * @return array An array of NoteEntity objects belonging to the specified user
     */
    public function getNotesByUserId(int $userId, string $visibility = 'public'){
        return $this->select('notes.*, notes.id as note_id, notes.created_at as note_created_at, notebooks.name as notebook_name, users.*, user_details.first_name, user_details.last_name, user_details.avatar')
        ->where('notes.user_id', $userId)
        ->where('notes.visibility', $visibility)
        ->join('notebooks', 'notes.notebook_id = notebooks.id')
        ->join('users','users.id = notes.user_id')
        ->join('user_details', 'user_details.user_id = users.id')
        ->orderBy('notes.created_at', 'DESC')
        ->findAll();
    }

    /**
     * Fetch a single note by its ID
     * 
     * @param int $noteId The ID of the note
     * @return NoteEntity|null The NoteEntity object if found, otherwise null
     */
    public function getNoteById(int $noteId){
        return $this->select('notes.*, notes.id as note_id, notes.visibility as note_visibility, notes.created_at as note_created_at, notes.updated_at as note_updated_at, notebooks.*, notebooks.id as notebook_id, notebooks.name as notebook_name, notebooks.visibility as notebook_visibility, notebooks.user_id as notebook_user_id, users.*, users.id as user_id, user_details.*')
        ->where('notes.id', $noteId)
        ->join('users','users.id = notes.user_id')
        ->join('notebooks','notebooks.id = notes.notebook_id', 'left')
        ->join('user_details','user_details.user_id=users.id', 'left')
        ->orderBy('notes.created_at', 'DESC')
        ->first();
    }
    /**
     * Fetch notes for a specific notebook
     * 
     * @param int $notebookId The ID of the notebook
     * @return array An array of NoteEntity objects belonging to the specified notebook
     */
    public function getNotesByNotebook($notebookId)
    {
        return $this->select('notes.*, notes.id as note_id, notes.visibility as note_visibility, notes.created_at as note_created_at, users.*, user_details.*, user_details.id as user_details_id')
        ->where('notebook_id', $notebookId)
        ->join('users','users.id = notes.user_id')
        ->join('user_details','user_details.user_id=users.id', 'left')
        ->orderBy('notes.created_at', 'DESC')
        ->findAll();
    }

    /**
     * Count the number of notes in a specific notebook
     * 
     * @param int $notebookId The ID of the notebook
     * @return int The count of notes in the specified notebook
     */
    public function countNotesByNotebook($notebookId)
    {
        return $this->where('notebook_id', $notebookId)->countAllResults();
    }

    public function getUsersLatesNotes($userId, $limit = 5)
    {
        return $this->select('notes.*, notes.id as note_id, notes.created_at as note_created_at, users.*, user_details.*')
            ->where('notes.user_id', $userId)
            ->join('users', 'users.id = notes.user_id')
            ->join('user_details', 'user_details.user_id = users.id', 'left')
            ->orderBy('notes.created_at', 'DESC')
            ->limit($limit)
            ->findAll();
    }

    public function getAllowComment($noteId){
        return $this->select('id as note_id')
            ->where('notes.id', $noteId)
            ->where('allow_comments', true)->countAllResults() > 0;
    }

    public function getNoteCountByUserId($userId){
        return $this->where('user_id', $userId)
            ->countAllResults();
    }
    
}

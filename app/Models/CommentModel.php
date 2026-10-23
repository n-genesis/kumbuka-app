<?php

namespace App\Models;

use App\Entities\Comment;
use CodeIgniter\Model;

class CommentModel extends Model
{
    protected $table            = 'comments';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = Comment::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id',
        'note_id',
        'content',
        'status',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = ['createNotification'];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getCommentById($id){
        return $this->select('comments.*, comments.id as comment_id')
        ->where('comments.id', $id)
        ->first();
    }
    public function getCommentsByNoteId($noteId)
    {
        return $this->select('comments.*, comments.id as comment_id, comments.created_at as comment_created_at, users.id as user_id, users.username, user_details.*, user_details.id as user_details_id')
        ->join('users', 'users.id = comments.user_id')
        ->join('user_details', 'user_details.user_id = users.id')
        ->where('comments.note_id', $noteId)
        ->orderBy('comments.created_at', 'DESC')
        ->findAll();
    }

    /**
     * Callback Method
     * This receives $eventData automatically from CodeIgniter's event pipeline
     */
    protected function createNotification(array $eventData): array
    {
        // Ensure the insertion succeeded and gave us an ID
        if (!$eventData['result']) {
            return $eventData;
        }

        // Extract the form data arrays passed during the insert() execution
        $submittedData = $eventData['data'];
        $userId = auth()->user()->id ?? null; // Capture the user ID from the data array

        // Get the User's ID of Note post
        $noteModel = model(NoteModel::class);
        $note = $noteModel->getNoteById($submittedData['note_id']);

        if ($userId) {
            $notifModel = model(NotificationModel::class);

            $notifModel->addNotification(
                $submittedData['note_id'],
                $note->user_id,
                $userId,
                "$note->first_name $note->last_name commented on $note->title.",
                'comment',
                
            );
        }

        // Always return the original event data array so the pipeline can finish cleanly
        return $eventData;
    }

    public function getCommentsByUserId($userId)
    {
        return $this->select('comments.*, comments.id as comment_id, comments.created_at as comment_created_at, users.id as user_id, users.username, user_details.*, user_details.id as user_details_id, notes.id as note_id, notes.title as note_title')
        ->join('users', 'users.id = comments.user_id')
        ->join('user_details', 'user_details.user_id = users.id')
        ->join('notes','notes.id = comments.note_id')
        ->where('comments.user_id', $userId)
        ->orderBy('comments.created_at', 'DESC')
        ->findAll();
    }

    public function getCommentsUsing($type = 'note', $id)
    {
        $query =  $this->select('comments.*, comments.id as comment_id, comments.created_at as comment_created_at, users.id as user_id, users.username, user_details.*, user_details.id as user_details_id, notes.id as note_id, notes.title as note_title')
        ->join('users', 'users.id = comments.user_id')
        ->join('user_details', 'user_details.user_id = users.id')
        ->join('notes','notes.id = comments.note_id');
        switch ($type) {
            case 'note':
                $query = $query->where('notes.user_id', $id)
                ->where('comments.user_id !=', $id);
                break;
            case 'user':
                $query = $query->where('comments.user_id', $id);
                break;
        }

        return $query->orderBy('comments.created_at', 'DESC')->findAll();
    }

    public function getCommentCountByNoteId($noteId)
    {
        return $this->where('note_id', $noteId)
            ->countAllResults();
    }
    public function getCommentCountByUserId($userId)
    {
        return $this->where('user_id', $userId)
            ->countAllResults();
    }
}

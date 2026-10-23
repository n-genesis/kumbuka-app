<?php

namespace App\Controllers\System;

use App\Models\CommentModel;
use App\Models\NoteModel;
use App\Models\User\UserModel;
use CodeIgniter\RESTful\ResourceController;

class CommentController extends ResourceController
{
    protected $format = 'json';

    public function store()
    {
        // Enforce AJAX check
        if (!$this->request->isAJAX()) {
            return $this->respond([
                'status'  => 'error',
                'message' => 'Direct script access is not allowed.',
                'csrf_token'   => csrf_hash()
            ], 403);
        }

        // Define validation rules
        $rules = [
            'note_id' => 'required|integer',
            'content'       => 'required|min_length[5]',
        ];

        // Define custom validation error messages
        $messages = [
            'content' => [
                'required'   => 'The comment section cannot be blank.',
                'min_length' => 'Your comment must be at least 5 characters long.'
            ]
        ];

        // Check validation
        if (!$this->validate($rules, $messages)) {
            // Flatten errors into a single clean string block or return the raw array
            $errors = implode(' ', $this->validator->getErrors());

            return $this->respond([
                'status'  => 'error',
                'message' => $errors,
                'csrf_token'   => csrf_hash() // Always include fresh token on failure
            ], 422);
        }

        $userId = auth()->user()->id;
        $noteId = $this->request->getPost('note_id');

        $userId = auth()->user()->id;
        $userModel = model(UserModel::class);
        $user = $userModel->findById($userId);

        // Process Database insertion
        $commentModel = model(CommentModel::class);

        $data = [
            'user_id'   => $userId,
            'note_id'   => $noteId,
            'content'       => $this->request->getPost('content'),
            'status'    => 'published',
        ];
        // Trigger NotificationModel Callback in CommentModel
        if ($commentModel->insert($data)) {
            // Get the User's ID of Note post
            $noteModel = model(NoteModel::class);
            $note = $noteModel->getNoteById($noteId);
            // Add to activity
            log_activity("Reply on note $note->title",'system','info');

            return $this->respond([
                'status'   => 'success',
                'message'  => 'Comment posted successfully!',
                'username' => $user->username,
                'content'     => esc($data['content']),
                'csrf_token'    => csrf_hash() // Fresh csrf_token for next submission
            ], 201);
            
        }

        // Database failure backup
        return $this->respond([
            'status'  => 'error',
            'message' => 'Unable to save your comment due to a server issue. Please try again.',
            'csrf_token'   => csrf_hash()
        ], 500);
    }

    public function delete($id = null){
        // Check if AJAX
        if(!$this->request->isAJAX()){
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Direct script access is not allowed.',
                'token'   => csrf_hash()
            ])->setStatusCode(403);
        }

        $userId = auth()->user()->id;

        $commentModel = model(CommentModel::class);

        $comment = $commentModel->getCommentById($id);

        // echo '<pre>';
        // var_dump($comment);
        // echo '</pre>';
        // exit;

        if(!$comment || $comment->note_author_user_id != $userId){
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => "Comment not found or you're Unauthorized delete this comment ",
                'token'   => csrf_hash() // Always include fresh token on failure
            ])->setStatusCode(422);
        }

        if($commentModel->deleteComment($id)){
            
            return $this->response->setJSON([
                'status'   => 'success',
                'message'  => 'Comment deleted successfully!',
                'token'   => csrf_hash() // Always include fresh token on failure
            ])->setStatusCode(201);
        }

        return $this->response->setJSON([
            'status'  => 'error',
            'message' => 'Unable to save your comment due to a server issue. Please try again.',
            'token'   => csrf_hash()
        ])->setStatusCode(500);


    }
}

<?php

namespace App\Controllers\User;

use App\Controllers\UserController;
use App\Models\CommentModel;
use App\Models\NoteModel;

class Comment extends UserController
{
    protected $commentModel;

    public function __construct()
    {
        $this->commentModel = model(CommentModel::class);
    }

    /**
     * Display a listing of the current user's comments.
     * GET /comments
     */
    public function index()
    {
        $comments = $this->commentModel->getCommentsUsing('user', $this->userId);
        $comments_received = $this->commentModel->getCommentsUsing('note', $this->userId);

        return $this->renderView('pages/activity/comments/index', [
            'appTitle' => setting('App.appName') . ' | Comments',
            'pageHeader' => 'Comments',
            'breadcrumbLinks' => [
                ['label' => 'Home', 'url' => base_url('home')],
                ['label' => 'Activity', 'url' => ''],
                ['label' => 'Comments', 'url' => ''],
            ],
            'comments' => $comments,
            'comments_received' => $comments_received,
        ]);
    }

    /**
     * Show a single comment.
     * GET /comments/show/(:num)
     */
    public function show($id = null)
    {
        $comment = $this->commentModel->find($id);

        if (!$comment || (int) $comment->user_id !== (int) $this->userId) {
            return redirect()->to('/comments')->with('error', 'Comment not found.');
        }

        return $this->renderView('pages/activity/comments/show', [
            'appTitle' => setting('App.appName') . ' | Comments',
            'pageHeader' => 'View Comment',
            'breadcrumbLinks' => [
                ['label' => 'Home', 'url' => base_url('home')],
                ['label' => 'Comments', 'url' => base_url('comments')],
                ['label' => 'View', 'url' => ''],
            ],
            'comment' => $comment,
        ]);
    }

    /**
     * Display the form to create a new comment.
     * GET /comments/new
     */
    public function new()
    {
        return $this->renderView('pages/activity/comments/new', [
            'appTitle' => setting('App.appName') . ' | New Comment',
            'pageHeader' => 'New Comment',
            'breadcrumbLinks' => [
                ['label' => 'Home', 'url' => base_url('home')],
                ['label' => 'Comments', 'url' => base_url('comments')],
                ['label' => 'New', 'url' => ''],
            ],
            'comment' => null,
        ]);
    }

    /**
     * Save a new comment.
     * POST /comments/create
     */
    public function create()
    {
        $rules = [
            'content' => 'required|min_length[3]|max_length[2000]',
            'note_id' => 'permit_empty|integer',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->commentModel->insert([
            'user_id' => $this->userId,
            'note_id' => $this->request->getPost('note_id'),
            'content' => trim($this->request->getPost('content')),
            'status' => 'published',
        ]);

        return redirect()->to('/comments')->with('success', 'Comment created successfully.');
    }

    /**
     * Display the form to edit an existing comment.
     * GET /comments/edit/(:num)
     */
    public function edit($id = null)
    {
        $comment = $this->commentModel->find($id);

        if (!$comment || (int) $comment->user_id !== (int) $this->userId) {
            return redirect()->to('/comments')->with('error', 'Comment not found.');
        }

        return $this->renderView('pages/activity/comments/edit', [
            'appTitle' => setting('App.appName') . ' | Edit Comment',
            'pageHeader' => 'Edit Comment',
            'breadcrumbLinks' => [
                ['label' => 'Home', 'url' => base_url('home')],
                ['label' => 'Comments', 'url' => base_url('comments')],
                ['label' => 'Edit', 'url' => ''],
            ],
            'comment' => $comment,
        ]);
    }

    /**
     * Update an existing comment.
     * POST /comments/update/(:num)
     */
    public function update($id = null)
    {
        $comment = $this->commentModel->find($id);

        if (!$comment || (int) $comment->user_id !== (int) $this->userId) {
            return redirect()->to('/comments')->with('error', 'Comment not found.');
        }

        $rules = [
            'content' => 'required|min_length[3]|max_length[2000]',
            'note_id' => 'permit_empty|integer',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->commentModel->update($id, [
            'note_id' => $this->request->getPost('note_id'),
            'content' => trim($this->request->getPost('content')),
            'status' => $this->request->getPost('status') ?? 'published',
        ]);

        return redirect()->to('/comments')->with('success', 'Comment updated successfully.');
    }

    /**
     * Display the confirmation screen before deleting a comment.
     * GET /comments/remove/(:num)
     */
    public function remove($id = null)
    {
        $comments = $this->commentModel->find($id);

        if (!$comments || (int) $comments->user_id !== (int) $this->userId) {
            return redirect()->to('/comments')->with('error', 'Comment not found.');
        }

        return $this->renderView('pages/activity/comments/remove', [
            'appTitle' => setting('App.appName') . ' | Remove Comment',
            'pageHeader' => 'Delete Comment',
            'breadcrumbLinks' => [
                ['label' => 'Home', 'url' => base_url('home')],
                ['label' => 'Comments', 'url' => base_url('comments')],
                ['label' => 'Delete', 'url' => ''],
            ],
            'comments' => $comments,
        ]);
    }

    /**
     * Permanently delete a comment.
     * POST /comments/delete/(:num)
     */
    public function delete($id = null)
    {
        $comment = $this->commentModel->getCommentById($id);

        if (!$comment || (int) $comment->user_id !== (int) $this->userId) {
            return redirect()->back()->with('error', 'Comment not found.');
        }

        // Get the User's ID of Note post
        $noteModel = model(NoteModel::class);
        $note = $noteModel->getNoteById($id);
        // Add to activity
        log_activity("Deleted reply on note $note->title",'system','info');

        $this->commentModel->delete($id);

        return redirect()->back()->with('message', 'Comment deleted successfully.');
    }
}

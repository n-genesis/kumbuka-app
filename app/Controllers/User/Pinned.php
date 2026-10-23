<?php

namespace App\Controllers\User;

use App\Controllers\UserController;
use App\Models\PinnedItemModel;

class Pinned extends UserController
{
    protected $pinnedItemModel;
    public function __construct(){
        $this->pinnedItemModel = model(PinnedItemModel::class);
    }
    /**
     * Display a listing of the current user's pinned note and notebooks.
     * GET /pinned
     */
    public function index()
    {


        return $this->renderView('pages/activity/pinned/index', [
            'appTitle' => setting('App.appName') . ' | Comments',
            'pageHeader' => 'Comments',
            'breadcrumbLinks' => [
                ['label' => 'Home', 'url' => base_url('home')],
                ['label' => 'Activity', 'url' => ''],
                ['label' => 'Pinned Notes & Notebooks', 'url' => ''],
            ],
           'pinnedNotes' => $this->pinnedItemModel->getPinnedItemsByUserId($this->userId, 'note', 25),
           'pinnedNotebooks' => $this->pinnedItemModel->getPinnedItemsByUserId($this->userId,'notebook', 25),
        ]);
    }

    /**
     * Show a single pinned item.
     * GET /pinned/show/(:num)
     */
    public function show($id = null)
    {
        $pinnedItem = $this->pinnedItemModel->find($id);

        if (!$pinnedItem || (int) $pinnedItem->user_id !== (int) $this->userId) {
            return redirect()->to('/pinned')->with('error', 'Comment not found.');
        }

        return $this->renderView('pages/activity/pinned/show', [
            'appTitle' => setting('App.appName') . ' | Pinned Item',
            'pageHeader' => 'View Comment',
            'breadcrumbLinks' => [
                ['label' => 'Home', 'url' => base_url('home')],
                ['label' => 'Pinned Item', 'url' => base_url('activity/pinned')],
                ['label' => 'View', 'url' => ''],
            ],
            'pinnedItem' => $pinnedItem,
        ]);
    }

    /**
     * GET /pinned/new
     */
    public function new()
    {
        return $this->renderView('pages/activity/pinned/new', [
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
     * Save a new pin item.
     * POST /pinned/create
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

        return redirect()->to('/pinned')->with('success', 'Comment created successfully.');
    }

    /**
     * Display the form to edit an existing pinned item.
     * GET /pinned/edit/(:num)
     */
    public function edit($id = null)
    {
        $comment = $this->commentModel->find($id);

        if (!$comment || (int) $comment->user_id !== (int) $this->userId) {
            return redirect()->to('/pinned')->with('error', 'Comment not found.');
        }

        return $this->renderView('pages/activity/pinned/edit', [
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
     * Update an existing pin item.
     * POST /pinned/update/(:num)
     */
    public function update($id = null)
    {
        $comment = $this->commentModel->find($id);

        if (!$comment || (int) $comment->user_id !== (int) $this->userId) {
            return redirect()->to('/pinned')->with('error', 'Comment not found.');
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

        return redirect()->to('/pinned')->with('success', 'Comment updated successfully.');
    }

    /**
     * Display the confirmation screen before deleting a pinned itme.
     * GET /pinned/remove/(:num)
     */
    public function remove($id = null)
    {
        $comments = $this->commentModel->find($id);

        if (!$comments || (int) $comments->user_id !== (int) $this->userId) {
            return redirect()->to('/pinned')->with('error', 'Comment not found.');
        }

        return $this->renderView('pages/activity/pinned/remove', [
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
     * Permanently delete a pinned item.
     * POST /pinned/delete/(:num)
     */
    public function delete($id = null)
    {
        $comment = $this->commentModel->getCommentById($id);

        if (!$comment || (int) $comment->user_id !== (int) $this->userId) {
            return redirect()->back()->with('error', 'Comment not found.');
        }

        $this->commentModel->delete($id);

        return redirect()->back()->with('message', 'Comment deleted successfully.');
    }
}

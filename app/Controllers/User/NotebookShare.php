<?php

namespace App\Controllers\User;

use App\Controllers\UserController;
use App\Models\FollowerModel;
use App\Models\NotebookModel;
use App\Models\NotebookShareModel;

class NotebookShare extends UserController
{
    protected $notebookModel;
    protected $notebookShareModel;

    protected $followerModel;

    public function __construct()
    {
        $this->notebookModel = model(NotebookModel::class);
        $this->notebookShareModel = model(NotebookShareModel::class);
        $this->followerModel = model(FollowerModel::class);
    }

    /**
     * Show all shares for a notebook.
     */
    public function index(int $notebookId)
    {
        // Check Ownership
        $notebook = $this->notebookModel->getNotebookById($notebookId);

        if (!$notebook || !$this->notebookShareModel->isOwnerOfNotebook($notebookId, $this->userId)) {
            return redirect()->to('/notebooks')->with('error', 'You are not allowed to share this notebook.');
        }

        return $this->renderView('pages/notebooks/shares/index', [
            'appTitle' => setting('App.appName') . ' | Notebook User Permissions',
            'pageHeader' => 'Permissions List',
            'breadcrumbLinks' => [
                ['label' => 'Home', 'url' => base_url('home')],
                ['label' => 'Notebooks', 'url' => base_url('notebooks')],
                ['label' => $notebook->name, 'url' => site_url("notebooks/show/$notebook->id")],
                ['label' => $notebook->title ?? 'Notebook Permissions', 'url' => ''],
            ],
            'notebook' => $notebook,
            'notebook_shares' => $this->notebookShareModel->getSharesForNotebook($notebookId),// Get List of Followers
        ]);
    }
    

    /**
     * Show form for adding a share.
     */
    public function new(int $notebookId)
    {
        // Check Ownership
        $notebook = $this->notebookModel->getNotebookById($notebookId);

        if (!$notebook || !$this->notebookShareModel->isOwnerOfNotebook($notebookId, $this->userId)) {
            return redirect()->to('/notebooks')->with('error', 'You are not allowed to share this notebook.');
        }

        return $this->renderView('pages/notebooks/shares/new', [
            'appTitle' => setting('App.appName') . ' | Permissions',
            'pageHeader' => 'Manage Permissions',
            'breadcrumbLinks' => [
                ['label' => 'Home', 'url' => site_url('home')],
                ['label' => 'Notebooks', 'url' => site_url('notebooks')],
                ['label' => $notebook->name ?? 'Notebook', 'url' => site_url('notebooks/' . $notebook->notebook_id)],
                ['label' => 'Notebooks Permission', 'url' => site_url("notebooks/$notebookId/shares")],
                ['label' => 'Share', 'url' => ''],
            ],
            'notebook' => $notebook,
            'user_shares' => $this->notebookShareModel->getSharesForNotebook($notebookId),
            'following' => $this->followerModel->getFollowing($this->userId),
        ]);
    }

    /**
     * Create a notebook share record.
     * POST /notebooks/(:num)/share/update
     */
    public function create(int $notebookId)
    {
        $notebook = $this->notebookModel->find($notebookId);

        if (!$notebook || !$this->notebookShareModel->isOwnerOfNotebook($notebookId, $this->userId)) {
            return redirect()->to('notebooks')->with('error', 'You are not allowed to share this notebook.');
        }

        $userId = (int) $this->request->getPost('user_id');
        $accessLevel = $this->request->getPost('access_level');

        if ($userId <= 0 || !in_array($accessLevel, ['view', 'edit'], true)) {
            return redirect()->back()->withInput()->with('errors', ['user_id' => 'Please choose a valid user and access level.']);
        }

        if ($userId === (int) $notebook->user_id) {
            return redirect()->back()->withInput()->with('errors', ['user_id' => 'The notebook owner cannot be added as a shared user.']);
        }

        $existing = $this->notebookShareModel->findByNotebookAndUser($notebookId, $userId);
        if ($existing) {
            $this->notebookShareModel->update($existing->id, ['access_level' => $accessLevel]);
            return redirect()->to("notebooks/$notebookId/shares/new")->with('message', 'Notebook share updated successfully.');
        }

        $this->notebookShareModel->insert([
            'notebook_id' => $notebookId,
            'user_id' => $userId,
            'access_level' => $accessLevel,
        ]);

        return redirect()->to("notebooks/$notebookId/shares/new")->with('message', 'Notebook shared successfully.');
    }

    /**
     * Show a specific share record.
     * TODO: Not Used
     */
    public function show(int $notebookId, int $shareId)
    {
        $notebook = $this->notebookModel->find($notebookId);
        $share = $this->notebookShareModel->find($shareId);

        if (!$notebook || !$share || (int) $share->notebook_id !== $notebookId || !$this->notebookShareModel->isOwnerOfNotebook($notebookId, $this->userId)) {
            return redirect()->to('/notebooks')->with('error', 'Share not found or access denied.');
        }

        return $this->renderView('pages/notebooks/shares/show', [
            'appTitle' => setting('App.appName') . ' | Notebook Share',
            'pageHeader' => 'Notebook Share',
            'breadcrumbLinks' => [
                ['label' => 'Home', 'url' => base_url('home')],
                ['label' => 'Notebooks', 'url' => base_url('notebooks')],
                ['label' => $notebook['title'] ?? 'Notebook', 'url' => base_url('notebooks/' . $notebookId)],
                ['label' => 'Share', 'url' => ''],
            ],
            'notebook' => $notebook,
            'share' => $share,
        ]);
    }

    /**
     * Remove a share row.
     */
    public function delete(int $notebookId, int $shareId)
    {
        $notebook = $this->notebookModel->getNotebookById($notebookId);
        $share = $this->notebookShareModel->getShareById($shareId);

        if (!$notebook || !$share || (int) $share->notebook_id !== $notebookId || !$this->notebookShareModel->isOwnerOfNotebook($notebookId, $this->userId)) {
            return redirect()->to('notebooks')->with('error', 'Share not found or access denied.');
        }

        $this->notebookShareModel->delete($shareId);

        return redirect()->back()->with('message', 'Notebook share removed.');
    }

    public function toggleShareStatus(int $notebookId, int $shareId)
    {
        $notebook = $this->notebookModel->find($notebookId);
        $share = $this->notebookShareModel->find($shareId);

        if (!$notebook || !$share || (int) $share->notebook_id !== $notebookId || !$this->notebookShareModel->isOwnerOfNotebook($notebookId, $this->userId)) {
            return redirect()->back()->with('error', 'Share not found or access denied.');
        }

        // Toggle the access level between 'view' and 'edit'
        $newAccessLevel = ($share->access_level === 'view') ? 'edit' : 'view';
        $this->notebookShareModel->update($shareId, ['access_level' => $newAccessLevel]);

        return redirect()->back()->with('message', 'Notebook share access level updated to ' . ucfirst($newAccessLevel) . '.');
    }

}

<?php

namespace App\Controllers\User;

use App\Controllers\UserController;
use App\Models\NotebookModel;
use App\Models\NotebookShareModel;
use App\Models\NoteModel;
use App\Models\PinnedItemModel;

class Notebook extends UserController
{
    protected $noteModel;
    protected $notebookModel;
    protected $notebookShareModel;
    protected $pinnedItemModel;


    public function __construct()
    {
        $this->noteModel = model(NoteModel::class);
        $this->notebookModel = model(NotebookModel::class);
        $this->notebookShareModel = model(NotebookShareModel::class);
        $this->pinnedItemModel = model(PinnedItemModel::class);
    }

    /**
     * Display a listing of the user's notebooks (Private + Shared with them)
     * GET /notebooks
     */
    public function index()
    {

        return $this->renderView('pages/notebooks/index', [
            'appTitle' => setting('App.appName') . ' | Your Notebooks',
            'pageHeader' => "Notebooks",
            'breadcrumbLinks' => [
                ['label' => 'Home', 'url' => base_url('home')],
                ['label' => " Notebooks", 'url' => ''],
            ],
            'notebooks' => $this->notebookModel->getNotebooksByUserId($this->userId),

        ]);
    }

    /**
     * Helper to verify notebook ownership before executing actions
     */
    private function verifyNotebookOwner($notebookId)
    {
        $notebook = $this->notebookModel->isOwnerOfNotebook((integer) $notebookId, $this->userId);

        if (!$notebook) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Notebook unauthorized or missing.");
        }
        return $notebook;
    }

    /**
     * Show a single notebook and its notes
     * GET /notebooks/show/(:num)
     */
    public function show($notebookId = null)
    {
        $notebook = $this->notebookModel->getNotebookById($notebookId);
        if (!$notebook) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Check Ownership
        $isOwner = ($notebook->user_id == $this->userId);

        // Check Many-to-Many Shared Access
        $shareDetails = $this->notebookShareModel->checkAccess($notebookId, $this->userId);
        $isShared = !empty($shareDetails);

        // Check is Note is Private
        $isPrivate = $notebook->visibility == 'private' ?? true;

        // Deny access if they neither own it nor have a share record
        if (!$isOwner && !$isShared) {
            return redirect()->to('/home')->with('error', "You don't have Access to this Notebook.");
        } elseif(!$isOwner && $isPrivate){
            return redirect()->to('/home')->with('error', "The owner of this notebook hasn't granted open access.");
        }

        return $this->renderView('pages/notebooks/show', [
            'appTitle' => setting('App.appName') . ' | Your Notebooks',
            'pageHeader' => "Notebooks",
            'breadcrumbLinks' => [
                ['label' => "Home", 'url' => base_url('home')],
                ['label' => "Notebooks", 'url' => base_url('notebooks')],
                ['label' => $notebook->name, 'url' => ''],
            ],
            'notebook' => $notebook,
            'notebook_id' => $notebookId,
            'access_level' => $isOwner ? 'admin' : $shareDetails->access_level,
            'notes' => $this->noteModel->getNotesByNotebook($notebookId)

        ]);
    }

    /**
     * Present a view to create a new notebook
     * GET /notebooks/new
     */
    public function new()
    {
        return $this->renderView('pages/notebooks/new', [
            'appTitle' => setting('App.appName') . ' | Create Notebooks',
            'pageHeader' => "Create Notebook",
            'breadcrumbLinks' => [
                ['label' => 'Home', 'url' => site_url('home')],
                ['label' => "Notebooks", 'url' => site_url('notebooks')],
                ['label' => "Create Notebook", 'url' => ''],
            ],
            'notebooks' => $this->notebookModel->where('user_id', $this->userId)->findAll(),

        ]);
    }



    // 4. POST /notebooks/create
    public function create()
    {

        if (!$this->validate('notebookRules')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $imagePath = null;
        $file = $this->request->getFile('notebook_image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/notebooks', $newName);
            $imagePath = 'uploads/notebooks/' . $newName;
        }

        $this->notebookModel->save([
            'user_id' => $this->userId,
            'name' => $this->request->getPost('name'),
            'metadate' => $this->request->getPost('metadata'),
            'description' => $this->request->getPost('description'),
            'theme_color' => $this->request->getPost('theme_color'),
            'image_path' => $imagePath,
            'visibility' => $this->request->getPost('visibility'),
        ]);

        // Add to activity
        log_activity("Created new note ".$this->request->getPost('name'),'system','info');

        return redirect()->to('/notebooks')->with('success', 'Notebook created successfully.');
    }

    // 5. GET /notebooks/edit/(:num)
    public function edit($id = null)
    {
        $notebook = $this->notebookModel->getNotebookById($id);
        if (!$notebook || $notebook->user_id != $this->userId) {
            return redirect()->to('/notebooks')->with('error', 'Notebook note found.');
        }

        
        $this->verifyNotebookOwner($notebook->notebook_id);

        return $this->renderView('pages/notebooks/edit', [
            'appTitle' => setting('App.appName') . " | Editing $notebook->name",
            'pageHeader' => "Editing: $notebook->name",
            'breadcrumbLinks' => [
                ['label' => 'Home', 'url' => base_url('home')],
                ['label' => 'Notebooks', 'url' => base_url('notebooks')],
                ['label' => "Edit Notebook", 'url' => ''],
            ],
            'notebook' => $notebook,

        ]);

    }

    // 6. POST /notebooks/update/(:num)
    public function update($id = null)
    {
        $notebook = $this->notebookModel->getNotebookById($id);
        $this->verifyNotebookOwner($notebook->notebook_id);

        if (!$this->validate('notebookRules')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Add to activity
        log_activity("Updated note ".$this->request->getPost('name'),'system','info');

        $this->notebookModel->update($id, [
            'name' => $this->request->getPost('name'),
            'metadata' => $this->request->getPost('metadata'),
            'description' => $this->request->getPost('description'),
            'theme_color' => $this->request->getPost('theme_color'),
            'visibility' => $this->request->getPost('visibility'),
        ]);
        return redirect()->to('/notebooks')->with('message', 'Notebook updated.');
    }

    // 7. POST /notebooks/remove/(:num)
    public function remove($id = null)
    {
        $notebook = $this->notebookModel->find($id);
        if (!$notebook || $notebook['user_id'] != (session()->get('user_id') ?? 1)) {
            return redirect()->to('/notebooks')->with('error', 'Unauthorized access.');
        }

        return view('notebooks/remove', ['notebook' => $notebook]);
    }

    // 8. POST /notebooks/delete/(:num)
    public function delete($id = null)
    {
        $notebook = $this->notebookModel->find($id);
        if (!$notebook || $notebook->user_id != $this->userId) {
            return redirect()->to('/notebooks')->with('error', 'Unauthorized access.');
        }

        $this->notebookModel->delete($id);
        // Add to activity
        log_activity("Deleted note $notebook->name",'system','info');
        return redirect()->to('/notebooks')->with('success', 'Notebook permanently deleted.');
    }

    public function togglePin($notebookId)
    {

        $existingPin = $this->pinnedItemModel->updatePinnedItem($this->userId,$notebookId, 'notebook');

        if ($existingPin) {
            // Already pinned, so unpin it
            $message = 'Notebook unpinned.';
        } else {
            $message = 'Notebook pinned.';
        }

        // Add to activity
        log_activity($message,'system','info');

        return redirect()->back()->with('message', $message);

    }
}

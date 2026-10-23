<?php

namespace App\Controllers\User;

use App\Controllers\UserController;
use App\Models\NotebookModel;
use App\Models\NotebookShareModel;
use App\Models\NoteImageModel;
use App\Models\NoteModel;
use App\Models\CommentModel;
use App\Models\PinnedItemModel;

class Note extends UserController
{
    protected $noteModel;
    protected $notebookModel;
    protected $noteImageModel;
    protected $notebookShareModel;
    protected $notebookImageModel;
    protected $commentModel;
    protected $pinnedItemModel;

    public function __construct()
    {
        $this->noteModel = model(NoteModel::class);
        $this->notebookModel = model(NotebookModel::class);
        $this->noteImageModel = model(NoteImageModel::class);
        $this->notebookShareModel = model(NotebookShareModel::class);
        $this->commentModel = model(CommentModel::class);
        $this->pinnedItemModel = model(PinnedItemModel::class);
    }

    /**
     * Display a listing of the user's notebooks (Private + Shared with them)
     * GET /notebooks
     */
    public function index()
    {
        $status = $this->request->getGet('status') ?? 'public';

        return $this->renderView('pages/notes/index', [
            'appTitle' => setting('App.appName') . ' | Your Notes',
            'pageHeader' => "Notes",
            'breadcrumbLinks' => [
                ['label' => 'Home', 'url' => base_url('home')],
                ['label' => " Notes", 'url' => ''],
            ],
            'notes' => $this->noteModel->getNotesByUserId($this->userId, $status),
            'notes_status' => $status,

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
     * Display a single note after verifying access to its notebook.
     * GET /notes/show/(:num)
     */
    public function show($id = null)
    {
        // Get Note
        $note = $this->noteModel->getNoteById($id);
        

        if (!$note) {
            return redirect()->to('notes')->with('error', 'Note not found.');
        }

        // Get Note Images
        $noteImages = $this->noteImageModel->getImagesByNoteId($id);

        // Check Ownership of Notebook
        $isOwner = ($note->notebook_user_id == $this->userId);

        // Check Many-to-Many Shared Access
        $shareDetails = $this->notebookShareModel->checkAccess($note->notebook_id, $this->userId);
        $isShared = !empty($shareDetails);

        // Check is Note is Private
        $isNotePrivate = $note->note_visibility == 'private' ?? true;
        $isNotebookPrivate = $note->notebook_visibility == 'private' ?? true;
        // echo '<pre>';
        // var_dump($note->notebook_visibility);
        // echo '</pre>';
        // exit;

        // Deny access if they neither own it nor have a share record
        if (!$isOwner && !$isShared && $this->userId) {
            // echo '<pre>';
            // var_dump($this->userId);
            // echo '</pre>';
            // exit;
            return redirect()->to('/home')->with('error', "The owner of this notebook hasn't granted open access.");
        } elseif(!$isOwner && $isNotePrivate){// If not Owner, note set to private, or Not loggin
            return redirect()->to('/home')->with('error', "The owner of this note hasn't granted open access.");
        }
        
        return $this->renderView('pages/notes/show', [
            'appTitle' => setting('App.appName') . ' | Your Notes',
            'pageHeader' => 'Note Details',
            'breadcrumbLinks' => [
                ['label' => 'Home', 'url' => base_url('home')],
                ['label' => 'Notes', 'url' => ($isOwner ? base_url('notes') : '')],
                ['label' => $note->notebook_name, 'url' => base_url("notebooks/$note->notebook_id")],
                ['label' => $note->title, 'url' => '']
            ],
            'note' => $note,
            'noteImages' => $noteImages,
        ]);
    }

    // 1. GET /notes/new?notebook_id=(:num)
    public function new()
    {

        return $this->renderView('pages/notes/new', [
            'appTitle' => setting('App.appName') . ' | New Note',
            'pageHeader' => "Create a new note",
            'breadcrumbLinks' => [
                ['label' => 'Home', 'url' => base_url('home')],
                ['label' => 'Notes', 'url' => base_url('notes')],
                ['label' => "Post New Note", 'url' => ''],
            ],
            'notebooks' => $this->notebookModel->getNotebooksByUserId($this->userId),

        ]);

    }

    // 2. POST /notes/create
    public function create()
    {

        if (!$this->validate('noteRules')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }


        $this->noteModel->save([
            'user_id' => $this->userId,
            'title' => $this->request->getPost('title'),
            'content' => $this->request->getPost('content'),// body input attribute name="content" for clarity
            'color' => $this->request->getPost('color'),
            'allow_comments' => $this->request->getPost('allow_comments'),
            'visibility' => $this->request->getPost('visibility'),
            'notebook_id' => $this->request->getPost('notebook_id'),
        ]);

        // Add to activity
        log_activity("Created a new note ".$this->request->getPost('title'),'system','info');

        return redirect()->to('notes')->with('message', 'Note added successfully.');
    }

    // 3. GET /notes/edit/(:num)
    public function edit($id = null)
    {
        $note = $this->noteModel->getNoteById($id);
        if (!$note) {
            return redirect()->to('/notebooks')->with('error', 'Note not found.');
        }

        $this->verifyNotebookOwner($note->notebook_id);

        return $this->renderView('pages/notes/edit', [
            'appTitle' => setting('App.appName') . ' | Edit Note',
            'pageHeader' => "Create a new note",
            'breadcrumbLinks' => [
                ['label' => 'Home', 'url' => base_url('home')],
                ['label' => 'Notes', 'url' => base_url('notes')],
                ['label' => "Edit Note", 'url' => ''],
            ],
            'note' => $note,
            'note_images' => $this->noteImageModel->getImagesByNoteId($note->note_id),
            'notebooks' => $this->notebookModel->getNotebooksByUserId($this->userId),

        ]);

    }

    // 4. POST /notes/update/(:num)
    public function update($id = null)
    {
        $note = $this->noteModel->find($id);
        if (!$note) {
            return redirect()->to('/notebooks')->with('error', 'Note not found.');
        }

        $this->verifyNotebookOwner($note->notebook_id);

        if (!$this->validate('noteRules')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Add to activity
        log_activity("Updated note $note->title",'system','info');

        $this->noteModel->update($id, [
            'title' => $this->request->getPost('title'),
            'content' => $this->request->getPost('content'),
            'color' => $this->request->getPost('color'),
            'allow_comments' => $this->request->getPost('allow_comments') == 1 ? true : false,
            'visibility' => $this->request->getPost('visibility'),
            'notebook_id' => $this->request->getPost('notebook_id'),
        ]);

        return redirect()->to("notes")->with('message', 'Note updated.');
    }

    // 5. GET /notes/remove/(:num)
    public function remove($id = null)
    {
        $note = $this->noteModel->find($id);
        if (!$note) {
            return redirect()->to('/notebooks')->with('error', 'Note not found.');
        }

        $this->verifyNotebookOwner($note['notebook_id']);

        return view('notes/remove', ['note' => $note]);
    }

    // 6. POST /notes/delete/(:num)
    public function delete($id = null)
    {
        $note = $this->noteModel->find($id);
        if (!$note) {
            return redirect()->to('notebooks')->with('error', 'Note not found.');
        }

        $this->verifyNotebookOwner($note->notebook_id);

        $this->noteModel->delete($id);

        // Add to activity
        log_activity("Deleted note $note->title",'system','info');
        
        return redirect()->to('notes')->with('message', 'Note deleted.');
    }

    public function togglePin($noteId)
    {

        $existingPin = $this->pinnedItemModel->updatePinnedItem($this->userId, $noteId, 'note');

        if ($existingPin) {
            // Already pinned, so unpin it
            $message = 'Note unpinned.';
        } else {
            // Not pinned yet, so pin it
            $message = 'Note pinned.';
        }

        // Add to activity
        log_activity($message,'system','info');

        return redirect()->back()->with('message', $message);

    }

    public function upload()
    {

        if (!$this->validate('imagesRules')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // 2. Grab the file array
        if ($imageFiles = $this->request->getFiles()) {
            foreach ($imageFiles['note_images'] as $img) {

                // 3. Check if the file is valid and hasn't moved yet
                if ($img->isValid() && !$img->hasMoved()) {

                    // 4. Generate a secure, random name
                    $newName = $img->getRandomName();

                    // 5. Move to the writable or public directory
                    $img->move(WRITEPATH . 'uploads/images', $newName);

                    // 6. Optional: Process/Resize the image
                    //$this->processImage($newName);
                }
            }
        }

        return redirect()->back()->withInput()->with('message', "Image(s) uploaded");
    }

    public function uploadImages()
    {

        if (!$this->validate('imagesRules')) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        $noteId = $this->request->getPost('note_id');

        // echo '<pre>';
        // var_dump($noteId);
        // echo '</pre>';
        // exit;


        if ($imageFiles = $this->request->getFiles()) {
            foreach ($imageFiles['note_images'] as $img) {

                // Check if the file is valid and hasn't moved yet
                if ($img->isValid() && !$img->hasMoved()) {

                    $appConfig = config(\Config\App::class);
                    // Path Substring replace %username% See Config App.php
                    $dirHash = md5($this->username . '|' . $this->userId);
                    $imagePath = str_replace('%username%', $dirHash, $appConfig->publicUploadPath);
                    // Path to upload file
                    $filepath = ROOTPATH . 'public/' . $imagePath . '/notebooks';
                    $files = directory_map($filepath);
                    // New File name
                    $newfile = $img->getName();
                    // Move uploaded image to directroy
                    $img->move($filepath, $newfile, true);

                    // Path to new file
                    $newFile = "$filepath/$newfile";

                    // Rersize the image to 1200x400 pixels
                    $targetWidth = 1200;
                    $targetHeight = 640;

                    // 2CI4 Image Service
                    $imageService = \Config\Services::image()
                        ->withFile($newFile);

                    // Smart Crop & Scale to ensure canvas is perfectly filled
                    $imageService->fit($targetWidth, $targetHeight, 'center')
                        ->save($newFile);

                    // Update Notebook Image field
                    if (!$this->noteImageModel->saveImage($noteId, "$imagePath/notebooks/$newfile")) {
                        return redirect()->back()->with('error', 'Failed to update notebook image. Please try again.');
                    }
                }
            }
        }

        return redirect()->back()->with('message', 'Your new notebook images was updated.');
    }

    private function processImage($fileName)
    {
        // Initialize the image library to create a thumbnail
        \Config\Services::image()
            ->withFile(WRITEPATH . 'uploads/images/' . $fileName)
            ->resize(300, 300, true, 'height')
            ->save(WRITEPATH . 'uploads/images/thumbs/' . $fileName);
    }
}

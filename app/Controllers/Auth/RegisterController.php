<?php

namespace App\Controllers\Auth;

use App\Models\FollowerModel;
use App\Models\NotebookModel;
use App\Models\NotebookShareModel;
use App\Models\NotificationModel;
use App\Models\PinnedItemModel;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\Events\Events;
use CodeIgniter\Shield\Authentication\Authenticators\Session;
use CodeIgniter\Shield\Controllers\RegisterController as ShieldRegisterController;
use App\Models\User\UserDetailsModel;


class RegisterController extends ShieldRegisterController
{
    /**
     * Explicitly inherit or display the registration view
     */
    public function registerView()
    {
        // This safely forwards the request to Shield's core view loader
        return parent::registerView();
    }

    /**
     * Register a new user and handle the registration process.
     */
    public function registerAction(): RedirectResponse
    {
        if (auth()->loggedIn()) {
            return redirect()->to('/home');
        }

        // Check if registration is allowed
        if (!setting('Auth.allowRegistration')) {
            return redirect()->back()->withInput()
                ->with('error', lang('Auth.registerDisabled'));
        }

        $users = $this->getUserProvider();

        // Validate here first, since some things,
        // like the password, can only be validated properly here.
        $rules = $this->getValidationRules();

        if (!$this->validateData($this->request->getPost(), $rules, [], config('Auth')->DBGroup)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Save the user
        $allowedPostFields = array_keys($rules);
        $user = $users->createNewUser($this->request->getPost($allowedPostFields));

        // Workaround for email only registration/login
        if ($user->username === null) {
            $user->username = null;
        }

        try {
            $users->save($user);
        } catch (ValidationException) {
            return redirect()->back()->withInput()->with('errors', $users->errors());
        }


        // To get the complete user object with ID, we need to get from the database
        $user = $users->findById($users->getInsertID());

        // Add to default group
        $users->addToDefaultGroup($user);

        // Get UserDetails Model
        $userDetailsModel = model(UserDetailsModel::class);

        $userDetails = $this->request->getPost(['first_name', 'last_name']);
        // Add user_id to beggining of array
        $userDetails['user_id'] = $user->id;
        $userDetails['avatar'] = config('App')->appDefaultImage;

        // Insert User Details
        $userDetailsModel->insert($userDetails);

        Events::trigger('register', $user);

        /** @var Session $authenticator */
        $authenticator = auth('session')->getAuthenticator();

        $authenticator->startLogin($user);
        // This line calls your custom createIdentity() method behind the scenes
        // $authenticator->loginById($user->id);

        // Add Default DB record for Demo purposes
        $followerModel = model(FollowerModel::class);
        // Admin User Follow new user
        $followerModel->toggleFollow($user->id,1);
        $followerModel->toggleFollow(1,$user->id);
        // Follow WebGuy
        $followerModel->toggleFollow($user->id,2);
        $followerModel->toggleFollow(2,$user->id);
        // Follow Potts
        $followerModel->toggleFollow($user->id,4);
        $followerModel->toggleFollow(4,$user->id);
        
        $pinnedItemModel = model(PinnedItemModel::class);
        // Pin two Notes
        $pinnedItemModel->updatePinnedItem($user->id, 1,'note');

        $notebookShareModel = model(NotebookShareModel::class);
        // Add Notebook Permisstion
        $notebookShareModel->toggleShare(1,$user->id);
        $notebookShareModel->toggleShare(2,$user->id);
        $notebookShareModel->toggleShare(4,$user->id);
        $notebookShareModel->toggleShare(5,$user->id);
        
        // Automaticly pin some notebooks
        $pinnedItemModel->updatePinnedItem($user->id,1,'notebook');
        $pinnedItemModel->updatePinnedItem($user->id,2,'notebook');

        // Create New Notebook
        $notebookModel = model(NotebookModel::class);
        $notebookModel->save([
            'user_id' => $user->id,
            'name' => 'Notebook',
            'image_path' => ''
        ]);
        //Pin newly created notebook
        $pinnedItemModel->updatePinnedItem($user->id,$notebookModel->getInsertID(),'notebook');
        $notebookShareModel->toggleShare($notebookModel->getInsertID(),1);

        // Create Welcome notification
        $notifModel = model(NotificationModel::class);
        $notifModel->addNotification(
            0,
            $user->id,
            1,
            "Welcome To Kumbuka, thanks for Signing up. Get ready to start sharing notes.",
            'welcome',
            
        );

        // If an action has been defined for register, start it up.
        $hasAction = $authenticator->startUpAction('register', $user);
        if ($hasAction) {
            return redirect()->route('auth-action-show');
        }

        // Set the user active
        $user->activate();

        $authenticator->completeLogin($user);

        // Success!
        return redirect()->to(config('Auth')->registerRedirect())
            ->with('message', lang('Auth.registerSuccess'));
    }

    public function registerActionWorking(): RedirectResponse
    {
        if (auth()->loggedIn()) {
            return redirect()->to('/home');
        }

        // Check if registration is allowed
        if (!setting('Auth.allowRegistration')) {
            return redirect()->back()->withInput()
                ->with('error', lang('Auth.registerDisabled'));
        }

        $users = $this->getUserProvider();

        // Validate here first, since some things,
        // like the password, can only be validated properly here.
        $rules = $this->getValidationRules();

        if (!$this->validateData($this->request->getPost(), $rules, [], config('Auth')->DBGroup)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Save the user
        $allowedPostFields = array_keys($rules);
        $user = $users->createNewUser($this->request->getPost($allowedPostFields));

        // Workaround for email only registration/login
        if ($user->username === null) {
            $user->username = null;
        }

        try {
            $users->save($user);
        } catch (ValidationException) {
            return redirect()->back()->withInput()->with('errors', $users->errors());
        }


        // To get the complete user object with ID, we need to get from the database
        $user = $users->findById($users->getInsertID());

        // Add to default group
        $users->addToDefaultGroup($user);

        // Get UserDetails Model
        $userDetailsModel = model(UserDetailsModel::class);

        $userDetails = $this->request->getPost(['first_name', 'last_name']);
        // Add user_id to beggining of array
        $userDetails['user_id'] = $user->id;
        $userDetails['avatar'] = config('App')->appDefaultImage;

        // Insert User Details
        $userDetailsModel->insert($userDetails);

        Events::trigger('register', $user);

        /** @var Session $authenticator */
        $authenticator = auth('session')->getAuthenticator();

        // $authenticator->startLogin($user);
        // This line calls your custom createIdentity() method behind the scenes
        $authenticator->loginById($user->id);
        

        // If an action has been defined for register, start it up.
        $hasAction = $authenticator->startUpAction('register', $user);
        if ($hasAction) {
            return redirect()->route('auth-action-show');
        }

        // Set the user active
        // $user->activate();

        // $authenticator->completeLogin($user);

        // Success!
        // return redirect()->to(config('Auth')->registerRedirect())
        //     ->with('message', lang('Auth.registerSuccess'));
    }

    public function registerActionOld(): RedirectResponse
    {
        if (auth()->loggedIn()) {
            return redirect()->to(config('Auth')->registerRedirect());
        }

        // Check if registration is allowed
        if (!setting('Auth.allowRegistration')) {
            return redirect()->back()->withInput()
                ->with('error', lang('Auth.registerDisabled'));
        }

        $users = $this->getUserProvider();

        // Validate here first, since some things,
        // like the password, can only be validated properly here.
        $rules = $this->getValidationRules();

        if (!$this->validateData($this->request->getPost(), $rules, [], config('Auth')->DBGroup)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Save the user
        $allowedPostFields = array_keys($rules);
        $user = $users->createNewUser($this->request->getPost($allowedPostFields));

        // Workaround for email only registration/login
        if ($user->username === null) {
            $user->username = null;
        }

        try {
            $users->save($user);
        } catch (ValidationException) {
            return redirect()->back()->withInput()->with('errors', $users->errors());
        }

        // To get the complete user object with ID, we need to get from the database
        $user = $users->findById($users->getInsertID());

        // Add to default group
        $users->addToDefaultGroup($user);

        Events::trigger('register', $user);

        /** @var Session $authenticator */
        $authenticator = auth('session')->getAuthenticator();

        $authenticator->startLogin($user);

        // If an action has been defined for register, start it up.
        $hasAction = $authenticator->startUpAction('register', $user);
        if ($hasAction) {
            return redirect()->route('auth-action-show');
        }

        // Set the user active
        $user->activate();

        $authenticator->completeLogin($user);

        // Success!
        return redirect()->to(config('Auth')->registerRedirect())
            ->with('message', lang('Auth.registerSuccess'));
    }

    public function emailSentNotice()
    {
        return view('auth/email_sent_notice');
    }
}

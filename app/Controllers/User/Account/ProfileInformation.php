<?php

namespace App\Controllers\User\Account;

use App\Controllers\UserController;
use App\Models\User\UserDetailsModel;
use App\Models\User\UserModel;
use CodeIgniter\Database\Config;
use Config\App;

/**
 * CRUD operations for editing User Details Information
 */
class ProfileInformation extends UserController
{
    protected $userModel;

    protected $userDetailModel;

    public function __construct() {
        $this->userModel = model(UserModel::class);
        $this->userDetailsModel = model(UserDetailsModel::class);
    }

    public function index()
    {

        $user = $this->userModel->findById($this->userId);

        return $this->renderView('pages/account/profile_information', [
            'appTitle' => setting('App.appName') . ' | User Profile',
            'pageHeader' => 'Edit Profile',
            'breadcrumbLinks' => [
                ['label' => 'Home', 'url' => site_url('home')],
                ['label' => 'Edit Profile', 'url' => ''],
            ],
            'user' => $user,
        ]);

    }

    public function update()
    {

        // Check if the logged in user is trying to update their own information
        if ($this->userId !== auth()->id()) {
            return redirect()->to('account/settings')->with('error', 'You do not have permission to edit this user');
        }

        $userDetailsModel = model(UserDetailsModel::class);

        // Check if a POST request
        if ($this->request->getPost()) {
            // Validation Name & Address(optional) failed
            if (!$this->validate('nameRules') && !$this->validate('contactRules')) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $inserted = [
                'user_id' => $this->userId,
                // Personal Information
                'first_name' => $this->request->getPost('first_name'),
                'last_name' => $this->request->getPost('last_name'),
                'bio' => $this->request->getPost('bio'),
                // Website & Social Links
                'website_link' => $this->request->getPost('website_link'),
                'social_link' => $this->request->getPost('social_link'),
            ];

            if ($userDetailsModel->where('user_id', $this->userId)->set($inserted)->update()) {
                return redirect()->back()->with('message', 'User details information updated successfully');
            } else {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

        }
    }


    public function uploadAvatar()
    {
        $userDetailsModel = model(UserDetailsModel::class);

        $validationRule = [
            'user-avatar' => [
            'label' => 'Profile Picture',
            'rules'  => [
                    'uploaded[user-avatar]', // Ensures a file was actually sent
                    'is_image[user-avatar]', // Blocks malicious scripts disguised as images
                    'mime_in[user-avatar,image/jpg,image/jpeg,image/png,image/webp]', // Safe format whitelist
                    'max_size[user-avatar,5120]', // Limit to 5MB (phone photos can be large)
                ],
        ]
    ];

        if (!$this->validate($validationRule)) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        $img = $this->request->getFile('user-avatar');

        if ($img->isValid() && !$img->hasMoved()) {
            $appConfig = config(App::class);
            // Path Substring replace %username% See Config App.php
            $dirHash = md5($this->username . '|' . $this->userId);
            $imagePath = str_replace('%username%', $dirHash, $appConfig->publicUploadPath);
            // Path to upload file
            $filepath = ROOTPATH . 'public/' . $imagePath;
            
            // New File name
            $newfile = $img->getRandomName();
            // // Clear Directroy to not
            // delete_files($filepath, false, true);
            // Move uploaded image to directroy
            $img->move($filepath, $newfile);

            // Path to new file
            $newFile = "$imagePath/$newfile";


            // Crop the image to a perfect 400x400px centered square automatically
            \Config\Services::image()
                ->withFile($newFile)
                ->fit(500, 500, 'center') // Dimensions: Width, Height, Position Anchor
                ->save($newFile); // Overwrites the original raw file securely


            // Update User Avatar field
            $userDetailsModel->where('user_id', $this->userId)->set([
                'avatar' => $newFile,
            ])->update();

            return redirect()->back()->with('message', 'Your new avatar images was updated.');

        }

        return redirect()->back()->with('message', 'It seems that file has already been uploaded.');
        ;
    }

    public function uploadCoverImage()
    {
        $validationRule = [
            'cover-image' => [
                'label' => 'Cover Image',
                'rules' => [
                    'uploaded[cover-image]', // File must be present
                    'is_image[cover-image]', // Must be a valid image file binary structure
                    'mime_in[cover-image,image/jpg,image/jpeg,image/png,image/webp]', // Allowed formats
                    'max_size[cover-image,8192]', // Limit to 8MB (high-res panoramas/phone landscapes can be heavy)
                ],
                'errors' => [
                    'mime_in' => 'Please upload a valid JPG, PNG, or WebP cover image.',
                    'max_size' => 'The cover image is too large. Maximum limit is 8MB.'
                ]
            ],
        ];

        if ($this->validate($validationRule)) {
            $img = $this->request->getFile('cover-image');

            if ($img->isValid() && !$img->hasMoved()) {

            $appConfig = config(App::class);
            // Path Substring replace %username% See Config App.php
            $dirHash = md5($this->username . '|' . $this->userId);
            $imagePath = str_replace('%username%', $dirHash, $appConfig->publicUploadPath);
            // Path to upload file
            $filepath = ROOTPATH . 'public/' . $imagePath;
            // New File name
            $newfile = $img->getRandomName();
            // // Clear Directroy to not
            // delete_files($filepath, false, true);
            // Move uploaded image to directroy
            $img->move($filepath, $newfile);
            // Path to new file
            $newFile = "$imagePath/$newfile";

            $this->userDetailsModel->where('user_id', $this->userId)->set([
                'cover_image' => $newFile,
            ])->update();

                $targetWidth = 1200;
                $targetHeight = 400;

                // 2CI4 Image Service
                $imageService = \Config\Services::image()
                    ->withFile($newFile);

                // Smart Crop & Scale to ensure canvas is perfectly filled
                $imageService->fit($targetWidth, $targetHeight, 'center')
                    ->save($newFile);
            }

            return redirect()->back()->with('message', 'Your new profile cover images was updated.');
        }

    }
}

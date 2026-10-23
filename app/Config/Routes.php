<?php

use App\Controllers\Public\Pages;
use App\Controllers\User\Activity\Log;
use App\Controllers\User\Notebook;
use App\Controllers\User\Network as Network;
use CodeIgniter\Router\RouteCollection;
// Authentication Controllers
use App\Controllers\Auth\RegisterController;
// System Controllers
use App\Controllers\System;
// Admin Controllers
use App\Controllers\Admin;
// General Pages
use App\Controllers\Home;
use App\Controllers\Public as PublicPages;
// User Operation Controllers
use App\Controllers\User;

/**
 * @var RouteCollection $routes
 */

// Authentication Routes
// $routes->get('register', [RegisterController::class, 'registerView']);
$routes->post('register', [RegisterController::class, 'registerAction']);

service('auth')->routes($routes);

$routes->group('auth', static function ($routes) {
    // $routes->get('a/show', [Public\Pages::class, null]);
    // Notice landing view page route structure
    $routes->get('email_sent_notice', [RegisterController::class, 'emailSentNotice']);
});


$routes->get('/', [Home::class, 'index']);

// Main Routes - Most of these are static templates
$routes->group('', function ($routes) {
    $routes->get('privacy_policy', [PublicPages\Pages::class, 'privacy_policy']);
    $routes->get('terms_of_service', [PublicPages\Pages::class, 'terms_of_service']);
    $routes->get('support', [PublicPages\Pages::class, 'support']);
    $routes->get('about_kumbuka', [PublicPages\Pages::class, 'about_kumbuka']);
});

// User Public Pages
// Uses Filter ProfileVisibilityFilter to check if the profile is public or private
$routes->group('', ['filter' => 'profilevisibility'], function ($routes) {
    // Public User Profile
    $routes->get('profile/(:segment)', [[User\Profile::class,'profile'],'$1']);
    // Public User Notes Collection 
});


$routes->group('', ['filter' => 'userAuth'], function ($routes) {
    // Uses Filter ProfileVisibilityFilter to check if the profile is public or private
    // $routes->get('profile/(:segment)', [[User\Profile::class,'profile'],'$1'],['filter' => 'profilevisibility']);

    // Dashboard/QuickPicks
    $routes->get('home', [User\Home::class, 'index']);
    
    // User Account Routes
    $routes->group('account', function ($routes) {
        // User Account Information CRUD Routes
        $routes->get('', [User\Account\ProfileInformation::class, 'index']);
        $routes->post('update', [User\Account\ProfileInformation::class,'update']);
        $routes->post('update-social', [User\Account\ProfileInformation::class,'updateSocial']);

        // Update Avatar picture
        $routes->post('update-avatar',[User\Account\ProfileInformation::class, 'uploadAvatar']);
        
        // Update Cover Image
        $routes->post('update-cover-image',[User\Account\ProfileInformation::class, 'uploadCoverImage']);

        // User Settings CRUD Routes
        $routes->get('settings', [User\Account\AccountSettings::class, 'index']);
        $routes->post('settings/update', [User\Account\AccountSettings::class,'updateInformation']);
        $routes->post('settings/change-password', [User\Account\AccountSettings::class,'changePassword']);
        
        // User Privacy Settings CRUD Routes
        $routes->get('privacy', [User\Account\PrivacySettings::class,'index']);
        $routes->post('privacy/update', [User\Account\PrivacySettings::class, 'update']);
        
        // Delete User Account
        $routes->delete('purge',  [[User\Account\PurgeProfile::class, 'purgeAccount'], '$1']);
    });

    // Note Routes
    $routes->presenter('notes', ['namespace' => '', 'controller' => User\Note::class]);
    $routes->post('notes/upload', [User\Note::class, 'uploadImages']);

    

    // Notes Comments
    $routes->post('comments/store',[System\CommentController::class, 'store']);

    // Notebook Share controllers
    $routes->group('notebooks', function ($routes) {
            $routes->get('(:num)/shares', [User\NotebookShare::class, 'index']);
            $routes->get('(:num)/shares/new', [User\NotebookShare::class, 'new']);
            $routes->post('(:num)/shares/create', [[User\NotebookShare::class, 'create'],'$1']);
            $routes->post('(:num)/shares/(:num)/toggle', [User\NotebookShare::class, 'toggleShareStatus']);
            // $routes->get('(:num)/shares/(:num)/edit', [User\NotebookShare::class, 'edit']);
            // $routes->post('(:num)/shares/(:num)/update', [User\NotebookShare::class, 'update']);
            $routes->post('(:num)/shares/(:num)/delete', [User\NotebookShare::class, 'delete']);
    });

    // Notebook Controllers - Generates all 7 standard CRUD routes for a web interface
    $routes->presenter('notebooks', ['namespace' => '', 'controller' => User\Notebook::class]);

    // Pin
    $routes->group('pin', function ($routes) {
        $routes->get('notes/(:num)', [User\Note::class, 'togglePin']);
        $routes->get('notebooks/(:num)',[User\Notebook::class, 'togglePin']);
    });
    
    // User Activity
    $routes->group('activity', function ($routes) {
        // Comments
        $routes->presenter('comments', ['namespace' => '', 'controller' => User\Comment::class]);
        // Notifications Routes
        $routes->presenter('notifications', ['namespace' => '', 'controller' => User\Notification::class]);
        $routes->post('notifications/markread',[User\Notification::class, 'markAsRead']);
        $routes->post('notifications/markread/(:num)',[User\Notification::class, 'markAsRead']);
        // User Activity Logs

        // User Pinned Notes & Notebooks
        $routes->presenter('pinned', ['namespace' => '', 'controller' => User\Pinned::class]);

        // Activity Log
        $routes->get('log', [User\Activity\Log::class, 'index']);
        
    });

    // User Network
    $routes->group('network', function ($routes) {
        // User following login user
        $routes->get('following', [Network\UserNetwork::class, 'following']);
        // User followed by login user
        $routes->get('friends', [Network\UserNetwork::class, 'friends']);
        // User feed
        $routes->get('feed', [Network\CommunityFeed::class, 'index']);
        $routes->get('notes', [Network\CommunityFeed::class, 'communityNotes']);
        $routes->get('notebooks', [Network\CommunityFeed::class, 'communityNotebooks']);
        // System Search
        $routes->get('search', [Network\Search::class, 'index']);
    });

    // Toggle Follow/Unfollow
    // $routes->post('follow/toggle/(:segment)', [[User\UserNetwork::class,'followUser'], '$1'],['filter' => 'followThrottle']);
    $routes->post('follow/toggle/(:segment)', [[Network\UserNetwork::class,'followUser'], '$1']);
});

/**
 * Admin Account Routes
 */
$routes->group('admin',['filter' => ['adminAuth']], function ($routes) {

    $routes->get('dashboard', [Admin\Dashboard::class, 'index']);
 
    // User Management
    $routes->get('users', [Admin\Users::class, 'index']);
    $routes->get('users/create', [Admin\Users::class, 'create']);
    $routes->post('users/store', [Admin\Users::class, 'store']);
    $routes->get('users/edit/(:num)', [[Admin\Users::class, 'edit'], '$1']);
    $routes->post('users/update/(:num)', [[Admin\Users::class, 'update'], '$1']);
    // Delete User
    $routes->delete('users/delete/(:num)', [[Admin\Users::class, 'delete'], '$1']);
    // Activate User
    $routes->post('users/activate/(:num)', [[Admin\Users::class,'activate'],'$1']);
    
    // Settings
    $routes->get('settings', [Admin\Settings::class, 'index']);
    $routes->post('settings/update', [Admin\Settings::class, 'update']);



});

<?php

namespace App\Controllers\User\Network;

use App\Controllers\UserController;
use App\Models\CommunityFeedModel;

class CommunityFeed extends UserController
{
    protected $feedModel;

    public function __construct()
    {
        $this->feedModel = model(CommunityFeedModel::class);
    }

    public function index()
    {
        // Set the limit for pagination, defaulting to 20 and capping at 100
        $limit = max(1, min((int) ($this->request->getGet('limit') ?? 20), 100));
        // $limit =4 ;

        $page = max(1, (int) ($this->request->getGet('page') ?? 1));
        $offset = ($page - 1) * $limit;
        $totalCount = $this->feedModel->getActivityCount($this->userId, 'notes') + $this->feedModel->getActivityCount($this->userId, 'notebooks');
        // echo "Total Count: " . $totalCount. '<br />'; // Debugging line to check the total count
        // echo "Page: $page, Limit: $limit, Offset: $offset"; // Debugging line
        // echo '<pre>';
        // print_r($totalCount);
        // echo '</pre>';
        // exit;
        
        // Fetch activities for the current user with pagination
        return $this->renderView('pages/network/community_feed', [
            'appTitle' => setting('App.appName') . ' | Community Feed',
            'pageHeader' => 'Recent Activity',
            'breadcrumbLinks' => [
                ['label' => 'Home', 'url' => site_url('home')],
                ['label' => 'Network', 'url' => site_url('network/feed')],
                ['label' => 'Community Feed', 'url' => ''],
            ],
            'activities' => $this->feedModel->getFollowingActivity($this->userId, $limit, $offset),
            'pager_links' => service('pager')->makeLinks($page, $limit, $totalCount, 'km_pager_full'),
        ]);
    }

    public function communityNotes(){
        return $this->renderPaginatedList(
            'notes',
            'Comm. Notes',
            fn (int $limit, int $offset): array => $this->feedModel->getFollowingNotes($this->userId, $limit, $offset)
        );
    }

    public function communityNotebooks()
    {
        return $this->renderPaginatedList(
            'notebooks',
            'Comm. Notebooks',
            fn (int $limit, int $offset): array => $this->feedModel->getFollowingNotebooks($this->userId, $limit, $offset)
        );
    }

    private function renderPaginatedList(string $table, string $pageHeader, callable $fetchEntries)
    {
        $limit = max(1, min((int) ($this->request->getGet('limit') ?? 20), 100));
        $page = max(1, (int) ($this->request->getGet('page') ?? 1));
        $offset = ($page - 1) * $limit;
        $totalCount = $this->feedModel->getActivityCount($this->userId, $table);

        return $this->renderView('pages/network/community_feed', [
            'appTitle' => setting('App.appName') . ' | ' . $pageHeader,
            'pageHeader' => $pageHeader,
            'breadcrumbLinks' => [
                ['label' => 'Home', 'url' => site_url('home')],
                ['label' => 'Network', 'url' => site_url('network/feed')],
                ['label' => $pageHeader, 'url' => ''],
            ],
            'activities' => $fetchEntries($limit, $offset),
            'pager_links' => service('pager')->makeLinks($page, $limit, $totalCount, 'km_pager_full'),
        ]);
    }
}

<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class UserSettings extends BaseConfig
{
    /**
     * Default avart iamge
     * @var string
     */
    public string $defaultAvatar = '/uploads/user-icon.png';
    public string $defaultCoverImage = '/uploads/default-cover.webp';
    public $accountPrivacy = null; // Default for account privacy
    public bool $accountActivityStatus = false; // Default to hide activity status
    public bool $allowFollowers = false; // Default to allow followers
    public string $profileVisibility = 'public'; // Default profile visibility (public, private, friends)
    
}

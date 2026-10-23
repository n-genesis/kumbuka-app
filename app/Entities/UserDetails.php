<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class UserDetails extends Entity
{
    protected $datamap = [
        'user_details_id' => 'id',
        'user_deatails_created_at' => 'created_at',
        'user_details_updated_at' => 'updated_at',
    ];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];

    public function getUserInitials(): string {
        $first = $this->attributes['first_name'];
        $last = $this->attributes['last_name'];
        $initials = ucfirst(substr($first, 0, 1)) . ucfirst(substr( $last, 0, 1));
        return $initials;
    }
    public function getBioSummary(): string
    {
        helper('text'); // Ensure the helper is loaded
        $rawBody = $this->attributes['bio'];

        // Truncate to 150 characters with a '...' suffix
        return character_limiter($rawBody, 150, '...');
    }
    
}

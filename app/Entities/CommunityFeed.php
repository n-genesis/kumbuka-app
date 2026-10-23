<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class CommunityFeed extends Entity
{
    protected $datamap = [];
    protected $dates = ['created_at', 'updated_at'];
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'notebook_id' => 'integer',
    ];

    /**
     * Get a human-readable updated time for the note.
     * This method formats the 'updated_at' timestamp into a more user-friendly format.
     *
     * @return string
     */
    public function getCreatedDate(): string {
        $rawDate = $this->attributes['created_at'];
        $time = $this->mutateDate($rawDate);
        return $time->humanize();
    }

    public function getNotebookId(): int {
        return $this->attributes['notebook_id'];
    }

    public function getSummary(): string
    {
        helper('text');

        return character_limiter(strip_tags((string) ($this->attributes['content'] ?? '')), 240, '...');
    }
    
}
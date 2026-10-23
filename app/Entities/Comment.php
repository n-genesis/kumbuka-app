<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Models\CommentModel;

class Comment extends Entity
{
    protected $datamap = [
        'comment_created_at' => 'created_at',
    ];
    protected $dates   = ['updated_at', 'deleted_at'];
    protected $casts   = [];

    public function getId(): int
    {
        return $this->attributes['id'];
    }
    public function getCreatedAt(): string
    {
        // Access the raw datetime string from the database row
        $rawDate = $this->attributes['comment_created_at'];
        // 1. Convert the raw database value to a Time instance
        $time = $this->mutateDate($rawDate);

        // 2. Format it using PHP's date format characters:
        // 'M' = Short month (Feb)
        // 'jS' = Day without leading zero + ordinal suffix (3rd)
        // 'Y' = 4-digit year (2025)
        return $time->format('M jS, Y');
    }

    /**
     * Get a human-readable published time for the note.
     * This method formats the 'created_at' timestamp into a more user-friendly format.
     *
     * @return string
     */
    public function getPublishedDate(): string
    {
        // Access the raw datetime string from the database row
        $rawDate = $this->attributes['comment_created_at'];
        $time = $this->mutateDate($rawDate);
        return $time->humanize();
    }
}

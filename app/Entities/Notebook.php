<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

/**
 * User Notebook Entity
 * 
 * This class create and entity for the notebooks table 
 * 
 * @package    App\Entities
 * @author     Andrew Nite <ngendesign@email.com.com>
 * @copyright  2026 N-Gen Design <https://ngendesign.com>
 * @license    https://opensource.org MIT License
 * @link       https://github.com/n-genesis/ngen-kumbuka-ci
 * 
 */

class Notebook extends Entity
{
    protected $datamap = [
        'notebook_id' => 'id',
        'notebook_title' => 'title',
        'notebook_created_at' => 'created_at',
        'notebook_updated_at' => 'updated_at',
    ];
    protected $dates   = ['updated_at', 'deleted_at'];
    protected $casts   = [];

    /**
     * Get the ID of the note.
     *
     * @return int
     */
    public function getId(): int {
        return $this->attributes['notebook_id'];
    }

    public function getPublished(): string
    {
        // Access the raw datetime string from the database row
        $rawDate = $this->attributes['created_at'];
        // 1. Convert the raw database value to a Time instance
        $time = $this->mutateDate($rawDate);

        // 2. Format it using PHP's date format characters:
        // 'M' = Short month (Feb)
        // 'jS' = Day without leading zero + ordinal suffix (3rd)
        // 'Y' = 4-digit year (2025)
        return $time->format('M jS, Y');
    }
    
    public function getNotesCount(): int
    {
        $noteModel = new \App\Models\NoteModel();
        return $noteModel->countNotesByNotebook($this->attributes['notebook_id']);
    }
}

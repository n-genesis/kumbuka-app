<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class NotebookShare extends Entity
{
    protected $datamap = [
        'notebook_share_id' => 'id',
    ];
    protected $dates   = ['updated_at', 'deleted_at'];
    protected $casts   = [];
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
}

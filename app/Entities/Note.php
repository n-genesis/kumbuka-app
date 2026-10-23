<?php

namespace App\Entities;


use CodeIgniter\Entity\Entity;
use App\Models\NoteModel;
use App\Models\NotebookShareModel;
use App\Models\CommentModel;
use App\Models\PinnedItemModel;

class Note extends Entity
{
    protected $datamap = [
        'note_id' => 'id',
        'note_title' => 'title',
        'note_created_at' => 'created_at',
        'note_updated_at' => 'updated_at',
    ];
    protected $dates   = ['deleted_at'];
    protected $casts   = [];

    /**
     * Get the ID of the note.
     *
     * @return int
     */
    public function getId(): int {
        
        // Check for 'note_id' as a fallback array key
        if (array_key_exists('note_id', $this->attributes)) {
            return (int) $this->attributes['note_id'];
        }

        // Check for 'id' first (the database column name)
        if (array_key_exists('id', $this->attributes)) {
            return (int) $this->attributes['id'];
        }

        return 0;
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
        $rawDate = $this->attributes['note_created_at'];
        // 1. Convert the raw database value to a Time instance
        $time = $this->mutateDate($rawDate);

        // 2. Format it using PHP's date format characters:
        // 'M' = Short month (Feb)
        // 'jS' = Day without leading zero + ordinal suffix (3rd)
        // 'Y' = 4-digit year (2025)
        return $time->format('M jS, Y');
    }

    /**
     * Get a human-readable updated time for the note.
     * This method formats the 'updated_at' timestamp into a more user-friendly format.
     *
     * @return string
     */
    public function getUpdatedDate(): string {
        $rawDate = $this->attributes['note_updated_at'];
        $time = $this->mutateDate($rawDate);
        return $time->humanize();
    }
    /**
     * Get a count of how many Shares a Note entry has
     * NOTE: Not the best to place is here. But I thought I'd do a 
     * lil lazy loading and keep it seperated since it comes from
     * the Share table but has a relation to the Notes table
     * 
     * @return int|string
     */
    public function getShareHistory(){
        $noteModel = model(NoteModel::class);

        return $noteModel->getNoteSharesCount($this->attributes['id']);
    }

    public function hasUserShared($user_id){
        $sharedModel = model(NotebookShareModel::class);
        return $sharedModel->hasShared($user_id,$this->attributes['id']);
    }

    public function getBodySummary(): string
    {
        helper('text'); // Ensure the helper is loaded
        $rawBody = $this->attributes['content'];


        // Truncate to 150 characters with a '...' suffix
        return character_limiter(strip_tags($rawBody), 240, '...');
    }

    /**
     * Get the count of comments for this note.
     *
     * @return int
     */
    public function getCommentCount(): int
    {
        $commentModel = model(CommentModel::class);
        return $commentModel->getCommentCountByNoteId($this->attributes['note_id']);
    }
    public function getAllowComments(): bool {
        $noteModel = model(NoteModel::class);
        return $noteModel->getAllowComment($this->attributes["note_id"]); 
    }
    /**
     * Check if the currest use has Pinned the note
     * @return void
     */
    public function getIsPinned(): bool{
            $pinnedModel = model(PinnedItemModel::class);
            return $pinnedModel->isPinned(auth()->id() ?? 0, $this->attributes['note_id'], 'note');
    }
    public function getPinnedCount(): int {
            $pinnedModel = model(PinnedItemModel::class);
            return $pinnedModel->getPinnedCountByEntityId($this->attributes['note_id'], 'note');
    }

}

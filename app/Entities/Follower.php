<?php

namespace App\Entities;

use App\Models\CommentModel;
use App\Models\NoteModel;
use App\Models\PinnedItemModel;
use CodeIgniter\Entity\Entity;
use CodeIgniter\I18n\Time; // Recommended for CI4 date handling

/**
 * Follower Entity
 * 
 * This class create and entity for the followers table 
 * 
 * @package     App\Entities
 * @author      Andrew Nite <ngendesign@email.com> 
 * @copyright   2026 N-Gen Design
 * @link        github.com/n-genesis/ngen-kumbuka-ci
 * 
 */
class Follower extends Entity
{
    protected $datamap = [];
    protected $dates   = ['updated_at', 'deleted_at'];
    protected $casts   = [];

    public function getCreatedAt(): string
    {
        // Access the raw datetime string from the database row
        $rawDate = $this->attributes['created_at'];

        if (empty($rawDate)) {
            return 'Not Published Yet';
        }

        $time = Time::parse($rawDate);
        return $time->toLocalizedString('MMM d, yyyy'); // e.g., "Oct 27, 2025"
    }

    public function getBioSummary(): string
    {
        helper('text'); // Ensure the helper is loaded
        $rawBody = $this->attributes['bio'];

        if(!empty($rawBody)){
            // Truncate to 150 characters with a '...' suffix
            return character_limiter($rawBody, 150, '...');
        } else {
            return 'This user have not written a bio yet.';
        }

        
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
    public function getPinnedCount(): int {
            $pinnedModel = model(PinnedItemModel::class);
            return $pinnedModel->getPinnedCountByEntityId($this->attributes['note_id'],'note');
    }

    public function getNotesCount(): int
    {
        $noteModel = model(NoteModel::class);
        return $noteModel->where('user_id', $this->attributes['user_id'])->countAllResults();
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class BaseModel extends Model
{
    /**
     * Validate whether a user owns a notebook.
     *
     * This centralizes the notebook ownership check so all controllers can
     * reuse the same CodeIgniter 4 pattern instead of duplicating logic.
     */
    protected function ensureNotebookOwner(int $notebookId, int $userId): bool
    {
        $notebook = $this->db->table('notebooks')
            ->select('user_id')
            ->where('id', $notebookId)
            ->get()
            ->getRow();

        if (!$notebook) {
            return false;
        }

        return (int) $notebook->user_id === $userId;
    }
    /**
     * Check that the provided user owns the notebook.
     */
    public function isOwnerOfNotebook(int $notebookId, int $userId): bool
    {
        return $this->ensureNotebookOwner($notebookId, $userId);
    }
}

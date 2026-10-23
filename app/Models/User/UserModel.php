<?php

declare(strict_types=1);

namespace App\Models\User;

use CodeIgniter\Shield\Models\UserModel as ShieldUserModel;
use App\Entities\User;

class UserModel extends ShieldUserModel
{
    protected $returnType = User::class; // Use your new Custom Entity

    protected function initialize(): void
    {
        parent::initialize();

        $this->allowedFields = [
            ...$this->allowedFields,
        ];
        // Bind the event to automatically attach profile details
        $this->afterFind[] = 'appendUserDetails';
    }

    /**
     * Automatically hooks into find(), findAll(), and first() to inject profile data
     */
    protected function appendUserDetails(array $data)
    {
        if (empty($data['data'])) {
            return $data;
        }

        $db = \Config\Database::connect();

        // 1. Handle Multiple Rows (findAll())
        if ($data['singleton'] === false) {
            foreach ($data['data'] as &$user) {
                // Determine if the row is an object or an array
                $userId = is_object($user) ? ($user->id ?? null) : ($user['id'] ?? null);

                if ($userId) {
                    $details = $db->table('user_details')
                        ->where('user_id', $userId)
                        ->get()
                        ->getRowArray(); // Fetch profile columns as array

                    if ($details) {
                        // Safe injection checking object vs array status
                        if (is_object($user)) {
                            // Check if it's your Entity or a generic stdClass object
                            if (method_exists($user, 'fill')) {
                                $user->fill($details);
                            } else {
                                // Loop and attach properties directly to stdClass object
                                foreach ($details as $key => $value) {
                                    $user->$key = $value;
                                }
                            }
                        } else {
                            $user = array_merge($user, $details);
                        }
                    }
                }
            }
        }
        
        // 2. Handle Single Row (find() or first())
        else {
            $user = $data['data'];
            $userId = is_object($user) ? ($user->id ?? null) : ($user['id'] ?? null);

            if ($userId) {
                $details = $db->table('user_details')
                    ->where('user_id', $userId)
                    ->get()
                    ->getRowArray();

                if ($details) {
                    if (is_object($user)) {
                        if (method_exists($user, 'fill')) {
                            $user->fill($details);
                        } else {
                            foreach ($details as $key => $value) {
                                $user->$key = $value;
                            }
                        }
                    } else {
                        $user = array_merge($user, $details);
                    }
                    $data['data'] = $user;
                }
            }
        }

        return $data;
    }

    /**
     * Optional: Create a custom method explicitly for heavy admin listings 
     * where query optimization (a real JOIN) is preferred over Shield's events.
     */
    public function getUsersWithDetails()
    {
        return $this->select('users.*, user_details.first_name, user_details.last_name')
            ->join('user_details', 'user_details.user_id = users.id', 'left')
            ->findAll();
    }
}

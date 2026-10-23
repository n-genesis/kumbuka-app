<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\ActivityLog as UserActivityEntity;
use CodeIgniter\I18n\Time;

class ActivityLogModel extends Model
{
    protected $table = 'activity_log';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = UserActivityEntity::class;
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'user_id',
        'category',
        'severity',
        'description',
        'metadata',
        'ip_address',
        'user_agent',
        'created_at',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = '';
    protected $deletedField = '';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    public function logActivity(string $description, string $category, string $severity, $metadata = null){

        $entry = [
            'user_id'    => auth()->id(),
            'category'=> $category,
            'severity'=> $severity,
            'description' => $description,
            'metadata'=> $metadata,
            'ip_address' => service('request')->getIPAddress(),
            'user_agent' => (string) service('request')->getUserAgent(),
        ];

        return $this->insert($entry);
    }
}

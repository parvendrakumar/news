<?php

namespace App\Models;

use CodeIgniter\Model;

class NotificationModel extends Model
{
    protected $table            = 'notifications';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['user_id', 'title', 'message', 'type', 'is_read', 'created_at'];
    protected $useTimestamps    = false;

    public function getUnreadCount($userId)
    {
        return $this->where(['user_id' => $userId, 'is_read' => 0])->countAllResults();
    }
}

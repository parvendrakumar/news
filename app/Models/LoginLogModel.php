<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginLogModel extends Model
{
    protected $table            = 'login_logs';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['user_id', 'email', 'ip_address', 'user_agent', 'status', 'attempted_at'];
    protected $useTimestamps    = false; // Handled by MySQL DEFAULT CURRENT_TIMESTAMP
}

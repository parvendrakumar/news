<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'role_id', 'username', 'email', 'password', 'full_name', 'status', 
        'last_login', 'avatar', 'failed_attempts', 'locked_until', 
        'last_ip', 'last_user_agent', 'two_factor_secret', 
        'two_factor_enabled', 'password_updated_at', 'otp_code', 'otp_expires_at',
        'reset_token', 'reset_expires_at'
    ];
    protected $useTimestamps    = true;
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class UserInterestModel extends Model
{
    protected $table            = 'user_interests';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['user_id', 'category_id', 'created_at'];
    protected $useTimestamps    = false;
}

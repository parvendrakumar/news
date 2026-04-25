<?php

namespace App\Models;

use CodeIgniter\Model;

class AdModel extends Model
{
    protected $table            = 'ad_management';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['slot_name', 'target_page', 'target_category_id', 'ad_type', 'image', 'link', 'custom_code', 'is_active'];
    protected $useTimestamps    = false;
}

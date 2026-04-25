<?php

namespace App\Models;

use CodeIgniter\Model;

class TickerModel extends Model
{
    protected $table            = 'breaking_ticker';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['content_hi', 'content_en', 'link', 'is_active'];
    protected $useTimestamps    = false;
}

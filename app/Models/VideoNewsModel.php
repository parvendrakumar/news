<?php

namespace App\Models;

use CodeIgniter\Model;

class VideoNewsModel extends Model
{
    protected $table            = 'video_news';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'title_hi', 'title_en', 'video_url', 'thumbnail', 'slug', 'description_hi', 
        'description_en', 'meta_title', 'meta_keywords', 'meta_description', 'status', 'views', 'author_name'
    ];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = '';
}

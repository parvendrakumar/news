<?php

namespace App\Models;

use CodeIgniter\Model;

class TranslationModel extends Model
{
    protected $table            = 'news_translations';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['news_id', 'language', 'title', 'description', 'meta_title', 'meta_keywords', 'meta_description'];
}

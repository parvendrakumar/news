<?php

namespace App\Models;

use CodeIgniter\Model;

class PageModel extends Model
{
    protected $table            = 'pages';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['slug', 'status'];

    public function getPage($slug, $lang = 'hi')
    {
        return $this->select('pages.*, page_translations.title, page_translations.content')
                    ->join('page_translations', 'page_translations.page_id = pages.id')
                    ->where('pages.slug', $slug)
                    ->where('page_translations.language', $lang)
                    ->where('pages.status', 'active')
                    ->first();
    }

    public function getAllPages($lang = 'hi')
    {
        return $this->select('pages.*, page_translations.title')
                    ->join('page_translations', 'page_translations.page_id = pages.id')
                    ->where('page_translations.language', $lang)
                    ->where('pages.status', 'active')
                    ->findAll();
    }
}

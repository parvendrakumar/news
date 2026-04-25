<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table            = 'categories';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['parent_id', 'slug', 'image', 'meta_title', 'meta_description', 'status', 'sort_order'];

    // Hierarchical fetch
    public function getCategories($lang = 'hi')
    {
        return $this->select('categories.*, category_translations.title')
                    ->join('category_translations', 'category_translations.category_id = categories.id')
                    ->where('category_translations.language', $lang)
                    ->where('categories.status', 'active')
                    ->orderBy('categories.sort_order', 'ASC')
                    ->findAll();
    }

    public function getCategoryTree($lang = 'hi', $parentId = 0, $indent = '')
    {
        $categories = $this->select('categories.*, category_translations.title')
                           ->join('category_translations', 'category_translations.category_id = categories.id')
                           ->where('category_translations.language', $lang)
                           ->where('categories.parent_id', $parentId)
                           ->where('categories.status', 'active')
                           ->orderBy('categories.sort_order', 'ASC')
                           ->findAll();
        
        $tree = [];
        foreach ($categories as $cat) {
            $cat['title_formatted'] = $indent . $cat['title'];
            $tree[] = $cat;
            $children = $this->getCategoryTree($lang, $cat['id'], $indent . '— ');
            $tree = array_merge($tree, $children);
        }
        return $tree;
    }
}

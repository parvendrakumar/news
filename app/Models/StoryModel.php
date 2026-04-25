<?php

namespace App\Models;

use CodeIgniter\Model;

class StoryModel extends Model
{
    protected $table            = 'visual_stories';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['title_hi', 'title_en', 'image', 'content_hi', 'content_en', 'slug', 'views', 'status', 'meta_title', 'meta_keywords', 'meta_description'];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = '';

    public function getLatestStories($lang = 'hi', $limit = 12)
    {
        $stories = $this->where('status', 'published')
                        ->orderBy('created_at', 'DESC')
                        ->limit($limit)
                        ->findAll();

        foreach ($stories as &$s) {
            $s['title'] = ($lang == 'hi') ? $s['title_hi'] : $s['title_en'];
            $s['content'] = ($lang == 'hi') ? $s['content_hi'] : $s['content_en'];
        }

        return $stories;
    }

    public function incrementViews($id)
    {
        return $this->where('id', $id)->set('views', 'views+1', false)->update();
    }
}

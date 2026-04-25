<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentModel extends Model
{
    protected $table            = 'comments';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['news_id', 'name', 'email', 'comment', 'status'];

    public function getCommentsByNews($newsId)
    {
        return $this->where('news_id', $newsId)
                    ->where('status', 'approved')
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }
}

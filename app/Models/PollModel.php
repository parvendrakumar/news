<?php

namespace App\Models;

use CodeIgniter\Model;

class PollModel extends Model
{
    protected $table            = 'polls';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['question_hi', 'question_en', 'is_active'];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = '';

    public function getFullPoll($id)
    {
        $poll = $this->find($id);
        if ($poll) {
            $db = \Config\Database::connect();
            $poll['options'] = $db->table('poll_options')->where('poll_id', $id)->get()->getResultArray();
        }
        return $poll;
    }
}

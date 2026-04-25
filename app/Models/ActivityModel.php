<?php

namespace App\Models;

use CodeIgniter\Model;

class ActivityModel extends Model
{
    protected $table            = 'activity_logs';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['user_id', 'action', 'details', 'ip_address'];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = '';

    public function log($action, $details = null)
    {
        $db = \Config\Database::connect();
        $status = $db->table('settings')->where('key', 'activity_logs_status')->get()->getRowArray();
        
        if (($status['value'] ?? '1') == '0') {
            return true; // Logging disabled
        }

        return $this->save([
            'user_id'    => session()->get('userId'),
            'action'     => $action,
            'details'    => $details,
            'ip_address' => service('request')->getIPAddress()
        ]);
    }
}

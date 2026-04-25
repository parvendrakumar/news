<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use App\Libraries\RedisStats;

class SyncViews extends BaseCommand
{
    protected $group       = 'Stats';
    protected $name        = 'stats:sync';
    protected $description = 'Syncs news views from Redis to MySQL.';

    public function run(array $params)
    {
        CLI::write('Starting view sync...', 'yellow');
        
        $stats = new RedisStats();
        $stats->syncToDb();
        
        CLI::write('View sync completed successfully!', 'green');
    }
}

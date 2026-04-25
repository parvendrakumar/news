<?php

namespace App\Libraries;

use CodeIgniter\Cache\CacheInterface;

class RedisStats
{
    protected $cache;

    public function __construct()
    {
        $this->cache = service('cache');
    }

    /**
     * Increment view count in Redis
     * For 200k+ concurrent users, updating DB on every request is fatal.
     * We increment in Redis and sync with DB every minute via Cron.
     */
    public function incrementView($newsId)
    {
        $key = "news_views_" . date('Y-m-d');
        
        // Using Redis specifically if available
        if (config('Cache')->handler == 'redis') {
            $redis = $this->cache->getBackend();
            $redis->hIncrBy($key, $newsId, 1);
        } else {
            // Fallback for non-redis environments
            $views = $this->cache->get($key . "_" . $newsId) ?: 0;
            $this->cache->save($key . "_" . $newsId, $views + 1, 3600);
        }
    }

    /**
     * Sync Redis views to MySQL
     * This should be called by a CLI command (cron)
     */
    public function syncToDb()
    {
        if (config('Cache')->handler != 'redis') return;

        $redis = $this->cache->getBackend();
        $date = date('Y-m-d');
        $key = "news_views_" . $date;
        $views = $redis->hGetAll($key);

        if (!empty($views)) {
            $db = \Config\Database::connect();
            foreach ($views as $newsId => $count) {
                if ($count > 0) {
                    $db->query("INSERT INTO news_views (news_id, view_date, view_count) 
                               VALUES (?, ?, ?) 
                               ON DUPLICATE KEY UPDATE view_count = view_count + ?", 
                               [$newsId, $date, $count, $count]);
                    
                    // Reset count in Redis after sync
                    $redis->hSet($key, $newsId, 0);
                }
            }
        }
    }
}

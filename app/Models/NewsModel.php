<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsModel extends Model
{
    protected $table            = 'news';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['category_id', 'slug', 'image', 'gallery', 'author_id', 'custom_author', 'status', 'publish_at', 'is_video_news', 'is_breaking', 'video_url', 'video_file'];
    protected $useTimestamps    = true;

    /**
     * Get news with translations
     */
    public function getLatestNews($lang = 'hi', $limit = 10, $category_id = null, $category_slug = null, $exclude_id = null, $offset = 0)
    {
        $builder = $this->select('news.*, news_translations.title, news_translations.description, categories.slug as category_slug')
                        ->join('news_translations', 'news_translations.news_id = news.id')
                        ->join('categories', 'categories.id = news.category_id')
                        ->where('news_translations.language', $lang)
                        ->where('news.status', 'published');
                        // Temporarily disabled to prevent timezone delay issues
                        // ->where('news.publish_at <=', date('Y-m-d H:i:s'));

        if ($category_id) {
            $builder->where('news.category_id', $category_id);
        }

        if ($category_slug) {
            $builder->where('categories.slug', $category_slug);
        }

        if ($exclude_id) {
            $builder->where('news.id !=', $exclude_id);
        }

        return $builder->orderBy('news.publish_at', 'DESC')
                       ->limit((int)$limit, (int)$offset)
                       ->find();
    }

    /**
     * Get Trending News based on views + time decay
     * Optimization: Use news_views table join
     */
    public function getTrendingNews($lang = 'hi', $limit = 5)
    {
        return $this->select('news.*, news_translations.title, categories.slug as category_slug, COALESCE(SUM(news_views.view_count), 0) as total_views')
                    ->join('news_translations', 'news_translations.news_id = news.id')
                    ->join('categories', 'categories.id = news.category_id')
                    ->join('news_views', 'news_views.news_id = news.id', 'left')
                    ->where('news_translations.language', $lang)
                    ->where('news.status', 'published')
                    ->groupBy('news.id')
                    ->orderBy('total_views', 'DESC')
                    ->orderBy('news.publish_at', 'DESC')
                    ->limit($limit)
                    ->find();
    }
    public function getPaginatedNews($lang = 'hi', $perPage = 10, $category_id = null)
    {
        $this->select('news.*, news_translations.title, news_translations.description, categories.slug as category_slug')
             ->join('news_translations', 'news_translations.news_id = news.id')
             ->join('categories', 'categories.id = news.category_id')
             ->where('news_translations.language', $lang)
             ->where('news.status', 'published');
             // Temporarily disabled to prevent timezone delay issues
             // ->where('news.publish_at <=', date('Y-m-d H:i:s'));

        if ($category_id) {
            $this->where('news.category_id', $category_id);
        }

        return $this->orderBy('news.publish_at', 'DESC')->paginate($perPage);
    }
}

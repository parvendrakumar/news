<?php

if (!function_exists('get_dynamic_nav')) {
    function get_dynamic_nav() {
        $cache = service('cache');
        $lang = service('language')->getLocale();
        $cacheKey = "dynamic_nav_{$lang}";

        if (!$data = $cache->get($cacheKey)) {
            $categoryModel = new \App\Models\CategoryModel();
            $pageModel = new \App\Models\PageModel();
            $newsModel = new \App\Models\NewsModel();

            $allCategories = $categoryModel->getCategories($lang);
            
            // Recursive tree builder
            function buildCategoryTree(array &$elements, $parentId = 0) {
                $branch = [];
                foreach ($elements as $key => $element) {
                    if ($element['parent_id'] == $parentId) {
                        $children = buildCategoryTree($elements, $element['id']);
                        if ($children) {
                            $element['children'] = $children;
                        } else {
                            $element['children'] = [];
                        }
                        $branch[] = $element;
                        unset($elements[$key]);
                    }
                }
                return $branch;
            }

            $categoryTree = buildCategoryTree($allCategories);

            // Dynamic DB column `sort_order` is now handling array sorting natively in CategoryModel 
           

            // Primary nav: first 6 categories; rest go into "More" dropdown
            $primaryNav   = array_slice($categoryTree, 0, 6);
            $secondaryNav = array_slice($categoryTree, 6);

            $data = [
                'categories'  => $categoryTree,
                'primaryNav'  => $primaryNav,
                'secondaryNav'=> $secondaryNav,
                'pages'       => $pageModel->getAllPages($lang),
                'latest'      => $newsModel->getLatestNews($lang, 6),
                'trending'    => $newsModel->getTrendingNews($lang, 6)
            ];

            $cache->save($cacheKey, $data, 3600);
        }

        return $data;
    }
}

if (!function_exists('get_setting')) {
    function get_setting($key, $default = '') {
        $db = \Config\Database::connect();
        $res = $db->table('settings')->where('key', $key)->get()->getRow();
        return $res ? $res->value : $default;
    }
}

if (!function_exists('get_ads')) {
    function get_ads($slot_name, $category_id = 0) {
        $db = \Config\Database::connect();
        $uri = service('uri');
        $path = $uri->getPath();

        // Determine current page type
        $currentPage = 'all';
        if ($path == '' || $path == '/' || $path == 'index.php') {
            $currentPage = 'home';
        } elseif (strpos($path, 'category/') !== false) {
            $currentPage = 'category';
        } elseif (strpos($path, 'news/') !== false) {
            $currentPage = 'news_detail';
        }

        // Clean slot name for matching
        $cleanSlot = trim(strtolower($slot_name));

        return $db->table('ad_management')
                  ->where('is_active', 1)
                  ->groupStart()
                    ->where('target_page', 'all')
                    ->orWhere('target_page', $currentPage)
                  ->groupEnd()
                  ->groupStart()
                    ->where('target_category_id', 0)
                    ->orWhere('target_category_id', (int)$category_id)
                  ->groupEnd()
                  ->groupStart()
                    ->where('LOWER(TRIM(slot_name))', $cleanSlot)
                    ->orLike('LOWER(TRIM(slot_name))', $cleanSlot, 'after')
                  ->groupEnd()
                  ->get()
                  ->getResultArray();
    }
}

if (!function_exists('get_active_poll')) {
    function get_active_poll() {
        $db = \Config\Database::connect();
        $poll = $db->table('polls')
                   ->where('is_active', 1)
                   ->orderBy('created_at', 'DESC')
                   ->get()
                   ->getRowArray();

        if ($poll) {
            $poll['options'] = $db->table('poll_options')
                                 ->where('poll_id', $poll['id'])
                                 ->get()
                                 ->getResultArray();
            $poll['hasVoted'] = session()->has('voted_poll_' . $poll['id']);
        }

        return $poll;
    }
}

if (!function_exists('get_unread_notifications_count')) {
    function get_unread_notifications_count() {
        $session = session();
        if (!$session->get('isLoggedIn')) return 0;
        
        $userId = $session->get('userId');
        $model = new \App\Models\NotificationModel();
        return $model->where(['user_id' => $userId, 'is_read' => 0])->countAllResults();
    }
}
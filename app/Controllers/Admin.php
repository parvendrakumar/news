<?php

namespace App\Controllers;

use App\Models\NewsModel;
use App\Models\CategoryModel;


class Admin extends BaseController
{
    public function dashboard()
    {
        $db = \Config\Database::connect();
        
        $data['stats'] = [
            'total_news'       => $db->table('news')->countAllResults(),
            'total_views'      => $db->table('news_views')->selectSum('view_count')->get()->getRow()->view_count ?? 0,
            'pending_comments' => $db->table('comments')->where('status', 'pending')->countAllResults(),
            'total_users'      => $db->table('users')->countAllResults(),
        ];

        // Fetch Recent Activity
        $data['recent_news'] = $db->table('news')
                                  ->select('news.*, news_translations.title')
                                  ->join('news_translations', 'news_translations.news_id = news.id AND news_translations.language = "hi"')
                                  ->orderBy('news.created_at', 'DESC')
                                  ->limit(5)
                                  ->get()->getResultArray();

        $data['recent_comments'] = $db->table('comments')
                                      ->orderBy('created_at', 'DESC')
                                      ->limit(5)
                                      ->get()->getResultArray();

        // --- NEW: CHART DATA ---
        // 1. Weekly Dispatches (Last 7 Days)
        $weeklyData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i days"));
            $count = $db->table('news')->where('DATE(created_at)', $date)->countAllResults();
            $label = date('D', strtotime($date));
            $weeklyData[] = ['label' => $label, 'count' => $count];
        }
        $data['chart_weekly'] = $weeklyData;

        // 2. Category Distribution
        $data['chart_categories'] = $db->table('categories')
                                       ->select('category_translations.title as label, COUNT(news.id) as count')
                                       ->join('category_translations', 'category_translations.category_id = categories.id AND category_translations.language = "en"', 'inner')
                                       ->join('news', 'news.category_id = categories.id', 'left')
                                       ->groupBy('categories.id')
                                       ->limit(6)
                                       ->get()->getResultArray();

        return view('admin/dashboard', $data);
    }

    public function calendar()
    {
        $db = \Config\Database::connect();
        $news = $db->table('news')
                   ->select('news.id, news_translations.title, news.created_at')
                   ->join('news_translations', 'news_translations.news_id = news.id AND news_translations.language = "hi"')
                   ->get()->getResultArray();

        $events = [];
        foreach ($news as $item) {
            $events[] = [
                'id'    => $item['id'],
                'title' => $item['title'],
                'start' => date('Y-m-d', strtotime($item['created_at'])),
                'url'   => base_url('admin/news/edit/' . $item['id']),
                'color' => '#dc2626'
            ];
        }

        $data['events'] = json_encode($events);
        $data['title']  = "Content Calendar";
        
        return view('admin/calendar', $data);
    }

    public function newsList()
    {
        $newsModel = new NewsModel();
        $search = $this->request->getGet('search');

        $builder = $newsModel->select('news.*, hi.title as title_hi, en.title as title_en, cat_hi.title as category_name')
                            ->join('news_translations hi', 'hi.news_id = news.id AND hi.language = "hi"', 'left')
                            ->join('news_translations en', 'en.news_id = news.id AND en.language = "en"', 'left')
                            ->join('category_translations cat_hi', 'cat_hi.category_id = news.category_id AND cat_hi.language = "hi"', 'left');

        if (!empty($search)) {
            $builder->groupStart()
                    ->like('hi.title', $search)
                    ->orLike('en.title', $search)
                    ->orLike('news.slug', $search)
                    ->groupEnd();
        }

        $data['news'] = $builder->orderBy('news.created_at', 'DESC')
                                ->paginate(20);
        $data['pager'] = $newsModel->pager;
        $data['search'] = $search;
        
        return view('admin/news/index', $data);
    }

    public function newsCreate()
    {
        $categoryModel = new CategoryModel();
        $data['categories'] = $categoryModel->getCategoryTree('hi');
        return view('admin/news/create', $data);
    }

    public function newsStore()
    {
        $newsModel = new NewsModel();

        $rules = [
            'category_id' => 'required',
            'slug'        => 'required|is_unique[news.slug]',
            'title_hi'    => 'required',
            'description_hi' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Handle Featured Image Upload
        $img = $this->request->getFile('image');
        $fileName = '';
        if ($img && $img->isValid() && !$img->hasMoved()) {
            $fileName = $img->getRandomName();
            $img->move('uploads/news', $fileName);
        }

        // Handle Gallery Upload (Multiple)
        $galleryImages = [];
        if ($files = $this->request->getFileMultiple('gallery')) {
            foreach ($files as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $gName = $file->getRandomName();
                    $file->move('uploads/news/gallery', $gName);
                    $galleryImages[] = $gName;
                }
            }
        }

        $newsData = [
            'category_id' => $this->request->getPost('category_id'),
            'slug'        => url_title($this->request->getPost('slug'), '-', true),
            'image'       => $fileName,
            'gallery'     => json_encode($galleryImages),
            'author_id'   => session()->get('userId'),
            'custom_author' => $this->request->getPost('custom_author'),
            'status'      => $this->request->getPost('status'),
            'publish_at'  => $this->request->getPost('publish_at') ?: date('Y-m-d H:i:s'),
            'is_video_news' => $this->request->getPost('is_video_news') ? 1 : 0,
            'is_breaking'   => $this->request->getPost('is_breaking') ? 1 : 0,
            'video_url'     => $this->request->getPost('video_url_status') === 'active' ? $this->request->getPost('video_url') : '',
        ];

        $newsId = $newsModel->insert($newsData);

        // Handle Initial Views
        $initialViews = (int)$this->request->getPost('initial_views');
        if ($initialViews > 0) {
            $db = \Config\Database::connect();
            $db->table('news_views')->insert([
                'news_id'    => $newsId,
                'view_date'  => date('Y-m-d'),
                'view_count' => $initialViews
            ]);
        }

        // Auto-generate SEO if empty
        list($mTitleHi, $mDescHi, $mKeysHi) = $this->_autoGenerateSEO(
            $this->request->getPost('title_hi'), 
            $this->request->getPost('description_hi'),
            $this->request->getPost('meta_title_hi'),
            $this->request->getPost('meta_description_hi'),
            $this->request->getPost('meta_keywords_hi')
        );

        list($mTitleEn, $mDescEn, $mKeysEn) = $this->_autoGenerateSEO(
            $this->request->getPost('title_en'), 
            $this->request->getPost('description_en'),
            $this->request->getPost('meta_title_en'),
            $this->request->getPost('meta_description_en'),
            $this->request->getPost('meta_keywords_en')
        );

        // Translations
        $translations = [
            [
                'news_id'     => $newsId, 
                'language'    => 'hi', 
                'title'       => $this->request->getPost('title_hi'), 
                'description' => $this->request->getPost('description_hi'),
                'meta_title'  => $mTitleHi,
                'meta_keywords' => $mKeysHi,
                'meta_description' => $mDescHi,
            ],
            [
                'news_id'     => $newsId, 
                'language'    => 'en', 
                'title'       => $this->request->getPost('title_en'), 
                'description' => $this->request->getPost('description_en'),
                'meta_title'  => $mTitleEn,
                'meta_keywords' => $mKeysEn,
                'meta_description' => $mDescEn,
            ],
        ];

        $db = \Config\Database::connect();
        $db->table('news_translations')->insertBatch($translations);

        return redirect()->to('admin/news')->with('success', 'News published successfully!');
    }

    public function newsEdit($id)
    {
        $newsModel = new NewsModel();
        $categoryModel = new CategoryModel();
        
        $news = $newsModel->find($id);
        if (!$news) {
            return redirect()->to('admin/news')->with('error', 'News item not found.');
        }

        // Get translations
        $db = \Config\Database::connect();
        $hi = $db->table('news_translations')->where(['news_id' => $id, 'language' => 'hi'])->get()->getRowArray();
        $en = $db->table('news_translations')->where(['news_id' => $id, 'language' => 'en'])->get()->getRowArray();

        $totalViews = $db->table('news_views')->selectSum('view_count')->where('news_id', $id)->get()->getRow()->view_count ?? 0;

        $data = [
            'news'        => $news,
            'hi'          => $hi,
            'en'          => $en,
            'total_views' => $totalViews,
            'categories'  => $categoryModel->getCategoryTree('hi')
        ];

        return view('admin/news/edit', $data);
    }

    public function newsUpdate($id)
    {
        $newsModel = new NewsModel();
        
        $rules = [
            'category_id' => 'required',
            'slug'        => "required|is_unique[news.slug,id,{$id}]",
            'title_hi'    => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Image Handling
        $img = $this->request->getFile('image');
        $fileName = $this->request->getPost('old_image');
        if ($img && $img->isValid() && !$img->hasMoved()) {
            $fileName = $img->getRandomName();
            $img->move('uploads/news', $fileName);
        }

        // Gallery Handling (Merge with existing)
        $existingGallery = json_decode($this->request->getPost('existing_gallery') ?: '[]', true);
        if ($files = $this->request->getFileMultiple('gallery')) {
            foreach ($files as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $gName = $file->getRandomName();
                    $file->move('uploads/news/gallery', $gName);
                    $existingGallery[] = $gName;
                }
            }
        }

        $newsData = [
            'id'            => $id,
            'category_id'   => $this->request->getPost('category_id'),
            'slug'          => url_title($this->request->getPost('slug'), '-', true),
            'image'         => $fileName,
            'status'        => $this->request->getPost('status'),
            'publish_at'    => $this->request->getPost('publish_at'),
            'custom_author' => $this->request->getPost('custom_author'),
            'is_video_news' => $this->request->getPost('is_video_news') ? 1 : 0,
            'is_breaking'   => $this->request->getPost('is_breaking') ? 1 : 0,
            'gallery'       => json_encode($existingGallery),
            'video_url'     => $this->request->getPost('video_url_status') === 'active' ? $this->request->getPost('video_url') : '',
        ];

        $newsModel->save($newsData);

        // Boost Views if requested
        $boost = (int)$this->request->getPost('initial_views');
        if ($boost > 0) {
            $db = \Config\Database::connect();
            $date = date('Y-m-d');
            $db->query("INSERT INTO news_views (news_id, view_date, view_count) 
                       VALUES ($id, '$date', $boost) 
                       ON DUPLICATE KEY UPDATE view_count = view_count + $boost");
        }

        // Auto-generate SEO if empty
        list($mTitleHi, $mDescHi, $mKeysHi) = $this->_autoGenerateSEO(
            $this->request->getPost('title_hi'), 
            $this->request->getPost('description_hi'),
            $this->request->getPost('meta_title_hi'),
            $this->request->getPost('meta_description_hi'),
            $this->request->getPost('meta_keywords_hi')
        );

        list($mTitleEn, $mDescEn, $mKeysEn) = $this->_autoGenerateSEO(
            $this->request->getPost('title_en'), 
            $this->request->getPost('description_en'),
            $this->request->getPost('meta_title_en'),
            $this->request->getPost('meta_description_en'),
            $this->request->getPost('meta_keywords_en')
        );

        // Update Translations
        $db = \Config\Database::connect();
        $db->table('news_translations')->where(['news_id' => $id, 'language' => 'hi'])->update([
            'title'            => $this->request->getPost('title_hi'),
            'description'      => $this->request->getPost('description_hi'),
            'meta_title'       => $mTitleHi,
            'meta_keywords'    => $mKeysHi,
            'meta_description' => $mDescHi,
        ]);

        $db->table('news_translations')->where(['news_id' => $id, 'language' => 'en'])->update([
            'title'            => $this->request->getPost('title_en'),
            'description'      => $this->request->getPost('description_en'),
            'meta_title'       => $mTitleEn,
            'meta_keywords'    => $mKeysEn,
            'meta_description' => $mDescEn,
        ]);

        return redirect()->to('admin/news')->with('success', 'News updated successfully!');
    }

    public function newsDelete($id)
    {
        $newsModel = new NewsModel();
        $newsModel->delete($id);
        
        $db = \Config\Database::connect();
        $db->table('news_translations')->where('news_id', $id)->delete();
        
        return redirect()->to('admin/news')->with('success', 'News item deleted.');
    }

    public function newsBulkDelete()
    {
        $ids = $this->request->getPost('ids');
        if (empty($ids) || !is_array($ids)) {
            return redirect()->to('admin/news')->with('error', 'No items selected.');
        }

        $newsModel = new NewsModel();
        $db = \Config\Database::connect();

        foreach ($ids as $id) {
            $newsModel->delete($id);
            $db->table('news_translations')->where('news_id', $id)->delete();
        }

        return redirect()->to('admin/news')->with('success', count($ids) . ' news items deleted successfully.');
    }

    public function newsToggleStatus($id)
    {
        $newsModel = new NewsModel();
        $news = $newsModel->find($id);
        $newStatus = ($news['status'] == 'published') ? 'draft' : 'published';
        
        $newsModel->update($id, ['status' => $newStatus]);
        return redirect()->back()->with('success', 'News status updated to ' . $newStatus);
    }

    public function newsBulkUpload()
    {
        $db = \Config\Database::connect();
        $categories = $db->table('categories')
                         ->select('categories.id, hi.title as title_hi, en.title as title_en')
                         ->join('category_translations hi', 'hi.category_id = categories.id AND hi.language = "hi"', 'left')
                         ->join('category_translations en', 'en.category_id = categories.id AND en.language = "en"', 'left')
                         ->where('categories.status', 'active')
                         ->orderBy('categories.sort_order', 'ASC')
                         ->get()->getResultArray();

        $data['categories'] = $categories;
        $data['title'] = 'Bulk Upload News';
        return view('admin/news/bulk_upload', $data);
    }

    public function newsBulkFormat()
    {
        $filename = 'news_bulk_format.csv';
        $header = ['category_id', 'slug', 'title_hi', 'description_hi', 'meta_title_hi', 'meta_keywords_hi', 'meta_description_hi', 'title_en', 'description_en', 'meta_title_en', 'meta_keywords_en', 'meta_description_en', 'status', 'publish_at', 'custom_author', 'is_video_news', 'is_breaking', 'video_url'];
        
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $filename);
        
        $output = fopen('php://output', 'w');
        // Add BOM for Excel UTF-8 support
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
        fputcsv($output, $header);
        
        // Example Row
        fputcsv($output, [
            '1', 
            'example-news-slug', 
            'हिंदी समाचार शीर्षक', 
            'हिंदी में समाचार विवरण यहाँ लिखें...', 
            'एसईओ शीर्षक हिंदी',
            'कीवर्ड1, कीवर्ड2',
            'एसईओ विवरण हिंदी यहाँ लिखें...',
            'Example News Title',
            'Write news description in English here...',
            'SEO Title English',
            'keyword1, keyword2',
            'SEO Description English here...',
            'published',
            date('Y-m-d H:i:s'),
            'Admin',
            '0',
            '0',
            'https://www.youtube.com/watch?v=...'
        ]);
        
        fclose($output);
        exit;
    }

    public function newsBulkStore()
    {
        $file = $this->request->getFile('csv_file');
        
        if (!$file || !$file->isValid()) {
            return redirect()->back()->with('error', 'Please upload a valid CSV file.');
        }

        $newsModel = new NewsModel();
        $db = \Config\Database::connect();
        
        if (($handle = fopen($file->getTempName(), 'r')) !== FALSE) {
            // Check for BOM and skip it
            $bom = fread($handle, 3);
            if ($bom != chr(0xEF).chr(0xBB).chr(0xBF)) {
                rewind($handle);
            }

            $headers = fgetcsv($handle); // Read headers
            
            if (!$headers || count($headers) < 3) {
                return redirect()->back()->with('error', 'Invalid CSV format. Please download and use the template.');
            }

            $successCount = 0;
            $errorCount = 0;

            while (($row = fgetcsv($handle)) !== FALSE) {
                if (count($row) < count($headers)) continue; // Skip mismatching rows

                // Map row data
                $data = array_combine($headers, $row);
                
                try {
                    $slug = !empty($data['slug']) ? url_title($data['slug'], '-', true) : url_title($data['title_en'] ?? $data['title_hi'], '-', true);
                    
                    // Check if slug exists, append random if needed
                    $check = $newsModel->where('slug', $slug)->first();
                    if ($check) $slug .= '-' . rand(100, 999);

                    $newsId = $newsModel->insert([
                        'category_id'   => $data['category_id'] ?? 1,
                        'slug'          => $slug,
                        'author_id'     => session()->get('userId'),
                        'custom_author' => $data['custom_author'] ?? '',
                        'status'        => $data['status'] ?? 'draft',
                        'publish_at'    => !empty($data['publish_at']) ? $data['publish_at'] : date('Y-m-d H:i:s'),
                        'is_video_news' => ($data['is_video_news'] ?? 0) == 1 ? 1 : 0,
                        'is_breaking'   => ($data['is_breaking'] ?? 0) == 1 ? 1 : 0,
                        'video_url'     => $data['video_url'] ?? '',
                    ]);

                    if ($newsId) {
                        $translations = [
                            [
                                'news_id'     => $newsId, 
                                'language'    => 'hi', 
                                'title'       => $data['title_hi'] ?? 'Untitled', 
                                'description' => $data['description_hi'] ?? '',
                                'meta_title'  => $data['meta_title_hi'] ?? '',
                                'meta_keywords' => $data['meta_keywords_hi'] ?? '',
                                'meta_description' => $data['meta_description_hi'] ?? '',
                            ],
                            [
                                'news_id'     => $newsId, 
                                'language'    => 'en', 
                                'title'       => $data['title_en'] ?? ($data['title_hi'] ?? 'Untitled'), 
                                'description' => $data['description_en'] ?? ($data['description_hi'] ?? ''),
                                'meta_title'  => $data['meta_title_en'] ?? '',
                                'meta_keywords' => $data['meta_keywords_en'] ?? '',
                                'meta_description' => $data['meta_description_en'] ?? '',
                            ],
                        ];
                        $db->table('news_translations')->insertBatch($translations);
                        $successCount++;
                    } else {
                        $errorCount++;
                    }
                } catch (\Exception $e) {
                    $errorCount++;
                }
            }
            fclose($handle);
        }

        return redirect()->to('admin/news')->with('success', "Bulk upload completed. $successCount articles imported, $errorCount errors.");
    }

    public function categoryList()
    {
        $categoryModel = new CategoryModel();
        $lang = 'hi'; 
        $search = $this->request->getGet('search');
        
        $query = $categoryModel->select('categories.*, category_translations.title')
                              ->join('category_translations', 'category_translations.category_id = categories.id')
                              ->where('category_translations.language', $lang);
        
        if (!empty($search)) {
            $query->groupStart()
                 ->like('category_translations.title', $search)
                 ->orLike('categories.slug', $search)
                 ->groupEnd();
        }
        
        $data = [
            'categories' => $query->orderBy('categories.sort_order', 'ASC')->paginate(15),
            'pager'      => $categoryModel->pager,
            'search'     => $search,
            'title'      => 'Post Categories'
        ];

        return view('admin/categories/index', $data);
    }

    public function categoryCreate()
    {
        $categoryModel = new CategoryModel();
        $data['parents'] = $categoryModel->select('categories.*, category_translations.title')
                                        ->join('category_translations', 'category_translations.category_id = categories.id')
                                        ->where('category_translations.language', 'hi')
                                        ->where('categories.parent_id', 0)
                                        ->findAll();
        return view('admin/categories/create', $data);
    }

    public function categoryStore()
    {
        $categoryModel = new CategoryModel();
        
        $rules = [
            'slug'     => 'required|is_unique[categories.slug]',
            'title_hi' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $catData = [
            'parent_id'        => $this->request->getPost('parent_id') ?: 0,
            'slug'             => $this->request->getPost('slug'),
            'status'           => $this->request->getPost('status'),
            'sort_order'       => (int) $this->request->getPost('sort_order'),
            'meta_title'       => $this->request->getPost('meta_title'),
            'meta_description' => $this->request->getPost('meta_description'),
        ];

        // Handle Image Upload
        $img = $this->request->getFile('image');
        if ($img && $img->isValid() && !$img->hasMoved()) {
            $newName = $img->getRandomName();
            $img->move(FCPATH . 'uploads/categories', $newName);
            $catData['image'] = $newName;
        }

        $catId = $categoryModel->insert($catData);

        // Translations (Fixed hi and en for demo)
        $db = \Config\Database::connect();
        $db->table('category_translations')->insertBatch([
            ['category_id' => $catId, 'language' => 'hi', 'title' => $this->request->getPost('title_hi')],
            ['category_id' => $catId, 'language' => 'en', 'title' => $this->request->getPost('title_en') ?: $this->request->getPost('title_hi')],
        ]);

        $cache = service('cache');
        $cache->delete('dynamic_nav_hi');
        $cache->delete('dynamic_nav_en');

        return redirect()->to('admin/categories')->with('success', 'Category created successfully!');
    }

    public function categoryEdit($id)
    {
        $categoryModel = new CategoryModel();
        $db = \Config\Database::connect();
        
        $category = $categoryModel->find($id);
        if (!$category) {
            return redirect()->to('admin/categories')->with('error', 'Category not found.');
        }

        $hi = $db->table('category_translations')->where(['category_id' => $id, 'language' => 'hi'])->get()->getRowArray();
        $en = $db->table('category_translations')->where(['category_id' => $id, 'language' => 'en'])->get()->getRowArray();

        $data = [
            'category' => $category,
            'hi'       => $hi,
            'en'       => $en,
            'parents'  => $categoryModel->select('categories.*, category_translations.title')
                                        ->join('category_translations', 'category_translations.category_id = categories.id')
                                        ->where('category_translations.language', 'hi')
                                        ->where('categories.parent_id', 0)
                                        ->where('categories.id !=', $id)
                                        ->findAll()
        ];

        return view('admin/categories/edit', $data);
    }

    public function categoryUpdate($id)
    {
        $categoryModel = new CategoryModel();
        
        $rules = [
            'slug'     => "required|is_unique[categories.slug,id,{$id}]",
            'title_hi' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $catData = [
            'id'               => $id,
            'parent_id'        => $this->request->getPost('parent_id') ?: 0,
            'slug'             => $this->request->getPost('slug'),
            'status'           => $this->request->getPost('status'),
            'sort_order'       => (int) $this->request->getPost('sort_order'),
            'meta_title'       => $this->request->getPost('meta_title'),
            'meta_description' => $this->request->getPost('meta_description'),
        ];

        // Handle Image Upload
        $img = $this->request->getFile('image');
        if ($img && $img->isValid() && !$img->hasMoved()) {
            // Delete old image if exists
            $oldCat = $categoryModel->find($id);
            if (!empty($oldCat['image']) && file_exists(FCPATH . 'uploads/categories/' . $oldCat['image'])) {
                unlink(FCPATH . 'uploads/categories/' . $oldCat['image']);
            }

            $newName = $img->getRandomName();
            $img->move(FCPATH . 'uploads/categories', $newName);
            $catData['image'] = $newName;
        }

        $categoryModel->save($catData);

        $cache = service('cache');
        $cache->delete('dynamic_nav_hi');
        $cache->delete('dynamic_nav_en');

        $db = \Config\Database::connect();
        // Update Hi
        $db->table('category_translations')->where(['category_id' => $id, 'language' => 'hi'])->update([
            'title' => $this->request->getPost('title_hi')
        ]);
        // Update En
        $db->table('category_translations')->where(['category_id' => $id, 'language' => 'en'])->update([
            'title' => $this->request->getPost('title_en') ?: $this->request->getPost('title_hi')
        ]);

        return redirect()->to('admin/categories')->with('success', 'Category updated successfully!');
    }

    public function categoryDelete($id)
    {
        $categoryModel = new CategoryModel();
        $categoryModel->delete($id);
        
        $db = \Config\Database::connect();
        $db->table('category_translations')->where('category_id', $id)->delete();
        
        $cache = service('cache');
        $cache->delete('dynamic_nav_hi');
        $cache->delete('dynamic_nav_en');

        return redirect()->to('admin/categories')->with('success', 'Category deleted.');
    }

    public function categoryToggleStatus($id)
    {
        $categoryModel = new CategoryModel();
        $cat = $categoryModel->find($id);
        $newStatus = ($cat['status'] == 'active') ? 'inactive' : 'active';
        
        $categoryModel->update($id, ['status' => $newStatus]);
        return redirect()->back()->with('success', 'Category status updated to ' . $newStatus);
    }

    public function categoryBulkUpload()
    {
        $categoryModel = new CategoryModel();
        $data['parents'] = $categoryModel->select('categories.*, category_translations.title')
                                        ->join('category_translations', 'category_translations.category_id = categories.id')
                                        ->where('category_translations.language', 'hi')
                                        ->where('categories.parent_id', 0)
                                        ->findAll();
        $data['title'] = 'Bulk Upload Categories';
        return view('admin/categories/bulk_upload', $data);
    }

    public function categoryBulkFormat()
    {
        $filename = 'categories_bulk_format.csv';
        $header = ['parent_id', 'slug', 'title_hi', 'title_en', 'status', 'sort_order', 'meta_title', 'meta_description'];
        
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $filename);
        
        $output = fopen('php://output', 'w');
        // Add BOM for Excel UTF-8 support
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
        fputcsv($output, $header);
        
        // Example Row
        fputcsv($output, [
            '0', 
            'politics-news', 
            'राजनीति', 
            'Politics', 
            'active', 
            '1',
            'Latest Political News', 
            'Get the latest political updates here.'
        ]);
        
        fclose($output);
        exit;
    }

    public function categoryBulkStore()
    {
        $file = $this->request->getFile('csv_file');
        
        if (!$file || !$file->isValid()) {
            return redirect()->back()->with('error', 'Please upload a valid CSV file.');
        }

        $categoryModel = new CategoryModel();
        $db = \Config\Database::connect();
        
        if (($handle = fopen($file->getTempName(), 'r')) !== FALSE) {
            // Check for BOM and skip it
            $bom = fread($handle, 3);
            if ($bom != chr(0xEF).chr(0xBB).chr(0xBF)) {
                rewind($handle);
            }

            $headers = fgetcsv($handle); // Read headers
            
            if (!$headers || count($headers) < 2) {
                return redirect()->back()->with('error', 'Invalid CSV format. Please download and use the template.');
            }

            $successCount = 0;
            $errorCount = 0;

            while (($row = fgetcsv($handle)) !== FALSE) {
                if (count($row) < count($headers)) continue; // Skip mismatching rows

                // Map row data
                $data = array_combine($headers, $row);
                
                try {
                    $slug = !empty($data['slug']) ? url_title($data['slug'], '-', true) : url_title($data['title_en'] ?? $data['title_hi'], '-', true);
                    
                    // Check if slug exists, append random if needed
                    $check = $categoryModel->where('slug', $slug)->first();
                    if ($check) $slug .= '-' . rand(100, 999);

                    $catId = $categoryModel->insert([
                        'parent_id'        => $data['parent_id'] ?? 0,
                        'slug'             => $slug,
                        'status'           => $data['status'] ?? 'active',
                        'sort_order'       => $data['sort_order'] ?? 0,
                        'meta_title'       => $data['meta_title'] ?? '',
                        'meta_description' => $data['meta_description'] ?? '',
                    ]);

                    if ($catId) {
                        $translations = [
                            [
                                'category_id' => $catId, 
                                'language'    => 'hi', 
                                'title'       => $data['title_hi'] ?? 'Untitled', 
                            ],
                            [
                                'category_id' => $catId, 
                                'language'    => 'en', 
                                'title'       => $data['title_en'] ?? ($data['title_hi'] ?? 'Untitled'), 
                            ],
                        ];
                        $db->table('category_translations')->insertBatch($translations);
                        $successCount++;
                    } else {
                        $errorCount++;
                    }
                } catch (\Exception $e) {
                    $errorCount++;
                }
            }
            fclose($handle);
        }

        return redirect()->to('admin/categories')->with('success', "Bulk upload completed. $successCount categories imported, $errorCount errors.");
    }

    public function userList()
    {
        check_admin();
        $db = \Config\Database::connect();
        $userModel = new \App\Models\UserModel();

        $search = $this->request->getGet('search');
        $roleFilter = $this->request->getGet('role');

        $builder = $userModel->select('users.*, roles.name as role_name')
                             ->join('roles', 'roles.id = users.role_id', 'left');

        if (!empty($search)) {
            $builder->groupStart()
                    ->like('users.username', $search)
                    ->orLike('users.full_name', $search)
                    ->orLike('users.email', $search)
                    ->groupEnd();
        }
        if (!empty($roleFilter)) {
            $builder->where('users.role_id', $roleFilter);
        }

        $data['users']   = $builder->orderBy('users.created_at', 'DESC')->paginate(20);
        $data['pager']   = $userModel->pager;
        $data['roles']   = $db->table('roles')->get()->getResultArray();
        $data['search']  = $search;
        $data['role']    = $roleFilter;
        $data['title']   = 'User Management';

        return view('admin/users/index', $data);
    }

    public function userCreate()
    {
        check_admin();
        $db = \Config\Database::connect();
        $data['roles'] = $db->table('roles')->get()->getResultArray();
        $data['title'] = 'Add Team Member';
        return view('admin/users/create', $data);
    }

    public function userInvite()
    {
        check_admin();
        $db = \Config\Database::connect();
        $data['roles'] = $db->table('roles')->get()->getResultArray();
        $data['title'] = 'Invite New User';
        return view('admin/users/invite', $data);
    }

    public function userInviteStore()
    {
        check_admin();
        $userModel = new \App\Models\UserModel();
        $db = \Config\Database::connect();

        $rules = [
            'email'     => 'required|valid_email|is_unique[users.email]',
            'full_name' => 'required|min_length[3]',
            'role_id'   => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Generate Random Password
        $plainPassword = bin2hex(random_bytes(4)); // 8 character random hex
        
        // Generate Username from name
        $nameParts = explode(' ', $this->request->getPost('full_name'));
        $username = strtolower($nameParts[0]) . rand(100, 999);
        
        // Check if username unique
        while ($userModel->where('username', $username)->first()) {
            $username = strtolower($nameParts[0]) . rand(100, 999);
        }

        $userData = [
            'username'  => $username,
            'email'     => $this->request->getPost('email'),
            'password'  => password_hash($plainPassword, PASSWORD_DEFAULT),
            'full_name' => $this->request->getPost('full_name'),
            'role_id'   => $this->request->getPost('role_id'),
            'status'    => 'active',
        ];

        $userModel->insert($userData);

        // Get Role Name for email
        $roleInfo = $db->table('roles')->where('id', $userData['role_id'])->get()->getRowArray();
        $roleName = $roleInfo['name'] ?? 'Team Member';

        // Send Invitation Email
        $smtp = $db->table('smtp_settings')->get()->getRowArray();
        if ($smtp && $smtp['is_active']) {
            $email = \Config\Services::email();
            $config = [
                'protocol'   => 'smtp',
                'SMTPHost'   => $smtp['smtp_host'],
                'SMTPUser'   => $smtp['smtp_user'],
                'SMTPPass'   => $smtp['smtp_pass'],
                'SMTPPort'   => (int)$smtp['smtp_port'],
                'SMTPCrypto' => $smtp['smtp_crypto'] != 'none' ? $smtp['smtp_crypto'] : '',
                'mailType'   => 'html',
                'charset'    => 'utf-8',
                'newline'    => "\r\n"
            ];
            $email->initialize($config);
            $email->setFrom($smtp['from_email'], $smtp['from_name']);
            $email->setTo($userData['email']);
            $email->setSubject('Invitation to join NewsPortal');
            
        // Use View Template
        $siteName = get_setting('site_name', 'NewsPortal');
        $siteLogo = get_setting('logo');
        
        $message = view('emails/invitation', [
            'full_name' => $userData['full_name'],
            'username'  => $username,
            'password'  => $plainPassword,
            'role'      => $roleName,
            'site_name' => $siteName,
            'site_logo' => $siteLogo
        ]);
            
            $email->setMessage($message);
            
            if ($email->send()) {
                return redirect()->to('admin/users/invite')->with('success', "Invitation sent to {$userData['email']} successfully! Username: $username");
            } else {
                // If mail fails, show the error but the user was still created
                $errorMsg = $email->printDebugger(['headers']);
                return redirect()->to('admin/users/invite')->with('success', "User created successfully (Username: $username), but invitation email failed to send. Please check your SMTP settings.")->with('error', "Mail Error: " . substr(strip_tags($errorMsg), 0, 200) . "...");
            }
        }

        return redirect()->to('admin/users/invite')->with('success', "User created successfully! Username: $username (Note: SMTP is inactive, so no email was sent)");
    }

    public function userStore()
    {
        check_admin();
        $userModel = new \App\Models\UserModel();

        $rules = [
            'username'  => 'required|min_length[3]|is_unique[users.username]',
            'email'     => 'required|valid_email|is_unique[users.email]',
            'password'  => 'required|min_length[6]',
            'full_name' => 'required',
            'role_id'   => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userData = [
            'username'  => $this->request->getPost('username'),
            'email'     => $this->request->getPost('email'),
            'password'  => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'full_name' => $this->request->getPost('full_name'),
            'role_id'   => $this->request->getPost('role_id'),
            'status'    => $this->request->getPost('status') ?: 'active',
        ];

        $userModel->insert($userData);
        return redirect()->to('admin/users')->with('success', 'User created successfully!');
    }

    public function userEdit($id)
    {
        check_admin();
        $userModel = new \App\Models\UserModel();
        $db = \Config\Database::connect();

        $user = $userModel->find($id);
        if (!$user) {
            return redirect()->to('admin/users')->with('error', 'User not found.');
        }

        $data['user']   = $user;
        $data['roles']  = $db->table('roles')->get()->getResultArray();
        $data['title']  = 'Edit Team Member';
        return view('admin/users/edit', $data);
    }

    public function userUpdate($id)
    {
        check_admin();
        $userModel = new \App\Models\UserModel();

        $user = $userModel->find($id);
        if (!$user) {
            return redirect()->to('admin/users')->with('error', 'User not found.');
        }

        $rules = [
            'username'  => "required|min_length[3]|is_unique[users.username,id,{$id}]",
            'email'     => "required|valid_email|is_unique[users.email,id,{$id}]",
            'full_name' => 'required',
            'role_id'   => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userData = [
            'username'  => $this->request->getPost('username'),
            'email'     => $this->request->getPost('email'),
            'full_name' => $this->request->getPost('full_name'),
            'role_id'   => $this->request->getPost('role_id'),
            'status'    => $this->request->getPost('status'),
        ];

        $userModel->update($id, $userData);
        return redirect()->to('admin/users')->with('success', 'User updated successfully!');
    }

    public function userDelete($id)
    {
        check_admin();
        $userModel = new \App\Models\UserModel();

        // Prevent deleting yourself
        if ($id == session()->get('userId')) {
            return redirect()->to('admin/users')->with('error', 'You cannot delete your own account.');
        }

        $userModel->delete($id);
        return redirect()->to('admin/users')->with('success', 'User deleted successfully.');
    }

    public function userToggleStatus($id)
    {
        check_admin();
        if ($id == session()->get('userId')) {
            return redirect()->to('admin/users')->with('error', 'You cannot deactivate your own account.');
        }
        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($id);
        $newStatus = ($user['status'] == 'active') ? 'inactive' : 'active';

        $userModel->update($id, ['status' => $newStatus]);
        return redirect()->back()->with('success', 'User status updated to ' . $newStatus . '.');
    }

    public function userResetPassword($id)
    {
        check_admin();
        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($id);
        if (!$user) {
            return redirect()->to('admin/users')->with('error', 'User not found.');
        }
        $data['user']  = $user;
        $data['title'] = 'Reset Password';
        return view('admin/users/reset_password', $data);
    }

    public function userResetPasswordStore($id)
    {
        check_admin();
        $userModel = new \App\Models\UserModel();

        $rules = [
            'password'         => 'required|min_length[6]',
            'password_confirm' => 'required|matches[password]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userModel->update($id, [
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
        ]);
        return redirect()->to('admin/users')->with('success', 'Password reset successfully!');
    }

    public function userBulkUpload()
    {
        check_admin();
        $db = \Config\Database::connect();
        $data['roles'] = $db->table('roles')->get()->getResultArray();
        $data['title'] = 'Bulk Upload Team Members';
        return view('admin/users/bulk_upload', $data);
    }

    public function userBulkFormat()
    {
        check_admin();
        $filename = 'users_bulk_format.csv';
        $header = ['full_name', 'username', 'email', 'password', 'role_id', 'status'];
        
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $filename);
        
        $output = fopen('php://output', 'w');
        fputcsv($output, $header);
        
        // Example Row
        fputcsv($output, [
            'John Doe', 
            'johndoe', 
            'john@example.com', 
            'password123', 
            '2', 
            'active'
        ]);
        
        fclose($output);
        exit;
    }

    public function userBulkStore()
    {
        check_admin();
        $file = $this->request->getFile('csv_file');
        
        if (!$file || !$file->isValid()) {
            return redirect()->back()->with('error', 'Please upload a valid CSV file.');
        }

        $userModel = new \App\Models\UserModel();
        
        if (($handle = fopen($file->getTempName(), 'r')) !== FALSE) {
            $headers = fgetcsv($handle);
            if (!$headers || count($headers) < 2) {
                return redirect()->back()->with('error', 'Invalid CSV format.');
            }

            $successCount = 0;
            $errorCount = 0;

            while (($row = fgetcsv($handle)) !== FALSE) {
                if (count($row) < count($headers)) continue;

                $data = array_combine($headers, $row);
                
                try {
                    // Check if user/email exists
                    $exists = $userModel->where('username', $data['username'])
                                       ->orWhere('email', $data['email'])
                                       ->first();
                    if ($exists) {
                        $errorCount++;
                        continue;
                    }

                    $userModel->insert([
                        'full_name' => $data['full_name'] ?? '',
                        'username'  => $data['username'],
                        'email'     => $data['email'],
                        'password'  => password_hash($data['password'] ?? 'User@123', PASSWORD_BCRYPT),
                        'role_id'   => $data['role_id'] ?? 2,
                        'status'    => $data['status'] ?? 'active',
                    ]);
                    $successCount++;
                } catch (\Exception $e) { $errorCount++; }
            }
            fclose($handle);
        }

        return redirect()->to('admin/users')->with('success', "Bulk upload completed. $successCount members imported, $errorCount errors/duplicates.");
    }

    // ─── Roles ───────────────────────────────────────────────────────────────

    public function roleList()
    {
        check_admin();
        $db = \Config\Database::connect();
        $data['roles'] = $db->query("
            SELECT roles.*, COUNT(users.id) as user_count
            FROM roles
            LEFT JOIN users ON users.role_id = roles.id
            GROUP BY roles.id
        ")->getResultArray();
        $data['title'] = 'Role Management';
        return view('admin/roles/index', $data);
    }

    public function roleCreate()
    {
        check_admin();
        $data['title'] = 'Create Role';
        return view('admin/roles/create', $data);
    }

    public function roleStore()
    {
        check_admin();
        $db = \Config\Database::connect();

        $rules = ['name' => 'required|is_unique[roles.name]'];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $permissions = $this->request->getPost('permissions') ?: [];
        $db->table('roles')->insert([
            'name'        => $this->request->getPost('name'),
            'permissions' => json_encode($permissions),
        ]);
        return redirect()->to('admin/roles')->with('success', 'Role created successfully!');
    }

    public function roleEdit($id)
    {
        check_admin();
        $db = \Config\Database::connect();
        $role = $db->table('roles')->where('id', $id)->get()->getRowArray();
        if (!$role) {
            return redirect()->to('admin/roles')->with('error', 'Role not found.');
        }
        $data['role']  = $role;
        $data['title'] = 'Edit Role';
        return view('admin/roles/edit', $data);
    }

    public function roleUpdate($id)
    {
        check_admin();
        $db = \Config\Database::connect();

        $rules = ["name" => "required|is_unique[roles.name,id,{$id}]"];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $permissions = $this->request->getPost('permissions') ?: [];
        $db->table('roles')->where('id', $id)->update([
            'name'        => $this->request->getPost('name'),
            'permissions' => json_encode($permissions),
        ]);
        return redirect()->to('admin/roles')->with('success', 'Role updated successfully!');
    }

    public function roleDelete($id)
    {
        check_admin();
        $db = \Config\Database::connect();

        // Prevent deleting a role that still has users
        $count = $db->table('users')->where('role_id', $id)->countAllResults();
        if ($count > 0) {
            return redirect()->to('admin/roles')->with('error', "Cannot delete: {$count} user(s) are assigned to this role.");
        }

        $db->table('roles')->where('id', $id)->delete();
        return redirect()->to('admin/roles')->with('success', 'Role deleted.');
    }

    public function commentList()
    {
        $commentModel = new \App\Models\CommentModel();
        
        // Use Left Join and prioritize any available title to avoid 'invisible' comments
        $data['comments'] = $commentModel->select('comments.*, COALESCE(hi.title, en.title, "Untitled Story") as news_title')
                                        ->join('news_translations hi', 'hi.news_id = comments.news_id AND hi.language = "hi"', 'left')
                                        ->join('news_translations en', 'en.news_id = comments.news_id AND en.language = "en"', 'left')
                                        ->orderBy('comments.created_at', 'DESC')
                                        ->findAll();
                                        
        return view('admin/comments/index', $data);
    }

    public function commentApprove($id)
    {
        $commentModel = new \App\Models\CommentModel();
        $commentModel->update($id, ['status' => 'approved']);
        return redirect()->to('admin/comments')->with('success', 'Comment approved.');
    }

    public function commentDelete($id)
    {
        $commentModel = new \App\Models\CommentModel();
        $commentModel->delete($id);
        return redirect()->to('admin/comments')->with('success', 'Comment deleted.');
    }

    public function settings()
    {
        check_admin();
        $db = \Config\Database::connect();
        $data['settings'] = $db->table('settings')->get()->getResultArray();
        $kv = [];
        foreach ($data['settings'] as $s) { $kv[$s['key']] = $s['value']; }
        $data['kv'] = $kv;
        $data['title'] = 'Site Settings';
        return view('admin/settings', $data);
    }

    public function settingsUpdate()
    {
        check_admin();
        $db = \Config\Database::connect();

        // ── File uploads ──────────────────────────────────────────────────────
        $fileUploads = ['site_logo', 'favicon', 'og_image', 'header_banner', 'sidebar_banner', 'footer_banner'];

        foreach ($fileUploads as $key) {
            $file = $this->request->getFile($key);
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move('uploads/settings', $newName);
                // Upsert
                $exists = $db->table('settings')->where('key', $key)->countAllResults();
                if ($exists) {
                    $db->table('settings')->where('key', $key)->update(['value' => $newName]);
                } else {
                    $db->table('settings')->insert(['key' => $key, 'value' => $newName]);
                }
            }
        }

        // ── Text / plain fields ───────────────────────────────────────────────
        $textFields = [
            'site_name', 'site_tagline', 'site_description',
            'footer_about', 'contact_email', 'copyright_text',
            'meta_title', 'meta_description', 'meta_keywords', 'meta_author',
            'google_analytics', 'timezone',
            'facebook_url', 'twitter_url', 'instagram_url', 'youtube_url',
        ];

        foreach ($textFields as $key) {
            $val = $this->request->getPost($key);
            if ($val !== null) {
                $exists = $db->table('settings')->where('key', $key)->countAllResults();
                if ($exists) {
                    $db->table('settings')->where('key', $key)->update(['value' => $val]);
                } else {
                    $db->table('settings')->insert(['key' => $key, 'value' => $val]);
                }
            }
        }

        // ── Checkbox / Toggle fields ──────────────────────────────────────────
        $checkboxFields = ['protection_right_click', 'protection_devtools'];
        foreach ($checkboxFields as $key) {
            $val = $this->request->getPost($key) ? '1' : '0';
            $exists = $db->table('settings')->where('key', $key)->countAllResults();
            if ($exists) {
                $db->table('settings')->where('key', $key)->update(['value' => $val]);
            } else {
                $db->table('settings')->insert(['key' => $key, 'value' => $val]);
            }
        }

        return redirect()->back()->with('success', 'All settings updated successfully!');
    }

    public function sitemapManager()
    {
        check_admin();
        $db = \Config\Database::connect();
        
        $data = [
            'last_generated' => get_setting('sitemap_last_generated', date('Y-m-d H:i:s')),
            'sitemap_url'    => base_url('sitemap.xml'),
            'news_stats'     => [
                'total' => $db->table('news')->countAllResults(),
                'cats'  => $db->table('categories')->countAllResults()
            ]
        ];

        return view('admin/seo/sitemap', $data);
    }

    public function sitemapGenerate()
    {
        check_admin();
        $db = \Config\Database::connect();
        
        // Update the timestamp to simulate 'generation' (since it's dynamic)
        $now = date('Y-m-d H:i:s');
        $exists = $db->table('settings')->where('key', 'sitemap_last_generated')->countAllResults();
        if ($exists) {
            $db->table('settings')->where('key', 'sitemap_last_generated')->update(['value' => $now]);
        } else {
            $db->table('settings')->insert(['key' => 'sitemap_last_generated', 'value' => $now]);
        }

        return redirect()->back()->with('success', 'Sitemap protocol executed successfully. Search engines will be notified on the next crawl.');
    }

    // --- VISUAL STORIES CRUD ---
    public function storyList()
    {
        $storyModel = new \App\Models\StoryModel();
        $data['stories'] = $storyModel->orderBy('created_at', 'DESC')->findAll();
        $data['title'] = 'Visual Stories';
        return view('admin/stories/index', $data);
    }

    public function storyCreate()
    {
        return view('admin/stories/create', ['title' => 'Create Story']);
    }

    public function storyStore()
    {
        $storyModel = new \App\Models\StoryModel();
        
        $image = $this->request->getFile('image');
        $imgName = '';
        if ($image->isValid() && ! $image->hasMoved()) {
            $imgName = $image->getRandomName();
            $image->move('uploads/stories', $imgName);
        }

        list($mTitle, $mDesc, $mKeys) = $this->_autoGenerateSEO(
            $this->request->getPost('title_en') ?: $this->request->getPost('title_hi'),
            $this->request->getPost('content_en') ?: $this->request->getPost('content_hi'),
            $this->request->getPost('meta_title'),
            $this->request->getPost('meta_description'),
            $this->request->getPost('meta_keywords')
        );

        $storyModel->save([
            'title_hi' => $this->request->getPost('title_hi'),
            'title_en' => $this->request->getPost('title_en'),
            'slug'     => url_title($this->request->getPost('title_en') ?: $this->request->getPost('title_hi'), '-', true),
            'content_hi' => $this->request->getPost('content_hi'),
            'content_en' => $this->request->getPost('content_en'),
            'image'    => $imgName,
            'status'   => $this->request->getPost('status') ?: 'published',
            'meta_title' => $mTitle,
            'meta_keywords' => $mKeys,
            'meta_description' => $mDesc
        ]);

        return redirect()->to('admin/stories')->with('success', 'Visual story created successfully!');
    }

    public function storyEdit($id)
    {
        $storyModel = new \App\Models\StoryModel();
        $data['story'] = $storyModel->find($id);
        $data['title'] = 'Edit Story';
        return view('admin/stories/edit', $data);
    }

    public function storyUpdate($id)
    {
        $storyModel = new \App\Models\StoryModel();
        
        $image = $this->request->getFile('image');
        $imgName = $this->request->getPost('old_image');
        
        if ($image && $image->isValid() && ! $image->hasMoved()) {
            $imgName = $image->getRandomName();
            $image->move('uploads/stories', $imgName);
        }

        list($mTitle, $mDesc, $mKeys) = $this->_autoGenerateSEO(
            $this->request->getPost('title_en') ?: $this->request->getPost('title_hi'),
            $this->request->getPost('content_en') ?: $this->request->getPost('content_hi'),
            $this->request->getPost('meta_title'),
            $this->request->getPost('meta_description'),
            $this->request->getPost('meta_keywords')
        );

        $storyModel->update($id, [
            'title_hi' => $this->request->getPost('title_hi'),
            'title_en' => $this->request->getPost('title_en'),
            'content_hi' => $this->request->getPost('content_hi'),
            'content_en' => $this->request->getPost('content_en'),
            'image'    => $imgName,
            'status'   => $this->request->getPost('status'),
            'meta_title' => $mTitle,
            'meta_keywords' => $mKeys,
            'meta_description' => $mDesc
        ]);

        return redirect()->to('admin/stories')->with('success', 'Visual story updated successfully!');
    }

    public function storyDelete($id)
    {
        $storyModel = new \App\Models\StoryModel();
        $storyModel->delete($id);
        return redirect()->to('admin/stories')->with('success', 'Story deleted successfully.');
    }

    public function storyBulkDelete()
    {
        $ids = $this->request->getPost('ids');
        if (empty($ids) || !is_array($ids)) {
            return redirect()->to('admin/stories')->with('error', 'No items selected.');
        }

        $storyModel = new \App\Models\StoryModel();
        foreach ($ids as $id) {
            $storyModel->delete($id);
        }

        return redirect()->to('admin/stories')->with('success', count($ids) . ' stories deleted successfully.');
    }

    public function storyBulkUpload()
    {
        $data['title'] = 'Bulk Upload Visual Stories';
        return view('admin/stories/bulk_upload', $data);
    }

    public function storyBulkFormat()
    {
        $filename = 'stories_bulk_format.csv';
        $header = ['title_hi', 'title_en', 'content_hi', 'content_en', 'slug', 'status', 'meta_title', 'meta_description'];
        
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $filename);
        
        $output = fopen('php://output', 'w');
        // Add BOM for Excel
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
        fputcsv($output, $header);
        
        // Example Row
        fputcsv($output, [
            'हिंदी कहानी शीर्षक', 
            'English Story Title', 
            'हिंदी में कहानी का विवरण...', 
            'Story description in English...', 
            'story-slug-example', 
            'published', 
            'Meta Title', 
            'Description...'
        ]);
        
        fclose($output);
        exit;
    }

    public function storyBulkStore()
    {
        $file = $this->request->getFile('csv_file');
        
        if (!$file || !$file->isValid()) {
            return redirect()->back()->with('error', 'Please upload a valid CSV file.');
        }

        $storyModel = new \App\Models\StoryModel();
        
        if (($handle = fopen($file->getTempName(), 'r')) !== FALSE) {
            $bom = fread($handle, 3);
            if ($bom != chr(0xEF).chr(0xBB).chr(0xBF)) rewind($handle);

            $headers = fgetcsv($handle);
            if (!$headers || count($headers) < 2) {
                return redirect()->back()->with('error', 'Invalid CSV format.');
            }

            $successCount = 0;
            $errorCount = 0;

            while (($row = fgetcsv($handle)) !== FALSE) {
                if (count($row) < count($headers)) continue;

                $data = array_combine($headers, $row);
                
                try {
                    $slug = !empty($data['slug']) ? url_title($data['slug'], '-', true) : url_title($data['title_en'] ?? $data['title_hi'], '-', true);
                    
                    // Check slug existence
                    $check = $storyModel->where('slug', $slug)->first();
                    if ($check) $slug .= '-' . rand(100, 999);

                    $storyModel->insert([
                        'title_hi'   => $data['title_hi'] ?? 'Untitled',
                        'title_en'   => $data['title_en'] ?? '',
                        'content_hi' => $data['content_hi'] ?? '',
                        'content_en' => $data['content_en'] ?? '',
                        'slug'       => $slug,
                        'status'     => $data['status'] ?? 'draft',
                        'meta_title' => $data['meta_title'] ?? '',
                        'meta_description' => $data['meta_description'] ?? '',
                    ]);
                    $successCount++;
                } catch (\Exception $e) { $errorCount++; }
            }
            fclose($handle);
        }

        return redirect()->to('admin/stories')->with('success', "Bulk upload completed. $successCount stories imported, $errorCount errors.");
    }

    // --- VIDEO NEWS CRUD ---
    public function videoList()
    {
        $videoModel = new \App\Models\VideoNewsModel();
        $data['videos'] = $videoModel->orderBy('created_at', 'DESC')->findAll();
        $data['title'] = 'Video News Management';
        return view('admin/videos/index', $data);
    }

    public function videoCreate()
    {
        return view('admin/videos/create', ['title' => 'Publish Video News']);
    }

    public function videoStore()
    {
        $videoModel = new \App\Models\VideoNewsModel();
        
        $image = $this->request->getFile('thumbnail');
        $imgName = '';
        if ($image->isValid() && ! $image->hasMoved()) {
            $imgName = $image->getRandomName();
            $image->move('public/uploads/videos', $imgName);
        }

        list($mTitle, $mDesc, $mKeys) = $this->_autoGenerateSEO(
            $this->request->getPost('title_en') ?: $this->request->getPost('title_hi'),
            $this->request->getPost('description_en') ?: $this->request->getPost('description_hi'),
            $this->request->getPost('meta_title'),
            $this->request->getPost('meta_description'),
            $this->request->getPost('meta_keywords')
        );

        $videoModel->save([
            'title_hi' => $this->request->getPost('title_hi'),
            'title_en' => $this->request->getPost('title_en'),
            'slug'     => url_title($this->request->getPost('title_en') ?: $this->request->getPost('title_hi'), '-', true),
            'video_url' => $this->request->getPost('video_url'),
            'description_hi' => $this->request->getPost('description_hi'),
            'description_en' => $this->request->getPost('description_en'),
            'meta_title' => $mTitle,
            'meta_keywords' => $mKeys,
            'meta_description' => $mDesc,
            'thumbnail' => $imgName,
            'status'   => $this->request->getPost('status') ?: 'published',
            'author_name' => $this->request->getPost('author_name') ?: session()->get('fullName')
        ]);

        return redirect()->to('admin/videos')->with('success', 'Video news published successfully!');
    }

    public function videoEdit($id)
    {
        $videoModel = new \App\Models\VideoNewsModel();
        $data['video'] = $videoModel->find($id);
        $data['title'] = 'Edit Video News';
        return view('admin/videos/edit', $data);
    }

    public function videoUpdate($id)
    {
        $videoModel = new \App\Models\VideoNewsModel();
        
        $image = $this->request->getFile('thumbnail');
        $imgName = $this->request->getPost('old_thumbnail');
        
        if ($image && $image->isValid() && ! $image->hasMoved()) {
            $imgName = $image->getRandomName();
            $image->move('uploads/videos', $imgName);
        }

        list($mTitle, $mDesc, $mKeys) = $this->_autoGenerateSEO(
            $this->request->getPost('title_en') ?: $this->request->getPost('title_hi'),
            $this->request->getPost('description_en') ?: $this->request->getPost('description_hi'),
            $this->request->getPost('meta_title'),
            $this->request->getPost('meta_description'),
            $this->request->getPost('meta_keywords')
        );

        $videoModel->update($id, [
            'title_hi' => $this->request->getPost('title_hi'),
            'title_en' => $this->request->getPost('title_en'),
            'video_url' => $this->request->getPost('video_url'),
            'description_hi' => $this->request->getPost('description_hi'),
            'description_en' => $this->request->getPost('description_en'),
            'meta_title' => $mTitle,
            'meta_keywords' => $mKeys,
            'meta_description' => $mDesc,
            'thumbnail' => $imgName,
            'status'   => $this->request->getPost('status'),
            'author_name' => $this->request->getPost('author_name')
        ]);

        return redirect()->to('admin/videos')->with('success', 'Video news updated successfully!');
    }

    public function videoDelete($id)
    {
        $videoModel = new \App\Models\VideoNewsModel();
        $videoModel->delete($id);
        return redirect()->to('admin/videos')->with('success', 'Video news deleted successfully.');
    }

    public function videoBulkDelete()
    {
        $ids = $this->request->getPost('ids');
        if (empty($ids) || !is_array($ids)) {
            return redirect()->to('admin/videos')->with('error', 'No items selected.');
        }

        $videoModel = new \App\Models\VideoNewsModel();
        foreach ($ids as $id) {
            $videoModel->delete($id);
        }

        return redirect()->to('admin/videos')->with('success', count($ids) . ' videos deleted successfully.');
    }

    public function videoBulkUpload()
    {
        $data['title'] = 'Bulk Upload Video News';
        return view('admin/videos/bulk_upload', $data);
    }

    public function videoBulkFormat()
    {
        $filename = 'videos_bulk_format.csv';
        $header = ['title_hi', 'title_en', 'video_url', 'description_hi', 'description_en', 'author_name', 'status', 'meta_title', 'meta_description'];
        
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $filename);
        
        $output = fopen('php://output', 'w');
        // Add BOM
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
        fputcsv($output, $header);
        
        // Example Row
        fputcsv($output, [
            'हिंदी वीडियो समाचार शीर्षक', 
            'English Video News Title', 
            'https://youtube.com/watch?v=example', 
            'हिंदी में विवरण...', 
            'Video description in English...', 
            'John Doe', 
            'published', 
            'Video Meta Title', 
            'Meta description...'
        ]);
        
        fclose($output);
        exit;
    }

    public function videoBulkStore()
    {
        $file = $this->request->getFile('csv_file');
        
        if (!$file || !$file->isValid()) {
            return redirect()->back()->with('error', 'Please upload a valid CSV file.');
        }

        $videoModel = new \App\Models\VideoNewsModel();
        
        if (($handle = fopen($file->getTempName(), 'r')) !== FALSE) {
            $bom = fread($handle, 3);
            if ($bom != chr(0xEF).chr(0xBB).chr(0xBF)) rewind($handle);

            $headers = fgetcsv($handle);
            if (!$headers || count($headers) < 2) {
                return redirect()->back()->with('error', 'Invalid CSV format.');
            }

            $successCount = 0;
            $errorCount = 0;

            while (($row = fgetcsv($handle)) !== FALSE) {
                if (count($row) < count($headers)) continue;

                $data = array_combine($headers, $row);
                
                try {
                    $slug = url_title($data['title_en'] ?? $data['title_hi'], '-', true);
                    
                    // Check slug
                    $check = $videoModel->where('slug', $slug)->first();
                    if ($check) $slug .= '-' . rand(100, 999);

                    $videoModel->insert([
                        'title_hi'       => $data['title_hi'] ?? 'Untitled',
                        'title_en'       => $data['title_en'] ?? '',
                        'video_url'      => $data['video_url'] ?? '',
                        'description_hi' => $data['description_hi'] ?? '',
                        'description_en' => $data['description_en'] ?? '',
                        'author_name'    => $data['author_name'] ?? session()->get('fullName'),
                        'slug'           => $slug,
                        'status'         => $data['status'] ?? 'published',
                        'meta_title'     => $data['meta_title'] ?? '',
                        'meta_description' => $data['meta_description'] ?? '',
                    ]);
                    $successCount++;
                } catch (\Exception $e) { $errorCount++; }
            }
            fclose($handle);
        }

        return redirect()->to('admin/videos')->with('success', "Bulk upload completed. $successCount video bulletins imported, $errorCount errors.");
    }

    // --- AD MANAGEMENT CRUD ---
    public function adList()
    {
        $adModel = new \App\Models\AdModel();
        $data['ads'] = $adModel->select('ad_management.*, category_translations.title as category_title')
                             ->join('category_translations', 'category_translations.category_id = ad_management.target_category_id AND category_translations.language = "hi"', 'left')
                             ->orderBy('slot_name', 'ASC')
                             ->findAll();
        $data['title'] = 'Advertisement Manager';
        return view('admin/ads/index', $data);
    }

    public function adCreate()
    {
        $categoryModel = new \App\Models\CategoryModel();
        $data = [
            'title' => 'Create Ad Slot',
            'categories' => $categoryModel->getCategories('hi')
        ];
        return view('admin/ads/create', $data);
    }

    public function adStore()
    {
        $adModel = new \App\Models\AdModel();
        
        $image = $this->request->getFile('image');
        $imgName = '';
        if ($image && $image->isValid() && ! $image->hasMoved()) {
            $imgName = $image->getRandomName();
            $image->move('uploads/ads', $imgName);
        }

        $adModel->save([
            'slot_name' => $this->request->getPost('slot_name'),
            'target_page'=> $this->request->getPost('target_page'),
            'target_category_id' => $this->request->getPost('target_category_id') ?: 0,
            'ad_type'   => $this->request->getPost('ad_type'),
            'image'     => $imgName,
            'link'      => $this->request->getPost('link'),
            'custom_code' => $this->request->getPost('custom_code'),
            'is_active' => $this->request->getPost('is_active') ? 1 : 0
        ]);

        return redirect()->to('admin/ads')->with('success', 'Ad slot created successfully!');
    }

    public function adEdit($id)
    {
        $adModel = new \App\Models\AdModel();
        $categoryModel = new \App\Models\CategoryModel();
        $data['ad'] = $adModel->find($id);
        $data['categories'] = $categoryModel->getCategories('hi');
        $data['title'] = 'Edit Ad Slot';
        return view('admin/ads/edit', $data);
    }

    public function adUpdate($id)
    {
        $adModel = new \App\Models\AdModel();
        
        $image = $this->request->getFile('image');
        $imgName = $this->request->getPost('old_image');
        
        if ($image && $image->isValid() && ! $image->hasMoved()) {
            $imgName = $image->getRandomName();
            $image->move('uploads/ads', $imgName);
        }

        $adModel->update($id, [
            'slot_name' => $this->request->getPost('slot_name'),
            'target_page'=> $this->request->getPost('target_page'),
            'target_category_id' => $this->request->getPost('target_category_id') ?: 0,
            'ad_type'   => $this->request->getPost('ad_type'),
            'image'     => $imgName,
            'link'      => $this->request->getPost('link'),
            'custom_code' => $this->request->getPost('custom_code'),
            'is_active' => $this->request->getPost('is_active') ? 1 : 0
        ]);

        return redirect()->to('admin/ads')->with('success', 'Ad slot updated successfully!');
    }

    public function adDelete($id)
    {
        $adModel = new \App\Models\AdModel();
        $adModel->delete($id);
        return redirect()->to('admin/ads')->with('success', 'Ad slot removed.');
    }

    public function adBulkUpload()
    {
        $data['title'] = 'Bulk Upload Ad Slots';
        return view('admin/ads/bulk_upload', $data);
    }

    public function adBulkFormat()
    {
        $filename = 'ads_bulk_format.csv';
        $header = ['slot_name', 'target_page', 'ad_type', 'link', 'custom_code', 'is_active'];
        
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $filename);
        
        $output = fopen('php://output', 'w');
        fputcsv($output, $header);
        
        // Example Row
        fputcsv($output, [
            'Home Top Banner', 
            'home', 
            'image', 
            'https://example.com/ad-landing', 
            '', 
            '1'
        ]);
        fputcsv($output, [
            'Sidebar JS Ad', 
            'all', 
            'custom_code', 
            '', 
            '<script src="https://ads.example.com/serve.js"></script>', 
            '1'
        ]);
        
        fclose($output);
        exit;
    }

    public function adBulkStore()
    {
        $file = $this->request->getFile('csv_file');
        
        if (!$file || !$file->isValid()) {
            return redirect()->back()->with('error', 'Please upload a valid CSV file.');
        }

        $adModel = new \App\Models\AdModel();
        
        if (($handle = fopen($file->getTempName(), 'r')) !== FALSE) {
            $headers = fgetcsv($handle);
            if (!$headers || count($headers) < 2) {
                return redirect()->back()->with('error', 'Invalid CSV format.');
            }

            $successCount = 0;
            $errorCount = 0;

            while (($row = fgetcsv($handle)) !== FALSE) {
                if (count($row) < count($headers)) continue;

                $data = array_combine($headers, $row);
                
                try {
                    $adModel->insert([
                        'slot_name'   => $data['slot_name'] ?? 'New Ad Slot',
                        'target_page' => $data['target_page'] ?? 'all',
                        'ad_type'     => $data['ad_type'] ?? 'image',
                        'link'        => $data['link'] ?? '',
                        'custom_code' => $data['custom_code'] ?? '',
                        'is_active'   => ($data['is_active'] ?? 1) == 1 ? 1 : 0,
                    ]);
                    $successCount++;
                } catch (\Exception $e) { $errorCount++; }
            }
            fclose($handle);
        }

        return redirect()->to('admin/ads')->with('success', "Bulk upload completed. $successCount ad slots created, $errorCount errors.");
    }

    // --- BREAKING TICKER CRUD ---
    public function tickerList()
    {
        $tickerModel = new \App\Models\TickerModel();
        $data['tickers'] = $tickerModel->orderBy('id', 'DESC')->findAll();
        $data['title'] = 'Breaking News Ticker';
        return view('admin/ticker/index', $data);
    }

    public function tickerCreate()
    {
        return view('admin/ticker/create', ['title' => 'Create Flash Alert']);
    }

    public function tickerStore()
    {
        $tickerModel = new \App\Models\TickerModel();
        
        $tickerModel->save([
            'content_hi' => $this->request->getPost('content_hi'),
            'content_en' => $this->request->getPost('content_en'),
            'link'       => $this->request->getPost('link'),
            'is_active'  => $this->request->getPost('is_active') ? 1 : 0
        ]);

        return redirect()->to('admin/ticker')->with('success', 'Flash alert added to ticker!');
    }

    public function tickerEdit($id)
    {
        $tickerModel = new \App\Models\TickerModel();
        $data['ticker'] = $tickerModel->find($id);
        $data['title'] = 'Edit Flash Alert';
        return view('admin/ticker/edit', $data);
    }

    public function tickerUpdate($id)
    {
        $tickerModel = new \App\Models\TickerModel();
        
        $tickerModel->update($id, [
            'content_hi' => $this->request->getPost('content_hi'),
            'content_en' => $this->request->getPost('content_en'),
            'link'       => $this->request->getPost('link'),
            'is_active'  => $this->request->getPost('is_active') ? 1 : 0
        ]);

        return redirect()->to('admin/ticker')->with('success', 'Flash alert updated successfully!');
    }

    public function tickerDelete($id)
    {
        $tickerModel = new \App\Models\TickerModel();
        $tickerModel->delete($id);
        return redirect()->to('admin/ticker')->with('success', 'Alert removed from ticker.');
    }

    public function tickerBulkUpload()
    {
        $data['title'] = 'Bulk Upload Flash Alerts';
        return view('admin/ticker/bulk_upload', $data);
    }

    public function tickerBulkFormat()
    {
        $filename = 'ticker_bulk_format.csv';
        $header = ['content_hi', 'content_en', 'link', 'is_active'];
        
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=' . $filename);
        
        $output = fopen('php://output', 'w');
        // Add BOM
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
        fputcsv($output, $header);
        
        // Example Row
        fputcsv($output, [
            'हिंदी ब्रेकिंग न्यूज़ अलर्ट', 
            'English Breaking News Alert', 
            'https://example.com/news/123', 
            '1'
        ]);
        
        fclose($output);
        exit;
    }

    public function tickerBulkStore()
    {
        $file = $this->request->getFile('csv_file');
        
        if (!$file || !$file->isValid()) {
            return redirect()->back()->with('error', 'Please upload a valid CSV file.');
        }

        $tickerModel = new \App\Models\TickerModel();
        
        if (($handle = fopen($file->getTempName(), 'r')) !== FALSE) {
            $bom = fread($handle, 3);
            if ($bom != chr(0xEF).chr(0xBB).chr(0xBF)) rewind($handle);

            $headers = fgetcsv($handle);
            if (!$headers || count($headers) < 2) {
                return redirect()->back()->with('error', 'Invalid CSV format.');
            }

            $successCount = 0;
            $errorCount = 0;

            while (($row = fgetcsv($handle)) !== FALSE) {
                if (count($row) < count($headers)) continue;

                $data = array_combine($headers, $row);
                
                try {
                    $tickerModel->insert([
                        'content_hi' => $data['content_hi'] ?? 'Untitled Alert',
                        'content_en' => $data['content_en'] ?? '',
                        'link'       => $data['link'] ?? '',
                        'is_active'  => ($data['is_active'] ?? 1) == 1 ? 1 : 0,
                    ]);
                    $successCount++;
                } catch (\Exception $e) { $errorCount++; }
            }
            fclose($handle);
        }

        return redirect()->to('admin/ticker')->with('success', "Bulk upload completed. $successCount flash alerts imported, $errorCount errors.");
    }

    // --- SUBSCRIBERS MANAGEMENT ---
    public function subscriberList()
    {
        $subModel = new \App\Models\SubscriberModel();
        $data['subscribers'] = $subModel->orderBy('created_at', 'DESC')->findAll();
        $data['title'] = 'Newsletter Subscribers';
        return view('admin/subscribers/index', $data);
    }

    public function subscriberDelete($id)
    {
        $subModel = new \App\Models\SubscriberModel();
        $subModel->delete($id);
        return redirect()->to('admin/subscribers')->with('success', 'Subscriber removed.');
    }

    // --- CONTACT MESSAGES MANAGEMENT ---
    public function contactList()
    {
        $db = \Config\Database::connect();
        $data['messages'] = $db->table('contact_messages')->orderBy('created_at', 'DESC')->get()->getResultArray();
        $data['title'] = 'Contact Inquiries';
        return view('admin/contact_messages/index', $data);
    }

    public function contactDelete($id)
    {
        $db = \Config\Database::connect();
        $db->table('contact_messages')->where('id', $id)->delete();
        return redirect()->to('admin/contact-messages')->with('success', 'Inquiry deleted.');
    }

    // --- POLLS & SURVEYS CRUD ---
    public function pollList()
    {
        $pollModel = new \App\Models\PollModel();
        $data['polls'] = $pollModel->orderBy('created_at', 'DESC')->findAll();
        foreach($data['polls'] as &$poll) {
            $poll = $pollModel->getFullPoll($poll['id']);
        }
        $data['title'] = 'Polls & Surveys';
        return view('admin/polls/index', $data);
    }

    public function pollCreate()
    {
        return view('admin/polls/create', ['title' => 'Create New Poll']);
    }

    public function pollStore()
    {
        $pollModel = new \App\Models\PollModel();
        $db = \Config\Database::connect();
        
        $pollID = $pollModel->insert([
            'question_hi' => $this->request->getPost('question_hi'),
            'question_en' => $this->request->getPost('question_en'),
            'is_active'   => 1
        ]);

        $options_hi = $this->request->getPost('options_hi');
        $options_en = $this->request->getPost('options_en');

        foreach($options_hi as $key => $opt) {
            if (!empty($opt)) {
                $db->table('poll_options')->insert([
                    'poll_id'   => $pollID,
                    'option_hi' => $opt,
                    'option_en' => $options_en[$key] ?? ''
                ]);
            }
        }

        return redirect()->to('admin/polls')->with('success', 'Poll created successfully!');
    }

    public function pollDelete($id)
    {
        $pollModel = new \App\Models\PollModel();
        $pollModel->delete($id);
        return redirect()->to('admin/polls')->with('success', 'Poll removed.');
    }

    // --- ACTIVITY LOGS ---
    public function activityLogList()
    {
        $db = \Config\Database::connect();
        $data['logs'] = $db->table('activity_logs')
                           ->select('activity_logs.*, users.full_name as fullName')
                           ->join('users', 'users.id = activity_logs.user_id', 'left')
                           ->orderBy('created_at', 'DESC')
                           ->limit(100)
                           ->get()
                           ->getResultArray();
        
        // Fetch status
        $status = $db->table('settings')->where('key', 'activity_logs_status')->get()->getRowArray();
        $data['logStatus'] = $status['value'] ?? '1';
        
        $data['title'] = 'Activity Audit Trail';
        return view('admin/activity_logs/index', $data);
    }

    public function activityLogToggle()
    {
        $db = \Config\Database::connect();
        $current = $db->table('settings')->where('key', 'activity_logs_status')->get()->getRowArray();
        $newStatus = ($current['value'] ?? '1') == '1' ? '0' : '1';
        
        $db->table('settings')->where('key', 'activity_logs_status')->update(['value' => $newStatus]);
        
        $msg = $newStatus == '1' ? 'Activity logging enabled.' : 'Activity logging disabled.';
        return redirect()->back()->with('success', $msg);
    }

    // --- DATABASE BACKUPS ---
    public function backupList()
    {
        $backupDir = WRITEPATH . 'backups/';
        $files = glob($backupDir . '*.sql');
        $data['backups'] = [];
        foreach($files as $file) {
            $data['backups'][] = [
                'name' => basename($file),
                'size' => round(filesize($file) / 1024, 2) . ' KB',
                'date' => date('d M Y, h:i A', filemtime($file))
            ];
        }
        $data['title'] = 'Database Backups';
        return view('admin/backups/index', $data);
    }

    public function backupRun()
    {
        $db = \Config\Database::connect();
        $tables = $db->listTables();
        $output = "-- City News Database Backup\n-- Generated: " . date('Y-m-d H:i:s') . "\n\n";

        foreach ($tables as $table) {
            $output .= "DROP TABLE IF EXISTS `$table`;\n";
            $res = $db->query("SHOW CREATE TABLE `$table`")->getRowArray();
            $output .= $res['Create Table'] . ";\n\n";

            $rows = $db->table($table)->get()->getResultArray();
            foreach ($rows as $row) {
                $keys = array_keys($row);
                $values = array_map(function($v) use ($db) {
                    return $v === null ? 'NULL' : $db->escape($v);
                }, array_values($row));
                $output .= "INSERT INTO `$table` (`" . implode("`, `", $keys) . "`) VALUES (" . implode(", ", $values) . ");\n";
            }
            $output .= "\n\n";
        }

        $fileName = 'backup_' . date('Y-m-d_His') . '.sql';
        file_put_contents(WRITEPATH . 'backups/' . $fileName, $output);

        // Log the action
        $logModel = new \App\Models\ActivityModel();
        $logModel->log('DB_BACKUP', 'Generated backup file: ' . $fileName);

        return redirect()->to('admin/backups')->with('success', 'Backup generated successfully!');
    }

    public function backupDownload($fileName)
    {
        $file = WRITEPATH . 'backups/' . $fileName;
        if (file_exists($file)) {
            return $this->response->download($file, null)->setFileName($fileName);
        }
        return redirect()->to('admin/backups')->with('error', 'File not found.');
    }

    public function backupDelete($fileName)
    {
        $file = WRITEPATH . 'backups/' . $fileName;
        if (file_exists($file)) {
            unlink($file);
            return redirect()->to('admin/backups')->with('success', 'Backup deleted.');
        }
        return redirect()->to('admin/backups')->with('error', 'File not found.');
    }

    // --- SMTP CONFIGURATION ---
    public function smtpSettings()
    {
        $db = \Config\Database::connect();
        $data['smtp'] = $db->table('smtp_settings')->get()->getRowArray();
        $data['title'] = 'SMTP Mailer Setup';
        return view('admin/smtp/index', $data);
    }

    public function smtpUpdate()
    {
        $db = \Config\Database::connect();
        $db->table('smtp_settings')->update([
            'smtp_host'   => $this->request->getPost('smtp_host'),
            'smtp_port'   => $this->request->getPost('smtp_port'),
            'smtp_user'   => $this->request->getPost('smtp_user'),
            'smtp_pass'   => $this->request->getPost('smtp_pass'),
            'smtp_crypto' => $this->request->getPost('smtp_crypto'),
            'from_email'  => $this->request->getPost('from_email'),
            'from_name'   => $this->request->getPost('from_name'),
            'is_active'   => $this->request->getPost('is_active') ? 1 : 0
        ], ['id' => 1]);

        return redirect()->to('admin/smtp')->with('success', 'SMTP settings updated.');
    }

    public function smtpTest()
    {
        $recipient = $this->request->getPost('test_email');
        if (empty($recipient)) {
            return redirect()->to('admin/smtp')->with('error', 'Recipient email is required.');
        }

        $db = \Config\Database::connect();
        $smtp = $db->table('smtp_settings')->get()->getRowArray();

        $email = \Config\Services::email();

        $config = [
            'protocol'   => 'smtp',
            'SMTPHost'   => $smtp['smtp_host'],
            'SMTPUser'   => $smtp['smtp_user'],
            'SMTPPass'   => $smtp['smtp_pass'],
            'SMTPPort'   => (int)$smtp['smtp_port'],
            'SMTPCrypto' => $smtp['smtp_crypto'] != 'none' ? $smtp['smtp_crypto'] : '',
            'mailType'   => 'html',
            'charset'    => 'utf-8',
            'newline'    => "\r\n"
        ];

        $email->initialize($config);
        $email->setFrom($smtp['from_email'], $smtp['from_name']);
        $email->setTo($recipient);
        $email->setSubject('City News - SMTP Connection Test');
        $email->setMessage('<h3>Success!</h3><p>Your SMTP configuration is working perfectly on City News portal.</p>');

        if ($email->send()) {
            return redirect()->to('admin/smtp')->with('success', 'Test email sent successfully to ' . $recipient);
        } else {
            $error = $email->printDebugger(['headers']);
            return redirect()->to('admin/smtp')->with('error', 'Failed to send test email. Error: ' . strip_tags($error));
        }
    }

    // --- SMS API CONFIGURATION ---
    public function smsSettings()
    {
        $db = \Config\Database::connect();
        $data['sms'] = $db->table('sms_settings')->get()->getRowArray();
        $data['title'] = 'SMS Gateway Setup';
        return view('admin/sms/index', $data);
    }

    public function smsUpdate()
    {
        $db = \Config\Database::connect();
        $db->table('sms_settings')->update([
            'gateway_name' => $this->request->getPost('gateway_name'),
            'api_url'      => $this->request->getPost('api_url'),
            'api_key'      => $this->request->getPost('api_key'),
            'sender_id'    => $this->request->getPost('sender_id'),
            'entity_id'    => $this->request->getPost('entity_id'),
            'template_id'  => $this->request->getPost('template_id'),
            'is_active'    => $this->request->getPost('is_active') ? 1 : 0
        ], ['id' => 1]);

        return redirect()->to('admin/sms')->with('success', 'SMS settings updated.');
    }

    public function smsTest()
    {
        $mobile = $this->request->getPost('test_mobile');
        $message = $this->request->getPost('test_message');
        
        if (empty($mobile) || empty($message)) {
            return redirect()->to('admin/sms')->with('error', 'Mobile number and message are required.');
        }

        $db = \Config\Database::connect();
        $sms = $db->table('sms_settings')->get()->getRowArray();

        // Basic CURL implementation for Generic SMS API
        $url = $sms['api_url'];
        $params = [
            'apikey'    => $sms['api_key'],
            'sender'    => $sms['sender_id'],
            'mobile'    => $mobile,
            'message'   => $message,
            'entityid'  => $sms['entity_id'],
            'templateid' => $sms['template_id']
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);

        if ($err) {
            return redirect()->to('admin/sms')->with('error', 'CURL Error: ' . $err);
        } else {
            return redirect()->to('admin/sms')->with('success', 'Test request sent. Gateway Response: ' . $response);
        }
    }

    // --- WHATSAPP API CONFIGURATION ---
    public function whatsappSettings()
    {
        $db = \Config\Database::connect();
        $data['whatsapp'] = $db->table('whatsapp_settings')->get()->getRowArray();
        $data['title'] = 'WhatsApp Business Setup';
        return view('admin/whatsapp/index', $data);
    }

    public function whatsappUpdate()
    {
        $db = \Config\Database::connect();
        $db->table('whatsapp_settings')->update([
            'gateway_name'    => $this->request->getPost('gateway_name'),
            'api_url'         => $this->request->getPost('api_url'),
            'api_key'         => $this->request->getPost('api_key'),
            'phone_number_id' => $this->request->getPost('phone_number_id'),
            'waba_id'         => $this->request->getPost('waba_id'),
            'is_active'       => $this->request->getPost('is_active') ? 1 : 0
        ], ['id' => 1]);

        return redirect()->to('admin/whatsapp')->with('success', 'WhatsApp settings updated.');
    }

    public function whatsappTest()
    {
        $mobile = $this->request->getPost('test_mobile');
        $template = $this->request->getPost('test_template');
        
        if (empty($mobile) || empty($template)) {
            return redirect()->to('admin/whatsapp')->with('error', 'Mobile number and template name are required.');
        }

        $db = \Config\Database::connect();
        $wa = $db->table('whatsapp_settings')->get()->getRowArray();

        $url = $wa['api_url'] . $wa['phone_number_id'] . "/messages";
        
        $data = [
            "messaging_product" => "whatsapp",
            "to" => $mobile,
            "type" => "template",
            "template" => [
                "name" => $template,
                "language" => ["code" => "en_US"]
            ]
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $wa['api_key'],
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);

        if ($err) {
            return redirect()->to('admin/whatsapp')->with('error', 'CURL Error: ' . $err);
        } else {
            $res = json_decode($response, true);
            if (isset($res['error'])) {
                return redirect()->to('admin/whatsapp')->with('error', 'WhatsApp Error: ' . $res['error']['message']);
            }
            return redirect()->to('admin/whatsapp')->with('success', 'Test request sent. Interaction ID: ' . ($res['messages'][0]['id'] ?? 'N/A'));
        }
    }

    // --- TELEGRAM API CONFIGURATION ---
    public function telegramSettings()
    {
        $db = \Config\Database::connect();
        $data['telegram'] = $db->table('telegram_settings')->get()->getRowArray();
        $data['title'] = 'Telegram Bot Setup';
        return view('admin/telegram/index', $data);
    }

    public function telegramUpdate()
    {
        $db = \Config\Database::connect();
        $db->table('telegram_settings')->update([
            'bot_token'  => $this->request->getPost('bot_token'),
            'channel_id' => $this->request->getPost('channel_id'),
            'is_active'  => $this->request->getPost('is_active') ? 1 : 0
        ], ['id' => 1]);

        return redirect()->to('admin/telegram')->with('success', 'Telegram settings updated.');
    }

    public function telegramTest()
    {
        $message = $this->request->getPost('test_message');
        if (empty($message)) {
            return redirect()->to('admin/telegram')->with('error', 'Test message is required.');
        }

        $db = \Config\Database::connect();
        $tg = $db->table('telegram_settings')->get()->getRowArray();

        $apiToken = $tg['bot_token'];
        $chatId = $tg['channel_id'];

        $url = "https://api.telegram.org/bot$apiToken/sendMessage";
        $data = [
            'chat_id' => $chatId,
            'text'    => "🚀 *City News - Connection Test*\n\nYour Telegram Bot is working perfectly! All news broadcasts are ready to go live.",
            'parse_mode' => 'Markdown'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);

        if ($err) {
            return redirect()->to('admin/telegram')->with('error', 'CURL Error: ' . $err);
        } else {
            $res = json_decode($response, true);
            if (!$res['ok']) {
                return redirect()->to('admin/telegram')->with('error', 'Telegram Error: ' . ($res['description'] ?? 'Unknown error'));
            }
            return redirect()->to('admin/telegram')->with('success', 'Test message pushed successfully to ' . $chatId);
        }
    }

    // --- BROADCAST TEMPLATES ---
    public function templateList()
    {
        $db = \Config\Database::connect();
        $data['templates'] = $db->table('broadcast_templates')->get()->getResultArray();
        $data['title'] = 'Broadcast Templates';
        return view('admin/templates/index', $data);
    }

    public function templateEdit($id)
    {
        $db = \Config\Database::connect();
        $data['template'] = $db->table('broadcast_templates')->where('id', $id)->get()->getRowArray();
        $data['title'] = 'Edit Broadcast Template';
        return view('admin/templates/edit', $data);
    }

    public function templateUpdate($id)
    {
        $db = \Config\Database::connect();
        $db->table('broadcast_templates')->update([
            'subject' => $this->request->getPost('subject'),
            'content' => $this->request->getPost('content'),
            'is_active' => $this->request->getPost('is_active') ? 1 : 0
        ], ['id' => $id]);

        return redirect()->to('admin/templates')->with('success', 'Template updated successfully.');
    }

    // --- GLOBAL MODULE MANAGER ---
    public function moduleList()
    {
        $db = \Config\Database::connect();
        $data['modules'] = $db->table('global_modules')->get()->getResultArray();
        $data['title'] = 'Global Module Manager';
        return view('admin/modules/index', $data);
    }

    public function moduleToggle($id)
    {
        $db = \Config\Database::connect();
        $module = $db->table('global_modules')->where('id', $id)->get()->getRowArray();
        
        if ($module) {
            $newStatus = $module['is_enabled'] ? 0 : 1;
            $db->table('global_modules')->update(['is_enabled' => $newStatus], ['id' => $id]);
            
            // Log action
            $logModel = new \App\Models\ActivityModel();
            $logModel->log('MODULE_TOGGLE', 'Toggled module ' . $module['module_key'] . ' to ' . ($newStatus ? 'ON' : 'OFF'));
            
            return redirect()->to('admin/modules')->with('success', $module['module_name'] . ' status updated.');
        }

        return redirect()->to('admin/modules')->with('error', 'Module not found.');
    }

    // --- LIVE TV STREAMING ---
    public function liveSettings()
    {
        $db = \Config\Database::connect();
        $data['live'] = $db->table('live_streams')->get()->getRowArray();
        $data['title'] = 'Live TV Setup';
        return view('admin/live/index', $data);
    }

    public function liveUpdate()
    {
        $db = \Config\Database::connect();
        $db->table('live_streams')->update([
            'stream_title' => $this->request->getPost('stream_title'),
            'stream_url'   => $this->request->getPost('stream_url'),
            'provider'     => $this->request->getPost('provider'),
            'is_active'    => $this->request->getPost('is_active') ? 1 : 0
        ], ['id' => 1]);

        return redirect()->to('admin/live')->with('success', 'Live stream updated successfully.');
    }

    public function todo()
    {
        return view('admin/todo', ['title' => 'Feature Coming Soon']);
    }

    public function ckeditorUpload()
    {
        $file = $this->request->getFile('upload');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            if (!is_dir('public/uploads/editor')) {
                mkdir('public/uploads/editor', 0777, true);
            }
            $newName = $file->getRandomName();
            $file->move('public/uploads/editor', $newName);
            
            $url = base_url('uploads/editor/' . $newName);
            $funcNum = $this->request->getGet('CKEditorFuncNum');
            
            echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', 'Successfully uploaded');</script>";
        }
    }

    // ─── Admin Profile Management ──────────────────────────────────────────
    
    public function profile()
    {
        $userModel = new \App\Models\UserModel();
        $id = session()->get('userId');
        
        $data = [
            'user'  => $userModel->find($id),
            'title' => 'My Profile'
        ];
        
        return view('admin/profile', $data);
    }

    public function updateProfile()
    {
        $userModel = new \App\Models\UserModel();
        $id = session()->get('userId');

        $rules = [
            'full_name' => 'required|min_length[3]',
            'email'     => "required|valid_email|is_unique[users.email,id,{$id}]"
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'full_name' => $this->request->getPost('full_name'),
            'email'     => $this->request->getPost('email'),
        ];

        // Handle Avatar Upload
        $file = $this->request->getFile('avatar');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            if ($file->move(FCPATH . 'uploads/avatars', $newName)) {
                $data['avatar'] = $newName;
                session()->set('avatar', $newName);
            }
        }

        $userModel->update($id, $data);
        session()->set('fullName', $data['full_name']);

        return redirect()->to('admin/profile')->with('success', 'Profile updated successfully.');
    }
    public function updatePassword()
    {
        $userModel = new \App\Models\UserModel();
        $id = session()->get('userId');

        $rules = [
            'password'         => 'required|min_length[8]',
            'password_confirm' => 'required|matches[password]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userModel->update($id, [
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'password_updated_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('admin/profile')->with('success', 'Password updated successfully.');
    }

    /* ── Notifications ── */
    public function notificationList()
    {
        $model = new \App\Models\NotificationModel();
        $db = \Config\Database::connect();
        
        $data['title'] = 'Notification Management';
        $data['notifications'] = $db->table('notifications')
                                   ->select('notifications.*, users.full_name as user_name')
                                   ->join('users', 'users.id = notifications.user_id', 'left')
                                   ->orderBy('created_at', 'DESC')
                                   ->get()
                                   ->getResultArray();
                                   
        return view('admin/notifications/index', $data);
    }

    public function notificationCreate()
    {
        $userModel = new \App\Models\UserModel();
        $data['title'] = 'Create Notification';
        $data['users'] = $userModel->where('status', 'active')->findAll();
        return view('admin/notifications/create', $data);
    }

    public function notificationStore()
    {
        $model = new \App\Models\NotificationModel();
        $rules = [
            'title'   => 'required|min_length[3]|max_length[255]',
            'message' => 'required',
            'type'    => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userId = $this->request->getPost('user_id'); // 'all' or specific ID
        $data = [
            'title'   => $this->request->getPost('title'),
            'message' => $this->request->getPost('message'),
            'type'    => $this->request->getPost('type'),
        ];

        if ($userId === 'all') {
            $userModel = new \App\Models\UserModel();
            $users = $userModel->where('status', 'active')->findAll();
            foreach ($users as $user) {
                $data['user_id'] = $user['id'];
                $model->insert($data);
            }
        } else {
            $data['user_id'] = $userId;
            $model->insert($data);
        }

        return redirect()->to('admin/notifications')->with('success', 'Notification(s) sent successfully.');
    }

    public function notificationDelete($id)
    {
        $model = new \App\Models\NotificationModel();
        $model->delete($id);
        return redirect()->to('admin/notifications')->with('success', 'Notification deleted.');
    }

    private function _autoGenerateSEO($title, $content, $metaTitle, $metaDesc, $metaKeys = '')
    {
        $resTitle = !empty($metaTitle) ? $metaTitle : $title;
        $resDesc = !empty($metaDesc) ? $metaDesc : character_limiter(strip_tags($content), 160);
        
        if (empty($metaKeys)) {
            $cleanTitle = preg_replace('/[^\w\s]/u', '', $title);
            $words = explode(' ', $cleanTitle);
            $words = array_filter($words, function($w) { return mb_strlen($w) > 3; });
            $resKeys = implode(', ', array_slice($words, 0, 15));
        } else {
            $resKeys = $metaKeys;
        }

        return [$resTitle, $resDesc, $resKeys];
    }

}

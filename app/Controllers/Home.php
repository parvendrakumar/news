<?php

namespace App\Controllers;

use App\Models\NewsModel;
use App\Models\CategoryModel;
use App\Models\PageModel;
use App\Models\StoryModel;
use App\Models\VideoNewsModel;

class Home extends BaseController
{
    protected $newsModel;
    protected $categoryModel;
    protected $pageModel;
    protected $storyModel;
    protected $videoNewsModel;
    protected $bookmarkModel;

    public function __construct()
    {
        $this->newsModel = new NewsModel();
        $this->categoryModel = new CategoryModel();
        $this->pageModel = new PageModel();
        $this->storyModel = new StoryModel();
        $this->videoNewsModel = new \App\Models\VideoNewsModel();
        $this->bookmarkModel = new \App\Models\BookmarkModel();
        helper(['text', 'data']);
    }

    public function index()
    {
        $lang = service('language')->getLocale();
        $cache = service('cache');
        $cacheKey = "home_data_{$lang}";

        // Fetch fresh data (Caching temporarily disabled)
        // 1. Big News (Featured/Breaking)
        $bigNews = $this->newsModel->where('is_breaking', 1)->getLatestNews($lang, 5);
        $featured = $this->newsModel->getLatestNews($lang, 4);

        // 2. Specialized Sections
        $visualStories = [];
        if (config('App')->moduleStatus['visual_stories'] ?? 1) {
            $visualStories = $this->storyModel->getLatestStories($lang, 12);
        }
        $videoNews = $this->videoNewsModel->where('status', 'published')
                                          ->orderBy('created_at', 'DESC')
                                          ->findAll(4);
        
        // Map video news to fit the existing frontend news structure if necessary
        foreach ($videoNews as &$vn) {
            $vn['title'] = ($lang == 'hi') ? $vn['title_hi'] : $vn['title_en'];
            $vn['image'] = $vn['thumbnail']; 
            $vn['publish_at'] = $vn['created_at'];
            $vn['video_url'] = $vn['video_url'];
        }
        
        // 3. Category Sections
        $sections = [
            'bijnor-news'   => $this->newsModel->getLatestNews($lang, 4, null, 'bijnor-news'),
            'entertainment' => $this->newsModel->getLatestNews($lang, 4, null, 'entertainment'),
            'state'         => $this->newsModel->getLatestNews($lang, 4, null, 'state-news'),
            'crime'         => $this->newsModel->getLatestNews($lang, 4, null, 'crime'),
            'games'         => $this->newsModel->getLatestNews($lang, 4, null, 'games'),
            'lifestyle'     => $this->newsModel->getLatestNews($lang, 4, null, 'lifestyle'),
            'religion'      => $this->newsModel->getLatestNews($lang, 4, null, 'religion'),
            'tech'          => $this->newsModel->getLatestNews($lang, 4, null, 'tech'),
            'education'     => $this->newsModel->getLatestNews($lang, 4, null, 'education'),
            'business'      => $this->newsModel->getLatestNews($lang, 4, null, 'business'),
            'world'         => $this->newsModel->getLatestNews($lang, 4, null, 'world'),
            'science'       => $this->newsModel->getLatestNews($lang, 4, null, 'science'),
            'auto'          => $this->newsModel->getLatestNews($lang, 4, null, 'auto'),
        ];

        // 4. Trending Right Sidebar
        $trending = $this->newsModel->getTrendingNews($lang, 12); 
        
        // 6. All Latest (for "More Data" section)
        $allLatest = $this->newsModel->getLatestNews($lang, 16, null, null, null, 4); 

        // 5. Live TV Stream
        $db = \Config\Database::connect();
        $liveStream = null;
        $liveModule = $db->table('global_modules')->where('module_key', 'live_tv')->get()->getRowArray();
        if ($liveModule && $liveModule['is_enabled']) {
            $liveStream = $db->table('live_streams')->where('is_active', 1)->get()->getRowArray();
        }

        // 4. Active Poll Fetching
        $pollModel = new \App\Models\PollModel();
        $activePoll = $pollModel->where('is_active', 1)->orderBy('created_at', 'DESC')->first();
        if ($activePoll) {
            $activePoll = $pollModel->getFullPoll($activePoll['id']);
            $activePoll['hasVoted'] = session()->get("voted_poll_{$activePoll['id']}") ? true : false;
        }

        $data = [
            'title'         => 'Home',
            'bigNews'       => $bigNews,
            'latest'        => $featured,
            'visualStories' => $visualStories,
            'videoNews'     => $videoNews,
            'sections'      => $sections,
            'trending'      => $trending,
            'allLatest'     => $allLatest,
            'liveStream'    => $liveStream,
            'activePoll'    => $activePoll
        ];

        return view('frontend/home', $data);
    }

    public function category($slug)
    {
        $lang = service('language')->getLocale();
        $category = $this->categoryModel->select('categories.*, category_translations.title')
                                        ->join('category_translations', 'category_translations.category_id = categories.id')
                                        ->where('slug', $slug)
                                        ->where('category_translations.language', $lang)
                                        ->first();

        if (!$category) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title'     => 'Category: ' . ($category['title'] ?? $slug),
            'category'  => $category,
            'news'      => $this->newsModel->getPaginatedNews($lang, 12, $category['id']),
            'pager'     => $this->newsModel->pager,
            'trending'  => $this->newsModel->getTrendingNews($lang, 5),
        ];

        return view('frontend/category', $data);
    }

    public function categories()
    {
        $lang = service('language')->getLocale();
        $categories = $this->categoryModel->select('categories.*, category_translations.title')
                                         ->join('category_translations', 'category_translations.category_id = categories.id')
                                         ->where('category_translations.language', $lang)
                                         ->where('categories.status', 'active')
                                         ->findAll();

        $data = [
            'title'      => 'Categories',
            'categories' => $categories,
            'trending'   => $this->newsModel->getTrendingNews($lang, 5),
        ];

        return view('frontend/category_list', $data);
    }

    public function newsDetail($slug)
    {
        $slug = trim($slug);
        $lang = service('language')->getLocale();
        $lang = substr($lang, 0, 2); 

        $news = $this->newsModel->select('news.*, news_translations.*, categories.slug as category_slug, COALESCE((SELECT SUM(view_count) FROM news_views WHERE news_id = news.id), 0) as view_count')
                                ->join('news_translations', 'news_translations.news_id = news.id')
                                ->join('categories', 'categories.id = news.category_id')
                                ->where('news.slug', $slug)
                                ->where('news_translations.language', $lang)
                                ->first();

        if (!$news) {
            // Keep legacy fallback for a short period or until links are updated
            if ($this->videoNewsModel->where('slug', $slug)->first()) return $this->videoDetail($slug);
            if ($this->storyModel->where('slug', $slug)->first()) return $this->storyDetail($slug);
            
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $this->trackView($news['id']);
        $commentModel = new \App\Models\CommentModel();
        $comments = $commentModel->where('news_id', $news['id'])
                                 ->where('status', 'approved')
                                 ->orderBy('created_at', 'DESC')
                                 ->findAll();

        $isBookmarked = false;
        if (session()->get('isLoggedIn')) {
            $isBookmarked = $this->bookmarkModel->where(['user_id' => session()->get('userId'), 'news_id' => $news['id']])->first() ? true : false;
        }

        // Active Poll Fetching
        $pollModel = new \App\Models\PollModel();
        $activePoll = $pollModel->where('is_active', 1)->orderBy('created_at', 'DESC')->first();
        if ($activePoll) {
            $activePoll = $pollModel->getFullPoll($activePoll['id']);
            $activePoll['hasVoted'] = session()->get("voted_poll_{$activePoll['id']}") ? true : false;
        }

        $data = [
            'title'        => $news['title'],
            'news'         => $news,
            'comments'     => $comments,
            'isBookmarked' => $isBookmarked,
            'trending'     => $this->newsModel->getTrendingNews($lang, 5),
            'related'      => $this->newsModel->getLatestNews($lang, 4, $news['category_id'], null, $news['id']),
            'activePoll'   => $activePoll
        ];

        return view('frontend/detail', $data);
    }

    public function videoDetail($slug)
    {
        $slug = trim($slug);
        $lang = substr(service('language')->getLocale(), 0, 2);
        
        $video = $this->videoNewsModel->groupStart()
                                        ->where('slug', $slug)
                                        ->orWhere('LOWER(slug)', strtolower($slug))
                                      ->groupEnd()
                                      ->where('status', 'published')
                                      ->first();
        
        if (!$video) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

        $news = [
            'id'            => $video['id'],
            'title'         => ($lang == 'hi') ? $video['title_hi'] : $video['title_en'],
            'description'   => ($lang == 'hi') ? $video['description_hi'] : $video['description_en'],
            'image'         => $video['thumbnail'],
            'publish_at'    => $video['created_at'],
            'category_slug' => 'video-news',
            'view_count'    => $video['views'] ?? 0,
            'custom_author' => $video['author_name'],
            'is_video_news' => 1,
            'video_url'     => $video['video_url'],
            'is_dedicated_video' => true,
            'category_id'        => null
        ];

        $data = [
            'title'        => $news['title'],
            'news'         => $news,
            'comments'     => [], // No comments for videos yet or fetch if needed
            'isBookmarked' => false,
            'trending'     => $this->newsModel->getTrendingNews($lang, 5),
            'related'      => $this->newsModel->getLatestNews($lang, 4)
        ];

        return view('frontend/detail', $data);
    }

    public function storyDetail($slug)
    {
        $slug = trim($slug);
        $lang = substr(service('language')->getLocale(), 0, 2);

        $story = $this->storyModel->groupStart()
                                    ->where('slug', $slug)
                                    ->orWhere('LOWER(slug)', strtolower($slug))
                                  ->groupEnd()
                                  ->where('status', 'published')
                                  ->first();
        
        if (!$story) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

        $story['title'] = ($lang == 'hi') ? $story['title_hi'] : $story['title_en'];
        $story['content'] = ($lang == 'hi') ? $story['content_hi'] : $story['content_en'];
        $story['description'] = ($lang == 'hi') ? ($story['description_hi'] ?? '') : ($story['description_en'] ?? '');
        
        $this->storyModel->incrementViews($story['id']);

        $isBookmarked = false;
        if (session()->get('isLoggedIn')) {
            $isBookmarked = $this->bookmarkModel->where(['user_id' => session()->get('userId'), 'story_id' => $story['id']])->first() ? true : false;
        }

        $data = [
            'title'        => $story['title'],
            'story'        => $story,
            'comments'     => [], // Visual stories don't use standard comments yet
            'isBookmarked' => $isBookmarked,
            'trending'     => $this->newsModel->getTrendingNews($lang, 5),
            'relatedStories' => $this->storyModel->where('id !=', $story['id'])->where('status', 'published')->orderBy('created_at', 'DESC')->findAll(4)
        ];
        
        return view('frontend/story_detail', $data);
    }

    public function postComment()
    {
        // Simple Spam Protection (Honeypot)
        if (!empty($this->request->getPost('website'))) {
            return redirect()->back()->with('error', 'Spam detected.');
        }

        $commentModel = new \App\Models\CommentModel();
        
        $commentData = [
            'news_id' => $this->request->getPost('news_id'),
            'name'    => $this->request->getPost('name'),
            'email'   => $this->request->getPost('email'),
            'comment' => $this->request->getPost('comment'),
            'status'  => 'pending' // Admin must approve
        ];

        $commentModel->insert($commentData);
        return redirect()->back()->with('success', 'Thank you! Your comment is awaiting approval.');
    }

    public function staticPage($slug)
    {
        $lang = service('language')->getLocale();
        $page = $this->pageModel->getPage($slug, $lang);

        if (!$page) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => $page['title'],
            'page'  => $page
        ];

        return view('frontend/page', $data);
    }

    private function trackView($newsId)
    {
        // For 200k users, we should use Redis or a optimized table.
        // Direct update is slow. Here we just log to a table as a fallback.
        $db = \Config\Database::connect();
        $date = date('Y-m-d');
        $db->query("INSERT INTO news_views (news_id, view_date, view_count) 
                   VALUES ($newsId, '$date', 1) 
                   ON DUPLICATE KEY UPDATE view_count = view_count + 1");
    }

    public function contact()
    {
        $num1 = rand(1, 10);
        $num2 = rand(2, 9);
        $this->session->set('captcha_result', $num1 + $num2);

        return view('frontend/contact', [
            'title' => 'Contact Us',
            'captcha_question' => "$num1 + $num2",
        ]);
    }

    public function submitContact()
    {
        // 1. Honeypot Bot-Trap
        if (!empty($this->request->getPost('website_verify'))) {
            return redirect()->to(base_url('contact'))->with('error', 'Spam detected. Access denied.');
        }

        // 2. Mathematical CAPTCHA Verification
        $captchaInput = $this->request->getPost('captcha');
        $captchaResult = $this->session->get('captcha_result');

        if ($captchaInput === null || (int)$captchaInput !== (int)$captchaResult) {
            return redirect()->to(base_url('contact'))->with('error', '🚨 Incorrect CAPTCHA answer. Please prove you are human.')->withInput();
        }

        // 3. Rate Limiting (Throttler)
        $throttler = \Config\Services::throttler();
        if ($throttler->check(md5($this->request->getIPAddress()), 3, 60) === false) {
            return redirect()->to(base_url('contact'))->with('error', 'Too many requests. Please try again after a minute.');
        }

        $rules = [
            'name'    => ['label' => 'Full Name',  'rules' => 'required|min_length[2]|max_length[120]|trim'],
            'email'   => ['label' => 'Email',       'rules' => 'required|valid_email|max_length[180]|trim'],
            'subject' => ['label' => 'Subject',     'rules' => 'required|min_length[3]|max_length[200]|trim'],
            'message' => ['label' => 'Message',     'rules' => 'required|min_length[10]|trim'],
            'phone'   => ['label' => 'Phone',       'rules' => 'permit_empty|max_length[30]|trim'],
        ];

        if (! $this->validate($rules)) {
            session()->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->to(base_url('contact'))->withInput();
        }

        $db = \Config\Database::connect();
        $db->table('contact_messages')->insert([
            'name'       => $this->request->getPost('name'),
            'email'      => $this->request->getPost('email'),
            'phone'      => $this->request->getPost('phone'),
            'subject'    => $this->request->getPost('subject'),
            'message'    => $this->request->getPost('message'),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        // --- SMTP NOTIFICATION TO ADMIN ---
        $smtp = $db->table('smtp_settings')->get()->getRowArray();
        if ($smtp && $smtp['is_active']) {
            $emailService = \Config\Services::email();
            $emailService->initialize([
                'protocol'   => 'smtp',
                'SMTPHost'   => $smtp['smtp_host'],
                'SMTPUser'   => $smtp['smtp_user'],
                'SMTPPass'   => $smtp['smtp_pass'],
                'SMTPPort'   => (int)$smtp['smtp_port'],
                'SMTPCrypto' => $smtp['smtp_crypto'] != 'none' ? $smtp['smtp_crypto'] : '',
                'mailType'   => 'html',
                'charset'    => 'utf-8',
                'newline'    => "\r\n"
            ]);

            $adminEmail = $smtp['from_email']; // Or fetch from global settings
            $emailService->setFrom($smtp['from_email'], 'City News Contact System');
            $emailService->setTo($adminEmail);
            $emailService->setSubject('New Inquiry: ' . $this->request->getPost('subject'));
            
            $msgBody = "<h3>New Message from City News Portal</h3>"
                     . "<p><strong>Name:</strong> " . esc($this->request->getPost('name')) . "</p>"
                     . "<p><strong>Email:</strong> " . esc($this->request->getPost('email')) . "</p>"
                     . "<p><strong>Phone:</strong> " . esc($this->request->getPost('phone')) . "</p>"
                     . "<p><strong>Subject:</strong> " . esc($this->request->getPost('subject')) . "</p>"
                     . "<p><strong>Message:</strong><br>" . nl2br(esc($this->request->getPost('message'))) . "</p>";
            
            $emailService->setMessage($msgBody);
            $emailService->send();
        }

        session()->setFlashdata('success', '✅ Thank you! Your message has been sent. We will get back to you soon.');
        return redirect()->to(base_url('contact'));
    }

    public function setLanguage($lang)
    {
        if (in_array($lang, ['en', 'hi'])) {
            $this->session->set('lang', $lang);
        }
        return redirect()->back();
    }

    public function sitemap()
    {
        $news = $this->newsModel->where('status', 'published')->orderBy('updated_at', 'DESC')->findAll(100);
        $categories = $this->categoryModel->findAll();
        
        $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        $xml .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
        
        $xml .= "  <url><loc>" . base_url() . "</loc><priority>1.0</priority></url>\n";
        
        foreach ($categories as $cat) {
            $xml .= "  <url><loc>" . base_url('category/' . $cat['slug']) . "</loc><priority>0.8</priority></url>\n";
        }
        
        foreach ($news as $n) {
            $xml .= "  <url><loc>" . base_url('news/' . $n['slug']) . "</loc><lastmod>" . date('Y-m-d', strtotime($n['updated_at'])) . "</lastmod><priority>0.7</priority></url>\n";
        }
        
        $xml .= "</urlset>";
        return $this->response->setXML($xml);
    }

    public function robots()
    {
        $robots = "User-agent: *\n";
        $robots .= "Allow: /\n";
        $robots .= "Sitemap: " . base_url('sitemap.xml') . "\n";
        return $this->response->setBody($robots)->setContentType('text/plain');
    }

    public function ajaxLatestNews()
    {
        $lang = $this->session->get('lang') ?: 'hi';
        $news = $this->newsModel->getLatestNews($lang, 5);
        return $this->response->setJSON($news);
    }

    public function ajaxTrackView()
    {
        $newsId = $this->request->getPost('news_id');
        if ($newsId) {
            $this->trackView($newsId);
            return $this->response->setJSON(['status' => 'success']);
        }
        return $this->response->setJSON(['status' => 'error'], 400);
    }

    public function pushSubscribe()
    {
        $token = $this->request->getPost('token');
        // Log to DB for real implementation
        return $this->response->setJSON(['status' => 'success', 'message' => 'Subscribed to notifications']);
    }

    public function search()
    {
        $lang = service('language')->getLocale();
        $query = $this->request->getGet('q');

        // 1. Rate Limiting (Throttler) - 10 searches per minute per IP
        $throttler = \Config\Services::throttler();
        if ($throttler->check(md5($this->request->getIPAddress() . '_search'), 10, 60) === false) {
             return redirect()->to(base_url())->with('error', 'Search frequency exceeded. Please wait a moment.');
        }

        // 2. Input Validation (Sanitize & Constraints)
        $query = trim(strip_tags($query ?? ''));
        if (strlen($query) < 3 && !empty($query)) {
             return redirect()->back()->with('error', 'Search query must be at least 3 characters long.');
        }

        $results = [];
        if (!empty($query)) {
            $results = $this->newsModel->select('news.*, news_translations.title, news_translations.description, categories.slug as category_slug')
                                        ->join('news_translations', 'news_translations.news_id = news.id')
                                        ->join('categories', 'categories.id = news.category_id')
                                        ->where('news_translations.language', $lang)
                                        ->where('news.status', 'published')
                                        ->groupStart()
                                            ->like('news_translations.title', $query)
                                            ->orLike('news_translations.description', $query)
                                        ->groupEnd()
                                        ->orderBy('news.publish_at', 'DESC')
                                        ->paginate(12);
        }
        
        // Fetch user bookmarks if logged in
        $userBookmarks = [];
        if (session()->get('isLoggedIn')) {
            $userBookmarks = $this->bookmarkModel->where('user_id', session()->get('userId'))->findAll();
        }
        $newsIds = array_column($userBookmarks, 'news_id');
        $storyIds = array_column($userBookmarks, 'story_id');

        $data = [
            'title'     => 'Search Results: ' . esc($query),
            'query'     => $query,
            'news'      => $results,
            'pager'     => $this->newsModel->pager,
            'bookmarkedNews' => $newsIds,
            'bookmarkedStories' => $storyIds
        ];

        return view('frontend/search', $data);
    }

    public function videoNews()
    {
        $lang = service('language')->getLocale();
        $videos = $this->videoNewsModel->where('status', 'published')
                                      ->orderBy('created_at', 'DESC')
                                      ->paginate(12);

        // Standardize for view
        foreach ($videos as &$vn) {
            $vn['title'] = ($lang == 'hi') ? $vn['title_hi'] : $vn['title_en'];
            $vn['image'] = $vn['thumbnail'];
            $vn['publish_at'] = $vn['created_at'];
            $vn['category_slug'] = 'video-news';
        }

        $data = [
            'title'     => 'Video News',
            'query'     => 'Video News',
            'news'      => $videos,
            'pager'     => $this->videoNewsModel->pager,
        ];

        return view('frontend/search', $data);
    }

    public function visualStories()
    {
        $lang = service('language')->getLocale();
        $stories = $this->storyModel->where('status', 'published')
                                    ->orderBy('created_at', 'DESC')
                                    ->paginate(12);

        // Standardize output for the listing view
        foreach ($stories as &$story) {
            $story['title'] = ($lang == 'hi') ? $story['title_hi'] : $story['title_en'];
            $story['description'] = ($lang == 'hi') ? ($story['description_hi'] ?? '') : ($story['description_en'] ?? '');
            $story['image'] = $story['image']; // Already direct path in StoryModel
            $story['category_slug'] = 'visual-stories';
            $story['publish_at'] = $story['created_at'];
            // Since the search view expects 'news' variable name for results
        }

        // Fetch user bookmarks if logged in
        $userBookmarks = [];
        if (session()->get('isLoggedIn')) {
            $userBookmarks = $this->bookmarkModel->where('user_id', session()->get('userId'))->findAll();
        }
        $newsIds = array_column($userBookmarks, 'news_id');
        $storyIds = array_column($userBookmarks, 'story_id');

        $data = [
            'title'     => 'Visual Stories',
            'query'     => 'Visual Stories',
            'news'      => $stories,
            'pager'     => $this->storyModel->pager,
            'trending'  => $this->newsModel->getTrendingNews($lang, 5),
            'is_story_list' => true,
            'bookmarkedNews' => $newsIds,
            'bookmarkedStories' => $storyIds
        ];

        return view('frontend/search', $data);
    }

    /**
     * Resolve flat slug to News, Category, or Page
     */
    public function resolveSlug($slug)
    {
        // 1. Check News
        $news = $this->newsModel->where('slug', $slug)->where('status', 'published')->first();
        if ($news) {
            return $this->newsDetail($slug);
        }

        // 2. Check Category
        $category = $this->categoryModel->where('slug', $slug)->first();
        if ($category) {
            return $this->category($slug);
        }

        // 3. Check Static Page
        $page = $this->pageModel->where('slug', $slug)->first();
        if ($page) {
            return $this->staticPage($slug);
        }

        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    public function subscribe()
    {
        $email = $this->request->getPost('email');
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()->with('error', 'Please provide a valid email address.');
        }

        $db = \Config\Database::connect();
        $existing = $db->table('subscribers')->where('email', $email)->get()->getRow();
        
        if ($existing) {
            return redirect()->back()->with('error', 'You are already subscribed to our newsletter!');
        }

        $db->table('subscribers')->insert([
            'email'      => $email,
            'status'     => 'active',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->back()->with('success', '✅ Thank you! You have successfully joined our newsletter.');
    }

    public function error404()
    {
        $this->response->setStatusCode(404);
        return view('frontend/error_404', [
            'title' => 'Page Not Found',
            'query' => ''
        ]);
    }
    
    public function submitVote()
    {
        if (!$this->request->isAJAX()) return $this->response->setJSON(['status' => 'error', 'msg' => 'Invalid request']);

        $pollId = $this->request->getPost('poll_id');
        $optionId = $this->request->getPost('option_id');

        if (session()->get("voted_poll_{$pollId}")) {
            return $this->response->setJSON(['status' => 'error', 'msg' => 'You have already voted on this poll.']);
        }

        $db = \Config\Database::connect();
        
        // Sanity Check
        $option = $db->table('poll_options')->where(['id' => $optionId, 'poll_id' => $pollId])->get()->getRowArray();
        if (!$option) return $this->response->setJSON(['status' => 'error', 'msg' => 'Invalid option selected.']);

        // Increment Vote
        $db->table('poll_options')->where('id', $optionId)->increment('votes');

        // Mark as voted in session
        session()->set("voted_poll_{$pollId}", true);

        // Get updated results
        $options = $db->table('poll_options')->where('poll_id', $pollId)->get()->getResultArray();
        $totalVotes = array_sum(array_column($options, 'votes'));

        foreach($options as &$opt) {
            $opt['percent'] = ($totalVotes > 0) ? round(($opt['votes'] / $totalVotes) * 100, 1) : 0;
        }

        return $this->response->setJSON([
            'status'  => 'success',
            'msg'     => 'Thank you for your vote!',
            'results' => $options
        ]);
    }
}

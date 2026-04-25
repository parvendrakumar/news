<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class User extends BaseController
{
    protected $session;
    protected $userModel;
    protected $categoryModel;
    protected $interestModel;
    protected $bookmarkModel;
    protected $notificationModel;

    public function __construct()
    {
        $this->session = session();
        $this->userModel = new \App\Models\UserModel();
        $this->categoryModel = new \App\Models\CategoryModel();
        $this->interestModel = new \App\Models\UserInterestModel();
        $this->bookmarkModel = new \App\Models\BookmarkModel();
        $this->notificationModel = new \App\Models\NotificationModel();

        // Check if user is logged in
        if (!$this->session->get('isLoggedIn')) {
            // Redirect to login if not logged in
            header('Location: ' . base_url('login'));
            exit;
        }

        // Check if user has USER role (role_id 3 or just not 1/2)
        if ($this->session->get('roleId') == 1) {
            // Admin should be in admin panel
            header('Location: ' . base_url('admin/dashboard'));
            exit;
        }
    }

    public function dashboard()
    {
        $userId = $this->session->get('userId');
        $user = $this->userModel->find($userId);
        
        if (!$user) {
            return redirect()->to('logout');
        }

        $data['title'] = 'User Dashboard';
        $data['user'] = $user;
        
        // Fetch personalized news
        $myInterests = $this->interestModel->where('user_id', $userId)->findAll();
        $selectedIds = array_column($myInterests, 'category_id');
        
        $newsModel = new \App\Models\NewsModel();
        if (!empty($selectedIds)) {
            $data['recommendedNews'] = $newsModel->select('news.*, news_translations.title')
                                                ->join('news_translations', 'news_translations.news_id = news.id')
                                                ->whereIn('news.category_id', $selectedIds)
                                                ->where('news.status', 'published')
                                                ->where('news_translations.language', 'en') // Assuming English for panel
                                                ->orderBy('news.created_at', 'DESC')
                                                ->limit(6)
                                                ->findAll();
        } else {
            $data['recommendedNews'] = [];
        }
        
        // Get Dashboard Stats
        $data['savedStoriesCount'] = $this->bookmarkModel->where('user_id', $userId)->countAllResults();
        
        // Count news published today
        $data['newTodayCount'] = $newsModel->where('publish_at >=', date('Y-m-d 00:00:00'))
                                           ->where('status', 'published')
                                           ->countAllResults();
        
        // Get discussion count by email since user_id is not in comments table
        $commentModel = new \App\Models\CommentModel();
        $data['discussionsCount'] = $commentModel->where('email', $user['email'])->countAllResults();

        return view('user/dashboard', $data);
    }

    public function profile()
    {
        return redirect()->to('user/settings');
    }

    public function updateProfile()
    {
        $id = $this->session->get('userId');
        $rules = [
            'full_name' => 'required|min_length[3]',
            'email'     => "required|valid_email|is_unique[users.email,id,{$id}]"
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'full_name' => $this->request->getPost('full_name'),
            'email'    => $this->request->getPost('email'),
        ];

        // Handle Avatar Upload
        $file = $this->request->getFile('avatar');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            if ($file->move(FCPATH . 'uploads/avatars', $newName)) {
                $data['avatar'] = $newName;
                // Update session
                $this->session->set('avatar', $newName);
            }
        }

        $this->userModel->update($id, $data);
        
        // Update session name too
        $this->session->set('fullName', $data['full_name']);

        return redirect()->to('user/settings')->with('success', 'Profile updated successfully.');
    }

    public function bookmarks()
    {
        $userId = $this->session->get('userId');
        $user = $this->userModel->find($userId);

        if (!$user) {
            return redirect()->to('logout');
        }

        $data['title'] = 'My Bookmarks';
        $data['user'] = $user;
        
        // Fetch bookmarked news with titles
        $data['savedNews'] = $this->bookmarkModel->select('news.*, news_translations.title')
                                                ->join('news', 'news.id = bookmarks.news_id')
                                                ->join('news_translations', 'news_translations.news_id = news.id')
                                                ->where('bookmarks.user_id', $userId)
                                                ->where('news_translations.language', 'en') // Assuming English for panel
                                                ->orderBy('bookmarks.created_at', 'DESC')
                                                ->findAll();

        $storyModel = new \App\Models\StoryModel();
        // Fetch bookmarked visual stories
        $data['savedStories'] = $this->bookmarkModel->select('visual_stories.*')
                                                   ->join('visual_stories', 'visual_stories.id = bookmarks.story_id')
                                                   ->where('bookmarks.user_id', $userId)
                                                   ->orderBy('bookmarks.created_at', 'DESC')
                                                   ->findAll();

        return view('user/bookmarks', $data);
    }

    public function toggleBookmark()
    {
        $userId = $this->session->get('userId');
        $newsId = $this->request->getPost('news_id');
        $storyId = $this->request->getPost('story_id');

        if (!$userId || (!$newsId && !$storyId)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid data']);
        }

        $where = ['user_id' => $userId];
        if ($newsId) {
            $where['news_id'] = $newsId;
        } else {
            $where['story_id'] = $storyId;
        }

        $existing = $this->bookmarkModel->where($where)->first();

        if ($existing) {
            $this->bookmarkModel->delete($existing['id']);
            return $this->response->setJSON(['status' => 'success', 'action' => 'removed']);
        } else {
            $data = ['user_id' => $userId];
            if ($newsId) $data['news_id'] = $newsId;
            if ($storyId) $data['story_id'] = $storyId;
            
            $this->bookmarkModel->insert($data);
            return $this->response->setJSON(['status' => 'success', 'action' => 'added']);
        }
    }

    public function notifications()
    {
        $userId = $this->session->get('userId');
        $user = $this->userModel->find($userId);

        if (!$user) {
            return redirect()->to('logout');
        }

        // Add a welcome notification if they have zero notifications total
        $total = $this->notificationModel->where('user_id', $userId)->countAllResults();
        if ($total == 0) {
            $this->notificationModel->insert([
                'user_id' => $userId,
                'title' => 'Welcome to City News!',
                'message' => 'Thank you for joining our community. We will notify you here about important updates.',
                'type' => 'success'
            ]);
        }

        $data['title'] = 'Notifications';
        $data['user'] = $user;
        $data['notifications'] = $this->notificationModel->where('user_id', $userId)
                                                       ->orderBy('created_at', 'DESC')
                                                       ->findAll();
        
        // Mark all as read
        $this->notificationModel->where('user_id', $userId)->set(['is_read' => 1])->update();

        return view('user/notifications', $data);
    }

    public function settings()
    {
        $userId = $this->session->get('userId');
        $user = $this->userModel->find($userId);

        if (!$user) {
            return redirect()->to('logout');
        }

        $data['title'] = 'Account Settings';
        $data['user'] = $user;
        return view('user/settings', $data);
    }

    public function interests()
    {
        $userId = $this->session->get('userId');
        $user = $this->userModel->find($userId);

        if (!$user) return redirect()->to('logout');

        $data['title'] = 'My Interests';
        $data['user'] = $user;
        $data['categories'] = $this->categoryModel->getCategories('en'); // Fetch categories
        
        $myInterests = $this->interestModel->where('user_id', $userId)->findAll();
        $data['selectedIds'] = array_column($myInterests, 'category_id');

        return view('user/interests', $data);
    }

    public function saveInterests()
    {
        $userId = $this->session->get('userId');
        $selected = $this->request->getPost('categories'); // Array of IDs

        // Clear existing
        $this->interestModel->where('user_id', $userId)->delete();

        if (!empty($selected)) {
            foreach ($selected as $catId) {
                $this->interestModel->insert([
                    'user_id' => $userId,
                    'category_id' => $catId
                ]);
            }
        }

        return redirect()->to('user/interests')->with('success', 'Interests updated successfully!');
    }

    public function updatePassword()
    {
        $id = $this->session->get('userId');
        $rules = [
            'password'         => 'required|min_length[8]',
            'password_confirm' => 'required|matches[password]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->userModel->update($id, [
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'password_updated_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('user/settings')->with('success', 'Security settings updated successfully.');
    }
}

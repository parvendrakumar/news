<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->set404Override('App\Controllers\Home::error404');
$routes->get('lang/(:segment)', 'Home::setLanguage/$1');
$routes->get('categories', 'Home::categories');
$routes->get('category/(:segment)', 'Home::category/$1');
$routes->get('news/(:segment)', 'Home::newsDetail/$1');
$routes->get('video/(:segment)', 'Home::videoDetail/$1');
$routes->get('story/(:segment)', 'Home::storyDetail/$1');
$routes->get('page/(:segment)', 'Home::staticPage/$1');
$routes->post('comment/post', 'Home::postComment');
$routes->get('contact', 'Home::contact');
$routes->post('contact/submit', 'Home::submitContact');
$routes->get('search', 'Home::search');
$routes->get('video-news', 'Home::videoNews');
$routes->get('visual-stories', 'Home::visualStories');
$routes->get('about', 'Home::staticPage/about-us');

// SEO / Utilities
$routes->get('sitemap.xml', 'Home::sitemap');
$routes->get('sitemap-news.xml', 'Home::sitemapNews');
$routes->get('robots.txt', 'Home::robots');

// AJAX Endpoints
$routes->get('ajax/latest-news', 'Home::ajaxLatestNews');
$routes->post('ajax/track-view', 'Home::ajaxTrackView');
$routes->post('ajax/submit-vote', 'Home::submitVote');

// Push Notifications
$routes->post('push/subscribe', 'Home::pushSubscribe');

// Newsletter Subscription (Public)
$routes->post('newsletter/subscribe', 'Home::subscribe');
$routes->get('newsletter/subscribe', function() { return redirect()->to(base_url()); });

// Auth Routes
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::attemptLogin');
$routes->get('auth/verify-otp', 'Auth::verifyOtp');
$routes->get('auth/resend-otp', 'Auth::resendOtp');
$routes->post('auth/attempt-verify-otp', 'Auth::attemptVerifyOtp');
$routes->get('auth/login-otp', 'Auth::loginOtp');
$routes->post('auth/send-login-otp', 'Auth::sendLoginOtp');
$routes->get('auth/forgot-password', 'Auth::forgotPassword');
$routes->post('auth/send-reset-link', 'Auth::sendResetLink');
$routes->get('auth/reset-password/(:any)', 'Auth::resetPassword/$1');
$routes->post('auth/attempt-reset-password', 'Auth::attemptResetPassword');
$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::attemptRegister');
$routes->get('logout', 'Auth::logout');

// User Routes (Protected)
$routes->group('user', ['filter' => 'auth'], function($routes) {
    $routes->get('dashboard', 'User::dashboard');
    $routes->get('profile', 'User::profile');
    $routes->post('profile/update', 'User::updateProfile');
    $routes->get('bookmarks', 'User::bookmarks');
    $routes->get('notifications', 'User::notifications');
    $routes->get('settings', 'User::settings');
    $routes->get('interests', 'User::interests');
    $routes->post('interests/save', 'User::saveInterests');
    $routes->post('bookmark/toggle', 'User::toggleBookmark');
    $routes->post('settings/password', 'User::updatePassword');
});

// Admin Routes (Protected)
$routes->group('admin', ['filter' => 'adminAuth'], function($routes) {
    $routes->get('dashboard', 'Admin::dashboard');
    $routes->get('profile', 'Admin::profile');
    $routes->post('profile/update', 'Admin::updateProfile');
    $routes->post('profile/password', 'Admin::updatePassword');
    $routes->get('media', 'Media::index');
    $routes->post('media/upload', 'Media::upload');
    $routes->post('media/import-csv', 'Media::importCsv');
    $routes->get('media/format', 'Media::downloadFormat');
    $routes->get('calendar', 'Admin::calendar');
    $routes->get('news', 'Admin::newsList');
    $routes->get('news/create', 'Admin::newsCreate');
    $routes->post('news/store', 'Admin::newsStore');
    $routes->get('news/edit/(:num)', 'Admin::newsEdit/$1');
    $routes->post('news/update/(:num)', 'Admin::newsUpdate/$1');
    $routes->get('news/delete/(:num)', 'Admin::newsDelete/$1');
    $routes->post('news/bulk-delete', 'Admin::newsBulkDelete');
    $routes->get('news/toggle-status/(:num)', 'Admin::newsToggleStatus/$1');
    $routes->get('news/bulk-upload', 'Admin::newsBulkUpload');
    $routes->post('news/bulk-store', 'Admin::newsBulkStore');
    $routes->get('news/bulk-format', 'Admin::newsBulkFormat');
    $routes->post('news/upload', 'Admin::ckeditorUpload');

    $routes->get('categories', 'Admin::categoryList');
    $routes->get('categories/create', 'Admin::categoryCreate');
    $routes->post('categories/store', 'Admin::categoryStore');
    $routes->get('categories/delete/(:num)', 'Admin::categoryDelete/$1');
    $routes->get('categories/edit/(:num)', 'Admin::categoryEdit/$1');
    $routes->post('categories/update/(:num)', 'Admin::categoryUpdate/$1');
    $routes->get('categories/bulk-upload', 'Admin::categoryBulkUpload');
    $routes->post('categories/bulk-store', 'Admin::categoryBulkStore');
    $routes->get('categories/bulk-format', 'Admin::categoryBulkFormat');
    $routes->get('categories/toggle-status/(:num)', 'Admin::categoryToggleStatus/$1');

    $routes->get('users', 'Admin::userList');
    $routes->get('users/invite', 'Admin::userInvite');
    $routes->post('users/invite', 'Admin::userInviteStore');
    $routes->get('users/create', 'Admin::userCreate');
    $routes->post('users/store', 'Admin::userStore');
    $routes->get('users/edit/(:num)', 'Admin::userEdit/$1');
    $routes->post('users/update/(:num)', 'Admin::userUpdate/$1');
    $routes->get('users/delete/(:num)', 'Admin::userDelete/$1');
    $routes->get('users/toggle-status/(:num)', 'Admin::userToggleStatus/$1');
    $routes->get('users/reset-password/(:num)', 'Admin::userResetPassword/$1');
    $routes->post('users/reset-password/(:num)', 'Admin::userResetPasswordStore/$1');
    $routes->get('users/bulk-upload', 'Admin::userBulkUpload');
    $routes->post('users/bulk-store', 'Admin::userBulkStore');
    $routes->get('users/bulk-format', 'Admin::userBulkFormat');

    $routes->get('roles', 'Admin::roleList');
    $routes->get('roles/create', 'Admin::roleCreate');
    $routes->post('roles/store', 'Admin::roleStore');
    $routes->get('roles/edit/(:num)', 'Admin::roleEdit/$1');
    $routes->post('roles/update/(:num)', 'Admin::roleUpdate/$1');
    $routes->get('roles/delete/(:num)', 'Admin::roleDelete/$1');

    $routes->get('comments', 'Admin::commentList');
    $routes->get('comments/approve/(:num)', 'Admin::commentApprove/$1');
    $routes->get('comments/delete/(:num)', 'Admin::commentDelete/$1');

    // Studio & Community Routes
    $routes->group('stories', function($routes) {
        $routes->get('/', 'Admin::storyList');
        $routes->get('create', 'Admin::storyCreate');
        $routes->post('store', 'Admin::storyStore');
        $routes->get('edit/(:num)', 'Admin::storyEdit/$1');
        $routes->post('update/(:num)', 'Admin::storyUpdate/$1');
        $routes->get('delete/(:num)', 'Admin::storyDelete/$1');
        $routes->post('bulk-delete', 'Admin::storyBulkDelete');
        $routes->get('bulk-upload', 'Admin::storyBulkUpload');
        $routes->post('bulk-store', 'Admin::storyBulkStore');
        $routes->get('bulk-format', 'Admin::storyBulkFormat');
    });

    $routes->group('videos', function($routes) {
        $routes->get('/', 'Admin::videoList');
        $routes->get('create', 'Admin::videoCreate');
        $routes->post('store', 'Admin::videoStore');
        $routes->get('edit/(:num)', 'Admin::videoEdit/$1');
        $routes->post('update/(:num)', 'Admin::videoUpdate/$1');
        $routes->get('delete/(:num)', 'Admin::videoDelete/$1');
        $routes->post('bulk-delete', 'Admin::videoBulkDelete');
        $routes->get('bulk-upload', 'Admin::videoBulkUpload');
        $routes->post('bulk-store', 'Admin::videoBulkStore');
        $routes->get('bulk-format', 'Admin::videoBulkFormat');
    });

    $routes->group('ads', function($routes) {
        $routes->get('/', 'Admin::adList');
        $routes->get('create', 'Admin::adCreate');
        $routes->post('store', 'Admin::adStore');
        $routes->get('edit/(:num)', 'Admin::adEdit/$1');
        $routes->post('update/(:num)', 'Admin::adUpdate/$1');
        $routes->get('delete/(:num)', 'Admin::adDelete/$1');
        $routes->get('bulk-upload', 'Admin::adBulkUpload');
        $routes->post('bulk-store', 'Admin::adBulkStore');
        $routes->get('bulk-format', 'Admin::adBulkFormat');
    });

    $routes->group('ticker', function($routes) {
        $routes->get('/', 'Admin::tickerList');
        $routes->get('create', 'Admin::tickerCreate');
        $routes->post('store', 'Admin::tickerStore');
        $routes->get('edit/(:num)', 'Admin::tickerEdit/$1');
        $routes->post('update/(:num)', 'Admin::tickerUpdate/$1');
        $routes->get('delete/(:num)', 'Admin::tickerDelete/$1');
        $routes->get('bulk-upload', 'Admin::tickerBulkUpload');
        $routes->post('bulk-store', 'Admin::tickerBulkStore');
        $routes->get('bulk-format', 'Admin::tickerBulkFormat');
    });

    $routes->group('polls', function($routes) {
        $routes->get('/', 'Admin::pollList');
        $routes->get('create', 'Admin::pollCreate');
        $routes->post('store', 'Admin::pollStore');
        $routes->get('delete/(:num)', 'Admin::pollDelete/$1');
    });

    $routes->get('subscribers', 'Admin::subscriberList');
    $routes->get('subscribers/delete/(:num)', 'Admin::subscriberDelete/$1');
    
    $routes->get('activity-logs', 'Admin::activityLogList');
    $routes->get('activity-logs/toggle', 'Admin::activityLogToggle');
    
    $routes->group('backups', function($routes) {
        $routes->get('/', 'Admin::backupList');
        $routes->get('run', 'Admin::backupRun');
        $routes->get('download/(:any)', 'Admin::backupDownload/$1');
        $routes->get('delete/(:any)', 'Admin::backupDelete/$1');
    });

    $routes->get('modules', 'Admin::moduleList');
    $routes->get('modules/toggle/(:num)', 'Admin::moduleToggle/$1');
    
    $routes->get('templates', 'Admin::templateList');
    $routes->get('templates/edit/(:num)', 'Admin::templateEdit/$1');
    $routes->post('templates/update/(:num)', 'Admin::templateUpdate/$1');

    $routes->get('smtp', 'Admin::smtpSettings');
    $routes->post('smtp/update', 'Admin::smtpUpdate');
    $routes->post('smtp/test', 'Admin::smtpTest');

    $routes->get('sms', 'Admin::smsSettings');
    $routes->post('sms/update', 'Admin::smsUpdate');
    $routes->post('sms/test', 'Admin::smsTest');

    $routes->get('whatsapp', 'Admin::whatsappSettings');
    $routes->post('whatsapp/update', 'Admin::whatsappUpdate');
    $routes->post('whatsapp/test', 'Admin::whatsappTest');

    $routes->get('telegram', 'Admin::telegramSettings');
    $routes->post('telegram/update', 'Admin::telegramUpdate');
    $routes->post('telegram/test', 'Admin::telegramTest');

    $routes->get('live', 'Admin::liveSettings');
    $routes->post('live/update', 'Admin::liveUpdate');
    
    $routes->get('contact-messages', 'Admin::contactList');
    $routes->get('contact-messages/delete/(:num)', 'Admin::contactDelete/$1');

    $routes->group('notifications', function($routes) {
        $routes->get('/', 'Admin::notificationList');
        $routes->get('create', 'Admin::notificationCreate');
        $routes->post('store', 'Admin::notificationStore');
        $routes->get('delete/(:num)', 'Admin::notificationDelete/$1');
    });


    
    $routes->get('seo', 'Admin::sitemapManager');
    $routes->post('seo/generate', 'Admin::sitemapGenerate');
    
    $routes->get('settings', 'Admin::settings');
    $routes->post('settings/update', 'Admin::settingsUpdate');
});
$routes->group('api/v1', function($routes) {
    $routes->get('news', 'Api\NewsController::index');
    $routes->get('news/(:segment)', 'Api\NewsController::show/$1');
    $routes->get('categories', 'Api\CategoryController::index');
    $routes->get('market-data', 'Api\MarketController::index');
});

// Flat Slug Resolver (Catch-all)
$routes->get('(:segment)', 'Home::resolveSlug/$1');

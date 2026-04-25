<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin' ?> - City News</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
    <style>
        .sidebar-link-active {
            background: rgba(255, 255, 255, 0.1);
            border-left: 4px solid #ef4444;
            color: white !important;
        }

        /* Premium Mobile Bottom Nav */
        .mobile-bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(20px);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 10px 0 calc(10px + env(safe-area-inset-bottom));
            z-index: 9999;
            box-shadow: 0 -10px 40px rgba(0, 0, 0, 0.3);
            display: flex;
            justify-content: space-around;
            align-items: center;
        }

        .mobile-nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none !important;
            color: #94a3b8;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            flex: 1;
            min-width: 0;
            padding: 0 2px;
        }

        .mobile-nav-item .nav-icon {
            font-size: 18px;
            margin-bottom: 2px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 28px;
            border-radius: 8px;
        }

        .mobile-nav-item span {
            font-size: 7px;
            font-weight: 800;
            letter-spacing: -0.2px;
            text-transform: uppercase;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            width: 100%;
            text-align: center;
        }

        .mobile-nav-item.active {
            color: #ef4444;
        }

        .mobile-nav-item.active .nav-icon {
            background: rgba(239, 68, 68, 0.2);
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(239, 68, 68, 0.2);
            color: #ef4444;
        }

        .mobile-nav-item.active span {
            color: #ef4444;
            font-weight: 900;
        }
        
        /* Tap dynamic feedback */
        .mobile-nav-item:active {
            transform: scale(0.9);
            opacity: 0.7;
        }

        @media (max-width: 768px) {
            main.overflow-hidden { padding-bottom: 70px !important; }
        }
    </style>
    <?= $this->renderSection('style') ?>
</head>
<body class="bg-slate-50 font-sans">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside id="sidebar" class="fixed inset-y-0 left-0 w-64 bg-slate-900 text-white flex flex-col shadow-2xl z-50 transform -translate-x-full md:relative md:translate-x-0 transition-transform duration-300 ease-in-out">
            <div class="p-6 border-b border-slate-800 flex items-center justify-between">
                <h1 class="text-xl font-black tracking-tighter text-red-500">CITY NEWS <span class="text-white text-xs font-normal opacity-50 block tracking-normal">ADMIN PANEL</span></h1>
                <button id="closeSidebar" class="md:hidden text-slate-400 hover:text-white"><i class="fas fa-times"></i></button>
            </div>
            
            <nav class="flex-1 overflow-y-auto p-4 space-y-2 mt-4">
                <?php 
                    $uri = service('uri');
                    $segment = $uri->getSegment(2); 
                ?>
                <a href="<?= base_url() ?>" target="_blank" class="flex items-center space-x-3 p-3 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white transition group">
                    <i class="fas fa-globe w-5 text-blue-400 group-hover:text-blue-300"></i>
                    <span class="font-bold text-sm">View Website</span>
                </a>

                <a href="<?= base_url('admin/dashboard') ?>" class="flex items-center space-x-3 p-3 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white transition <?= $segment == 'dashboard' ? 'sidebar-link-active' : '' ?>">
                    <i class="fas fa-home w-5"></i>
                    <span class="font-bold text-sm">Dashboard</span>
                </a>

                <a href="<?= base_url('admin/news') ?>" class="flex items-center space-x-3 p-3 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white transition <?= $segment == 'news' ? 'sidebar-link-active' : '' ?>">
                    <i class="fas fa-newspaper w-5"></i>
                    <span class="font-bold text-sm">News Management</span>
                </a>

                <a href="<?= base_url('admin/media') ?>" class="flex items-center space-x-3 p-3 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white transition <?= $segment == 'media' ? 'sidebar-link-active' : '' ?>">
                    <i class="fas fa-images w-5 text-indigo-400"></i>
                    <span class="font-bold text-sm">Media Library</span>
                </a>

                <a href="<?= base_url('admin/calendar') ?>" class="flex items-center space-x-3 p-3 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white transition <?= $segment == 'calendar' ? 'sidebar-link-active' : '' ?>">
                    <i class="fas fa-calendar-alt w-5 text-orange-400"></i>
                    <span class="font-bold text-sm">News Calendar</span>
                </a>

                <a href="<?= base_url('admin/categories') ?>" class="flex items-center space-x-3 p-3 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white transition <?= $segment == 'categories' ? 'sidebar-link-active' : '' ?>">
                    <i class="fas fa-list w-5"></i>
                    <span class="font-bold text-sm">Categories</span>
                </a>

                <a href="<?= base_url('admin/comments') ?>" class="flex items-center space-x-3 p-3 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white transition <?= $segment == 'comments' ? 'sidebar-link-active' : '' ?>">
                    <i class="fas fa-comments w-5"></i>
                    <span class="font-bold text-sm">Comments</span>
                </a>
                
                <div class="pt-6 pb-2 px-3 text-[10px] font-black text-slate-500 uppercase tracking-widest border-t border-slate-800/50 mt-4">Visual Studio</div>
                <?php if (config('App')->moduleStatus['visual_stories'] ?? 1): ?>
                <a href="<?= base_url('admin/stories') ?>" class="flex items-center space-x-3 p-3 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white transition <?= $segment == 'stories' ? 'sidebar-link-active' : '' ?>">
                    <i class="fas fa-bolt w-5 text-yellow-500"></i>
                    <span class="font-bold text-sm">Visual Stories</span>
                </a>
                <?php endif; ?>

                <?php if (config('App')->moduleStatus['video_news'] ?? 1): ?>
                <a href="<?= base_url('admin/videos') ?>" class="flex items-center space-x-3 p-3 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white transition <?= $segment == 'videos' ? 'sidebar-link-active' : '' ?>">
                    <i class="fas fa-video w-5 text-blue-500"></i>
                    <span class="font-bold text-sm">Video News</span>
                </a>
                <?php endif; ?>

                <?php if (config('App')->moduleStatus['live_tv'] ?? 1): ?>
                <a href="<?= base_url('admin/live') ?>" class="flex items-center space-x-3 p-3 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white transition <?= $segment == 'live' ? 'sidebar-link-active' : '' ?>">
                    <i class="fas fa-circle w-5 text-red-600 animate-pulse"></i>
                    <span class="font-bold text-sm">Live TV Setup</span>
                </a>
                <?php endif; ?>

                <?php if (config('App')->moduleStatus['breaking_ticker'] ?? 1): ?>
                <a href="<?= base_url('admin/ticker') ?>" class="flex items-center space-x-3 p-3 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white transition <?= $segment == 'ticker' ? 'sidebar-link-active' : '' ?>">
                    <i class="fas fa-broadcast-tower w-5 text-red-500"></i>
                    <span class="font-bold text-sm">Breaking Ticker</span>
                </a>
                <?php endif; ?>

                <div class="pt-6 pb-2 px-3 text-[10px] font-black text-slate-500 uppercase tracking-widest border-t border-slate-800/50 mt-4">Revenue & Ads</div>
                <?php if (config('App')->moduleStatus['ad_manager'] ?? 1): ?>
                <a href="<?= base_url('admin/ads') ?>" class="flex items-center space-x-3 p-3 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white transition <?= $segment == 'ads' ? 'sidebar-link-active' : '' ?>">
                    <i class="fas fa-ad w-5 text-green-500"></i>
                    <span class="font-bold text-sm">Ad Manager</span>
                </a>
                <?php endif; ?>

                <div class="pt-6 pb-2 px-3 text-[10px] font-black text-slate-500 uppercase tracking-widest border-t border-slate-800/50 mt-4">Community</div>
                <?php if (config('App')->moduleStatus['polls'] ?? 1): ?>
                <a href="<?= base_url('admin/polls') ?>" class="flex items-center space-x-3 p-3 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white transition <?= $segment == 'polls' ? 'sidebar-link-active' : '' ?>">
                    <i class="fas fa-poll w-5 text-orange-400"></i>
                    <span class="font-bold text-sm">Polls & Surveys</span>
                </a>
                <?php endif; ?>

                <?php if (config('App')->moduleStatus['subscribers'] ?? 1): ?>
                <a href="<?= base_url('admin/subscribers') ?>" class="flex items-center space-x-3 p-3 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white transition <?= $segment == 'subscribers' ? 'sidebar-link-active' : '' ?>">
                    <i class="fas fa-envelope-open-text w-5 text-purple-500"></i>
                    <span class="font-bold text-sm">Subscribers</span>
                </a>
                <?php endif; ?>
                <a href="<?= base_url('admin/contact-messages') ?>" class="flex items-center space-x-3 p-3 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white transition <?= $segment == 'contact_messages' ? 'sidebar-link-active' : '' ?>">
                    <i class="fas fa-inbox w-5 text-cyan-500"></i>
                    <span class="font-bold text-sm">Contact Messages</span>
                </a>
                <a href="<?= base_url('admin/notifications') ?>" class="flex items-center space-x-3 p-3 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white transition <?= $segment == 'notifications' ? 'sidebar-link-active' : '' ?>">
                    <i class="fas fa-bell w-5 text-red-400"></i>
                    <span class="font-bold text-sm">User Notifications</span>
                </a>

                <?php if (has_role('admin')): ?>
                <div class="pt-6 pb-2 px-3 text-[10px] font-black text-slate-500 uppercase tracking-widest border-t border-slate-800/50 mt-4">Administration</div>
                <a href="<?= base_url('admin/modules') ?>" class="flex items-center space-x-3 p-3 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white transition <?= $segment == 'modules' ? 'sidebar-link-active' : '' ?>">
                    <i class="fas fa-toggle-on w-5 text-green-400"></i>
                    <span class="font-bold text-sm">Module Manager</span>
                </a>
                <a href="<?= base_url('admin/users') ?>" class="flex items-center space-x-3 p-3 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white transition <?= $segment == 'users' && !url_is('admin/users/invite*') ? 'sidebar-link-active' : '' ?>">
                    <i class="fas fa-users-cog w-5"></i>
                    <span class="font-bold text-sm">User Management</span>
                </a>
                <a href="<?= base_url('admin/users/invite') ?>" class="flex items-center space-x-3 p-3 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white transition <?= url_is('admin/users/invite*') ? 'sidebar-link-active' : '' ?>">
                    <i class="fas fa-user-plus w-5 text-emerald-400"></i>
                    <span class="font-bold text-sm">Invite Member</span>
                </a>
                <a href="<?= base_url('admin/roles') ?>" class="flex items-center space-x-3 p-3 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white transition <?= $segment == 'roles' ? 'sidebar-link-active' : '' ?>">
                    <i class="fas fa-shield-alt w-5"></i>
                    <span class="font-bold text-sm">Roles & Permissions</span>
                </a>
                <a href="<?= base_url('admin/seo') ?>" class="flex items-center space-x-3 p-3 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white transition <?= url_is('admin/seo*') ? 'sidebar-link-active' : '' ?>">
                    <i class="fas fa-map w-5 text-indigo-400"></i>
                    <span class="font-bold text-sm">SEO & Sitemap</span>
                </a>
                <a href="<?= base_url('admin/settings') ?>" class="flex items-center space-x-3 p-3 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white transition <?= $segment == 'settings' ? 'sidebar-link-active' : '' ?>">
                    <i class="fas fa-cog w-5 text-slate-400"></i>
                    <span class="font-bold text-sm">Site Settings</span>
                </a>
                <a href="<?= base_url('admin/activity-logs') ?>" class="flex items-center space-x-3 p-3 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white transition <?= $segment == 'activity-logs' ? 'sidebar-link-active' : '' ?>">
                    <i class="fas fa-history w-5 text-slate-500"></i>
                    <span class="font-bold text-sm">Activity Logs</span>
                </a>
                <a href="<?= base_url('admin/backups') ?>" class="flex items-center space-x-3 p-3 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white transition <?= $segment == 'backups' ? 'sidebar-link-active' : '' ?>">
                    <i class="fas fa-database w-5 text-green-500"></i>
                    <span class="font-bold text-sm">Database Backups</span>
                </a>

                <div class="pt-6 pb-2 px-3 text-[10px] font-black text-slate-500 uppercase tracking-widest border-t border-slate-800/50 mt-4">Notifications</div>
                <a href="<?= base_url('admin/templates') ?>" class="flex items-center space-x-3 p-3 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white transition <?= $segment == 'templates' ? 'sidebar-link-active' : '' ?>">
                    <i class="fas fa-layer-group w-5 text-pink-400"></i>
                    <span class="font-bold text-sm">News Templates</span>
                </a>
                <?php if (config('App')->moduleStatus['smtp'] ?? 1): ?>
                <a href="<?= base_url('admin/smtp') ?>" class="flex items-center space-x-3 p-3 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white transition <?= $segment == 'smtp' ? 'sidebar-link-active' : '' ?>">
                    <i class="fas fa-paper-plane w-5 text-blue-400"></i>
                    <span class="font-bold text-sm">SMTP Setup</span>
                </a>
                <?php endif; ?>

                <?php if (config('App')->moduleStatus['sms'] ?? 1): ?>
                <a href="<?= base_url('admin/sms') ?>" class="flex items-center space-x-3 p-3 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white transition <?= $segment == 'sms' ? 'sidebar-link-active' : '' ?>">
                    <i class="fas fa-sms w-5 text-yellow-400"></i>
                    <span class="font-bold text-sm">SMS API Setup</span>
                </a>
                <?php endif; ?>

                <?php if (config('App')->moduleStatus['whatsapp'] ?? 1): ?>
                <a href="<?= base_url('admin/whatsapp') ?>" class="flex items-center space-x-3 p-3 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white transition <?= $segment == 'whatsapp' ? 'sidebar-link-active' : '' ?>">
                    <i class="fab fa-whatsapp w-5 text-green-400"></i>
                    <span class="font-bold text-sm">WhatsApp Setup</span>
                </a>
                <?php endif; ?>

                <?php if (config('App')->moduleStatus['telegram'] ?? 1): ?>
                <a href="<?= base_url('admin/telegram') ?>" class="flex items-center space-x-3 p-3 rounded-xl text-slate-400 hover:bg-slate-800 hover:text-white transition <?= $segment == 'telegram' ? 'sidebar-link-active' : '' ?>">
                    <i class="fab fa-telegram w-5 text-sky-400"></i>
                    <span class="font-bold text-sm">Telegram Setup</span>
                </a>
                <?php endif; ?>
                <?php endif; ?>
            </nav>

            <div class="p-4 border-t border-slate-800">
                <a href="<?= base_url('logout') ?>" class="flex items-center space-x-3 p-3 rounded-xl text-red-400 hover:bg-red-500/10 transition">
                    <i class="fas fa-sign-out-alt w-5"></i>
                    <span class="font-bold text-sm">Sign Out</span>
                </a>
            </div>
        </aside>

        <!-- Sidebar Overlay (Mobile Only) -->
        <div id="sidebarOverlay" class="fixed inset-0 bg-slate-900/50 z-40 hidden md:hidden"></div>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col overflow-hidden">
            <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-4 md:px-8 z-40">
                <div class="flex items-center space-x-4">
                    <button id="openSidebar" class="md:hidden h-10 w-10 bg-slate-50 text-slate-600 rounded-xl flex items-center justify-center hover:bg-red-50 hover:text-red-600 transition">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="text-xs font-bold text-slate-400 uppercase tracking-widest hidden sm:block">Welcome back, <?= session()->get('fullName') ?></div>
                </div>
                <div class="flex items-center space-x-3 sm:space-x-4">
                    <a href="<?= base_url() ?>" target="_blank" class="text-xs font-bold text-blue-600 hover:text-blue-700 hover:underline flex items-center gap-1">
                        View Website <i class="fas fa-external-link-alt text-[10px]"></i>
                    </a>
                    <a href="<?= base_url('logout') ?>" class="md:hidden h-10 w-10 bg-red-50 text-red-600 rounded-xl flex items-center justify-center hover:bg-red-600 hover:text-white transition-all shadow-sm border border-red-100" title="Sign Out">
                        <i class="fas fa-power-off"></i>
                    </a>
                    <a href="<?= base_url('admin/profile') ?>" class="h-10 w-10 md:h-8 md:w-8 rounded-full bg-slate-900 border border-slate-700 flex items-center justify-center text-white font-bold text-xs uppercase hover:bg-red-600 transition-all shadow-lg overflow-hidden group">
                        <?php if (session()->get('avatar')): ?>
                            <img src="<?= base_url('uploads/avatars/' . session()->get('avatar')) ?>" class="h-full w-full object-cover group-hover:scale-110 transition-transform">
                        <?php else: ?>
                            <?= substr(session()->get('fullName'), 0, 1) ?>
                        <?php endif; ?>
                    </a>
                </div>
            </header>

            <div class="flex-1 overflow-y-auto p-4 md:p-8">
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-2xl flex items-center">
                        <i class="fas fa-check-circle mr-3"></i>
                        <span class="font-bold"><?= session()->getFlashdata('success') ?></span>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-2xl flex items-center">
                        <i class="fas fa-exclamation-circle mr-3"></i>
                        <span class="font-bold"><?= session()->getFlashdata('error') ?></span>
                    </div>
                <?php endif; ?>

                <?= $this->renderSection('content') ?>
            </div>
        </main>
    </div>

    <!-- Mobile Bottom Navigation (Admin) -->
    <div class="mobile-bottom-nav md:hidden">
        <a href="<?= base_url() ?>" class="mobile-nav-item">
            <div class="nav-icon"><i class="fas fa-globe"></i></div>
            <span>WEBSITE</span>
        </a>
        <a href="<?= base_url('admin/dashboard') ?>" class="mobile-nav-item <?= $segment == 'dashboard' ? 'active' : '' ?>">
            <div class="nav-icon"><i class="fas fa-home"></i></div>
            <span>HOME</span>
        </a>
        <a href="<?= base_url('admin/news') ?>" class="mobile-nav-item <?= $segment == 'news' ? 'active' : '' ?>">
            <div class="nav-icon"><i class="fas fa-newspaper"></i></div>
            <span>NEWS</span>
        </a>
        <a href="<?= base_url('admin/stories') ?>" class="mobile-nav-item <?= $segment == 'stories' ? 'active' : '' ?>">
            <div class="nav-icon"><i class="fas fa-bolt"></i></div>
            <span>STORIES</span>
        </a>
        <a href="<?= base_url('admin/videos') ?>" class="mobile-nav-item <?= $segment == 'videos' ? 'active' : '' ?>">
            <div class="nav-icon"><i class="fas fa-video"></i></div>
            <span>VIDEOS</span>
        </a>
        <a href="javascript:void(0)" class="mobile-nav-item" id="mobile-menu-trigger-admin">
            <div class="nav-icon"><i class="fas fa-bars"></i></div>
            <span>MENU</span>
        </a>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const openBtn = document.getElementById('openSidebar');
        const closeBtn = document.getElementById('closeSidebar');
        const menuTrigger = document.getElementById('mobile-menu-trigger-admin');

        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        if(openBtn) openBtn.onclick = toggleSidebar;
        if(closeBtn) closeBtn.onclick = toggleSidebar;
        if(overlay) overlay.onclick = toggleSidebar;
        if(menuTrigger) menuTrigger.onclick = toggleSidebar;
    </script>
    <?= $this->renderSection('scripts') ?>
</body>
</html>

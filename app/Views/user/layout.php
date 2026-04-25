<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'User Panel' ?> | NewsPortal</title>
    <!-- Modern Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Albert+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Tailwind CSS (via CDN for modern UI) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Albert Sans', sans-serif; background: #f8fafc; }
        .glass-panel { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2); }
        .mobile-bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            padding: 10px 0 calc(10px + env(safe-area-inset-bottom));
            z-index: 10000;
            display: flex;
            justify-content: space-around;
            align-items: center;
            box-shadow: 0 -10px 30px rgba(0, 0, 0, 0.03);
        }

        .mobile-nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none !important;
            color: #94a3b8;
            transition: all 0.3s;
            flex: 1;
        }

        .mobile-nav-item i {
            font-size: 20px;
            margin-bottom: 4px;
        }

        .mobile-nav-item span {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .mobile-nav-item.active {
            color: #dc2626;
        }

        @media (max-width: 768px) {
            main { padding-bottom: 70px !important; }
        }
    </style>
</head>
<body class="bg-slate-50">

    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-slate-100 flex-shrink-0 flex flex-col transform -translate-x-full md:translate-x-0 md:relative transition-transform duration-300 ease-in-out">
            <div class="p-8 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-red-600 rounded-xl flex items-center justify-center text-white font-black text-xl shadow-lg shadow-red-200">
                        N
                    </div>
                    <span class="font-black text-xl tracking-tighter text-slate-800">NewsPortal</span>
                </div>
                <!-- Close Button (Mobile Only) -->
                <button onclick="toggleSidebar()" class="md:hidden text-slate-400 hover:text-red-600 transition">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <nav class="flex-1 px-4 py-8 space-y-1 overflow-y-auto">
                <a href="<?= base_url('user/dashboard') ?>" class="sidebar-link flex items-center gap-4 px-4 py-3.5 rounded-2xl font-bold text-slate-600 transition-all hover:bg-slate-50 <?= (uri_string() == 'user/dashboard') ? 'active' : '' ?>">
                    <i class="fas fa-home-alt text-lg"></i>
                    Dashboard
                </a>
                <a href="<?= base_url('user/settings') ?>" class="sidebar-link flex items-center gap-4 px-4 py-3.5 rounded-2xl font-bold text-slate-600 transition-all hover:bg-slate-50 <?= (uri_string() == 'user/settings' || uri_string() == 'user/profile') ? 'active' : '' ?>">
                    <i class="fas fa-user-gear text-lg"></i>
                    Profile & Settings
                </a>
                <a href="<?= base_url('user/bookmarks') ?>" class="sidebar-link flex items-center gap-4 px-4 py-3.5 rounded-2xl font-bold text-slate-600 transition-all hover:bg-slate-50 <?= (uri_string() == 'user/bookmarks') ? 'active' : '' ?>">
                    <i class="fas fa-bookmark text-lg"></i>
                    Saved Stories
                </a>
                <a href="<?= base_url('user/notifications') ?>" class="sidebar-link flex items-center justify-between gap-4 px-4 py-3.5 rounded-2xl font-bold text-slate-600 transition-all hover:bg-slate-50 <?= (uri_string() == 'user/notifications') ? 'active' : '' ?>">
                    <div class="flex items-center gap-4">
                        <i class="fas fa-bell text-lg"></i>
                        Notifications
                    </div>
                    <?php if (($count = get_unread_notifications_count()) > 0): ?>
                        <span class="bg-red-600 text-white text-[10px] px-2 py-0.5 rounded-full"><?= $count ?></span>
                    <?php endif; ?>
                </a>
                <a href="<?= base_url('user/interests') ?>" class="sidebar-link flex items-center gap-4 px-4 py-3.5 rounded-2xl font-bold text-slate-600 transition-all hover:bg-slate-50 <?= (uri_string() == 'user/interests') ? 'active' : '' ?>">
                    <i class="fas fa-heart text-lg"></i>
                    My Interests
                </a>
                <a href="<?= base_url() ?>" class="sidebar-link flex items-center gap-4 px-4 py-3.5 rounded-2xl font-bold text-slate-600 transition-all hover:bg-slate-50">
                    <i class="fas fa-globe text-lg text-blue-500"></i>
                    Main Website
                </a>

                <?php if (session()->get('roleId') == 1): ?>
                <div class="px-4 pt-6 pb-2 text-[10px] font-black text-slate-400 uppercase tracking-widest">Management</div>
                <a href="<?= base_url('admin/dashboard') ?>" class="flex items-center gap-4 px-4 py-3.5 rounded-2xl font-bold text-red-600 bg-red-50 hover:bg-red-100 transition-all">
                    <i class="fas fa-user-shield text-lg"></i>
                    Admin Panel
                </a>
                <?php endif; ?>
            </nav>

            <div class="p-6">
                <a href="<?= base_url('logout') ?>" class="w-full flex items-center gap-4 px-4 py-4 rounded-3xl font-black text-red-600 bg-red-50 hover:bg-red-100 transition-all">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </a>
            </div>
        </aside>

        <!-- Overlay (Mobile Only) -->
        <div id="sidebar-overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-40 hidden transition-opacity duration-300"></div>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col min-w-0 overflow-hidden bg-slate-50">
            <!-- Topbar -->
            <header class="bg-white/70 backdrop-blur-md border-b border-slate-100 px-8 py-4 flex items-center justify-between sticky top-0 z-10">
                <div class="flex items-center gap-4 md:hidden">
                    <button onclick="toggleSidebar()" class="p-2 text-slate-500 hover:text-red-600 transition ring-2 ring-slate-100 rounded-xl">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <span class="font-black text-xl tracking-tighter text-slate-800">NewsPortal</span>
                </div>
                
                <div class="hidden md:flex items-center gap-2 text-slate-400 font-bold text-sm">
                    <span class="hover:text-slate-600 transition cursor-pointer">Panel</span>
                    <i class="fas fa-chevron-right text-[10px] opacity-50"></i>
                    <span class="text-slate-900"><?= $title ?></span>
                </div>

                <div class="flex items-center gap-3 sm:gap-6">
                    <a href="<?= base_url('logout') ?>" class="md:hidden w-10 h-10 flex items-center justify-center rounded-xl bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition shadow-sm border border-red-100" title="Logout">
                        <i class="fas fa-power-off"></i>
                    </a>
                    
                    <a href="<?= base_url('user/notifications') ?>" class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-100 text-slate-500 hover:bg-red-600 hover:text-white transition relative hidden xs:flex" title="Notifications">
                        <i class="fas fa-bell"></i>
                        <?php if (($count = get_unread_notifications_count()) > 0): ?>
                            <span class="absolute -top-1 -right-1 min-w-[20px] h-5 bg-red-600 rounded-full border-2 border-white flex items-center justify-center text-[10px] font-black text-white px-1 shadow-sm">
                                <?= $count ?>
                            </span>
                        <?php endif; ?>
                    </a>

                    <div class="flex items-center gap-3 group cursor-pointer">
                        <div class="text-right hidden sm:block transition-all group-hover:translate-x-1">
                            <p class="text-xs font-black text-slate-800 leading-tight"><?= esc(session()->get('fullName')) ?></p>
                            <div class="flex items-center justify-end gap-1">
                                <span class="w-1 h-1 rounded-full bg-emerald-500"></span>
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest"><?= esc(session()->get('userRole') ?: 'Active Member') ?></p>
                            </div>
                        </div>
                        <div class="relative">
                            <img src="<?= base_url('uploads/avatars/' . (session()->get('avatar') ?: 'default.png')) ?>" 
                                 class="w-10 h-10 rounded-xl object-cover ring-2 ring-slate-100 group-hover:ring-red-100 transition-all shadow-sm" alt="Avatar">
                            <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-white rounded-full flex items-center justify-center shadow-sm border border-slate-50 opacity-0 group-hover:opacity-100 transition-opacity">
                                <i class="fas fa-chevron-down text-[8px] text-slate-400"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Scrollable Content -->
            <div class="flex-1 overflow-y-auto p-4 md:p-8">
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-2xl flex items-center animate-in fade-in slide-in-from-top-4 duration-500">
                        <i class="fas fa-check-circle mr-3"></i>
                        <span class="font-bold"><?= session()->getFlashdata('success') ?></span>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-2xl flex items-center animate-in fade-in slide-in-from-top-4 duration-500">
                        <i class="fas fa-exclamation-circle mr-3"></i>
                        <span class="font-bold"><?= session()->getFlashdata('error') ?></span>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-2xl animate-in fade-in slide-in-from-top-4 duration-500">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-exclamation-circle mr-3"></i>
                            <span class="font-bold">Please fix the following errors:</span>
                        </div>
                        <ul class="list-disc list-inside ml-7 text-sm font-medium">
                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?= $this->renderSection('content') ?>
            </div>
        </main>
    </div>

    <!-- Mobile Bottom Navigation -->
    <div class="mobile-bottom-nav md:hidden">
        <a href="<?= base_url() ?>" class="mobile-nav-item">
            <i class="fas fa-globe"></i>
            <span>Website</span>
        </a>
        <a href="<?= base_url('user/dashboard') ?>" class="mobile-nav-item <?= (uri_string() == 'user/dashboard') ? 'active' : '' ?>">
            <i class="fas fa-home-alt"></i>
            <span>Home</span>
        </a>
        <a href="<?= base_url('user/bookmarks') ?>" class="mobile-nav-item <?= (uri_string() == 'user/bookmarks') ? 'active' : '' ?>">
            <i class="fas fa-bookmark"></i>
            <span>Saved</span>
        </a>
        <a href="<?= base_url('user/settings') ?>" class="mobile-nav-item <?= (uri_string() == 'user/settings' || uri_string() == 'user/profile') ? 'active' : '' ?>">
            <i class="fas fa-user-cog"></i>
            <span>Settings</span>
        </a>
        <a href="<?= base_url('user/notifications') ?>" class="mobile-nav-item <?= (uri_string() == 'user/notifications') ? 'active' : '' ?>">
            <i class="fas fa-bell"></i>
            <span>Alerts</span>
        </a>
        <button onclick="toggleSidebar()" class="mobile-nav-item">
            <i class="fas fa-bars"></i>
            <span>Menu</span>
        </button>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
            
            // Prevent body scroll when menu is open
            if (!sidebar.classList.contains('-translate-x-full')) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        }
    </script>

</body>
</html>

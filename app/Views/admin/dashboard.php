<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="dashboard-modern-wrapper">
    <!-- Header Strategy -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Admin <span class="text-red-600">Dashboard</span></h1>
            <p class="text-slate-500 font-medium">Welcome back! Here's what's happening today.</p>
        </div>
        <div class="flex items-center gap-3">
            <div class="bg-white border border-slate-100 rounded-2xl px-4 py-2 flex items-center gap-3 shadow-sm">
                <span class="h-2 w-2 rounded-full bg-green-500 animate-pulse"></span>
                <span class="text-xs font-bold text-slate-600 uppercase tracking-widest">Active Now</span>
            </div>
            <button onclick="location.reload()" class="h-10 w-10 bg-white border border-slate-100 rounded-2xl flex items-center justify-center text-slate-400 hover:text-red-600 transition shadow-sm">
                <i class="fas fa-sync-alt"></i>
            </button>
        </div>
    </div>
    
    <!-- Visual Analytics: Charts -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
        <div class="bg-white rounded-[2rem] border border-slate-100 p-4 md:p-8 shadow-sm group hover:shadow-xl transition-all duration-500">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h3 class="font-black text-xl text-slate-900 tracking-tight">Dispatch <span class="text-red-600">Trends</span></h3>
                    <p class="text-slate-400 text-xs font-bold uppercase tracking-widest mt-1">Activity over the last 7 days</p>
                </div>
                <div class="h-10 w-10 bg-slate-50 rounded-xl flex items-center justify-center text-slate-400"><i class="fas fa-chart-line"></i></div>
            </div>
            <div style="height: 300px; position: relative;">
                <canvas id="weeklyChart"></canvas>
            </div>
        </div>

        <div class="bg-white rounded-[2rem] border border-slate-100 p-4 md:p-8 shadow-sm group hover:shadow-xl transition-all duration-500">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h3 class="font-black text-xl text-slate-900 tracking-tight">Content <span class="text-red-600">Segments</span></h3>
                    <p class="text-slate-400 text-xs font-bold uppercase tracking-widest mt-1">Distribution across categories</p>
                </div>
                <div class="h-10 w-10 bg-slate-50 rounded-xl flex items-center justify-center text-slate-400"><i class="fas fa-chart-pie"></i></div>
            </div>
            <div style="height: 300px; position: relative;">
                <canvas id="categoryChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <!-- Articles Card -->
        <div class="stat-card-premium group" style="--accent: #1e3a8a;">
            <div class="stat-bg-icon"><i class="fas fa-newspaper"></i></div>
            <div class="flex justify-between items-start relative z-10">
                <div class="h-12 w-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-xl mb-6 group-hover:bg-blue-600 group-hover:text-white transition-all duration-500">
                    <i class="fas fa-newspaper"></i>
                </div>
            </div>
            <div class="relative z-10">
                <div class="text-3xl font-black text-slate-900 mb-1"><?= number_format($stats['total_news'] ?? 0) ?></div>
                <div class="text-xs font-bold text-slate-400 uppercase tracking-widest">Total News Articles</div>
            </div>
        </div>

        <!-- Views Card -->
        <div class="stat-card-premium group" style="--accent: #7c3aed;">
            <div class="stat-bg-icon"><i class="fas fa-eye"></i></div>
            <div class="flex justify-between items-start relative z-10">
                <div class="h-12 w-12 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center text-xl mb-6 group-hover:bg-purple-600 group-hover:text-white transition-all duration-500">
                    <i class="fas fa-eye"></i>
                </div>
            </div>
            <div class="relative z-10">
                <div class="text-3xl font-black text-slate-900 mb-1"><?= number_format($stats['total_views'] ?? 0) ?></div>
                <div class="text-xs font-bold text-slate-400 uppercase tracking-widest">Total Post Views</div>
            </div>
        </div>

        <!-- Comments Card -->
        <div class="stat-card-premium group" style="--accent: #ea580c;">
            <div class="stat-bg-icon"><i class="fas fa-comments"></i></div>
            <div class="flex justify-between items-start relative z-10">
                <div class="h-12 w-12 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center text-xl mb-6 group-hover:bg-orange-600 group-hover:text-white transition-all duration-500">
                    <i class="fas fa-comments"></i>
                </div>
            </div>
            <div class="relative z-10">
                <div class="text-3xl font-black text-slate-900 mb-1"><?= number_format($stats['pending_comments'] ?? 0) ?></div>
                <div class="text-xs font-bold text-slate-400 uppercase tracking-widest">Pending Comments</div>
            </div>
        </div>

        <!-- Users Card -->
        <a href="<?= base_url('admin/users') ?>" class="stat-card-premium group block cursor-pointer transition-all hover:scale-[1.02]" style="--accent: #dc2626; text-decoration: none !important;">
            <div class="stat-bg-icon"><i class="fas fa-users-cog"></i></div>
            <div class="flex justify-between items-start relative z-10">
                <div class="h-12 w-12 bg-red-50 text-red-600 rounded-2xl flex items-center justify-center text-xl mb-6 group-hover:bg-red-600 group-hover:text-white transition-all duration-500">
                    <i class="fas fa-users-cog"></i>
                </div>
                <div class="text-[10px] font-black text-slate-300 opacity-0 group-hover:opacity-100 transition-opacity">MANAGE →</div>
            </div>
            <div class="relative z-10">
                <div class="text-3xl font-black text-slate-900 mb-1"><?= number_format($stats['total_users'] ?? 0) ?></div>
                <div class="text-xs font-bold text-slate-400 uppercase tracking-widest">User Management</div>
            </div>
        </a>
    </div>

    <!-- Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white rounded-[2rem] border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden">
                <div class="p-4 md:p-8 border-b border-slate-50 flex flex-col sm:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h3 class="font-black text-xl text-slate-900 tracking-tight">Recent <span class="text-red-600">News</span></h3>
                        <p class="text-slate-400 text-xs font-bold uppercase tracking-widest mt-1">Latest articles published on your portal</p>
                    </div>
                    <a href="<?= base_url('admin/news') ?>" class="h-9 px-4 bg-slate-50 text-slate-600 rounded-xl text-xs font-black flex items-center hover:bg-slate-900 hover:text-white transition">See All News</a>
                </div>
                <div class="p-4">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="text-left">
                                    <th class="p-4 text-xs font-black text-slate-400 uppercase tracking-widest">Article</th>
                                    <th class="p-4 text-xs font-black text-slate-400 uppercase tracking-widest">Date</th>
                                    <th class="p-4 text-xs font-black text-slate-400 uppercase tracking-widest">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                <?php foreach($recent_news as $news): ?>
                                <tr class="group">
                                    <td class="p-4">
                                        <div class="flex items-center gap-4">
                                            <div class="h-10 w-10 rounded-xl overflow-hidden bg-slate-100 flex-shrink-0">
                                                <img src="<?= base_url('uploads/news/'.($news['image'] ?: 'default.jpg')) ?>" class="h-full w-full object-cover">
                                            </div>
                                            <div>
                                                <div class="font-black text-slate-800 text-sm line-clamp-1"><?= esc($news['title']) ?></div>
                                                <div class="text-[10px] font-bold text-slate-400 tracking-wider"><?= $news['slug'] ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-4 text-xs font-bold text-slate-500"><?= date('M d, Y', strtotime($news['created_at'])) ?></td>
                                    <td class="p-4">
                                        <a href="<?= base_url('admin/news/edit/'.$news['id']) ?>" class="h-8 w-8 bg-slate-50 text-slate-400 rounded-lg flex items-center justify-center hover:bg-red-50 hover:text-red-600 transition">
                                            <i class="fas fa-edit text-xs"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <!-- Quick Actions Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <a href="<?= base_url('admin/news/create') ?>" class="action-card group">
                    <div class="action-icon bg-red-50 text-red-600"><i class="fas fa-plus"></i></div>
                    <span class="font-black text-sm text-slate-800">Add News Post</span>
                </a>
                <a href="<?= base_url('admin/categories') ?>" class="action-card group">
                    <div class="action-icon bg-blue-50 text-blue-600"><i class="fas fa-folder-plus"></i></div>
                    <span class="font-black text-sm text-slate-800">New Category</span>
                </a>
                <a href="<?= base_url('admin/settings') ?>" class="action-card group">
                    <div class="action-icon bg-slate-100 text-slate-600"><i class="fas fa-cog"></i></div>
                    <span class="font-black text-sm text-slate-800">Site Settings</span>
                </a>
            </div>
        </div>

        <!-- Interaction Sidebar -->
        <div class="space-y-8">
            <div class="bg-slate-900 rounded-[2rem] p-6 md:p-8 text-white shadow-2xl shadow-slate-900/40 relative overflow-hidden">
                <div class="relative z-10">
                    <h3 class="font-black text-xl mb-6 flex items-center gap-3">
                        <i class="fas fa-comments text-red-500"></i> Local <span class="text-slate-400">Comments</span>
                    </h3>
                    <div class="space-y-6">
                        <?php foreach($recent_comments as $comment): ?>
                        <div class="group cursor-default">
                            <div class="flex items-center justify-between mb-1">
                                <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest"><?= esc($comment['name']) ?></span>
                                <span class="text-[9px] font-bold text-slate-600"><?= date('d M', strtotime($comment['created_at'])) ?></span>
                            </div>
                            <p class="text-xs text-slate-300 font-medium line-clamp-2 leading-relaxed opacity-80 group-hover:opacity-100 transition"><?= esc($comment['comment']) ?></p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <a href="<?= base_url('admin/comments') ?>" class="mt-8 block h-10 w-full bg-slate-800 border border-slate-700 rounded-xl flex items-center justify-center text-xs font-black text-slate-300 hover:bg-red-600 hover:text-white hover:border-red-600 transition">View All Comments</a>
                </div>
            </div>

            <!-- Dashboard Health -->
            <div class="bg-white rounded-[2rem] border border-slate-100 p-6 md:p-8 shadow-sm">
                <h3 class="font-black text-lg text-slate-900 mb-6">System <span class="text-red-600">Health</span></h3>
                <div class="space-y-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="h-8 w-8 bg-green-50 text-green-600 rounded-lg flex items-center justify-center text-xs"><i class="fas fa-database"></i></div>
                            <span class="text-xs font-black text-slate-700">Database</span>
                        </div>
                        <span class="text-[10px] font-black text-green-600">GOOD</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="h-8 w-8 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center text-xs"><i class="fas fa-sitemap"></i></div>
                            <span class="text-xs font-black text-slate-700">Sitemap</span>
                        </div>
                        <a href="<?= base_url('sitemap.xml') ?>" target="_blank" class="text-[10px] font-black text-blue-600 hover:underline">XML</a>
                    </div>
                    <div class="pt-6 border-t border-slate-50">
                        <div class="bg-slate-50 rounded-2xl p-4 text-center">
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1">Server Response</span>
                            <span class="text-sm font-black text-slate-800">Optimal (24ms)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<style>
    .dashboard-modern-wrapper {
        animation: fadeIn 0.8s ease-out;
    }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

    .stat-card-premium {
        background: white;
        padding: 24px;
        border-radius: 2rem;
        border: 1px solid #f1f5f9;
        position: relative;
        overflow: hidden;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .stat-card-premium:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        border-color: var(--accent);
    }
    .stat-bg-icon {
        position: absolute;
        top: -10px;
        right: -10px;
        font-size: 80px;
        color: var(--accent);
        opacity: 0.03;
        transition: all 0.4s;
    }
    .stat-card-premium:hover .stat-bg-icon {
        opacity: 0.08;
        transform: scale(1.1) rotate(-10deg);
    }

    .action-card {
        background: white;
        padding: 24px;
        border-radius: 1.5rem;
        border: 1px solid #f1f5f9;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        text-decoration: none !important;
        transition: all 0.3s;
    }
    .action-card:hover {
        background: #0f172a;
        transform: translateY(-5px);
    }
    .action-card:hover span { color: white; }
    .action-icon {
        height: 48px;
        width: 48px;
        border-radius: 1rem;
        display: flex;
        items-center: center;
        justify-content: center;
        font-size: 18px;
        margin-bottom: 16px;
        transition: all 0.3s;
    }
    .action-card:hover .action-icon {
        background: rgba(255,255,255,0.1);
        color: white;
        transform: scale(1.1);
    }
    
    .divide-y > * + * {
        border-top-width: 1px;
    }
</style>
<?= $this->section('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // --- 1. Weekly Dispatch Trends ---
        const weeklyCtx = document.getElementById('weeklyChart').getContext('2d');
        const weeklyGradient = weeklyCtx.createLinearGradient(0, 0, 0, 400);
        weeklyGradient.addColorStop(0, 'rgba(220, 38, 38, 0.4)');
        weeklyGradient.addColorStop(1, 'rgba(220, 38, 38, 0)');

        new Chart(weeklyCtx, {
            type: 'line',
            data: {
                labels: <?= json_encode(array_column($chart_weekly, 'label')) ?>,
                datasets: [{
                    label: 'Articles',
                    data: <?= json_encode(array_column($chart_weekly, 'count')) ?>,
                    borderColor: '#dc2626',
                    borderWidth: 4,
                    backgroundColor: weeklyGradient,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 6,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#dc2626',
                    pointBorderWidth: 2,
                    pointHoverRadius: 8,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { color: '#f1f5f9' }, ticks: { font: { weight: 'bold' } } },
                    x: { grid: { display: false }, ticks: { font: { weight: 'bold' } } }
                }
            }
        });

        // --- 2. Category Distribution ---
        const catCtx = document.getElementById('categoryChart').getContext('2d');
        new Chart(catCtx, {
            type: 'doughnut',
            data: {
                labels: <?= json_encode(array_column($chart_categories, 'label')) ?>,
                datasets: [{
                    data: <?= json_encode(array_column($chart_categories, 'count')) ?>,
                    backgroundColor: ['#dc2626', '#1e3a8a', '#7c3aed', '#ea580c', '#0f172a', '#64748b'],
                    borderWidth: 0,
                    hoverOffset: 20
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '75%',
                plugins: {
                    legend: { position: 'bottom', labels: { usePointStyle: true, font: { weight: 'bold', size: 11 } } }
                }
            }
        });

        console.log("Modern Visual Analytics Initialized.");
    });
</script>
<?= $this->endSection() ?>
<?= $this->endSection() ?>

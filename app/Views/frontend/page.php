<?= $this->extend('frontend/layout') ?>

<?= $this->section('content') ?>

<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        important: true,
    }
</script>

<style>
    .premium-page-banner {
        background: radial-gradient(circle at top left, #1e3a8a 0%, #0f172a 100%);
        padding: 60px 50px;
        position: relative;
        overflow: hidden;
        margin-bottom: 50px;
        color: #fff;
        border-radius: 24px;
        border: 1px solid rgba(255,255,255,0.05);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) both;
    }
    .premium-page-banner::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -20%;
        width: 100%;
        height: 200%;
        background: radial-gradient(circle, rgba(59, 130, 246, 0.15) 0%, transparent 70%);
        filter: blur(60px);
        z-index: 1;
        pointer-events: none;
    }
    .breadcrumb-premium-alt {
        font-size: 10px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: rgba(255,255,255,0.4);
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 25px;
        position: relative;
        z-index: 10;
    }
    .breadcrumb-premium-alt a {
        color: rgba(59, 130, 246, 0.8);
        text-decoration: none;
        transition: all 0.3s;
    }
    .breadcrumb-premium-alt a:hover {
        color: #fff;
    }
    .page-title-main {
        font-size: clamp(32px, 6vw, 56px);
        font-weight: 950;
        letter-spacing: -2px;
        margin: 0 0 15px 0;
        position: relative;
        z-index: 10;
        line-height: 1.1;
    }
    .page-title-main span {
        background: linear-gradient(to right, #60a5fa, #3b82f6);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .page-subtitle {
        font-size: 16px;
        color: rgba(255,255,255,0.6);
        font-weight: 500;
        max-width: 600px;
        position: relative;
        z-index: 10;
        line-height: 1.7;
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .content-area {
        line-height: 1.9;
        font-size: 1.1rem;
        color: #334155;
    }
    .content-area h3 {
        font-weight: 950;
        color: #1e293b;
        margin-top: 3rem;
        letter-spacing: -1px;
        font-size: 1.8rem;
    }
    .sidebar-widget {
        background: #fff;
        border: 1px solid #f1f5f9;
        border-radius: 24px;
        padding: 35px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.02);
        transition: transform 0.3s;
    }
    .sidebar-widget:hover {
        transform: translateY(-5px);
    }
</style>

<div class="container mt-4">
    <div class="premium-page-banner">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="breadcrumb-premium-alt">
                    <a href="<?= base_url() ?>">Home</a> 
                    <i class="fas fa-chevron-right" style="font-size:8px;"></i> 
                    <span><?= esc($page['title']) ?></span>
                </div>
                <h1 class="page-title-main">Everything <span>About</span> <?= esc($page['title']) ?>.</h1>
                <p class="page-subtitle">Learn more about our mission, vision, and the values that drive our commitment to professional journalism.</p>
            </div>
            <div class="col-lg-4 text-end d-none d-lg-block">
                <div style="font-size: 120px; color: rgba(255,255,255,0.03); font-weight: 950; letter-spacing: -8px; line-height: 0.8; transform: rotate(-5deg); pointer-events: none;">
                    <?= strtoupper(substr(esc($page['title']), 0, 3)) ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container pb-80">
    <div class="row g-5">
        <div class="col-lg-8">
            <div class="content-area">
                <?= $page['content'] ?>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="sticky-top" style="top: 100px; z-index: 10;">
                <!-- Social Follow -->
                <div class="sidebar-widget mb-4">
                    <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest mb-6 border-l-4 border-red-600 pl-4">Stay Connected</h3>
                    <div class="grid grid-cols-1 gap-3">
                        <?php if ($fb = get_setting('facebook_url')): ?>
                        <a href="<?= $fb ?>" target="_blank" class="flex items-center gap-3 p-3 rounded-xl bg-[#1877F2]/5 text-[#1877F2] hover:bg-[#1877F2] hover:text-white transition group">
                            <i class="fab fa-facebook-f w-8 h-8 flex items-center justify-center rounded-lg bg-white shadow-sm transition"></i>
                            <span class="font-black text-xs">FACEBOOK</span>
                        </a>
                        <?php endif; ?>

                        <?php if ($ig = get_setting('instagram_url')): ?>
                        <a href="<?= $ig ?>" target="_blank" class="flex items-center gap-3 p-3 rounded-xl bg-[#E4405F]/5 text-[#E4405F] hover:bg-[#E4405F] hover:text-white transition group">
                            <i class="fab fa-instagram w-8 h-8 flex items-center justify-center rounded-lg bg-white shadow-sm transition"></i>
                            <span class="font-black text-xs">INSTAGRAM</span>
                        </a>
                        <?php endif; ?>

                        <?php if ($tw = get_setting('twitter_url')): ?>
                        <a href="<?= $tw ?>" target="_blank" class="flex items-center gap-3 p-3 rounded-xl bg-[#1DA1F2]/5 text-[#1DA1F2] hover:bg-[#1DA1F2] hover:text-white transition group">
                            <i class="fab fa-twitter w-8 h-8 flex items-center justify-center rounded-lg bg-white shadow-sm transition"></i>
                            <span class="font-black text-xs">TWITTER / X</span>
                        </a>
                        <?php endif; ?>

                        <?php if ($yt = get_setting('youtube_url')): ?>
                        <a href="<?= $yt ?>" target="_blank" class="flex items-center gap-3 p-3 rounded-xl bg-[#FF0000]/5 text-[#FF0000] hover:bg-[#FF0000] hover:text-white transition group">
                            <i class="fab fa-youtube w-8 h-8 flex items-center justify-center rounded-lg bg-white shadow-sm transition"></i>
                            <span class="font-black text-xs">YOUTUBE</span>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="sidebar-widget">
                    <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest mb-6 border-l-4 border-red-600 pl-4">In The Spotlight</h3>
                    <div class="space-y-6">
                        <?php if (!empty($navData['trending'])): ?>
                            <?php foreach (array_slice($navData['trending'], 0, 4) as $item): ?>
                                <a href="<?= base_url('news/' . $item['slug']) ?>" class="flex gap-4 group text-decoration-none">
                                    <div class="w-20 h-20 rounded-xl overflow-hidden flex-shrink-0 shadow-sm">
                                        <img src="<?= base_url('uploads/news/' . ($item['image'] ?: 'default.jpg')) ?>" class="w-full h-full object-cover group-hover:scale-110 transition" alt="">
                                    </div>
                                    <div class="flex flex-col justify-center">
                                        <h4 class="text-sm font-black text-slate-800 group-hover:text-red-600 transition leading-snug line-clamp-2">
                                            <?= esc($item['title']) ?>
                                        </h4>
                                        <div class="flex items-center gap-2 mt-1">
                                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-wider"><?= date('M d', strtotime($item['publish_at'])) ?></span>
                                            <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
                                            <span class="text-[9px] font-black text-red-600 uppercase tracking-wider"><?= esc($item['category_slug']) ?></span>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Premium Spotlight Card (Custom for About) -->
                <?php if ($page['slug'] == 'about-us' && !empty($navData['trending'])): $spot = $navData['trending'][0]; ?>
                    <div class="mt-8 relative group cursor-pointer overflow-hidden rounded-3xl bg-slate-900 border border-slate-800 shadow-2xl">
                        <div class="absolute inset-0 opacity-40 group-hover:opacity-60 transition duration-700">
                            <img src="<?= base_url('uploads/news/' . ($spot['image'] ?: 'default.jpg')) ?>" class="w-full h-full object-cover scale-105 group-hover:scale-110 transition duration-1000" alt="">
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/60 to-transparent"></div>
                        <div class="relative p-8 flex flex-col justify-end min-h-[400px]">
                            <div class="mb-4">
                                <span class="bg-red-600 text-white text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest shadow-lg shadow-red-600/40">Must Read</span>
                            </div>
                            <h2 class="text-2xl font-black text-white leading-tight mb-4 group-hover:text-red-100 transition">
                                <?= esc($spot['title']) ?>
                            </h2>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-white/10 backdrop-blur-md flex items-center justify-center border border-white/20">
                                        <i class="fas fa-bolt text-yellow-400 text-xs"></i>
                                    </div>
                                    <span class="text-xs font-bold text-slate-300"><?= esc($spot['total_views'] ?? '2K+') ?> Reads</span>
                                </div>
                                <a href="<?= base_url('news/' . $spot['slug']) ?>" class="text-white text-xs font-black uppercase tracking-widest flex items-center gap-2 group/btn">
                                    Full Story <i class="fas fa-arrow-right group-hover/btn:translate-x-1 transition"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

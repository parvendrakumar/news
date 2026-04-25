<?= $this->extend('frontend/layout') ?>

<?= $this->section('content') ?>

<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        important: true,
    }
</script>

<style>
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
        animation: fadeInUpBanner 0.8s cubic-bezier(0.16, 1, 0.3, 1) both;
    }
    .premium-page-banner::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image: radial-gradient(#ffffff08 1px, transparent 1px);
        background-size: 20px 20px;
        opacity: 0.5;
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
    @keyframes fadeInUpBanner {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .search-card {
        background: #fff;
        border: 1px solid #f1f5f9;
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .search-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(15, 23, 42, 0.06);
        border-color: #3b82f6;
    }
    .sidebar-widget {
        background: #fff;
        border: 1px solid #f1f5f9;
        border-radius: 24px;
        padding: 30px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.02);
    }
</style>

<div class="container mt-4">
    <div class="premium-page-banner">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="breadcrumb-premium-alt">
                    <a href="<?= base_url() ?>" style="color: rgba(59, 130, 246, 0.8); text-decoration: none;">Home</a> 
                    <i class="fas fa-chevron-right" style="font-size:8px;"></i> 
                    <span><?= (isset($is_story_list) ? 'Visual Stories' : 'Search Results') ?></span>
                </div>
                <h1 class="page-title-main">
                    <?php if (isset($is_story_list)): ?>
                        Exploring <span>Visual</span> Stories.
                    <?php elseif ($title == 'Video News'): ?>
                        Exploring <span>Video</span> News.
                    <?php else: ?>
                        Searching for <span>"<?= esc($query) ?>"</span>.
                    <?php endif; ?>
                </h1>
                <p class="page-subtitle">We found <?= count($news) ?> relevant matches across our comprehensive news network, curated specifically for your interests.</p>
            </div>
            <div class="col-lg-4 text-end d-none d-lg-block">
                <div style="font-size: 100px; color: rgba(255,255,255,0.03); font-weight: 950; letter-spacing: -8px; line-height: 0.8; transform: rotate(-5deg); pointer-events: none;">
                    <?= strtoupper(substr(isset($is_story_list) ? 'STORIES' : ($title == 'Video News' ? 'VIDEOS' : 'SEARCH'), 0, 3)) ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container pb-20">
    <div class="row g-4">
        <!-- Main Content -->
        <div class="col-lg-8">
            <div class="row g-4">
                <?php if (!empty($news)): ?>
                    <?php foreach ($news as $item): ?>
                        <div class="col-md-6">
                            <?php 
                                $isStory = ($item['category_slug'] ?? '') == 'visual-stories';
                                $isVideo = ($item['category_slug'] ?? '') == 'video-news';
                                $detailSlug = 'news';
                                if ($isStory) $detailSlug = 'story';
                                if ($isVideo) $detailSlug = 'video';
                            ?>
                            <article class="search-card group h-100 flex flex-col">
                                <div class="relative h-56 overflow-hidden">
                                    <div class="absolute top-4 left-4 z-10">
                                        <span class="bg-red-600 text-white text-[9px] font-black px-3 py-1.5 rounded-lg uppercase tracking-wider">
                                            <?= esc($item['category_slug']) ?>
                                        </span>
                                    </div>
                                    <div class="absolute top-4 right-4 z-10">
                                        <?php 
                                            $isBookmarked = false;
                                            if (isset($bookmarkedStories)) {
                                                $isBookmarked = in_array($item['id'], $bookmarkedStories);
                                            } elseif (isset($bookmarkedNews)) {
                                                $isBookmarked = in_array($item['id'], $bookmarkedNews);
                                            }
                                        ?>
                                        <button class="w-10 h-10 <?= $isBookmarked ? 'bg-red-600 text-white' : 'bg-white/90 text-slate-800' ?> backdrop-blur-md rounded-xl flex items-center justify-center shadow-sm hover:scale-110 transition list-bookmark-btn" 
                                                data-id="<?= $item['id'] ?>" 
                                                data-type="<?= $isStory ? 'story' : 'news' ?>">
                                            <i class="<?= $isBookmarked ? 'fas' : 'far' ?> fa-bookmark"></i>
                                        </button>
                                    </div>
                                    <a href="<?= base_url($detailSlug . '/' . $item['slug']) ?>" class="block h-full">
                                        <?php 
                                            $imgPrefix = 'uploads/news/';
                                            if (isset($item['thumbnail'])) $imgPrefix = 'uploads/videos/';
                                            elseif (($item['category_slug'] ?? '') == 'visual-stories' || isset($is_dedicated_story)) $imgPrefix = 'uploads/stories/';
                                        ?>
                                        <img src="<?= base_url($imgPrefix . ($item['image'] ?: 'default.jpg')) ?>" 
                                             class="w-full h-full object-cover transition duration-700 group-hover:scale-110" alt="">
                                    </a>
                                </div>
                                <div class="p-6 flex-grow flex flex-col">
                                    <div class="flex items-center gap-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-3">
                                        <i class="far fa-calendar-alt text-red-500"></i>
                                        <?= date('M d, Y', strtotime($item['publish_at'])) ?>
                                    </div>
                                    <h3 class="text-lg font-black text-slate-900 leading-snug mb-3 line-clamp-2 transition hover:text-red-600">
                                        <a href="<?= base_url($detailSlug . '/' . $item['slug']) ?>" class="text-decoration-none text-current"><?= esc($item['title']) ?></a>
                                    </h3>
                                    <p class="text-slate-500 text-sm leading-relaxed mb-4 line-clamp-3 font-medium">
                                        <?= character_limiter(strip_tags($item['description'] ?? ''), 130) ?>
                                    </p>
                                    <div class="mt-auto pt-4 border-t border-slate-50">
                                        <a href="<?= base_url($detailSlug . '/' . $item['slug']) ?>" class="inline-flex items-center gap-2 text-[11px] font-black text-red-600 uppercase tracking-widest hover:gap-4 transition-all">
                                            Full Coverage <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="text-center py-20 px-10 bg-slate-50 rounded-[2.5rem] border border-slate-100">
                            <div class="w-24 h-24 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-6">
                                <i class="fas fa-search-minus text-3xl"></i>
                            </div>
                            <h3 class="text-2xl font-black text-slate-900 mb-2">No matching stories found</h3>
                            <p class="text-slate-500 font-bold text-sm mb-8 max-w-md mx-auto">We couldn't find anything matching your search. Try searching for broader terms or categories.</p>
                            
                            <div class="max-w-md mx-auto">
                                <form action="<?= base_url('search') ?>" method="GET" class="relative">
                                    <input type="text" name="q" placeholder="Search again..." 
                                           class="w-full pl-6 pr-32 py-4 bg-white border border-slate-200 rounded-2xl font-bold text-sm focus:ring-4 focus:ring-red-100 focus:border-red-600 transition outline-none">
                                    <button type="submit" class="absolute right-2 top-2 bottom-2 px-6 bg-red-600 text-white text-xs font-black uppercase rounded-xl hover:bg-red-700 transition">
                                        Search
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Pagination -->
            <?php if (!empty($news)): ?>
            <div class="mt-12 flex justify-center">
                <?= $pager->links() ?>
            </div>
            <?php endif; ?>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="sticky-top" style="top: 100px; z-index: 10;">
                <!-- Search Again Widget -->
                <div class="sidebar-widget mb-4">
                    <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest mb-6 border-l-4 border-red-600 pl-4">Refine Search</h3>
                    <form action="<?= base_url('search') ?>" method="GET" class="relative">
                        <input type="text" name="q" value="<?= esc($query) ?>" placeholder="Type keywords..." 
                               class="w-full px-5 py-3 bg-slate-50 border border-slate-100 rounded-xl font-bold text-sm focus:bg-white focus:ring-4 focus:ring-red-100 focus:border-red-600 transition outline-none">
                        <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-red-600 transition">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>

                <!-- Stay Connected Widget -->
                <div class="sidebar-widget mb-4" style="padding: 0; border: none; background: transparent; box-shadow: none;">
                    <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest mb-6 border-l-4 border-red-600 pl-4">Stay Connected</h3>
                    <div class="grid grid-cols-1 gap-3">
                        <?php 
                        $socialLinks = [
                            ['id' => 'fb', 'label' => 'FACEBOOK', 'icon' => 'fab fa-facebook-f', 'url' => get_setting('facebook_url'), 'bg' => '#1877F2', 'light' => 'rgba(24, 119, 242, 0.08)'],
                            ['id' => 'ig', 'label' => 'INSTAGRAM', 'icon' => 'fab fa-instagram', 'url' => get_setting('instagram_url'), 'bg' => '#E4405F', 'light' => 'rgba(228, 64, 95, 0.08)'],
                            ['id' => 'tw', 'label' => 'TWITTER / X', 'icon' => 'fab fa-twitter', 'url' => get_setting('twitter_url'), 'bg' => '#1DA1F2', 'light' => 'rgba(29, 161, 242, 0.08)'],
                            ['id' => 'yt', 'label' => 'YOUTUBE', 'icon' => 'fab fa-youtube', 'url' => get_setting('youtube_url'), 'bg' => '#FF0000', 'light' => 'rgba(255, 0, 0, 0.08)']
                        ];
                        foreach ($socialLinks as $soc): if ($soc['url']):
                        ?>
                        <a href="<?= $soc['url'] ?>" target="_blank" class="flex items-center gap-4 p-4 rounded-2xl transition-all duration-500 group no-underline" style="background: <?= $soc['light'] ?>; border: 1px solid rgba(255,255,255,0.1);">
                            <span class="w-10 h-10 flex items-center justify-center rounded-xl bg-white shadow-sm group-hover:scale-110 group-hover:rotate-6 transition-all duration-500" style="color: <?= $soc['bg'] ?>;">
                                <i class="<?= $soc['icon'] ?> text-lg"></i>
                            </span>
                            <div class="flex flex-col">
                                <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest group-hover:text-slate-600 transition-colors"><?= $soc['label'] ?></span>
                                <span class="text-[11px] font-black text-slate-900 group-hover:text-red-600 transition-colors">Follow News</span>
                            </div>
                            <i class="fas fa-chevron-right ms-auto text-[10px] text-slate-300 group-hover:translate-x-1 group-hover:text-red-600 transition-all"></i>
                        </a>
                        <?php endif; endforeach; ?>
                    </div>
                </div>

                <!-- Trending Selection -->
                <div class="sidebar-widget">
                    <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest mb-6 border-l-4 border-red-600 pl-4">In The Spotlight</h3>
                    <div class="space-y-6">
                        <?php if (!empty($navData['trending'])): ?>
                            <?php foreach (array_slice($navData['trending'], 0, 3) as $item): ?>
                                <a href="<?= base_url('news/' . $item['slug']) ?>" class="flex gap-4 group text-decoration-none">
                                    <div class="w-16 h-16 rounded-xl overflow-hidden flex-shrink-0">
                                        <img src="<?= base_url('uploads/news/' . ($item['image'] ?: 'default.jpg')) ?>" class="w-full h-full object-cover group-hover:scale-110 transition" alt="">
                                    </div>
                                    <div class="flex flex-col justify-center">
                                        <h4 class="text-sm font-black text-slate-800 group-hover:text-red-600 transition leading-snug line-clamp-2">
                                            <?= esc($item['title']) ?>
                                        </h4>
                                        <span class="text-[9px] font-black text-slate-400 uppercase mt-1 tracking-wider"><?= date('M d', strtotime($item['publish_at'])) ?></span>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/js/vendor/jquery-1.12.4.min.js') ?>"></script>
<script>
$(document).ready(function() {
    $('.list-bookmark-btn').on('click', function(e) {
        e.preventDefault();
        <?php if (!session()->get('isLoggedIn')): ?>
            window.location.href = '<?= base_url('login') ?>';
            return;
        <?php endif; ?>

        var btn = $(this);
        var id = btn.data('id');
        var type = btn.data('type');
        
        btn.css('opacity', '0.5');

        var postData = {
            <?= csrf_token() ?>: '<?= csrf_hash() ?>'
        };
        if (type === 'story') {
            postData.story_id = id;
        } else {
            postData.news_id = id;
        }

        $.post('<?= base_url('user/bookmark/toggle') ?>', postData, function(res) {
            btn.css('opacity', '1');
            if (res.status === 'success') {
                if (res.action === 'added') {
                    btn.removeClass('bg-white/90 text-slate-800').addClass('bg-red-600 text-white');
                    btn.find('i').removeClass('far').addClass('fas');
                } else {
                    btn.removeClass('bg-red-600 text-white').addClass('bg-white/90 text-slate-800');
                    btn.find('i').removeClass('fas').addClass('far');
                }
            }
        });
    });
});
</script>

<?= $this->endSection() ?>

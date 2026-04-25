<?= $this->extend('frontend/layout') ?>

<?= $this->section('content') ?>

<style>
    /* ── Premium Category Layout ── */
    :root {
        --text-pure: #0f172a;
        --text-muted: #64748b;
        --accent-red: #dc2626;
        --bg-gray: #f8fafc;
        --border-light: #e2e8f0;
    }

    body { background-color: #fff; }

    /* ── Immersive Category Header ── */
    .premium-category-banner {
        background: radial-gradient(circle at top left, #1e3a8a 0%, #0f172a 100%);
        padding: 35px 40px;
        position: relative;
        overflow: hidden;
        margin-bottom: 30px;
        color: #fff;
        border-radius: 20px;
        border: 1px solid rgba(255,255,255,0.05);
        box-shadow: 0 15px 30px -10px rgba(0, 0, 0, 0.4);
    }
    
    @media (max-width: 768px) {
        .premium-category-banner {
            padding: 30px 20px;
            margin-bottom: 25px;
            border-radius: 16px;
        }
    }

    .premium-category-banner::before {
        content: ''; position: absolute; top: -50%; left: -20%;
        width: 100%; height: 200%; background: radial-gradient(circle, rgba(59, 130, 246, 0.12) 0%, transparent 70%); filter: blur(50px);
        z-index: 1; pointer-events: none;
    }

    .breadcrumb-premium { font-size: 9px; font-weight: 800; text-transform: uppercase; letter-spacing: 1.2px; color: rgba(255,255,255,0.4); display: flex; align-items: center; gap: 8px; flex-wrap: wrap; margin-bottom: 15px; position: relative; z-index: 10; }
    .breadcrumb-premium a { color: rgba(59, 130, 246, 0.7); text-decoration: none; transition: all 0.3s; }
    .breadcrumb-premium a:hover { color: #fff; }
    
    .category-title { font-size: clamp(26px, 5vw, 44px); font-weight: 950; letter-spacing: -1.5px; margin: 0 0 10px 0; position: relative; z-index: 10; line-height: 1.1; }
    .category-title span { background: linear-gradient(to right, #60a5fa, #3b82f6); -webkit-background-clip: text; -webkit-text-fill-color: transparent; filter: drop-shadow(0 0 10px rgba(96, 165, 250, 0.2)); } 
    .category-desc { font-size: 15px; color: rgba(255,255,255,0.6); font-weight: 500; max-width: 550px; position: relative; z-index: 10; line-height: 1.6; }

    @media (max-width: 768px) {
        .category-title { font-size: 28px; letter-spacing: -1px; }
        .category-desc { font-size: 13px; }
    }

    /* ── News Grid Architecture ── */
    .news-card-pro { background: #fff; border-radius: 20px; overflow: hidden; display: flex; flex-direction: column; height: 100%; border: 1px solid var(--border-light); transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1); position: relative; box-shadow: 0 4px 10px rgba(0,0,0,0.02); }
    .news-card-pro:hover { transform: translateY(-8px); box-shadow: 0 20px 40px rgba(0,0,0,0.08); border-color: transparent; }
    
    .news-card-pro .nc-thumb { height: 240px; position: relative; overflow: hidden; }
    .news-card-pro .nc-thumb img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.7s; }
    .news-card-pro:hover .nc-thumb img { transform: scale(1.08); }

    @media (max-width: 768px) {
        .news-card-pro .nc-thumb { height: 130px; }
        .nc-badge { top: 10px !important; left: 10px !important; padding: 3px 8px !important; font-size: 8px !important; }
        .nc-badge i { display: none; }
    }
    
    .nc-badge { position: absolute; top: 20px; left: 20px; background: rgba(0,0,0,0.7); backdrop-filter: blur(10px); color: #fff; font-size: 10px; font-weight: 900; padding: 6px 14px; border-radius: 30px; text-transform: uppercase; letter-spacing: 1px; z-index: 5; border: 1px solid rgba(255,255,255,0.1); }
    
    .nc-content { padding: 25px; display: flex; flex-direction: column; flex-grow: 1; }
    @media (max-width: 768px) { 
        .nc-content { padding: 12px; }
        .nc-content p { display: none; }
        .nc-content h3 { font-size: 14px !important; margin-bottom: 8px !important; height: 40px; }
        .nc-meta { font-size: 9px !important; margin-bottom: 6px !important; }
        .nc-footer { padding-top: 8px !important; }
        .nc-footer .author-meta { display: none !important; }
        .read-more-btn { font-size: 9px !important; }
    }

    .nc-meta { font-size: 12px; font-weight: 800; color: var(--text-muted); text-transform: uppercase; margin-bottom: 12px; display: flex; align-items: center; gap: 8px; }
    .nc-meta i { color: var(--accent-red); }
    
    .nc-content h3 { font-size: clamp(17px, 4vw, 19px); font-weight: 900; line-height: 1.4; color: var(--text-pure); margin-bottom: 15px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
    .nc-content p { font-size: 14px; color: #475569; line-height: 1.6; margin-bottom: 20px; flex-grow: 1; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    
    .nc-footer { display: flex; align-items: center; justify-content: space-between; border-top: 1px solid var(--border-light); padding-top: 15px; margin-top: auto; }
    .read-more-btn { font-size: 11px; font-weight: 900; color: var(--text-pure); text-transform: uppercase; letter-spacing: 1px; text-decoration: none; display: flex; align-items: center; gap: 5px; transition: color 0.3s; }
    .news-card-pro:hover .read-more-btn { color: var(--accent-red); }
    .read-more-btn i { font-size: 14px; transition: transform 0.3s; }
    .news-card-pro:hover .read-more-btn i { transform: translateX(4px); }

    /* ── Sidebars ── */
    .side-widget { background: #fff; border: 1px solid var(--border-light); border-radius: 20px; padding: 30px; margin-bottom: 40px; box-shadow: 0 10px 30px rgba(0,0,0,0.02); }
    @media (max-width: 768px) { .side-widget { padding: 20px; } }

    .side-title { font-size: 18px; font-weight: 950; letter-spacing: -0.5px; text-transform: uppercase; color: var(--text-pure); margin-bottom: 25px; position: relative; padding-bottom: 15px; }
    .side-title::after { content: ''; position: absolute; bottom: 0; left: 0; width: 40px; height: 3px; background: var(--accent-red); border-radius: 5px; }
    
    .side-social-item { display: flex; align-items: center; justify-content: space-between; padding: 15px; border-radius: 12px; margin-bottom: 12px; color: #fff !important; text-decoration: none !important; transition: transform 0.3s; box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
    .side-social-item:hover { transform: scale(1.02); filter: brightness(1.1); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
    .ss-left { display: flex; align-items: center; gap: 12px; font-size: 14px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; }
    .ss-left i { font-size: 22px; width: 25px; text-align: center; }
    .ss-right { font-size: 11px; font-weight: 900; background: rgba(0,0,0,0.2); padding: 4px 10px; border-radius: 20px; }

    .side-related-item { display: flex; gap: 15px; padding: 15px 0; border-bottom: 1px solid var(--border-light); text-decoration: none !important; transition: transform 0.3s; }
    .side-related-item:hover { transform: translateX(5px); }
    .side-related-item:last-child { border-bottom: none; }
    .sri-thumb { width: 85px; height: 70px; border-radius: 10px; overflow: hidden; flex-shrink: 0; }
    .sri-thumb img { width: 100%; height: 100%; object-fit: cover; }
    .sri-text h5 { font-size: 13px; font-family: 'Inter', sans-serif; font-weight: 800; color: var(--text-pure); line-height: 1.4; margin: 0 0 5px 0; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; transition: color 0.3s; }
    .side-related-item:hover .sri-text h5 { color: var(--accent-red); }
    .sri-text span { font-size: 10px; color: var(--text-muted); font-weight: 800; text-transform: uppercase; }

    /* ── Premium Pagination ── */
    .pagination-area { margin-top: 60px !important; }
    .pagination-area .pagination { gap: 10px; border: none; }
    
    .pagination-area .page-item { border: none; }
    .pagination-area .page-item .page-link {
        border: none;
        background: #f1f5f9;
        color: var(--text-pure);
        font-weight: 800;
        font-size: 13px;
        width: 42px;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    .pagination-area .page-item .page-link:hover {
        background: var(--text-pure);
        color: #fff;
        transform: translateY(-3px) scale(1.1);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }

    .pagination-area .page-item.active .page-link {
        background: linear-gradient(135deg, #1e3a8a 0%, #1e1b4b 100%);
        color: #fff;
        box-shadow: 0 10px 20px -5px rgba(30, 58, 138, 0.4);
        transform: scale(1.1);
        z-index: 10;
    }

    .pagination-area .page-item:first-child .page-link,
    .pagination-area .page-item:last-child .page-link {
        width: auto;
        padding: 0 20px;
        border-radius: 30px;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 11px;
    }

    @media (max-width: 768px) {
        .pagination-area { margin-top: 40px !important; }
        .pagination-area .pagination { gap: 6px; }
        .pagination-area .page-item .page-link {
            width: 36px;
            height: 36px;
            font-size: 12px;
            border-radius: 10px;
        }
        .pagination-area .page-item:first-child .page-link,
        .pagination-area .page-item:last-child .page-link {
            padding: 0 15px;
            font-size: 10px;
        }
    }
</style>

<div class="container mt-4">
    <div class="premium-category-banner">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="breadcrumb-premium">
                    <a href="<?= base_url() ?>">Home</a> 
                    <i class="fas fa-chevron-right" style="font-size:8px;"></i> 
                    <a href="#">Category Directory</a>
                    <i class="fas fa-chevron-right" style="font-size:8px;"></i> 
                    <span><?= esc($category['title']) ?></span>
                </div>
                <h1 class="category-title">Exploring <span><?= esc($category['title']) ?></span>.</h1>
                <p class="category-desc" style="margin-bottom:0;">Dive deep into the most significant stories and breaking updates defining the <?= esc($category['title']) ?> landscape today.</p>
            </div>
            <div class="col-lg-4 text-end d-none d-lg-block">
                <div style="font-size: 80px; color: rgba(255,255,255,0.03); font-weight: 950; letter-spacing: -5px; line-height: 0.8; transform: rotate(-5deg) translateY(10px);">
                    <?= strtoupper(substr(esc($category['title']), 0, 3)) ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Ad Billboard -->
<?php 
    $headerAds = get_ads('CATEGORY_HEADER_ADS', $category['id']); 
    if (empty($headerAds)) $headerAds = get_ads('CATEGORY_ADS', $category['id']);
    if (empty($headerAds)) $headerAds = get_ads('Category', $category['id']);
    if (!empty($headerAds)): 
?>
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div style="width: 100%; border-radius: 16px; overflow: hidden; background: #fff; border: 1px solid var(--border-light); text-align: center; padding: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.02);">
                <span style="font-size: 8px; font-weight: 900; color: var(--text-muted); text-transform: uppercase; letter-spacing: 2px; display: block; margin-bottom: 10px;">Advertisement Placement</span>
                <?php foreach ($headerAds as $ad): ?>
                    <?php if ($ad['ad_type'] == 'image'): ?>
                        <a href="<?= $ad['link'] ?>" target="_blank" class="d-inline-block">
                            <img src="<?= base_url('uploads/ads/' . $ad['image']) ?>" style="max-width: 100%; height: auto; border-radius: 8px;">
                        </a>
                    <?php else: ?>
                        <?= $ad['custom_code'] ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<div class="container pb-5">
    <div class="row">
        <!-- Main News Column -->
        <div class="col-lg-8">
            <div class="row g-3 g-md-4">
                <?php if (!empty($news)): ?>
                    <?php foreach ($news as $item): ?>
                        <div class="col-6 col-md-6 d-flex">
                            <article class="news-card-pro w-100">
                                <div class="nc-thumb">
                                    <span class="nc-badge"><i class="fas fa-layer-group me-1"></i> <?= esc($category['title']) ?></span>
                                    <a href="<?= base_url('news/' . $item['slug']) ?>">
                                        <img src="<?= base_url('uploads/news/' . ($item['image'] ?: 'default.jpg')) ?>" alt="<?= esc($item['title']) ?>">
                                    </a>
                                </div>
                                <div class="nc-content">
                                    <div class="nc-meta">
                                        <i class="far fa-calendar-alt"></i> <?= date('M d, Y', strtotime($item['publish_at'])) ?>
                                    </div>
                                    <a href="<?= base_url('news/' . $item['slug']) ?>" style="text-decoration:none;">
                                        <h3><?= esc($item['title']) ?></h3>
                                    </a>
                                    <p><?= character_limiter(strip_tags($item['description'] ?? ''), 110) ?></p>
                                    
                                    <div class="nc-footer">
                                        <div class="author-meta" style="display:flex; align-items:center; gap:8px;">
                                            <div style="width:25px; height:25px; border-radius:50%; background:var(--bg-gray); display:flex; align-items:center; justify-content:center; font-size:10px; font-weight:900; color:var(--text-pure);"><?= strtoupper(substr(esc($item['custom_author'] ?? 'E'), 0, 1)) ?></div>
                                            <span style="font-size:11px; font-weight:800; color:var(--text-pure);"><?= esc($item['custom_author'] ?? 'Editorial') ?></span>
                                        </div>
                                        <a href="<?= base_url('news/' . $item['slug']) ?>" class="read-more-btn">Read <i class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </article>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12 text-center" style="padding: 100px 0;">
                        <div style="font-size: 80px; color: var(--border-light); margin-bottom: 20px;"><i class="fas fa-folder-open"></i></div>
                        <h4 style="color: var(--text-pure); font-weight: 900; font-size: 24px;">No stories available directly.</h4>
                        <p style="color: var(--text-muted); font-size: 15px; max-width: 400px; margin: 0 auto 25px;">It seems the editorial desk is currently working on stories for this category. Check back later.</p>
                        <a href="<?= base_url() ?>" style="background: var(--text-pure); color: #fff; padding: 12px 25px; border-radius: 40px; font-size: 12px; font-weight: 900; text-transform: uppercase; text-decoration: none;">Return Homepage</a>
                    </div>
                <?php endif; ?>
            </div>
            
            <!-- Pagination -->
            <div class="pagination-area mt-5 mb-5 d-flex justify-content-center">
                <?= $pager->links() ?>
            </div>
        </div>

        <!-- Sidebar Streamlined -->
        <div class="col-lg-4 ps-lg-4">
            
            <!-- Connect Widget -->
            <div class="side-widget">
                <h4 class="side-title">Connect <span style="color:var(--text-muted); font-weight:400;">With Us</span></h4>
                <div class="side-social-links">
                    <?php if ($fb = get_setting('facebook_url')): ?>
                    <a href="<?= $fb ?>" target="_blank" class="side-social-item" style="background: #1877f2;">
                        <span class="ss-left"><i class="fab fa-facebook-f"></i> Facebook</span><span class="ss-right">24K</span>
                    </a>
                    <?php endif; ?>
                    <?php if ($ig = get_setting('instagram_url')): ?>
                    <a href="<?= $ig ?>" target="_blank" class="side-social-item" style="background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);">
                        <span class="ss-left"><i class="fab fa-instagram"></i> Instagram</span><span class="ss-right">52K</span>
                    </a>
                    <?php endif; ?>
                    <?php if ($tw = get_setting('twitter_url')): ?>
                    <a href="<?= $tw ?>" target="_blank" class="side-social-item" style="background: #1da1f2;">
                        <span class="ss-left"><i class="fab fa-twitter"></i> Twitter</span><span class="ss-right">18K</span>
                    </a>
                    <?php endif; ?>
                    <?php if ($yt = get_setting('youtube_url')): ?>
                    <a href="<?= $yt ?>" target="_blank" class="side-social-item" style="background: #ff0000;">
                        <span class="ss-left"><i class="fab fa-youtube"></i> YouTube</span><span class="ss-right">120K</span>
                    </a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Trending Widget -->
            <div class="side-widget">
                <h4 class="side-title">Trending <span style="color:var(--text-muted); font-weight:400;">Now</span></h4>
                <div class="vertical-trending-slider-cat">
                    <?php foreach ($trending as $item): ?>
                    <div class="trending-slide-item">
                        <a href="<?= base_url('news/' . $item['slug']) ?>" class="side-related-item">
                            <div class="sri-thumb"><img src="<?= base_url('uploads/news/' . ($item['image'] ?: 'default.jpg')) ?>" alt=""></div>
                            <div class="sri-text">
                                <h5><?= esc($item['title']) ?></h5>
                                <span><i class="fas fa-bolt text-warning"></i> <?= esc($item['category_slug']) ?></span>
                            </div>
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Direct Advertisement Slider -->
            <?php $sidebarAds = get_ads('SIDEBAR_PREMIUM_SLOT', $category['id']); if (!empty($sidebarAds)): ?>
            <div class="side-widget">
                <h4 class="side-title">Direct <span style="color:var(--text-muted); font-weight:400;">Ad</span></h4>
                <div style="border-radius:12px; overflow:hidden; border: 1px solid var(--border-light);">
                    <?php foreach ($sidebarAds as $ad): ?>
                        <?php if ($ad['ad_type'] == 'image'): ?>
                            <a href="<?= $ad['link'] ?>" target="_blank">
                                <img src="<?= base_url('uploads/ads/' . $ad['image']) ?>" style="width: 100%; height: auto; display: block;">
                            </a>
                        <?php else: ?>
                            <?= $ad['custom_code'] ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
            
            <!-- Quick Newsletter -->
            <div class="side-widget" style="background: #000; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.15); color: #fff;">
                <h4 style="font-size: 18px; font-weight: 900; margin-bottom: 15px; color: #fff;">Weekly <span style="color: var(--accent-red);">Curated</span></h4>
                <p style="font-size: 13px; color: #94a3b8; font-weight: 600; margin-bottom: 20px;">The biggest <?= esc($category['title']) ?> updates wrapped up and delivered directly into your inbox every Sunday.</p>
                <form action="<?= base_url('newsletter/subscribe') ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="d-flex" style="background: rgba(255,255,255,0.1); border-radius: 40px; padding: 4px;">
                        <input type="email" name="email" placeholder="Your Email..." required style="background: transparent; border: none; outline: none; padding: 10px 15px; color: #fff; font-size: 12px; font-weight: 700; width: 100%;">
                        <button type="submit" style="background: var(--text-pure); border: 1px solid rgba(255,255,255,0.1); color: #fff; border-radius: 40px; padding: 0 15px; font-size: 11px; font-weight: 900; text-transform: uppercase;">GO</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        $('.vertical-trending-slider-cat').slick({
            vertical: true,
            verticalSwiping: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 3000,
            arrows: false,
            dots: false,
            infinite: true,
            pauseOnHover: true
        });
    });
</script>
<?= $this->endSection() ?>

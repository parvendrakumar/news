<?= $this->extend('frontend/layout') ?>

<?= $this->section('content') ?>

<style>
/* ── Section headings ── */
.sec-head { border-left: 5px solid #dc2626; padding-left: 12px; margin-bottom: 20px; }
.sec-head h3 { font-size: 20px; font-weight: 800; margin: 0; color: #1a1a1a; text-transform: uppercase; }
.sec-head a  { font-size: 10px; font-weight: 900; color: #9ca3af; text-decoration: none; letter-spacing: 1px; }
.sec-head a:hover { color: #dc2626; }

/* ── Hero image ── */
.hero-img     { width: 100%; height: 420px; object-fit: cover; display: block; border-radius: 8px; }
.hero-wrap    { position: relative; border-radius: 8px; overflow: hidden; }
.hero-cap     { position: absolute; bottom: 0; left: 0; right: 0; padding: 24px; background: linear-gradient(transparent, rgba(0,0,0,.85)); }
.hero-cap h2  { margin: 0; font-size: 22px; font-weight: 800; }
.hero-cap h2 a{ color: #fff; text-decoration: none; }
.hero-cap h2 a:hover { color: #fca5a5; }
.hero-badge   { display: inline-block; background: #dc2626; color: #fff; font-size: 10px; font-weight: 900; padding: 2px 8px; border-radius: 4px; text-transform: uppercase; margin-bottom: 8px; }
.hero-desc    { color: #d1d5db; font-size: 13px; margin-top: 6px; margin-bottom: 0; }

/* ── Visual Stories ── */
.story-outer  { text-align: center; }
.story-ring   { width: 80px; height: 80px; border-radius: 50%; border: 3px solid #dc2626; padding: 2px; margin: 0 auto; overflow: hidden; transition: transform .3s; }
.story-ring:hover { transform: scale(1.03); }
.story-ring img { width: 100%; height: 100%; border-radius: 50%; object-fit: cover; display: block; }
.story-title  { font-size: 10px; font-weight: 800; margin-top: 6px; line-height: 1.3; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; }

/* ── Trending sidebar ── */
.trend-item   { display: flex; gap: 10px; align-items: flex-start; border-bottom: 1px solid #f3f4f6; padding-bottom: 12px; margin-bottom: 12px; }
.trend-thumb  { width: 80px; height: 64px; object-fit: cover; border-radius: 6px; flex-shrink: 0; }
.trend-cat    { font-size: 9px; font-weight: 900; color: #dc2626; text-transform: uppercase; letter-spacing: 1px; display: block; }
.trend-title  { font-size: 12px; font-weight: 700; line-height: 1.3; margin: 0; }
.trend-title a{ color: #1a1a1a; text-decoration: none; }
.trend-title a:hover { color: #dc2626; }

/* ── Video section ── */
.video-section { background: #111; border-radius: 20px; padding: 30px; margin: 40px 0; }
.video-section h3 { color: #fff; font-size: 26px; font-weight: 900; font-style: italic; margin: 0 0 24px; }
.video-section h3 span { color: #dc2626; }
.video-card   { position: relative; border-radius: 10px; overflow: hidden; background: #000; }
.video-card img { width: 100%; height: 160px; object-fit: cover; display: block; opacity: .75; transition: opacity .3s; }
.video-card:hover img { opacity: .5; }
.play-btn     { position: absolute; top: 50%; left: 50%; transform: translate(-50%,-50%); color: #fff; font-size: 38px; pointer-events: none; }
.video-cap    { padding: 8px; }
.video-cap h4 { font-size: 12px; font-weight: 700; color: #fff; margin: 0; line-height: 1.3; }

/* ── Category grids ── */
.cat-major-img  { width: 100%; height: 180px; object-fit: cover; display: block; border-radius: 10px; }
.cat-major-wrap { position: relative; border-radius: 10px; overflow: hidden; margin-bottom: 12px; }
.cat-major-cap  { position: absolute; bottom: 0; left: 0; right: 0; padding: 12px; background: linear-gradient(transparent, rgba(0,0,0,.8)); }
.cat-major-cap h4 { font-size: 13px; font-weight: 700; margin: 0; }
.cat-major-cap h4 a { color: #fff; text-decoration: none; }
.cat-minor    { display: flex; gap: 10px; align-items: center; border-bottom: 1px solid #f0f0f0; padding-bottom: 10px; margin-bottom: 10px; min-height: 64px; overflow: hidden; }
.cat-minor-thumb { width: 72px; height: 56px; object-fit: cover; border-radius: 6px; flex-shrink: 0; }
.cat-minor-title { font-size: 11px; font-weight: 700; line-height: 1.3; margin: 0; }
.cat-minor-title a { color: #1a1a1a; text-decoration: none; }
.cat-minor-title a:hover { color: #dc2626; }
.cat-minor-date  { font-size: 9px; color: #9ca3af; text-transform: uppercase; font-weight: 900; letter-spacing: 1px; }
</style>

<div style="padding: 20px 0;">
  <div class="container">

    <!-- ① BIG NEWS TICKER -->
    <div class="row mb-4">
      <div class="col-12">
        <div class="premium-breaking-ticker" style="background: #fff; border: 1px solid #f0f0f0; border-radius: 8px; display: flex; align-items: center; box-shadow: 0 4px 15px rgba(0,0,0,0.04); overflow: hidden; height: 46px;">
          
          <div class="ticker-label-modern" style="background: linear-gradient(90deg, #dc2626, #b91c1c); color: #fff; font-weight: 900; font-size: 11px; padding: 0 20px; height: 100%; display: flex; align-items: center; justify-content: center; text-transform: uppercase; letter-spacing: 1px; z-index: 2; position: relative; box-shadow: 4px 0 15px rgba(220, 38, 38, 0.3);">
            <i class="fas fa-bolt flash-icon" style="margin-right: 8px; font-size: 14px;"></i> BIG NEWS
          </div>

          <div class="ticker-scroll-area" style="flex: 1; overflow: hidden; white-space: nowrap; position: relative; height: 100%; display: flex; align-items: center;">
            <div class="fade-left" style="position: absolute; left: 0; top: 0; bottom: 0; width: 40px; background: linear-gradient(to right, #fff, transparent); z-index: 1;"></div>
            <div class="fade-right" style="position: absolute; right: 0; top: 0; bottom: 0; width: 40px; background: linear-gradient(to left, #fff, transparent); z-index: 1;"></div>
            
            <div id="js-news-marquee" style="display: inline-block; padding-left: 100%; animation: marquee-ticker 35s linear infinite;">
              <?php foreach ($bigNews as $b): ?>
                <a href="<?= base_url('news/' . $b['slug'] ?? '#') ?>" class="news-item-modern" style="color: #111; font-weight: 700; font-size: 13px; text-decoration: none; margin-right: 10px; display: inline-flex; align-items: center;">
                    <?= esc($b['title']) ?>
                    <span class="ticker-separator" style="color: #dc2626; opacity: 0.5; margin: 0 25px; font-size: 18px;">•</span>
                </a>
              <?php endforeach; ?>
            </div>
          </div>

        </div>
      </div>
    </div>

    <style>
      @keyframes marquee-ticker {
        0% { transform: translateX(0); }
        100% { transform: translateX(-100%); }
      }
      #js-news-marquee:hover { animation-play-state: paused; }
      
      @keyframes flash-bolt {
        0%, 100% { opacity: 1; text-shadow: 0 0 10px rgba(255,255,255,0.8); }
        50% { opacity: 0.6; text-shadow: none; }
      }
      .flash-icon { animation: flash-bolt 1.5s infinite; }
      .news-item-modern:hover { color: #dc2626 !important; }
      .news-item-modern:last-child .ticker-separator { display: none; }

      @media only screen and (max-width: 767px) {
        .ticker-label-modern { padding: 0 12px; font-size: 9px; }
        .ticker-label-modern i { margin-right: 5px; font-size: 12px; }
        .news-item-modern { font-size: 11px; }
      }
      
      /* ── Ad Styling ── */
      .ad-billboard { width: 100%; margin: 25px 0; border-radius: 12px; overflow: hidden; background: #f9fafb; border: 1px solid #f0f0f0; text-align: center; }
      .ad-sidebar   { width: 100%; margin-top: 30px; border-radius: 16px; overflow: hidden; background: #fff; border: 1px solid #eee; box-shadow: 0 4px 15px rgba(0,0,0,0.03); }
      .ad-label     { font-size: 8px; font-weight: 900; color: #9ca3af; text-transform: uppercase; letter-spacing: 1px; padding: 4px; border-bottom: 1px solid #f9fafb; display: block; }
    </style>

    <!-- Ad Billboard: HOME_TOP_BANNER -->
    <?php $topAds = get_ads('HOME_TOP_BANNER'); if (!empty($topAds)): ?>
    <div class="row row-gap-fix">
        <div class="col-12">
            <div class="ad-billboard">
                <span class="ad-label">Advertisement</span>
                <?php foreach ($topAds as $ad): ?>
                    <?php if ($ad['ad_type'] == 'image'): ?>
                        <a href="<?= $ad['link'] ?>" target="_blank">
                            <img src="<?= base_url('uploads/ads/' . $ad['image']) ?>" style="max-width: 100%; height: auto; display: block; margin: 0 auto;">
                        </a>
                    <?php else: ?>
                        <?= $ad['custom_code'] ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- ② HERO + SIDEBAR -->
    <div class="row row-gap-fix">
      <!-- Hero Carousel & Highlights -->
      <div class="col-lg-8">
        <?php if (!empty($latest)): ?>
        <div class="owl-carousel hero-carousel mb-4" style="border-radius: 12px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
          <?php foreach ($latest as $news): ?>
          <div class="item">
            <div class="hero-wrap">
              <a href="<?= base_url('news/' . $news['slug']) ?>"><img loading="lazy" src="<?= base_url('uploads/news/' . ($news['image'] ?: 'default.jpg')) ?>" class="hero-img" alt=""></a>
              <div class="hero-cap">
                <span class="hero-badge"><?= esc($news['category_slug']) ?></span>
                <h2><a href="<?= base_url('news/' . $news['slug']) ?>"><?= esc($news['title']) ?></a></h2>
                <p class="hero-desc d-none d-md-block"><?= character_limiter(strip_tags($news['description'] ?? ''), 140) ?></p>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Auto-Rotating Sub-Hero Carousel (2 visible at a time) -->
        <?php $subCards = !empty($allLatest) ? array_slice($allLatest, 1, 8) : (!empty($latest) ? array_slice($latest, 1, 6) : []); ?>
        <?php if(!empty($subCards)): ?>
        <div class="owl-carousel sub-hero-carousel mt-2" style="margin: 0 -5px;">
            <?php foreach($subCards as $bc): ?>
            <div class="item" style="padding: 0 5px;">
                <a href="<?= base_url('news/' . $bc['slug']) ?>" class="d-block text-decoration-none hero-subcard-link">
                    <div class="hero-subcard-v2" style="border-radius: 12px; overflow: hidden; background: #111; box-shadow: 0 4px 20px rgba(0,0,0,0.15); isolation: isolate;">
                        <div style="aspect-ratio: 16/9; overflow: hidden; position: relative;">
                            <img loading="lazy" src="<?= base_url('uploads/news/' . ($bc['image'] ?: 'default.jpg')) ?>" 
                                 style="width: 100%; height: 100%; object-fit: cover; opacity: 0.95; transition: transform 0.5s ease; display: block;" 
                                 class="subcard-img-v2">
                            <div style="position: absolute; inset: 0; background: linear-gradient(to bottom, transparent 40%, rgba(0,0,0,0.55));"></div>
                            <span style="position: absolute; top: 8px; left: 8px; background: #dc2626; color: #fff; font-size: 8px; font-weight: 900; padding: 2px 7px; border-radius: 4px; text-transform: uppercase; letter-spacing: 0.5px;"><?= esc($bc['category_slug']) ?></span>
                        </div>
                        <div style="padding: 10px 12px 12px; background: #fff;">
                            <h4 style="color: #0f172a; font-size: 13px; font-weight: 800; line-height: 1.35; margin: 0; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;"><?= esc($bc['title']) ?></h4>
                            <span style="font-size: 10px; color: #94a3b8; font-weight: 700; display: block; margin-top: 5px;"><i class="far fa-clock me-1"></i><?= date('d M', strtotime($bc['publish_at'] ?? 'now')) ?></span>
                        </div>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>

        <style>
            .hero-subcard-link:hover .subcard-img-v2 { transform: scale(1.08); }
            .hero-subcard-link:hover h4 { color: #dc2626 !important; }
            .hero-subcard-v2 { transition: box-shadow 0.3s; }
            .hero-subcard-link:hover .hero-subcard-v2 { box-shadow: 0 8px 25px rgba(0,0,0,0.2); }
            /* Dots styling */
            .sub-hero-carousel .owl-dots { margin-top: 10px; text-align: center; }
            .sub-hero-carousel .owl-dot span { width: 6px; height: 6px; background: #ddd; border-radius: 50%; display: inline-block; margin: 0 3px; transition: all 0.3s; }
            .sub-hero-carousel .owl-dot.active span { background: #dc2626; width: 18px; border-radius: 4px; }
        </style>
        <?php endif; ?>
        <!-- Injected Visual Stories & Other Sections here via restructuring -->
        <?php if (!empty($visualStories)): ?>
        <div class="mt-4 mb-5">
            <div class="sec-head mb-4 d-flex justify-content-between align-items-center">
                <h3 style="font-size: 24px; font-weight: 900; letter-spacing: -1px;">Visual <span style="color: #dc2626;">Stories</span></h3>
                <a href="<?= base_url('visual-stories') ?>" style="font-size:11px; font-weight:900; color:#9ca3af; text-decoration:none; text-transform:uppercase; letter-spacing:1px;">See All ›</a>
            </div>
            <div class="owl-carousel visual-stories-carousel">
              <?php foreach ($visualStories as $story): ?>
              <div class="item">
                <div class="story-card text-center" style="padding: 10px;">
                    <a href="<?= base_url('story/' . $story['slug']) ?>" class="text-decoration-none">
                    <div class="story-circle-premium" style="width: 85px; height: 85px; margin: 0 auto 10px; border-radius: 50%; padding: 3px; background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%); transition: transform 0.3s;">
                        <div style="background: #fff; width: 100%; height: 100%; border-radius: 50%; padding: 2px;">
                            <img loading="lazy" src="<?= base_url('uploads/stories/' . ($story['image'] ?: 'default.jpg')) ?>" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;" alt="">
                        </div>
                    </div>
                    <p style="font-size: 11px; font-weight: 700; color: #333; line-height: 1.2; margin: 0; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;"><?= esc($story['title']) ?></p>
                    </a>
                </div>
              </div>
              <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
      </div>

      <!-- Trending sidebar -->
      <div class="col-lg-4">
        <?php if (!empty($liveStream)): ?>
        <div class="live-tv-sidebar mb-4" style="background: #111; border-radius: 16px; padding: 15px; border: 1px solid #dc2626; box-shadow: 0 10px 30px rgba(220, 38, 38, 0.15);">
          <div class="d-flex align-items-center justify-content-between mb-3 px-2">
            <h3 style="font-size: 14px; font-weight: 900; color: #fff; margin: 0; text-transform: uppercase; letter-spacing: 0.5px;">
              <span class="live-pulse" style="display: inline-block; width: 8px; height: 8px; background: #dc2626; border-radius: 50%; margin-right: 8px; box-shadow: 0 0 10px #dc2626; animation: red-pulse 1.5s infinite;"></span>
              Live <span style="color: #dc2626;">TV</span>
            </h3>
            <div class="d-flex align-items-center gap-2">
                <span style="font-size: 9px; font-weight: 800; color: #dc2626; text-transform: uppercase;">On Air</span>
                <button type="button" class="btn btn-sm btn-outline-danger px-2 py-0" data-bs-toggle="modal" data-bs-target="#badiScreenLiveModal" style="font-size: 9px; font-weight: 800; border-radius: 20px; text-transform: uppercase; padding-top: 2px; padding-bottom: 2px;" title="Watch in Theater Mode">
                    <i class="fas fa-expand me-1"></i> Badi Screen
                </button>
            </div>
          </div>
          <div class="live-embed-wrap" style="aspect-ratio: 16/9; border-radius: 10px; overflow: hidden; background: #000;">
            <iframe width="100%" height="100%" src="<?= $liveStream['stream_url'] ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          </div>
        </div>
        <style>
          @keyframes red-pulse {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(220, 38, 38, 0.7); }
            70% { transform: scale(1); box-shadow: 0 0 0 6px rgba(220, 38, 38, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(220, 38, 38, 0); }
          }
        </style>
        <?php endif; ?>

        <div class="trending-sidebar-premium" style="background: #fff; border-radius: 16px; padding: 24px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); border: 1px solid #f0f0f0;">
          <div class="sec-head mb-4" style="border-left: 4px solid #dc2626; padding-left: 15px;">
            <h3 style="font-size: 20px; font-weight: 900; color: #111; letter-spacing: -0.5px; text-transform: uppercase;">Trending <span style="color: #dc2626;">Now</span></h3>
          </div>
          
          <div class="vertical-trending-slider">
            <?php 
              $trendCount = 1;
              foreach ($trending as $item): 
            ?>
            <div class="trending-slide-item">
                <a href="<?= base_url('news/' . $item['slug']) ?>" class="trending-item-new text-decoration-none d-flex align-items-center gap-3 mb-3 p-2" style="transition: all 0.3s ease; border-radius: 12px;">
                  <div class="trend-rank" style="font-size: 20px; font-weight: 900; color: #f3f4f6; flex-shrink: 0; width: 30px; line-height: 1;">
                    <?= sprintf('%02d', $trendCount++) ?>
                  </div>
                  <div class="trend-thumb-wrap" style="width: 70px; height: 55px; border-radius: 8px; overflow: hidden; flex-shrink: 0; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                    <img loading="lazy" src="<?= base_url('uploads/news/' . ($item['image'] ?: 'default.jpg')) ?>" style="width: 100%; height: 100%; object-fit: cover;" alt="">
                  </div>
                  <div class="trend-content" style="flex-grow: 1;">
                    <span style="font-size: 9px; font-weight: 900; color: #dc2626; text-transform: uppercase; letter-spacing: 0.8px; display: block; margin-bottom: 4px;"><?= esc($item['category_slug']) ?></span>
                    <p class="trend-title-premium" style="font-size: 13px; font-weight: 800; line-height: 1.4; color: #111; margin: 0; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; transition: color 0.3s;"><?= esc($item['title']) ?></p>
                  </div>
                </a>
            </div>
            <?php endforeach; ?>
          </div>

          <div class="mt-3 text-center">
            <a href="#" class="view-all-trend" style="display: inline-block; padding: 8px 24px; background: #f9fafb; border-radius: 20px; color: #6b7280; font-size: 10px; font-weight: 800; text-decoration: none; text-transform: uppercase; border: 1px solid #eee;">
                Full Trends
            </a>
          </div>
        </div>
        
        <!-- Ad Sidebar: SIDEBAR_PREMIUM_SLOT -->
        <?php $sidebarAds = get_ads('SIDEBAR_PREMIUM_SLOT'); if (!empty($sidebarAds)): ?>
        <div class="ad-sidebar">
            <span class="ad-label text-center">Sponsored</span>
            <?php foreach ($sidebarAds as $ad): ?>
                <?php if ($ad['ad_type'] == 'image'): ?>
                    <a href="<?= $ad['link'] ?>" target="_blank">
                        <img src="<?= base_url('uploads/ads/' . $ad['image']) ?>" style="width: 100%; height: auto; display: block;">
                    </a>
                <?php else: ?>
                    <div class="p-3"><?= $ad['custom_code'] ?></div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <div class="mt-1">
            <?= view('frontend/partials/poll_widget') ?>
        </div>

        <style>
          .social-bar-premium:hover { transform: translateX(5px); filter: brightness(1.1); }
          .trending-item-new:hover { background: #fff1f2; transform: translateX(5px); }
          .trending-item-new:hover .trend-rank { color: #dc2626 !important; opacity: 0.4; }
          .trending-item-new:hover .trend-title-premium { color: #c90000; }
          .view-all-trend:hover { background: #dc2626; color: #fff; border-color: #dc2626; }
          
          /* Slick Vertical Spacing */
          .vertical-trending-slider .slick-slide { height: auto !important; }
        </style>
      </div>
    </div>

    <!-- ④ SPOTLIGHT VIDEOS SECTION -->
    <?php if (!empty($videoNews)): ?>
    <section class="premium-spotlight-section py-5" style="background: #fff; margin: 40px 0; position: relative; z-index: 1;">
        <div class="spotlight-container" style="background: #0f1115; border-radius: 30px; padding: 50px 40px; position: relative; overflow: hidden; box-shadow: 0 30px 60px rgba(0,0,0,0.2);">
            <!-- Ambient Glow -->
            <div style="position: absolute; top: -100px; right: -50px; width: 400px; height: 400px; background: radial-gradient(circle, rgba(220, 38, 38, 0.1) 0%, transparent 70%); filter: blur(60px); z-index: 1;"></div>
            
            <div class="d-flex justify-content-between align-items-center mb-4 mb-md-5 position-relative" style="z-index: 5;">
                <div class="spotlight-header d-flex align-items-center gap-2">
                    <div class="pulse-play-icon">
                        <i class="fas fa-play"></i>
                    </div>
                    <div class="d-flex align-items-baseline gap-2">
                        <h2 style="color: #fff; font-weight: 950; font-size: clamp(22px, 5vw, 34px); letter-spacing: -1px; margin: 0; text-transform: uppercase;">SPOTLIGHT</h2>
                        <span style="background: #dc2626; color: #fff; font-size: 10px; font-weight: 900; padding: 2px 8px; border-radius: 4px; letter-spacing: 1px; text-transform: uppercase; vertical-align: middle;">VIDEOS</span>
                    </div>
                </div>
                <div class="text-end">
                    <a href="<?= base_url('video-news') ?>" class="spotlight-explore-btn d-flex flex-column align-items-center" style="opacity: 1; text-decoration: none;">
                        <span style="font-size: 9px; font-weight: 950; letter-spacing: 0.5px; color: #fff;">EXPLORE</span>
                        <i class="fas fa-long-arrow-alt-right mt-1" style="font-size: 12px; color: #fff;"></i>
                    </a>
                </div>
            </div>

            <div class="owl-carousel video-news-carousel spotlight-slider position-relative" style="z-index: 10;">
                <?php foreach ($videoNews as $video): ?>
                <div class="item">
                    <div class="spotlight-video-card">
                        <a href="<?= base_url('video/' . $video['slug']) ?>" class="d-block text-decoration-none">
                            <div class="sv-thumb-wrap">
                                <?php 
                                  $vImgDir = (isset($video['thumbnail']) ? 'uploads/videos/' : 'uploads/news/');
                                  $vFinalImg = base_url($vImgDir . ($video['image'] ?: 'default.jpg'));
                                ?>
                                <img src="<?= $vFinalImg ?>" alt="<?= esc($video['title']) ?>" class="sv-thumb">
                                <div class="sv-overlay"></div>
                                <div class="sv-play-action">
                                    <i class="fas fa-play"></i>
                                </div>
                                <div class="sv-tag"><i class="fas fa-video me-1"></i> PLAY NOW</div>
                            </div>
                            <div class="sv-content mt-3">
                                <h4 class="sv-title"><?= esc($video['title']) ?></h4>
                                <div class="sv-meta">
                                    <span><i class="far fa-clock me-1"></i><?= date('M d, Y', strtotime($video['publish_at'])) ?></span>
                                    <span style="color: #475569;">•</span>
                                    <span><i class="far fa-eye me-1"></i><?= number_format(rand(1000, 50000)) ?> Views</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    
    <style>
        .spotlight-badge { background: #dc2626; color: #fff; font-size: 11px; font-weight: 900; padding: 4px 12px; border-radius: 6px; letter-spacing: 1px; border: 1px solid rgba(255,255,255,0.1); box-shadow: 0 4px 10px rgba(220,38,38,0.3); }
        .pulse-play-icon { width: 44px; height: 44px; background: #dc2626; color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 16px; box-shadow: 0 0 20px rgba(220,38,38,0.5); flex-shrink: 0; }
        .pulse-play-icon i { margin-left: 3px; }
        
        @media (max-width: 768px) {
            .pulse-play-icon { width: 34px; height: 34px; font-size: 13px; }
        }
        
        .spotlight-explore-btn { color: #fff; text-decoration: none; font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: 1.5px; opacity: 0.6; transition: all 0.3s; }
        .spotlight-explore-btn:hover { opacity: 1; color: #dc2626; }

        .spotlight-video-card { background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05); border-radius: 20px; padding: 15px; transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1); }
        .spotlight-video-card:hover { background: rgba(255,255,255,0.07); transform: translateY(-8px); border-color: rgba(255,255,255,0.1); }
        
        .sv-thumb-wrap { position: relative; width: 100%; height: 200px; border-radius: 14px; overflow: hidden; background: #000; }
        .sv-thumb { width: 100%; height: 100%; object-fit: cover; transition: transform 0.8s; opacity: 0.85; }
        .spotlight-video-card:hover .sv-thumb { transform: scale(1.1); opacity: 0.6; }
        
        .sv-overlay { position: absolute; inset: 0; background: linear-gradient(transparent, rgba(0,0,0,0.6)); }
        
        .sv-play-action { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%) scale(0.8); width: 60px; height: 60px; background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.3); backdrop-filter: blur(5px); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 20px; opacity: 0; transition: all 0.4s; }
        .spotlight-video-card:hover .sv-play-action { opacity: 1; transform: translate(-50%, -50%) scale(1); }
        .sv-play-action i { margin-left: 4px; }
        
        .sv-tag { position: absolute; bottom: 15px; left: 15px; background: #dc2626; color: #fff; font-size: 9px; font-weight: 900; padding: 4px 10px; border-radius: 6px; letter-spacing: 0.5px; text-transform: uppercase; transform: translateY(10px); opacity: 0; transition: all 0.3s 0.1s; }
        .spotlight-video-card:hover .sv-tag { transform: translateY(0); opacity: 1; }
        
        .sv-title { color: #fff; font-size: 15px; font-weight: 800; line-height: 1.4; margin: 0 0 8px 0; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; transition: color 0.3s; }
        .spotlight-video-card:hover .sv-title { color: #fca5a5; }
        .sv-meta { font-size: 12px; color: #94a3b8; font-weight: 600; text-transform: uppercase; margin-top: 6px; display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }
        
        @media (max-width: 768px) {
            .spotlight-container { padding: 20px 15px; border-radius: 16px; }
            .sv-thumb-wrap { height: 140px; border-radius: 10px; }
            .sv-tag { opacity: 1; transform: translateY(0); font-size: 8px; }
            .sv-play-action { opacity: 1; transform: translate(-50%, -50%) scale(0.8); }
            .spotlight-video-card { padding: 10px; border-radius: 14px; }
            .sv-title { font-size: 13px; font-weight: 800; -webkit-line-clamp: 2; }
            .sv-meta { font-size: 11px; color: #94a3b8; margin-top: 5px; gap: 4px; }
            .sv-meta i { font-size: 10px; }
            .sv-content { margin-top: 10px !important; }
        }
    </style>
    <?php endif; ?>

    <!-- ◉ PERSPECTIVES & OPINIONS -->
    <?php $opinions = isset($allLatest) ? array_slice($allLatest, 5, 4) : []; ?>
    <?php if(!empty($opinions)): ?>
    <div class="row mt-5 mb-5">
        <div class="col-12 mb-4 text-center">
            <h3 style="font-size: 30px; font-weight: 950; letter-spacing: -1px; margin: 0; text-transform: uppercase;">
                <i class="fas fa-pen-nib" style="color: #dc2626; margin-right: 8px;"></i> Perspectives & <span style="color: #dc2626;">Opinions</span>
            </h3>
            <p style="color: #64748b; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; margin-top: 8px;">Expert Views & Editorials</p>
        </div>
        <div class="col-12">
            <div class="row px-lg-3 py-lg-4" style="background: #f8fafc; border-radius: 24px; border: 1px solid #e2e8f0; margin: 0;">
                <?php foreach($opinions as $op): ?>
                <div class="col-lg-6 mb-3 mt-3">
                    <a href="<?= base_url('news/' . $op['slug']) ?>" class="opinion-card d-flex align-items-center text-decoration-none" style="background: #fff; padding: 25px; border-radius: 16px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); border: 1px solid #f1f5f9; transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1); height: 100%;">
                        <div style="position: relative; width: 75px; height: 75px; flex-shrink: 0; margin-right: 20px;">
                            <img loading="lazy" src="<?= base_url('uploads/news/' . ($op['image'] ?: 'default.jpg')) ?>" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%; box-shadow: 0 5px 15px rgba(0,0,0,0.1); border: 3px solid #fff; transition: transform 0.4s;" class="op-img">
                            <div style="position: absolute; bottom: -5px; right: -5px; width: 28px; height: 28px; background: #dc2626; color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 10px; border: 3px solid #fff; box-shadow: 0 2px 5px rgba(220,38,38,0.4);"><i class="fas fa-quote-right"></i></div>
                        </div>
                        <div>
                            <span style="font-size: 10px; font-weight: 900; color: #dc2626; text-transform: uppercase; letter-spacing: 0.5px; background: #fff1f2; padding: 4px 8px; border-radius: 4px; display: inline-block; margin-bottom: 8px;"><?= esc($op['custom_author'] ?? 'Editorial Desk') ?></span>
                            <h4 style="font-size: 16px; font-weight: 800; color: #0f172a; line-height: 1.4; margin: 0; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; transition: color 0.3s;" class="op-title"><?= esc($op['title']) ?></h4>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <style>
        .opinion-card:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0,0,0,0.08); border-color: #dc2626; }
        .opinion-card:hover .op-title { color: #dc2626; }
        .opinion-card:hover .op-img { transform: scale(1.1); }
    </style>
    <?php endif; ?>

    <!-- ⑤ PREMIUM CATEGORY GRIDS -->
    <?php
      $sectionMeta = [
        'bijnor-news'   => 'बिजनौर समाचार',
        'entertainment' => 'Entertainment',
        'state'         => 'State Wise News',
        'crime'         => 'Crime',
        'games'         => 'Games',
        'lifestyle'     => 'Lifestyle',
        'religion'      => 'Religion',
        'tech'          => 'Technology',
        'education'     => 'Education',
        'business'      => 'Business',
        'world'         => 'World',
        'science'       => 'Science',
        'auto'          => 'Auto',
      ];
    ?>
    <div class="row row-gap-fix mt-5">
      <?php foreach ($sectionMeta as $key => $label):
        if (empty($sections[$key])) continue;
        $items = $sections[$key];
      ?>
      <div class="col-lg-4 col-md-6" style="margin-bottom: 45px;">
        
        <!-- Category Header Modern -->
        <div class="d-flex justify-content-between align-items-end mb-4 border-bottom pb-2" style="border-color: #f1f5f9 !important;">
          <h3 style="font-size: 22px; font-weight: 900; color: #0f172a; margin: 0; letter-spacing: -0.5px; position: relative;">
            <span style="position: absolute; bottom: -9px; left: 0; width: 40px; height: 3px; background: #dc2626; border-radius: 4px;"></span>
            <?= $label ?>
          </h3>
          <a href="<?= base_url('category/' . ($key === 'state' ? 'state-news' : $key)) ?>" class="cat-see-all-btn">
            View All <i class="fas fa-angle-right ms-1"></i>
          </a>
        </div>

        <!-- Featured Major Card -->
        <div class="cat-grid-major premium-news-card mb-3">
          <a href="<?= base_url('news/' . $items[0]['slug']) ?>" class="d-block w-100 h-100">
            <img loading="lazy" src="<?= base_url('uploads/news/' . ($items[0]['image'] ?: 'default.jpg')) ?>" class="cat-major-img-new" alt="">
            <div class="cat-major-overlay">
              <span class="cat-major-badge"><i class="fas fa-bolt text-white me-1"></i> <?= $label ?></span>
              <h4 class="cat-major-title"><?= esc($items[0]['title']) ?></h4>
            </div>
          </a>
        </div>

        <!-- Minor List Items -->
        <div class="cat-minor-list">
          <?php for ($i = 1; $i < count($items); $i++): ?>
          <a href="<?= base_url('news/' . $items[$i]['slug']) ?>" class="cat-minor-item d-flex">
            <div class="cat-minor-thumb-wrap">
              <img loading="lazy" src="<?= base_url('uploads/news/' . ($items[$i]['image'] ?: 'default.jpg')) ?>" class="cat-minor-img" alt="">
            </div>
            <div class="cat-minor-content">
              <h5 class="cat-minor-title-new"><?= esc($items[$i]['title']) ?></h5>
              <div class="cat-minor-meta"><i class="far fa-clock"></i> <?= date('M d, Y', strtotime($items[$i]['publish_at'])) ?></div>
            </div>
          </a>
          <?php endfor; ?>
        </div>

      </div>
      <?php endforeach; ?>
    </div>

    <style>
      .cat-see-all-btn { font-size: 10px; font-weight: 800; color: #64748b; background: #f8fafc; padding: 4px 12px; border-radius: 12px; text-decoration: none; text-transform: uppercase; letter-spacing: 1px; transition: all 0.3s; border: 1px solid #e2e8f0; }
      .cat-see-all-btn:hover { background: #dc2626; color: #fff; border-color: #dc2626; }
      
      .cat-grid-major { position: relative; height: 210px; border-radius: 14px; overflow: hidden; background: #000; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
      .cat-major-img-new { width: 100%; height: 100%; object-fit: cover; opacity: 0.9; transition: transform 0.6s cubic-bezier(0.165, 0.84, 0.44, 1); }
      .cat-grid-major:hover .cat-major-img-new { transform: scale(1.08); opacity: 0.75; }
      .cat-major-overlay { position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.95) 0%, rgba(0,0,0,0.3) 50%, transparent 100%); display: flex; flex-direction: column; justify-content: flex-end; padding: 20px 15px; }
      .cat-major-badge { background: #dc2626; color: #fff; font-size: 9px; font-weight: 900; padding: 4px 10px; border-radius: 6px; text-transform: uppercase; letter-spacing: 0.5px; align-self: flex-start; margin-bottom: 10px; box-shadow: 0 4px 10px rgba(220,38,38,0.3); }
      .cat-major-title { font-size: 16px; font-weight: 800; color: #fff; line-height: 1.35; margin: 0; text-shadow: 0 2px 5px rgba(0,0,0,0.8); display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; transition: color 0.3s; }
      .cat-grid-major:hover .cat-major-title { color: #fca5a5; }

      .cat-minor-item { gap: 14px; align-items: center; padding: 12px 10px; border-radius: 10px; border-bottom: 1px solid #f1f5f9; text-decoration: none; transition: all 0.3s ease; }
      .cat-minor-item:last-child { border-bottom: none; }
      .cat-minor-item:hover { background: #fff1f2; transform: translateX(6px); border-bottom-color: transparent; }
      .cat-minor-thumb-wrap { width: 85px; height: 64px; border-radius: 8px; overflow: hidden; flex-shrink: 0; box-shadow: 0 4px 12px rgba(0,0,0,0.08); }
      .cat-minor-img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s; }
      .cat-minor-item:hover .cat-minor-img { transform: scale(1.15); }
      .cat-minor-content { flex: 1; }
      .cat-minor-title-new { font-size: 13px; font-weight: 800; color: #0f172a; line-height: 1.4; margin: 0 0 6px 0; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; transition: color 0.3s; }
      .cat-minor-item:hover .cat-minor-title-new { color: #dc2626; }
      .cat-minor-meta { font-size: 10px; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px; }
      .cat-minor-meta i { color: #dc2626; margin-right: 4px; font-size: 11px; }
    </style>

    <!-- ◉ TODAY'S FOCUS (PARALLAX BANNER) -->
    <?php if(isset($allLatest[0])): $pItem = $allLatest[0]; ?>
    <div class="row mt-5 mb-5">
        <div class="col-12">
            <a href="<?= base_url('news/' . $pItem['slug']) ?>" class="d-block text-decoration-none">
            <div class="parallax-focus-wrap" style="position: relative; border-radius: 24px; overflow: hidden; height: 420px; box-shadow: 0 20px 50px rgba(0,0,0,0.15);">
                <div style="position: absolute; inset: 0; background-image: url('<?= base_url('uploads/news/' . ($pItem['image'] ?: 'default.jpg')) ?>'); background-size: cover; background-position: center; background-attachment: fixed; filter: brightness(0.65) contrast(1.1); transition: 0.3s; transform-origin: center;"></div>
                <div style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(15, 23, 42, 0.95) 0%, rgba(15, 23, 42, 0.3) 60%, transparent 100%);"></div>
                
                <div style="position: absolute; bottom: 0; left: 0; width: 100%; padding: 50px 20px; text-align: center;">
                    <div class="container">
                        <span style="background: #dc2626; color: #fff; font-size: 11px; font-weight: 900; padding: 6px 18px; border-radius: 30px; text-transform: uppercase; letter-spacing: 1px; display: inline-block; margin-bottom: 20px; box-shadow: 0 5px 15px rgba(220,38,38,0.4);">Today's Focus</span>
                        <h2 style="color: #fff; font-size: 38px; font-weight: 900; line-height: 1.2; margin: 0 auto 15px auto; max-width: 900px; text-shadow: 0 4px 15px rgba(0,0,0,0.9);"><?= esc($pItem['title']) ?></h2>
                        <p style="color: #cbd5e1; font-size: 16px; margin: 0 auto 25px auto; max-width: 650px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-line-break: auto; -webkit-box-orient: vertical; overflow: hidden; font-weight: 500;"><?= character_limiter(strip_tags($pItem['description'] ?? ''), 150) ?></p>
                        <span class="btn-read-focus" style="display: inline-block; background: #fff; color: #0f172a; padding: 14px 40px; border-radius: 40px; font-weight: 900; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; text-decoration: none; transition: all 0.3s;">Read Article <i class="fas fa-arrow-right ms-2"></i></span>
                    </div>
                </div>
            </div>
            </a>
        </div>
    </div>
    <?php endif; ?>

    <!-- ◉ EDITOR'S PICKS -->
    <?php $editorsPicks = isset($allLatest) ? array_slice($allLatest, 2, 4) : []; ?>
    <?php if(count($editorsPicks) == 4): ?>
    <div class="row mt-5 mb-5 pb-3">
        <div class="col-12 mb-4 d-flex justify-content-between align-items-end" style="border-bottom: 2px solid #f1f5f9; padding-bottom: 12px;">
            <h3 style="font-size: 28px; font-weight: 950; letter-spacing: -1px; margin: 0; position: relative;">
                <span style="position: absolute; bottom: -14px; left: 0; width: 50px; height: 3px; background: #dc2626; border-radius: 4px;"></span>
                Editor's <span style="color: #dc2626;">Picks</span>
            </h3>
            <span style="font-size: 10px; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px;">Selected for you</span>
        </div>
        <?php foreach($editorsPicks as $ep): ?>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="editor-pick-card" style="background: #fff; border-radius: 16px; overflow: hidden; border: 1px solid #f1f5f9; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1); height: 100%; box-shadow: 0 4px 15px rgba(0,0,0,0.02);">
                <a href="<?= base_url('news/' . $ep['slug']) ?>" class="d-block text-decoration-none h-100 d-flex flex-column">
                    <div style="height: 180px; overflow: hidden; position: relative; flex-shrink: 0;">
                        <img loading="lazy" src="<?= base_url('uploads/news/' . ($ep['image'] ?: 'default.jpg')) ?>" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s;" class="ep-img">
                        <span style="position: absolute; top: 12px; right: 12px; background: rgba(0,0,0,0.65); backdrop-filter: blur(4px); color: #fff; font-size: 10px; font-weight: 800; padding: 4px 10px; border-radius: 12px; text-transform: uppercase;"><i class="fas fa-star text-warning"></i> Pick</span>
                    </div>
                    <div style="padding: 20px; flex-grow: 1; display: flex; flex-direction: column;">
                        <span style="color: #dc2626; font-size: 10px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.5px; display: block; margin-bottom: 8px;"><?= esc($ep['category_slug']) ?></span>
                        <h4 style="color: #0f172a; font-size: 16px; font-weight: 800; line-height: 1.4; margin: 0 0 10px 0; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; transition: color 0.3s;" class="ep-title"><?= esc($ep['title']) ?></h4>
                        <div style="font-size: 10px; font-weight: 800; color: #94a3b8; margin-top: auto; padding-top: 10px; border-top: 1px solid #f1f5f9;"><i class="far fa-clock"></i> <?= date('F d, Y', strtotime($ep['publish_at'] ?? 'now')) ?></div>
                    </div>
                </a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    
    <style>
        .editor-pick-card:hover { transform: translateY(-8px); box-shadow: 0 15px 30px rgba(0,0,0,0.08); border-color: #e2e8f0; }
        .editor-pick-card:hover .ep-img { transform: scale(1.1); }
        .editor-pick-card:hover .ep-title { color: #dc2626 !important; }
        .btn-read-focus:hover { background: #dc2626 !important; color: #fff !important; transform: translateY(-5px); box-shadow: 0 15px 25px rgba(220,38,38,0.4); }
        
        @media (max-width: 768px) {
            .parallax-focus-wrap { height: 350px !important; }
            .parallax-focus-wrap h2 { font-size: 24px !important; }
            .parallax-focus-wrap p { font-size: 14px !important; }
            .parallax-focus-wrap .btn-read-focus { padding: 10px 25px !important; font-size: 11px !important; }
        }
    </style>
    <?php endif; ?>

    <!-- ⑥ LATEST UPDATES (MORE DATA) -->
    <div class="row" style="margin-top: 40px;">
        <div class="col-12">
            <div class="sec-head mb-5 text-center" style="border-left:none; padding-left:0;">
                <h3 style="font-size: 32px; font-weight: 950; letter-spacing: -1.5px; position:relative; display:inline-block; padding-bottom:15px;">
                    LATEST <span style="color: #dc2626;">UPDATES</span>
                    <span style="position:absolute; bottom:0; left:50%; transform:translateX(-50%); width:80px; height:6px; background:#dc2626; border-radius:10px;"></span>
                </h3>
                <p class="text-slate-400 font-bold text-sm mt-3 uppercase tracking-widest">Never miss a beat from around the world</p>
            </div>
        </div>
        
        <div class="col-12">
            <div class="row gy-5 gx-4" id="latest-updates-grid">
                <?php foreach ($allLatest as $item): ?>
                <div class="col-lg-4 col-md-6 mb-2">
                    <div class="premium-news-card" style="background: #fff; border-radius: 24px; overflow: hidden; height: 100%; box-shadow: 0 10px 40px rgba(0,0,0,0.04); border: 1px solid #f1f5f9; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);">
                        <a href="<?= base_url('news/' . $item['slug']) ?>" class="news-card-img-wrap d-block" style="position: relative; height: 200px; overflow: hidden;">
                            <img loading="lazy" src="<?= base_url('uploads/news/' . ($item['image'] ?: 'default.jpg')) ?>" style="width: 100%; height: 100%; object-fit: cover; transition: all 0.6s;" alt="">
                            <div class="news-card-badge" style="position: absolute; top: 15px; left: 15px; background: #dc2626; color: #fff; font-size: 9px; font-weight: 900; padding: 4px 12px; border-radius: 6px; text-transform: uppercase; letter-spacing: 0.5px; z-index: 2;">
                                <?= esc($item['category_slug']) ?>
                            </div>
                        </a>
                        <div class="news-card-content p-4">
                            <div class="d-flex align-items-center gap-2 mb-2 mt-2" style="font-size: 10px; font-weight: 800; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px;">
                                <i class="far fa-calendar-alt text-red-500"></i>
                                <?= date('M d, Y', strtotime($item['publish_at'])) ?>
                            </div>
                            <h4 class="news-card-title mb-3" style="font-size: 18px; font-weight: 900; line-height: 1.4; color: #0f172a; transition: color 0.3s; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                <a href="<?= base_url('news/' . $item['slug']) ?>" class="text-decoration-none text-current hover-red"><?= esc($item['title']) ?></a>
                            </h4>
                            <p class="news-card-excerpt text-slate-500 text-sm leading-relaxed mb-4" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; font-weight: 600;">
                                <?= character_limiter(strip_tags($item['description'] ?? ''), 120) ?>
                            </p>
                            <a href="<?= base_url('news/' . $item['slug']) ?>" class="read-more-btn-new" style="display: inline-flex; align-items: center; gap: 8px; font-size: 11px; font-weight: 900; color: #dc2626; text-decoration: none; text-transform: uppercase; letter-spacing: 1px;">
                                Read Story <i class="fas fa-arrow-right" style="font-size: 10px; transition: transform 0.3s;"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <div class="text-center mt-5">
                <a href="<?= base_url('search') ?>" class="premium-button text-decoration-none" style="display: inline-flex; align-items: center; gap: 12px; background: #0f172a; color: #fff; padding: 16px 40px; border-radius: 20px; font-size: 13px; font-weight: 900; text-transform: uppercase; letter-spacing: 1.5px; transition: all 0.3s; border: none; box-shadow: 0 10px 30px rgba(15, 23, 42, 0.2);">
                    Explore More News <i class="fas fa-plus"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- ◉ EXPLORE HOT TOPICS -->
    <div class="row mt-4 mb-5 pt-3">
        <div class="col-12 text-center mb-4">
            <h3 style="font-size: 24px; font-weight: 950; letter-spacing: -0.5px; text-transform: uppercase; margin: 0;">Explore Hot <span style="color: #dc2626;">Topics</span></h3>
            <p class="text-slate-400 font-bold text-sm mt-2 uppercase tracking-wide">Quick links to what's trending now</p>
        </div>
        <div class="col-12 text-center">
            <div class="d-flex flex-wrap justify-content-center gap-3">
                <?php foreach ($sectionMeta as $key => $label): ?>
                    <a href="<?= base_url('category/' . ($key === 'state' ? 'state-news' : $key)) ?>" class="topic-pill">
                        #<?= esc($label) ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <style>
        .topic-pill { display: inline-block; padding: 12px 24px; background: #fff; border: 2px solid #f1f5f9; color: #475569; font-size: 13px; font-weight: 800; border-radius: 30px; text-decoration: none; text-transform: uppercase; letter-spacing: 0.5px; transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275); box-shadow: 0 4px 10px rgba(0,0,0,0.02); }
    <!-- ⑦ CONNECT WITH US -->
    <div class="row" style="margin-top: 70px;">
        <div class="col-12 mb-4 text-center">
            <h3 style="font-size: 32px; font-weight: 950; letter-spacing: -1px; text-transform: uppercase; margin: 0;">Follow <span style="color: #dc2626;">Network</span></h3>
        </div>
        
        <div class="col-lg-3 col-6 mb-3">
            <a href="#" class="social-vibrant-tile" style="background: linear-gradient(135deg, #1877f2 0%, #0d5cb8 100%);">
                <div class="vibrant-inner">
                    <i class="fab fa-facebook-f"></i>
                    <div>
                        <span class="v-platform">Facebook</span>
                        <span class="v-metrics">850k+ Fans</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-6 mb-3">
            <a href="#" class="social-vibrant-tile" style="background: linear-gradient(135deg, #1da1f2 0%, #0d7dbd 100%);">
                <div class="vibrant-inner">
                    <i class="fab fa-twitter"></i>
                    <div>
                        <span class="v-platform">Twitter</span>
                        <span class="v-metrics">420k+ Followers</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-6 mb-3">
            <a href="#" class="social-vibrant-tile" style="background: linear-gradient(135deg, #ff0000 0%, #cc0000 100%);">
                <div class="vibrant-inner">
                    <i class="fab fa-youtube"></i>
                    <div>
                        <span class="v-platform">YouTube</span>
                        <span class="v-metrics">1.2M+ Subs</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-6 mb-3">
            <a href="#" class="social-vibrant-tile" style="background: linear-gradient(135deg, #833ab4 0%, #fd1d1d 50%, #fcb045 100%);">
                <div class="vibrant-inner">
                    <i class="fab fa-instagram"></i>
                    <div>
                        <span class="v-platform">Instagram</span>
                        <span class="v-metrics">980k+ Followers</span>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- ⑧ NEWSLETTER SUBSCRIPTION -->
    <div class="row" style="margin-top: 60px; margin-bottom: 40px;">
        <div class="col-12">
            <div class="newsletter-premium-box" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); border-radius: 24px; padding: 60px 40px; box-shadow: 0 20px 40px rgba(0,0,0,0.15); display: flex; align-items: center; justify-content: space-between; overflow: hidden; position: relative; border: 1px solid rgba(255,255,255,0.05);">
                
                <!-- Dekorative BG -->
                <div style="position: absolute; top: -50px; right: -50px; width: 300px; height: 300px; background: #dc2626; border-radius: 50%; opacity: 0.2; filter: blur(80px); z-index: 0;"></div>
                
                <div class="newsletter-content" style="position: relative; z-index: 1; max-width: 50%;">
                    <h3 style="font-size: 36px; font-weight: 900; color: #fff; margin-bottom: 15px; letter-spacing: -1px;">Stay <span style="color: #dc2626;">Updated.</span></h3>
                    <p style="color: #94a3b8; font-size: 16px; margin: 0; line-height: 1.6;">Get the latest breaking news, premium stories, and personalized updates delivered right to your inbox every morning.</p>
                </div>
                
                <div class="newsletter-form-wrap" style="position: relative; z-index: 1; width: 45%;">
                    <form action="<?= base_url('subscribe') ?>" method="POST" class="d-flex align-items-center" style="gap: 10px; background: rgba(255,255,255,0.05); padding: 6px; border-radius: 40px; border: 1px solid rgba(255,255,255,0.1); backdrop-filter: blur(10px);">
                        <input type="email" name="email" placeholder="Enter your email address..." required style="flex: 1; background: transparent; border: none; padding: 15px 25px; color: #fff; font-size: 15px; outline: none; box-shadow: none;">
                        <button type="submit" style="background: #dc2626; color: #fff; border: none; padding: 15px 35px; border-radius: 35px; font-weight: 800; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; transition: all 0.3s; cursor: pointer;">Subscribe</button>
                    </form>
                </div>
            </div>
            
            <style>
                .newsletter-form-wrap form button:hover { background: #b91c1c; transform: scale(1.05); box-shadow: 0 5px 15px rgba(220,38,38,0.4); }
                .newsletter-form-wrap form input::placeholder { color: #64748b; }
                
                @media (max-width: 991px) {
                    .newsletter-premium-box { flex-direction: column; text-align: center; padding: 40px 20px; }
                    .newsletter-content { max-width: 100%; margin-bottom: 30px; }
                    .newsletter-form-wrap { width: 100%; }
                }
            </style>
        </div>
    </div>

    <style>
        .premium-news-card:hover { transform: translateY(-10px); box-shadow: 0 30px 60px rgba(15, 23, 42, 0.1); border-color: #e2e8f0; }
        .premium-news-card:hover img { transform: scale(1.1); }
        .premium-news-card:hover .news-card-title a { color: #dc2626; }
        .read-more-btn-new:hover i { transform: translateX(5px); }
        .premium-button:hover { background: #dc2626; transform: translateY(-3px); box-shadow: 0 15px 35px rgba(220, 38, 38, 0.3); }
        .hover-red:hover { color: #dc2626 !important; }
    </style>



    <style>
      .social-vibrant-tile { 
        display: block; 
        text-decoration: none !important; 
        border-radius: 20px; 
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); 
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        border: 1px solid rgba(255,255,255,0.05);
        height: 100%;
      }
      .vibrant-inner { 
        padding: 25px 15px; 
        display: flex; 
        flex-direction: column;
        align-items: center; 
        justify-content: center;
        gap: 12px; 
        color: #fff;
        text-align: center;
      }
      @media (min-width: 768px) {
        .vibrant-inner { flex-direction: row; text-align: left; padding: 25px 20px; gap: 15px; }
      }
      .social-vibrant-tile:hover { 
        transform: translateY(-12px) scale(1.03); 
        box-shadow: 0 25px 50px rgba(0,0,0,0.5);
        filter: brightness(1.15);
        border-color: rgba(255,255,255,0.2);
      }
      .vibrant-inner i { font-size: 26px; filter: drop-shadow(0 4px 10px rgba(0,0,0,0.3)); }
      .v-platform { display: block; font-size: 10px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; opacity: 0.8; margin-bottom: 2px; }
      .v-metrics { display: block; font-size: 14px; font-weight: 900; letter-spacing: -0.5px; }

      /* Responsive Fixes */
      @media (max-width: 767px) {
        .story-circle-premium { width: 65px !important; height: 65px !important; }
        .story-card p { font-size: 10px !important; }
        .social-vibrant-tile { margin-bottom: 10px; }
        .vibrant-inner i { font-size: 20px; }
        .v-metrics { font-size: 12px; }
        .sec-head h3 { font-size: 18px !important; }
      }
    </style>
  </div>
</div>

<!-- Extra: Badi Screen Live TV Modal -->
<?php if (!empty($liveStream)): ?>
<div class="modal fade" id="badiScreenLiveModal" tabindex="-1" aria-labelledby="badiScreenLiveModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content" style="background: #09090b; border: 1px solid #27272a; border-radius: 20px; overflow: hidden; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.8);">
      <div class="modal-header align-items-center" style="border-bottom: 1px solid #18181b; padding: 15px 25px;">
        <h5 class="modal-title d-flex align-items-center" id="badiScreenLiveModalLabel" style="color: #fff; font-weight: 900; text-transform: uppercase; letter-spacing: 1px; font-size: 16px;">
           <span class="live-pulse" style="display: inline-block; width: 10px; height: 10px; background: #ef4444; border-radius: 50%; margin-right: 12px; animation: red-pulse 1.5s infinite;"></span>
           Live <span style="color: #ef4444; margin-left: 5px;">TV Broadcast</span>
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" style="opacity: 0.8;"></button>
      </div>
      <div class="modal-body p-0" style="background: #000;">
        <div class="embed-responsive" style="aspect-ratio: 16/9; width: 100%;">
          <iframe id="bigLiveFrame" width="100%" height="100%" src="<?= $liveStream['stream_url'] ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
  $(document).ready(function() {
      // Refresh iframe src on modal close to stop background playback
      const liveModal = document.getElementById('badiScreenLiveModal');
      if (liveModal) {
          liveModal.addEventListener('hidden.bs.modal', function () {
              const iframe = document.getElementById('bigLiveFrame');
              if (iframe) {
                  const src = iframe.src;
                  iframe.src = '';
                  iframe.src = src;
              }
          });
      }
  });

  function updateLiveTicker() {
    $.get('<?= base_url('ajax/latest-news') ?>', function(data) {
      if (data && data.length > 0) {
        var html = '';
        data.forEach(function(item) {
          html += '<li class="news-item" style="color:#fff;font-weight:700;font-size:13px;">' + item.title + '</li>';
        });
        $('#js-news').html(html);
      }
    });
  }
  setInterval(updateLiveTicker, 300000);

  $(document).ready(function() {
    $('.visual-stories-carousel').owlCarousel({
        loop: true,
        margin: 0,
        nav: false,
        dots: false,
        autoplay: true,
        autoplaySpeed: 1000,
        autoplayTimeout: 3000,
        responsive: {
            0: { items: 3 },
            600: { items: 6 },
            1000: { items: 8 }
        }
    });

    $('.video-news-carousel').owlCarousel({
        loop: true,
        margin: 20,
        nav: false,
        dots: false,
        autoplay: true,
        autoplaySpeed: 1500,
        autoplayTimeout: 4000,
        responsive: {
            0: { items: 1 },
            600: { items: 2 },
            1000: { items: 4 }
        }
    });

    $('.hero-carousel').owlCarousel({
        items: 1,
        loop: true,
        margin: 0,
        nav: false,
        dots: true,
        autoplay: true,
        autoplayTimeout: 5000,
        smartSpeed: 1000,
        animateOut: 'fadeOut'
    });

    // Sub-Hero Auto Carousel
    $('.sub-hero-carousel').owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        dots: false,
        autoplay: true,
        autoplayTimeout: 4000,
        autoplayHoverPause: true,
        smartSpeed: 700,
        responsive: {
            0:   { items: 2 },
            768: { items: 2 }
        }
    });
    $('.vertical-trending-slider').slick({
        vertical: true,
        verticalSwiping: true,
        slidesToShow: 6,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2500,
        speed: 800,
        arrows: false,
        dots: false,
        pauseOnHover: true,
        infinite: true,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 4
                }
            }
        ]
    });
  });
</script>
<?= $this->endSection() ?>

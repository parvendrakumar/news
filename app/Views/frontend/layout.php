<!doctype html>
<html class="no-js" lang="<?= service('language')->getLocale() ?>">
<head>
    <?php
        $navData     = get_dynamic_nav();
        $siteName    = get_setting('site_name', 'City News');
        $siteTagline = get_setting('site_tagline', 'Your City. Your News.');
        
        // --- ADVANCED SEO RESOLUTION ---
        $isDetail = false;
        $currentObj = $news ?? $video ?? $story ?? null;
        
        if ($currentObj) {
            $isDetail = true;
            $metaTitle = ($currentObj['meta_title'] ?? '') ?: ($currentObj['title'] ?? ($currentObj['title_hi'] ?? ($title ?? '')));
            $metaDesc  = ($currentObj['meta_description'] ?? '') ?: character_limiter(strip_tags($currentObj['description'] ?? ($currentObj['description_hi'] ?? ($currentObj['content_hi'] ?? ''))), 160);
            $metaKw    = $currentObj['meta_keywords'] ?? '';
            
            // Image resolution
            $thumb = $currentObj['image'] ?? ($currentObj['thumbnail'] ?? '');
            $imgDir = isset($currentObj['is_video_news']) ? 'uploads/news/' : (isset($currentObj['video_url']) ? 'uploads/videos/' : (isset($currentObj['visual_story_id']) ? 'uploads/stories/' : 'uploads/news/'));
            // Fix for inconsistent keys
            if (isset($currentObj['visual_story_id'])) $imgDir = 'uploads/stories/';
            
            $ogImage = !empty($thumb) ? base_url($imgDir . $thumb) : base_url('uploads/settings/' . get_setting('og_image', ''));
        } else {
            $metaTitle = $title ?? get_setting('meta_title', $siteName);
            $metaDesc  = $page_meta_desc ?? get_setting('meta_description', get_setting('site_description', ''));
            $metaKw    = get_setting('meta_keywords', '');
            $ogImage   = base_url('uploads/settings/' . get_setting('og_image', ''));
        }

        $metaAuthor = get_setting('meta_author', $siteName);
        $gaId       = get_setting('google_analytics', '');
        $favicon    = get_setting('favicon', '');
        $siteLogo   = get_setting('site_logo', '');
        $headerBannerSetting = get_setting('header_banner', '');
    ?>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= esc($metaTitle) ?> | <?= esc($siteName) ?></title>

    <!-- Primary SEO Meta -->
    <meta name="description"  content="<?= esc($metaDesc) ?>">
    <?php if ($metaKw): ?>
    <meta name="keywords"     content="<?= esc($metaKw) ?>">
    <?php endif; ?>
    <meta name="author"       content="<?= esc($metaAuthor) ?>">
    <meta name="robots"       content="index, follow">

    <!-- Open Graph / Facebook -->
    <meta property="og:type"        content="<?= $isDetail ? 'article' : 'website' ?>">
    <meta property="og:url"         content="<?= current_url() ?>">
    <meta property="og:title"       content="<?= esc($metaTitle) ?> | <?= esc($siteName) ?>">
    <meta property="og:description" content="<?= esc($metaDesc) ?>">
    <meta property="og:image"       content="<?= $ogImage ?>">

    <!-- Twitter Card -->
    <meta name="twitter:card"        content="summary_large_image">
    <meta name="twitter:title"       content="<?= esc($metaTitle) ?> | <?= esc($siteName) ?>">
    <meta name="twitter:description" content="<?= esc($metaDesc) ?>">
    <meta name="twitter:image"       content="<?= $ogImage ?>">

    <!-- Structured Data (JSON-LD) -->
    <?php if ($isDetail): ?>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "NewsArticle",
      "headline": "<?= addslashes(esc($metaTitle)) ?>",
      "image": ["<?= $ogImage ?>"],
      "datePublished": "<?= $currentObj['publish_at'] ?? $currentObj['created_at'] ?? date('Y-m-d H:i:s') ?>",
      "author": [{
          "@type": "Person",
          "name": "<?= addslashes(esc($currentObj['custom_author'] ?? ($currentObj['author_name'] ?? $siteName))) ?>"
        }]
    }
    </script>
    <?php endif; ?>

    <!-- Canonical -->
    <link rel="canonical" href="<?= current_url() ?>">

    <?php if ($favicon): ?>
    <link rel="icon" type="image/x-icon" href="<?= base_url('uploads/settings/' . $favicon) ?>">
    <?php endif; ?>

    <!-- Google Analytics -->
    <?php if ($gaId): ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?= esc($gaId) ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '<?= esc($gaId) ?>');
    </script>
    <?php endif; ?>

    <!-- CSS here -->
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/owl.carousel.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/ticker-style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/flaticon.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/slicknav.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/animate.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/magnific-popup.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/fontawesome-all.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/themify-icons.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/slick.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/nice-select.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        body { overflow-x: hidden; }
        body.dark-mode { background: #0f172a; color: #e2e8f0; }
        .dark-mode .header-mid, .dark-mode .header-bottom, .dark-mode .footer-area, .dark-mode .footer-bottom-area { background: #020617 !important; border-color: #1e293b !important; }
        .dark-mode .section-tittle h3, .dark-mode .footer-tittle h4, .dark-mode .footer-pera p, .dark-mode .header-info-left ul li { color: #f8fafc !important; }
        .dark-mode .main-menu ul li a, .dark-mode .trending-tittle strong { color: #94a3b8 !important; }
        .dark-mode .trand-right-cap h4 a, .dark-mode .what-cap h4 a, .dark-mode .trend-top-cap h2 a { color: #fff !important; }
        .dark-mode .bg-light { background: #1e293b !important; color: #fff; }
        .dark-mode .header-top { background: #000 !important; border-color: #1e293b !important; }
        .dark-mode #dynamic-weather, .dark-mode .header-top-left span { color: #cbd5e1 !important; }

        /* Premium Header Utilities */
        .util-divider { width: 1px; height: 16px; background: rgba(255,255,255,0.1); margin: 0 5px; }
        
        .header-util-item {
            width: 34px;
            height: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            cursor: pointer;
        }
        .header-util-item:hover {
            background: rgba(255,255,255,0.15);
            transform: translateY(-2px);
            border-color: rgba(255,255,255,0.2);
        }

        #dark-mode-toggle { font-size: 14px; color: #9ca3af; transition: all 0.3s; }
        body.dark-mode #dark-mode-toggle { color: #fbbf24; }
        body.dark-mode #dark-mode-toggle i { transform: rotate(360deg); }

        .lang-switcher-v2 {
            display: flex;
            background: #18181b;
            border: 1px solid #27272a;
            border-radius: 40px;
            padding: 2px;
            gap: 2px;
        }
        .lang-switcher-v2 a {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 900;
            text-decoration: none !important;
            color: #71717a;
            transition: all 0.3s;
        }
        .lang-switcher-v2 a.active {
            background: #dc2626;
            color: #fff;
            box-shadow: 0 4px 10px rgba(220, 38, 36, 0.3);
        }
        .lang-switcher-v2 a:not(.active):hover {
            color: #fff;
            background: rgba(255,255,255,0.05);
        }

        .notif-trigger-premium {
            position: relative;
            color: #9ca3af;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none !important;
            transition: color 0.3s;
        }
        .header-util-item:hover .notif-trigger-premium { color: #fff; }
        
        .notif-pulse {
            position: absolute;
            top: -2px;
            right: -2px;
            width: 8px;
            height: 8px;
            background: #ef4444;
            border-radius: 50%;
            border: 2px solid #0f1115;
            box-shadow: 0 0 10px rgba(239, 68, 68, 0.5);
            animation: pulse-red 2s infinite;
        }

        @keyframes pulse-red {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7); }
            70% { transform: scale(1.1); box-shadow: 0 0 0 6px rgba(239, 68, 68, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(239, 68, 68, 0); }
        }
        /* Header Ad Carousel Defensive Styles */
        .header-ad-carousel { 
            max-height: 90px; 
            overflow: hidden; 
            display: block !important; 
        }
        .header-ad-carousel:not(.owl-loaded) {
            display: flex !important;
            flex-direction: column;
        }
        .header-ad-carousel:not(.owl-loaded) .item:not(:first-child) {
            display: none !important;
        }
        .header-ad-carousel .item { 
            height: 90px; 
            display: flex; 
            align-items: center; 
            justify-content: flex-end; 
        }
        /* Force Header visibility on Mobile */
        @media (max-width: 991px) {
            .main-header { display: block !important; }
            /* Compensate for fixed mobile header */
            body { padding-top: 70px !important; }
        }
        /* Mobile editorial header styles */
        .mobile-header-editorial {
            position: fixed !important;
            top: 0 !important;
            left: 0;
            right: 0;
            z-index: 99999 !important;
            background: #fff !important;
            box-shadow: 0 2px 12px rgba(0,0,0,0.12) !important;
        }
        /* Ensure slicknav stays below mobile header */
        .slicknav_menu { display: none !important; }
        @media (max-width: 991px) {
            .slicknav_menu { display: block !important; z-index: 99998 !important; }
        }
        /* Isolate stacking context for news/video cards so badges never escape card boundaries */
        .news-card-pro,
        .spotlight-video-card,
        .premium-news-card,
        .hero-subcard,
        .hero-wrap,
        .trending-sidebar-premium,
        .nc-thumb {
            isolation: isolate;
        }
        /* Cap all floating badges inside cards */
        .nc-badge,
        .sv-tag,
        .hero-badge,
        .cat-major-cap {
            z-index: 5 !important;
        }
    </style>
</head>

<body class="<?= (cookie('theme') == 'dark' ? 'dark-mode' : '') ?>">
    <header class="header-premium" style="font-family: 'Outfit', sans-serif;">
        <div class="header-area">
            <div class="main-header">
                <!-- Desktop Top Social and Data Bar (Hidden on Mobile) -->
                <div class="header-top d-none d-lg-block" style="background: #0f1115; padding: 10px 0; border-bottom: 1px solid #1f2229;">
                    <div class="container">
                        <div class="row align-items-center">
                            <!-- Left: Weather & Date -->
                            <div class="col-6 col-md-5 col-lg-3 text-start mb-2 mb-md-0">
                                <div class="header-top-left d-flex gap-2 align-items-center" style="font-size: 10px; color: #9ca3af; font-weight: 700; text-transform: uppercase;">
                                    <span id="dynamic-weather"><i class="fas fa-cloud-sun text-warning"></i> 28°C</span>
                                    <span class="d-none d-sm-inline" style="color: #3f3f46;">|</span>
                                    <span class="d-none d-sm-inline"><i class="far fa-calendar-alt text-danger"></i> <?= date('d M') ?></span>
                                </div>
                            </div>

                            <!-- Right: Controls (Moved up for mobile side-by-side) -->
                            <div class="col-6 col-md-7 col-lg-3 order-lg-3">
                                <div class="header-top-right d-flex justify-content-end gap-2 align-items-center">
                                    <!-- Theme Toggle -->
                                    <div class="header-util-item" style="width:28px; height:28px;">
                                        <div id="dark-mode-toggle" title="Toggle Theme" style="font-size:12px;">
                                            <i class="fas fa-moon"></i>
                                        </div>
                                    </div>

                                    <span class="util-divider" style="height:12px;"></span>
                                    
                                    <!-- Language Switcher -->
                                    <div class="lang-switcher-v2" style="font-size:10px; padding:2px;">
                                        <a href="<?= base_url('lang/hi') ?>" class="<?= (service('language')->getLocale() == 'hi' ? 'active' : '') ?>" style="padding:2px 6px;">HI</a>
                                        <a href="<?= base_url('lang/en') ?>" class="<?= (service('language')->getLocale() == 'en' ? 'active' : '') ?>" style="padding:2px 6px;">EN</a>
                                    </div>
                                    
                                    <span class="util-divider d-none d-sm-inline" style="height:12px;"></span>
                                    
                                    <!-- Notifications -->
                                    <div class="header-util-item d-none d-sm-flex" style="width:28px; height:28px;">
                                        <a href="#" class="notif-trigger-premium" title="Notifications" style="font-size:12px;">
                                            <i class="fas fa-bell"></i>
                                            <span class="notif-pulse"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Middle: Market Data & Ticker (LIVE) -->
                            <div class="col-12 col-lg-6 mb-2 mb-lg-0 order-lg-2">
                                <div class="d-flex align-items-center" style="background: #18181b; border: 1px solid #27272a; padding: 4px 6px; border-radius: 40px; font-size: 10px; color: #d4d4d8;">
                                    <span style="background: #dc2626; color: #fff; padding: 2px 10px; border-radius: 20px; font-weight: 900; margin-right: 10px; letter-spacing: 0.5px; text-transform: uppercase; flex-shrink: 0;">
                                        <i class="fas fa-chart-line"></i>
                                    </span>
                                    <marquee id="market-ticker-marquee" behavior="scroll" direction="left" scrollamount="4" style="font-weight: 700; font-family: 'Inter', sans-serif;">
                                        <span class="market-loading" style="color: #9ca3af; font-style: italic;">Loading market data...</span>
                                    </marquee>
                                </div>
                            </div>
                            <script>
                            (function() {
                                function renderTicker(items) {
                                    var html = '';
                                    items.forEach(function(item) {
                                        var color   = item.trend === 'up' ? '#4ade80' : '#f87171';
                                        var arrow   = item.trend === 'up' ? '▲' : '▼';
                                        var changeTxt = item.changePct || item.change || '';
                                        html += '<span style="margin-right: 6px;">' + item.label + '</span>';
                                        html += '<span style="color:' + color + '; font-weight:900;">' + arrow + ' ' + item.price + ' (' + changeTxt + ')</span>';
                                        html += '<span style="color:#4b5563; margin: 0 18px;">|</span>';
                                    });
                                    document.getElementById('market-ticker-marquee').innerHTML = html;
                                }

                                function loadMarketData() {
                                    fetch('<?= base_url('api/v1/market-data') ?>')
                                        .then(function(r) { return r.json(); })
                                        .then(function(res) {
                                            if (res.data && res.data.length) {
                                                renderTicker(res.data);
                                            }
                                        })
                                        .catch(function() {
                                            document.getElementById('market-ticker-marquee').innerHTML =
                                                'SENSEX <span style="color:#4ade80">▲ 78,516</span> &nbsp;|&nbsp; NIFTY <span style="color:#4ade80">▲ 24,378</span> &nbsp;|&nbsp; GOLD <span style="color:#f87171">▼ ₹15,415/g</span>';
                                        });
                                }

                                // Load immediately + refresh every 5 minutes
                                loadMarketData();
                                setInterval(loadMarketData, 300000);
                            })();
                            </script>
                        </div>
                    </div>
                </div>

                <!-- Desktop Middle Branding Bar (Hidden on Mobile) -->
                <div class="header-mid d-none d-lg-block py-3 py-lg-4" style="background: var(--bg-pure, #fff);">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-4 col-md-5 col-12 text-center text-md-start mb-3 mb-md-0">
                                <div class="logo">
                                    <a href="<?= base_url() ?>">
                                        <img src="<?= base_url('uploads/settings/' . $siteLogo) ?>" alt="<?= esc($siteName) ?>" style="max-height: 70px; width: auto; object-fit: contain;">
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-7 col-12">
                                <div class="header-ad text-center text-md-end">
                                    <div class="owl-carousel header-ad-carousel">
                                        <?php 
                                            $headerAds = get_ads('header_banner');
                                            if (!empty($headerAds)):
                                                foreach ($headerAds as $ad):
                                        ?>
                                        <div class="item">
                                            <?php if ($ad['ad_type'] == 'image'): ?>
                                                <a href="<?= esc($ad['link']) ?>" target="_blank" class="d-inline-block">
                                                    <img src="<?= base_url('uploads/ads/' . $ad['image']) ?>" alt="Header Ad" style="max-height: 90px; width: auto; max-width: 100%; object-fit: contain;">
                                                </a>
                                            <?php else: ?>
                                                <?= $ad['custom_code'] ?>
                                            <?php endif; ?>
                                        </div>
                                        <?php 
                                                endforeach;
                                            else:
                                        ?>
                                        <!-- Fallback Ad if none active in ad_management -->
                                        <div class="item">
                                            <?php if ($headerBannerSetting): ?>
                                                <a href="#" class="d-inline-block"><img src="<?= base_url('uploads/settings/' . $headerBannerSetting) ?>" alt="Banner Ad" style="max-height: 90px; width: auto; max-width: 100%; object-fit: contain;"></a>
                                            <?php else: ?>
                                                <a href="#" class="d-inline-block"><img src="<?= base_url('assets/img/hero/header_card.jpg') ?>" alt="Default Ad" style="max-height: 90px; width: auto; max-width: 100%; object-fit: contain;"></a>
                                            <?php endif; ?>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Desktop Middle Branding Bar -->

                <!-- Editorial Mobile Header (Inspired by The Hindu) -->
                <div class="mobile-header-editorial d-lg-none">
                    <div class="container">
                       
                        
                        <!-- Main Logo & Triggers Row -->
                        <div class="d-flex justify-content-between align-items-center py-2">
                            <div class="mobile-brand" style="max-width: 60%;">
                                <a href="<?= base_url() ?>" class="text-decoration-none d-flex align-items-center">
                                    <?php if (!empty($siteLogo) && file_exists(FCPATH . 'uploads/settings/' . $siteLogo)): ?>
                                        <img src="<?= base_url('uploads/settings/' . $siteLogo) ?>" 
                                             alt="<?= esc($siteName) ?>" 
                                             style="max-height: 44px; width: auto; object-fit: contain; display: block;">
                                    <?php else: ?>
                                        <span style="font-family: 'Outfit', serif; font-size: 20px; font-weight: 900; color: #c90000; letter-spacing: -0.5px; line-height: 1;">
                                            <?= esc($siteName) ?>
                                        </span>
                                    <?php endif; ?>
                                </a>
                            </div>
                            <div class="mobile-nav-tools d-flex align-items-center gap-3">
                                <div class="search-trigger-v2" style="font-size: 18px; color: #111; cursor: pointer; padding: 5px;">
                                    <i class="fas fa-search"></i>
                                </div>
                                <?php if (session()->get('isLoggedIn')): ?>
                                    <a href="<?= base_url('user/notifications') ?>" class="position-relative" style="font-size: 18px; color: #111; cursor: pointer; padding: 5px; text-decoration: none;">
                                        <i class="fas fa-bell"></i>
                                        <?php if (get_unread_notifications_count() > 0): ?>
                                            <span class="position-absolute" style="top: 0; right: 0; width: 7px; height: 7px; background: #c90000; border-radius: 50%; border: 1.5px solid #fff;"></span>
                                        <?php endif; ?>
                                    </a>
                                <?php endif; ?>
                                <div class="menu-trigger-v2 d-none" style="font-size: 22px; color: #111; cursor: pointer; border-left: 1px solid #eee; padding-left: 15px; padding: 5px 5px 5px 15px;">
                                    <i class="fas fa-bars"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modern Navigation Bar (Hidden on Mobile) -->
                <div class="header-bottom header-sticky modern-navbar-wrap d-none d-lg-block" style="background: #fff; border-bottom: 1px solid #eee; z-index: 9999; padding: 0;">
                    <div class="container">


                        <div class="row align-items-center position-relative g-0">
                            <div class="col-12 d-flex align-items-center">
                                <!-- Main Menu -->
                                <div class="main-menu w-100">
                                    <nav>                  
                                        <ul id="navigation" class="modern-nav-ul d-flex align-items-center m-0 p-0">    
                                            <!-- Fixed Triggers -->
                                            <li class="nav-trigger-item d-none d-lg-block">
                                                <a href="javascript:void(0)" id="modern-drawer-trigger" class="nav-link-modern" style="padding: 15px 23px; font-size: 18px;"><i class="fas fa-bars"></i></a>
                                            </li>

                                            <li class="d-none d-xl-block"><a href="<?= base_url() ?>" class="nav-link-modern <?= url_is('') ? 'active' : '' ?>">Home</a></li>
                                              <?php foreach (($navData['primaryNav'] ?? $navData['categories'] ?? []) as $cat): ?>
                                                 <?php $isBijnor = (strpos(strtolower($cat['slug']), 'bijnor') !== false); ?>
                                                 <li class="position-relative <?= !empty($cat['children']) ? 'has-premium-submenu' : '' ?>">
                                                    <a href="<?= !empty($cat['children']) ? 'javascript:void(0)' : base_url('category/' . $cat['slug']) ?>" class="nav-link-modern <?= url_is('category/' . $cat['slug']) ? 'active' : '' ?>" <?= $isBijnor ? 'style="color: #c90000;"' : '' ?>><?= esc($cat['title']) ?></a>
                                                    <?php if (!empty($cat['children'])): ?>
                                                    <ul class="premium-submenu">
                                                        <?php foreach ($cat['children'] as $child): ?>
                                                            <li class="position-relative <?= !empty($child['children']) ? 'has-child-submenu' : '' ?>">
                                                                <a href="<?= !empty($child['children']) ? 'javascript:void(0)' : base_url('category/' . $child['slug']) ?>" class="justify-content-between d-flex align-items-center">
                                                                    <?= esc($child['title']) ?>
                                                                </a>
                                                                <?php if (!empty($child['children'])): ?>
                                                                <ul class="premium-submenu-child">
                                                                    <?php foreach ($child['children'] as $sub): ?>
                                                                        <li><a href="<?= base_url('category/' . $sub['slug']) ?>"><?= esc($sub['title']) ?></a></li>
                                                                    <?php endforeach; ?>
                                                                </ul>
                                                                <?php endif; ?>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                    <?php endif; ?>
                                                </li>
                                              <?php endforeach; ?>
                                             
                                             <li class="d-none d-lg-block"><a href="<?= base_url('about') ?>" class="nav-link-modern <?= url_is('about') ? 'active' : '' ?>">About</a></li>
                                             <li class="d-none d-lg-block"><a href="<?= base_url('contact') ?>" class="nav-link-modern <?= url_is('contact') ? 'active' : '' ?>">Contact</a></li>
                                            
                                            <!-- Premium tag removed -->

                                            <!-- Right Side Utility Icons -->
                                            <li class="nav-trigger-item d-none d-lg-block" style="margin-left: auto !important;">
                                                <a href="javascript:void(0)" id="modern-search-btn" class="nav-link-modern d-flex align-items-center justify-content-center" style="padding: 18px 20px; font-size: 18px; width: 60px; height: 100%; border-right: none;" title="Search">
                                                    <i class="fas fa-search"></i>
                                                </a>
                                            </li>
                                            
                                            <li class="nav-trigger-item d-none d-lg-block">
                                                <?php if (session()->get('isLoggedIn')): ?>
                                                    <a href="<?= base_url('user/notifications') ?>" class="nav-link-modern d-flex align-items-center justify-content-center position-relative" style="padding: 18px 20px; font-size: 19px; width: 60px; height: 100%; border-right: none;" title="Notifications">
                                                        <i class="fas fa-bell"></i>
                                                        <?php $topNotif = get_unread_notifications_count(); if ($topNotif > 0): ?>
                                                            <span class="position-absolute" style="top: 12px; right: 12px; width: 8px; height: 8px; background: #c90000; border-radius: 50%; border: 2px solid #fff;"></span>
                                                        <?php endif; ?>
                                                    </a>
                                                <?php endif; ?>
                                            </li>

                                            <li class="nav-trigger-item d-none d-lg-block">
                                                <?php if (session()->get('isLoggedIn')): ?>
                                                    <a href="<?= base_url('user/dashboard') ?>" class="nav-link-modern d-flex align-items-center justify-content-center" style="padding: 18px 20px; font-size: 19px; width: 60px; height: 100%; border-right: none; color: #c90000;" title="User Dashboard">
                                                        <i class="fas fa-user-circle"></i>
                                                    </a>
                                                <?php else: ?>
                                                    <a href="<?= base_url('login') ?>" class="nav-link-modern d-flex align-items-center justify-content-center" style="padding: 18px 20px; font-size: 19px; width: 60px; height: 100%; border-right: none;" title="Login">
                                                        <i class="far fa-user-circle"></i>
                                                    </a>
                                                <?php endif; ?>
                                            </li>

                                            <!-- Standard mobile parts removed to favor editorial header -->
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
     </div>
            </div>
        </div>
    </header>
    <!-- Full Width Search Search Overlay -->
    <div id="search-overlay-premium" style="position: fixed; top: 0; left: 0; width: 100%; height: 80px; background: #fff; z-index: 200005; display: flex; align-items: center; padding: 0; transform: translateY(-10px) scale(0.98); opacity: 0; pointer-events: none; transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1); box-shadow: 0 15px 40px rgba(0,0,0,0.15);">
        <div class="container w-100">
            <form action="<?= base_url('search') ?>" method="GET" style="width: 100%; display: flex; align-items: center; gap: 20px;">
                <i class="fas fa-search" style="font-size: 24px; color: #111;"></i>
                <input type="text" name="q" placeholder="Search news, stories, and more..." autocomplete="off" style="flex: 1; border: none; outline: none; font-size: 22px; font-weight: 700; color: #000; background: transparent; padding: 10px 0;">
                <div id="search-close-global" style="cursor: pointer; font-size: 28px; color: #111; padding: 10px; transition: all 0.3s; line-height: 1;" onmouseover="this.style.color='#c90000'" onmouseout="this.style.color='#111'"><i class="fas fa-times"></i></div>
            </form>
        </div>
    </div>
    <style>
        .nav-link-modern { font-size: 15px; font-weight: 800; color: #111; text-decoration: none !important; padding: 18px 15px; display: inline-block; transition: all 0.2s; font-family: 'Outfit', sans-serif; position: relative; }
        .nav-link-modern:hover { color: #c90000; }
        .nav-link-modern.active { color: #c90000; }
        .nav-link-modern.active:after { content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 4px; background: #c90000; }
        .nav-link-modern:hover:not(.active):after { display: none; }
        
        .modern-nav-ul { list-style: none; width: 100%; border-left: 1px solid #eee; border-right: 1px solid #eee; }
        .nav-trigger-item { background: #fff; }
        .search-trigger-modern .nav-link-modern { font-weight: 900; color: #002e5b; border-right: 1px solid #eee; }

        .premium-tag-item .premium-link { font-weight: 800; color: #002e5b; }
        .premium-tag-item .premium-link:hover { color: #ffb81c; }

        /* Prime Premium Dropdown */
        .premium-submenu { 
            position: absolute; 
            top: 100%; 
            left: 0; 
            background: rgba(255, 255, 255, 0.95); 
            backdrop-filter: blur(10px);
            min-width: 220px; 
            list-style: none !important; 
            padding: 10px 0 !important; 
            margin: 0 !important;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1); 
            border-radius: 0 0 15px 15px; 
            visibility: hidden; 
            opacity: 0; 
            transform: translateY(15px); 
            transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1); 
            z-index: 1000; 
            border: 1px solid rgba(0,0,0,0.05);
            border-top: 3px solid #c90000; 
        }
        .has-premium-submenu:hover > .premium-submenu { visibility: visible; opacity: 1; transform: translateY(0); }
        
        .premium-submenu > li { 
            list-style: none !important; 
            padding: 0 !important; 
            margin: 0 !important; 
            display: block !important; 
            width: 100% !important;
            float: none !important;
        }
        
        .premium-submenu > li > a { 
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            font-size: 14px !important; 
            font-weight: 600 !important; 
            color: #333 !important; 
            padding: 12px 25px !important; 
            margin: 0 !important;
            text-transform: none !important;
            text-decoration: none !important; 
            transition: all 0.2s ease !important;
            line-height: normal !important;
            height: auto !important;
            position: relative;
        }
        .premium-submenu > li > a:after { content: '\f105' !important; font-family: 'Font Awesome 5 Free' !important; font-weight: 900 !important; font-size: 11px !important; color: #ccc !important; position: static !important; width: auto !important; height: auto !important; background: transparent !important; transition: all 0.2s ease !important; } 
        .premium-submenu > li > a:hover { color: #c90000 !important; background: rgba(201, 0, 0, 0.03) !important; padding-left: 30px !important; } 
        .premium-submenu > li > a:hover:after { color: #c90000 !important; transform: translateX(3px) !important; }

        /* 3rd Level Submenu (Side-fly) */
        .premium-submenu-child { 
            position: absolute; 
            top: 0; 
            left: 100%; 
            background: rgba(255, 255, 255, 0.95); 
            backdrop-filter: blur(10px);
            min-width: 220px; 
            list-style: none !important; 
            padding: 10px 0 !important; 
            margin: 0 !important;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1); 
            border-radius: 15px; 
            visibility: hidden; 
            opacity: 0; 
            transform: translateX(15px); 
            transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1); 
            z-index: 1001; 
            border: 1px solid rgba(0,0,0,0.05);
            border-left: 3px solid #c90000;
        }
        .has-child-submenu:hover > .premium-submenu-child { visibility: visible; opacity: 1; transform: translateX(0); }

        .premium-submenu-child li { 
            list-style: none !important; 
            padding: 0 !important; 
            margin: 0 !important; 
            display: block !important; 
            width: 100% !important;
            float: none !important;
        }

        .premium-submenu-child li a { 
            display: block !important;
            font-size: 14px !important; 
            font-weight: 600 !important; 
            color: #555 !important; 
            padding: 10px 25px !important; 
            margin: 0 !important;
            text-decoration: none !important; 
            transition: all 0.2s ease !important;
            line-height: normal !important;
            height: auto !important;
        }
        .premium-submenu-child li a:hover { color: #c90000 !important; background: rgba(201, 0, 0, 0.03) !important; padding-left: 30px !important; }

        
        /* Side Drawer Styles */
        .side-drawer-premium { position: fixed; top: 0; left: -380px; width: 380px; max-width: 85vw; height: 100vh; background: #fff; z-index: 200000; transition: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1); box-shadow: 25px 0 60px rgba(0,0,0,0.1); padding: 50px 40px; overflow-y: auto; }
        .side-drawer-premium.open { left: 0; }
        .drawer-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); z-index: 150000; opacity: 0; pointer-events: none; transition: all 0.6s; }
        .drawer-overlay.open { opacity: 1; pointer-events: auto; }
        
        .drawer-menu li { transition: all 0.3s; opacity: 0.9; }
        .drawer-menu li:hover { opacity: 1; transform: translateX(8px); }
        .drawer-menu li:hover i { color: #c90000 !important; }
        .drawer-menu a:hover { color: #c90000 !important; }

        .header-sticky.sticky-bar { padding: 0; background: #fff !important; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .transition { transition: all 0.2s ease-in-out; }
        .hover-opacity-100:hover { opacity: 1 !important; }

        /* Global Social Tiles */
        .social-vibrant-tile { display: block; text-decoration: none !important; border-radius: 20px; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); box-shadow: 0 10px 20px rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.05); height: 100%; }
        .vibrant-inner { padding: 25px 15px; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 12px; color: #fff; text-align: center; }
        @media (min-width: 768px) { .vibrant-inner { flex-direction: row; text-align: left; padding: 25px 20px; gap: 15px; } }
        .social-vibrant-tile:hover { transform: translateY(-12px) scale(1.03); box-shadow: 0 25px 50px rgba(0,0,0,0.5); filter: brightness(1.15); border-color: rgba(255,255,255,0.2); }
        .vibrant-inner i { font-size: 26px; filter: drop-shadow(0 4px 10px rgba(0,0,0,0.3)); }
        .v-platform { display: block; font-size: 10px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; opacity: 0.8; margin-bottom: 2px; }
        .v-metrics { display: block; font-size: 14px; font-weight: 900; letter-spacing: -0.5px; }

        @media only screen and (max-width: 767px) {
            .community-panoramic-card { border-radius: 30px !important; padding: 40px 15px !important; margin-bottom: 60px !important; }
            .community-panoramic-card h2 { font-size: 28px !important; letter-spacing: -1.5px !important; }
            .community-panoramic-card p { font-size: 14px !important; margin-bottom: 30px !important; }
            .vibrant-inner { padding: 15px 5px !important; }
            .v-metrics { font-size: 11px !important; }
            .slicknav_btn { display: none !important; } /* Hide original slicknav button */
            .footer-brand, .footer-area p, .footer-social-new { text-align: center !important; justify-content: center !important; }
        }

        .row-gap-fix {
            margin-bottom: 20px !important;
        }
    </style>
    </header>

    <main>
        <?= $this->renderSection('content') ?>
    </main>

    <?php if (!isset($isAuthPage) || !$isAuthPage): ?>

    <?php endif; ?>

    <footer style="background: #0a0a0a; color: #a3a3a3; font-family: 'Inter', sans-serif;">
        <!-- Footer Start-->
        <div class="footer-area" style="padding: 80px 0 60px; border-top: 1px solid #1f1f1f;">
            <div class="container">
                <div class="row g-5">
                    <!-- Brand Section -->
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="footer-brand mb-4">
                            <a href="<?= base_url() ?>">
                                <?php if ($siteLogo): ?>
                                <img src="<?= base_url('uploads/settings/' . $siteLogo) ?>" alt="<?= esc($siteName) ?>" style="max-height:50px; filter: brightness(0) invert(1);">
                                <?php else: ?>
                                <h2 style="color: #fff; font-weight: 950; letter-spacing: -2px; margin: 0; font-size: 32px; text-transform: uppercase;">
                                    <span style="color: #dc2626;"><?= substr($siteName, 0, 1) ?></span><?= substr($siteName, 1) ?>
                                </h2>
                                <?php endif; ?>
                            </a>
                        </div>
                        <p style="font-size: 15px; line-height: 1.7; color: #888; margin-bottom: 30px;">
                            <?= esc(get_setting('footer_about', $siteName . ' is your trusted source for regional updates, deep-dive stories, and viral content that matters to your city.')) ?>
                        </p>
                        <div class="footer-social-new d-flex gap-3">
                            <?php
                                $socials = [
                                    'twitter'   => get_setting('twitter_url', '#'),
                                    'instagram' => get_setting('instagram_url', '#'),
                                    'facebook-f'=> get_setting('facebook_url', '#'),
                                    'youtube'   => get_setting('youtube_url', '#'),
                                ];
                                foreach ($socials as $icon => $url):
                                    if ($url === '#') continue;
                            ?>
                                <a href="<?= esc($url) ?>" target="_blank" style="width: 40px; height: 40px; border-radius: 50%; background: #1a1a1a; display: flex; align-items: center; justify-content: center; color: #fff; transition: all 0.3s; border: 1px solid #333;">
                                    <i class="fab fa-<?= $icon ?>"></i>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Newsletter Section -->
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <h4 style="color: #fff; font-weight: 700; margin-bottom: 25px; font-size: 18px; text-transform: uppercase; letter-spacing: 1px;">Join Our Newsletter</h4>
                        <p style="font-size: 14px; margin-bottom: 20px;">Get the latest headlines delivered straight to your inbox daily.</p>
                        
                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success p-2" style="font-size: 11px; border-radius: 8px; background: rgba(34,197,94,0.1); border-color: rgba(34,197,94,0.2); color: #4ade80; font-weight: 700;">
                                <i class="fas fa-check-circle me-2"></i> <?= session()->getFlashdata('success') ?>
                            </div>
                        <?php elseif (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger p-2" style="font-size: 11px; border-radius: 8px; background: rgba(220,38,38,0.1); border-color: rgba(220,38,38,0.2); color: #f87171; font-weight: 700;">
                                <i class="fas fa-exclamation-circle me-2"></i> <?= session()->getFlashdata('error') ?>
                            </div>
                        <?php endif; ?>

                        <form action="<?= base_url('newsletter/subscribe') ?>" method="POST" class="newsletter-form-premium" style="position: relative;">
                            <?= csrf_field() ?>
                            <input type="email" name="email" placeholder="Your email address" required style="width: 100%; background: #111; border: 1px solid #222; padding: 15px 20px; border-radius: 12px; color: #fff; outline: none; transition: border-color 0.3s;">
                            <button type="submit" style="position: absolute; right: 5px; top: 5px; bottom: 5px; background: #dc2626; color: #fff; border: none; padding: 0 20px; border-radius: 8px; font-weight: 700; font-size: 13px; transition: background 0.3s;">SUBSCRIBE</button>
                        </form>
                        <div style="margin-top: 15px; font-size: 12px; color: #555;">* We hate spam as much as you do.</div>
                    </div>

                    <!-- Trending News Section -->
                    <div class="col-xl-4 col-lg-4 col-md-12">
                        <h4 style="color: #fff; font-weight: 700; margin-bottom: 25px; font-size: 18px; text-transform: uppercase; letter-spacing: 1px;">Trending Now</h4>
                        <div class="footer-carousel-premium">
                            <div class="slick-vertical-footer">
                                <?php foreach (($navData['trending'] ?? $navData['latest'] ?? []) as $news): ?>
                                <div class="item">
                                    <a href="<?= base_url('news/'.$news['slug']) ?>" class="d-flex align-items-center gap-5 text-decoration-none py-3" style="group">
                                        <div style="width: 85px; height: 62px; flex-shrink: 0; border-radius: 12px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.5);">
                                            <img src="<?= base_url('uploads/news/'.($news['image'] ?: 'default.jpg')) ?>" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s;" alt="">
                                        </div>
                                        <p style="color: #ccc; font-size: 13.5px; font-weight: 700; line-height: 1.6; margin: 0; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; padding-left: 5px;"><?= esc($news['title']) ?></p>
                                    </a>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom" style="padding: 30px 0; border-top: 1px solid #161616;">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-5">
                        <p style="font-size: 13px; margin: 0; color: #555;">
                            <?= esc(get_setting('copyright_text', '&copy; ' . date('Y') . ' ' . $siteName . '. All rights reserved.')) ?> 
                            <span class="ms-2">Designed with ❤️ for India.</span>
                        </p>
                    </div>
                    <div class="col-md-7">
                        <!-- Menu Hidden as per request -->
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
    <style>
        .footer-social-new a:hover { background: #dc2626 !important; border-color: #dc2626 !important; transform: translateY(-3px); }
        .newsletter-form-premium input:focus { border-color: #dc2626 !important; }
        .footer-bottom a:hover { color: #fff !important; }
        .footer-news-carousel .item a:hover p { color: #fff !important; }
        .footer-news-carousel .item a:hover img { transform: scale(1.1); }
        /* Brand Identity Reinforcement */
        .brand-text-wrap h1 { 
            color: #c90000 !important; 
            font-size: clamp(18px, 4vw, 32px) !important; 
            font-weight: 950 !important;
            white-space: nowrap;
        }
        .brand-text-wrap h1 span { 
            color: #111 !important; 
            font-weight: 400 !important; 
        }

        /* Mobile Header Harmony Refined */
        @media only screen and (max-width: 991px) {
            .header-top { padding: 8px 0 !important; }
            .header-top-left { margin-bottom: 5px; }
            .header-top-left, .header-top-right { justify-content: center !important; gap: 20px !important; }
            
            .header-mid { display: none !important; } /* Hide mid bar on mobile to consolidate */
            
            .header-bottom { padding: 10px 0 !important; background: #fff !important; overflow: visible !important; }
            .header-bottom .col-xl-12 { display: flex !important; align-items: center; justify-content: space-between; gap: 10px; }
            
            .sticky-logo-premium { display: block !important; margin: 0 !important; flex-shrink: 0; max-width: 60%; }
            .sticky-logo-premium a { display: flex; align-items: center; text-decoration: none; }
            
            .header-right { margin-left: auto; flex-shrink: 0; }
            .search-trigger-premium { position: static !important; transform: none !important; padding: 12px !important; border: none !important; background: #f8f9fa; border-radius: 8px; font-size: 18px !important; }
            
            .mobile_menu { margin-left: 5px; border-radius: 8px; }
            .mobile_menu .slicknav_btn { background: #c90000 !important; margin: 0 !important; border-radius: 8px; padding: 8px 10px !important; }
            .mobile_menu .slicknav_icon-bar { background-color: #fff !important; width: 18px; height: 2px; margin: 3px 0; }
            #search-overlay-premium { padding: 0 15px !important; }
            #search-overlay-premium input { font-size: 18px !important; }
            
            /* Slicknav Mobile Layout Fix */
            .slicknav_menu { background: transparent !important; padding: 0 !important; z-index: 100000 !important; }
            .slicknav_nav { 
                position: fixed !important; 
                top: 65px !important; 
                left: 0 !important; 
                right: 0 !important;
                width: 100% !important; 
                margin: 0 !important;
                height: calc(100vh - 65px);
                background: #fff !important; 
                box-shadow: 0 20px 40px rgba(0,0,0,0.15) !important; 
                padding: 10px 0 !important;
                border-top: 3px solid #c90000;
                overflow-y: auto;
                z-index: 999999 !important;
                animation: slickFadeIn 0.3s ease-out;
            }
            @keyframes slickFadeIn { from { opacity: 0; transform: translateY(-5px); } to { opacity: 1; transform: translateY(0); } }
            
            .slicknav_nav li { margin: 0 !important; }
            .slicknav_nav a { 
                color: #111 !important; 
                font-weight: 800 !important; 
                font-size: 15px !important;
                padding: 18px 25px !important; 
                border-bottom: 1px solid #f3f4f6;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                display: block;
                text-decoration: none !important;
            }
            .slicknav_nav .slicknav_row { padding: 0 !important; border-bottom: 1px solid #f3f4f6; }
            .slicknav_nav .slicknav_row a { border-bottom: none !important; display: inline-block !important; width: auto !important; }
            
            .slicknav_nav ul a { padding-left: 45px !important; background: #fcfcfc !important; font-weight: 600 !important; font-size: 14px !important; color: #444 !important; }
            .slicknav_nav a:hover { background: #fff1f2 !important; color: #c90000 !important; }
            
            .slicknav_arrow { float: right !important; font-size: 16px !important; color: #c90000 !important; font-weight: 900 !important; margin-right: 15px !important; margin-top: 18px !important; }
            .slicknav_hidden { display: none !important; visibility: hidden !important; }
            .slicknav_open > ul { display: block !important; visibility: visible !important; }
            
            .dark-mode .slicknav_nav { background: #020617 !important; border-top-color: #c90000; }
            .dark-mode .slicknav_nav a { color: #f8fafc !important; border-bottom-color: #1e293b; }
            .dark-mode .slicknav_nav ul a { background: #0f172a !important; color: #94a3b8 !important; }
        }
    </style>

    <!-- JS here -->
    <script src="<?= base_url('assets/js/vendor/modernizr-3.5.0.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/vendor/jquery-1.12.4.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/popper.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/jquery.slicknav.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/owl.carousel.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/slick.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/gijgo.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/wow.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/animated.headline.js') ?>"></script>
    <script src="<?= base_url('assets/js/jquery.magnific-popup.js') ?>"></script>
    <script src="<?= base_url('assets/js/jquery.ticker.js') ?>"></script>
    <script src="<?= base_url('assets/js/site.js') ?>"></script>
    <script src="<?= base_url('assets/js/jquery.scrollUp.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/jquery.nice-select.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/jquery.sticky.js') ?>"></script>
    <script src="<?= base_url('assets/js/contact.js') ?>"></script>
    <script src="<?= base_url('assets/js/jquery.form.js') ?>"></script>
    <script src="<?= base_url('assets/js/jquery.validate.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/mail-script.js') ?>"></script>
    <script src="<?= base_url('assets/js/jquery.ajaxchimp.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/plugins.js') ?>"></script>
    <script>
        async function updateWeather() {
            const weatherEl = document.getElementById('dynamic-weather');
            try {
                // Default to Delhi if location fails
                let lat = 28.6139;
                let lon = 77.2090;

                // Try to get user location
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(async (position) => {
                        lat = position.coords.latitude;
                        lon = position.coords.longitude;
                        fetchWeatherData(lat, lon, weatherEl);
                    }, () => {
                        fetchWeatherData(lat, lon, weatherEl);
                    });
                } else {
                    fetchWeatherData(lat, lon, weatherEl);
                }
            } catch (error) {
                weatherEl.innerHTML = '<i class="fas fa-sun me-2" style="color: #ffb800;"></i> 32ºc, Clear';
            }
        }

        async function fetchWeatherData(lat, lon, el) {
            try {
                const response = await fetch(`https://api.open-meteo.com/v1/forecast?latitude=${lat}&longitude=${lon}&current_weather=true`);
                const data = await response.json();
                if (data.current_weather) {
                    const temp = Math.round(data.current_weather.temperature);
                    const wind = data.current_weather.windspeed;
                    const code = data.current_weather.weathercode;
                    const isDay = data.current_weather.is_day;
                    let icon = 'sun';
                    let desc = 'Clear';
                    
                    if (code > 0 && code < 4) { icon = 'cloud-sun'; desc = 'Partly Cloudy'; }
                    else if (code >= 4 && code < 50) { icon = 'cloud'; desc = 'Cloudy'; }
                    else if (code >= 50 && code < 70) { icon = 'cloud-showers-heavy'; desc = 'Rain'; }
                    else if (code >= 70) { icon = 'snowflake'; desc = 'Snow'; }

                    el.innerHTML = `<i class="fas fa-${icon} me-2" style="color: #ffb800;"></i> ${temp}ºc, ${desc}`;
                    el.style.cursor = 'pointer';
                    el.title = 'Click for details';
                    
                    // Detail Click
                    el.onclick = () => {
                        const existingDetail = document.getElementById('weather-detail-pop');
                        if (existingDetail) {
                            existingDetail.remove();
                        } else {
                            const detail = document.createElement('div');
                            detail.id = 'weather-detail-pop';
                            detail.style.cssText = 'position:absolute; top:40px; left:0; background:#000; color:#fff; padding:15px; border-radius:10px; z-index:9999; font-size:11px; min-width:150px; border:1px solid #333; box-shadow:0 10px 25px rgba(0,0,0,0.5);';
                            detail.innerHTML = `
                                <div class="mb-2" style="font-weight:900; color:#dc2626; border-bottom:1px solid #222; padding-bottom:5px;">WEATHER DETAILS</div>
                                <div class="d-flex justify-content-between mb-1"><span>Condition:</span> <span style="color:#fff;">${desc}</span></div>
                                <div class="d-flex justify-content-between mb-1"><span>Wind Speed:</span> <span style="color:#fff;">${wind} km/h</span></div>
                                <div class="d-flex justify-content-between mb-1"><span>Time:</span> <span style="color:#fff;">${isDay ? 'Day' : 'Night'}</span></div>
                                <div class="mt-2 text-center" style="font-size:9px; color:#555;">Data by Open-Meteo</div>
                            `;
                            el.parentElement.style.position = 'relative';
                            el.parentElement.appendChild(detail);
                            
                            // Close on outside click
                            setTimeout(() => {
                                document.addEventListener('click', function closePop(e) {
                                    if (!el.contains(e.target) && !detail.contains(e.target)) {
                                        detail.remove();
                                        document.removeEventListener('click', closePop);
                                    }
                                });
                            }, 10);
                        }
                    };
                }
            } catch (e) {
                el.innerHTML = '<i class="fas fa-sun me-2" style="color: #ffb800;"></i> 32ºc, Clear';
            }
        }
        updateWeather();

        window.addEventListener('DOMContentLoaded', (event) => {
            // Drawer Logic
            const hamburgerBtn = document.querySelector('.nav-trigger-item:first-child a');
            const mobileDrawerBtn = document.getElementById('mobile-drawer-btn');
            const bottomNavMenuTrigger = document.getElementById('mobile-menu-trigger');
            const sideDrawer = document.getElementById('side-drawer');
            const drawerOverlay = document.getElementById('drawer-overlay');
            const closeDrawer = document.getElementById('close-drawer');

            const toggleDrawer = () => {
                sideDrawer?.classList.toggle('open');
                drawerOverlay?.classList.toggle('open');
                document.body.style.overflow = sideDrawer?.classList.contains('open') ? 'hidden' : '';
            };

            hamburgerBtn?.addEventListener('click', toggleDrawer);
            mobileDrawerBtn?.addEventListener('click', toggleDrawer);
            bottomNavMenuTrigger?.addEventListener('click', toggleDrawer);

            // Close Drawer Logic removed from here to consolidate in the jQuery block below

            // Search Toggle logic
            const searchToggle = document.getElementById('search-toggle');
            const modernSearchBtn = document.getElementById('modern-search-btn');
            const searchOverlay = document.getElementById('search-overlay-premium');
            const searchClose = document.getElementById('search-close');
            
            const openSearch = () => {
                if(searchOverlay) {
                    searchOverlay.style.opacity = '1';
                    searchOverlay.style.pointerEvents = 'auto';
                    searchOverlay.style.transform = 'translateY(0) scale(1)';
                    $('#search-overlay-premium input').focus();
                }
            };
            
            const closeSearch = () => {
                if(searchOverlay) {
                    searchOverlay.style.opacity = '0';
                    searchOverlay.style.pointerEvents = 'none';
                    searchOverlay.style.transform = 'translateY(-5px) scale(0.98)';
                }
            };

            searchToggle?.addEventListener('click', openSearch);
            modernSearchBtn?.addEventListener('click', openSearch);
            searchClose?.addEventListener('click', closeSearch);
        });

        // Mobile Search Toggle
        document.querySelector('.search-m-trigger')?.addEventListener('click', () => {
            const searchOverlay = document.getElementById('search-overlay-premium');
            if(searchOverlay) {
                searchOverlay.style.opacity = '1';
                searchOverlay.style.pointerEvents = 'auto';
                searchOverlay.style.transform = 'translateY(0) scale(1)';
                $('#search-overlay-premium input').focus();
            }
        });

        // Dropdown Toggle logic
        document.querySelectorAll('.has-premium-submenu').forEach(item => {
            item.addEventListener('click', (e) => {
                e.stopPropagation();
                // Close others
                document.querySelectorAll('.has-premium-submenu').forEach(other => {
                    if (other !== item) other.classList.remove('is-active');
                });
                item.classList.toggle('is-active');
            });
        });

        document.addEventListener('click', () => {
            document.querySelectorAll('.has-premium-submenu').forEach(item => {
                item.classList.remove('is-active');
            });
        });
    </script>
    <!-- Premium Mobile Bottom Navigation -->
    <div class="mobile-bottom-nav d-lg-none">
        <div class="mobile-nav-wrap">
            <a href="<?= base_url() ?>" class="mobile-nav-item <?= url_is('') ? 'active' : '' ?>">
                <div class="nav-icon"><i class="fas fa-home"></i></div>
                <span>HOME</span>
            </a>
            <a href="<?= base_url('video-news') ?>" class="mobile-nav-item <?= str_contains(current_url(), 'video-news') ? 'active' : '' ?>">
                <div class="nav-icon"><i class="fas fa-play-circle"></i></div>
                <span>VIDEOS</span>
            </a>
            <a href="<?= base_url('visual-stories') ?>" class="mobile-nav-item <?= str_contains(current_url(), 'visual-stories') ? 'active' : '' ?>">
                <div class="nav-icon"><i class="fas fa-images"></i></div>
                <span>STORIES</span>
            </a>
            <?php 
                $dashboardUrl = 'login';
                if (session()->get('isLoggedIn')) {
                    $dashboardUrl = (session()->get('roleId') == 1) ? 'admin/dashboard' : 'user/dashboard';
                }
            ?>
            <a href="<?= base_url($dashboardUrl) ?>" class="mobile-nav-item <?= (str_contains(current_url(), 'login') || str_contains(current_url(), 'admin') || str_contains(current_url(), 'user')) ? 'active' : '' ?>">
                <div class="nav-icon"><i class="fas fa-user-circle"></i></div>
                <span>ACCOUNT</span>
            </a>
            <a href="javascript:void(0)" class="mobile-nav-item" id="mobile-menu-trigger">
                <div class="nav-icon"><i class="fas fa-bars"></i></div>
                <span>MENU</span>
            </a>
        </div>
    </div>

    <style>
        .mobile-bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            padding: 10px 0 calc(10px + env(safe-area-inset-bottom));
            z-index: 10000;
            box-shadow: 0 -10px 25px rgba(0, 0, 0, 0.05);
            border-radius: 20px 20px 0 0;
        }
        
        .dark-mode .mobile-bottom-nav {
            background: rgba(15, 23, 42, 0.95);
            border-top-color: rgba(255, 255, 255, 0.05);
            box-shadow: 0 -10px 25px rgba(0, 0, 0, 0.3);
        }

        .mobile-nav-wrap {
            display: flex;
            justify-content: space-around;
            align-items: center;
            max-width: 500px;
            margin: 0 auto;
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
            font-size: 8px;
            font-weight: 800;
            letter-spacing: 0px;
            text-transform: uppercase;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            width: 100%;
            text-align: center;
        }

        .mobile-nav-item:hover {
            color: #c90000;
        }
        
        .mobile-nav-item:hover .nav-icon {
            background: rgba(201, 0, 0, 0.05);
            transform: translateY(-2px);
        }

        .mobile-nav-item.active {
            color: #c90000;
        }

        .mobile-nav-item.active .nav-icon {
            background: #fff1f2;
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(201, 0, 0, 0.1);
        }
        
        .mobile-nav-item.active .nav-icon i {
            color: #c90000;
        }
        
        .dark-mode .mobile-nav-item.active .nav-icon {
            background: rgba(201, 0, 0, 0.2);
            box-shadow: 0 8px 15px rgba(201, 0, 0, 0.2);
        }

        .mobile-nav-item.active span {
            color: #c90000;
            font-weight: 900;
        }
        
        /* Tap dynamic feedback */
        .mobile-nav-item:active {
            transform: scale(0.9);
            opacity: 0.7;
        }

        /* Prevent content from being hidden behind nav */
        @media (max-width: 991px) {
            body { padding-bottom: 80px !important; }
            .footer-area { margin-bottom: 20px; }
        }
        
    </style>

    <script src="<?= base_url('assets/js/main.js') ?>"></script>
    
    <script>
        $(document).ready(function() {
            // Mobile Search Trigger
            $('#mobile-search-trigger').click(function() {
                // Ensure the search overlay opens reliably
                const searchOverlay = document.getElementById('search-overlay-premium');
                if(searchOverlay) {
                    searchOverlay.style.opacity = '1';
                    searchOverlay.style.pointerEvents = 'auto';
                    searchOverlay.style.transform = 'translateY(0) scale(1)';
                    $('#search-overlay-premium input').focus();
                }
            });

            // Modern Drawer handles the mobile menu, Slicknav is no longer instantiated.
            $('#dark-mode-toggle').click(function() {
                $('body').toggleClass('dark-mode');
                const isDark = $('body').hasClass('dark-mode');
                document.cookie = "theme=" + (isDark ? 'dark' : 'light') + "; path=/; max-age=" + (30*24*60*60);
                $(this).find('i').toggleClass('fa-moon fa-sun');
            });

            // Initialize icon
            if ($('body').hasClass('dark-mode')) {
                $('#dark-mode-toggle i').removeClass('fa-moon').addClass('fa-sun');
            }

            // Push Notification Placeholder
            $('#push-subscribe').click(function(e) {
                e.preventDefault();
                if (!("Notification" in window)) {
                    alert("This browser does not support desktop notification");
                } else if (Notification.permission === "granted") {
                    alert("Already subscribed!");
                } else if (Notification.permission !== "denied") {
                    Notification.requestPermission().then(function (permission) {
                        if (permission === "granted") {
                            alert("Thank you for subscribing!");
                            // Here you'd send the token to /push/subscribe
                        }
                    });
                }
            });
            // Footer Vertical Slider (Slick)
            $('.slick-vertical-footer').slick({
                vertical: true,
                verticalSwiping: true,
                slidesToShow: 2,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2500,
                arrows: false,
                dots: false,
                infinite: true,
                pauseOnHover: true,
                adaptiveHeight: true
            });

            // Home Sidebar Trending Carousel
            $('.trending-side-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: false,
                dots: true,
                autoplay: true,
                autoplayTimeout: 4000,
                autoplayHoverPause: true,
                items: 1
            });
            // Header Ad Carousel
            var $headerAdCarousel = $('.header-ad-carousel');
            var headerAdCount = $headerAdCarousel.find('.item').length;
            $headerAdCarousel.owlCarousel({
                items: 1,
                loop: headerAdCount > 1,
                autoplay: headerAdCount > 1,
                autoplayTimeout: 4000,
                nav: false,
                dots: false,
                smartSpeed: 800,
                animateOut: headerAdCount > 1 ? 'fadeOut' : false
            });
        });
</script>

    <!-- Identity Shield Enforcement -->
    <?php
        $rcp = get_setting('protection_right_click', '0');
        $dtg = get_setting('protection_devtools', '0');
    ?>
    <?php if ($rcp == '1' || $dtg == '1'): ?>
    <script>
        (function() {
            // Right-Click Protection
            <?php if ($rcp == '1'): ?>
            document.addEventListener('contextmenu', e => e.preventDefault());
            <?php endif; ?>

            // DevTools Guard
            <?php if ($dtg == '1'): ?>
            document.onkeydown = function(e) {
                // F12, Ctrl+Shift+I, Ctrl+Shift+C, Ctrl+Shift+J, Ctrl+U
                if (e.keyCode == 123 || 
                    (e.ctrlKey && e.shiftKey && (e.keyCode == 73 || e.keyCode == 74 || e.keyCode == 67)) || 
                    (e.ctrlKey && e.keyCode == 85)) {
                    return false;
                }
            };
            <?php endif; ?>
        })();
    </script>
    <?php endif; ?>

    <!-- Side Drawer -->
    <div class="side-drawer-premium" id="side-drawer">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div class="drawer-brand">
                <?php if ($siteLogo): ?>
                    <img src="<?= base_url('uploads/settings/' . $siteLogo) ?>" alt="<?= esc($siteName) ?>" style="max-height: 40px; width: auto;">
                <?php else: ?>
                    <div style="background:#c90000; color:#fff; padding:4px 12px; border-radius:8px; font-weight:950; font-size:22px; letter-spacing:-1px;"><?= substr($siteName, 0, 2) ?></div>
                <?php endif; ?>
            </div>
            <div id="close-drawer" style="cursor: pointer; font-size: 24px; color: #111; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; background: #f8f9fa; border-radius: 50%; transition: all 0.3s;" onmouseover="this.style.background='#fff1f2'; this.style.color='#c90000';" onmouseout="this.style.background='#f8f9fa'; this.style.color='#111';"><i class="fa fa-times"></i></div>
        </div>
        <div class="drawer-menu">
            <h4 style="font-size: 11px; font-weight: 800; color: #888; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 30px;">Browse Categories</h4>
            <ul class="list-unstyled drawer-menu-ul">
                <li class="mb-4 d-flex align-items-center gap-3">
                    <i class="fas fa-home" style="width: 20px; color: #555;"></i>
                    <a href="<?= base_url() ?>" style="font-size: 20px; font-weight: 700; color: #111; text-decoration: none;">Home</a>
                </li>
                <?php 
                $cat_icons = [
                    'politic' => 'fa-university',
                    'sport' => 'fa-futbol',
                    'national' => 'fa-flag',
                    'entertain' => 'fa-film',
                    'tech' => 'fa-microchip',
                    'health' => 'fa-heartbeat',
                    'visual' => 'fa-images',
                    'crime' => 'fa-user-secret',
                    'game' => 'fa-gamepad',
                    'lifestyle' => 'fa-coffee',
                    'religion' => 'fa-book-open',
                    'education' => 'fa-graduation-cap',
                    'business' => 'fa-briefcase',
                    'world' => 'fa-globe',
                    'science' => 'fa-flask',
                    'auto' => 'fa-car',
                    'state' => 'fa-map-marker-alt',
                    'bijnor' => 'fa-map-marked-alt'
                ];
                foreach (($navData['categories'] ?? []) as $cat): 
                    $iconClass = 'fa-list-ul';
                    foreach($cat_icons as $slug_part => $icon) {
                        if(stripos($cat['slug'], $slug_part) !== false || stripos($cat['title'], $slug_part) !== false) {
                            $iconClass = $icon;
                            break;
                        }
                    }
                ?>
                    <li class="mb-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <i class="fas <?= $iconClass ?>" style="width: 20px; color: #888; font-size: 16px; text-align: center;"></i>
                                <a href="<?= !empty($cat['children']) ? 'javascript:void(0)' : base_url('category/' . $cat['slug']) ?>" 
                                   class="<?= !empty($cat['children']) ? 'drawer-submenu-toggle' : '' ?>"
                                   style="font-size: 20px; font-weight: 700; color: #111; text-decoration: none;">
                                   <?= esc($cat['title']) ?>
                                </a>
                            </div>
                            <?php if(!empty($cat['children'])): ?>
                                <i class="fas fa-chevron-right drawer-submenu-icon" style="color: #cbd5e1; font-size: 14px; transition: transform 0.3s; cursor: pointer;"></i>
                            <?php endif; ?>
                        </div>
                        
                        <?php if(!empty($cat['children'])): ?>
                            <ul class="drawer-submenu-list list-unstyled ps-5 mt-3 d-none" style="border-left: 2px solid #f1f5f9; margin-left: 10px;">
                                <?php foreach($cat['children'] as $child): ?>
                                    <li class="mb-3">
                                        <a href="<?= base_url('category/' . $child['slug']) ?>" style="font-size: 16px; font-weight: 600; color: #475569; text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='#c90000'" onmouseout="this.style.color='#475569'">
                                            <?= esc($child['title']) ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
            
            <div class="mt-5 pt-4 border-top">
                <h4 style="font-size: 11px; font-weight: 800; color: #888; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 25px;">Company</h4>
                <ul class="list-unstyled drawer-menu-ul">
                    <li class="mb-4 d-flex align-items-center gap-3">
                        <i class="fas fa-info-circle" style="width: 20px; color: #888;"></i>
                        <a href="<?= base_url('about') ?>" style="font-size: 18px; font-weight: 700; color: #111; text-decoration: none;">About Us</a>
                    </li>
                    <li class="mb-4 d-flex align-items-center gap-3">
                        <i class="fas fa-envelope" style="width: 20px; color: #888;"></i>
                        <a href="<?= base_url('contact') ?>" style="font-size: 18px; font-weight: 700; color: #111; text-decoration: none;">Contact Us</a>
                    </li>
                </ul>
            </div>

            <div class="mt-4 pt-4 border-top">
                <h4 style="font-size: 11px; font-weight: 800; color: #888; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 20px;">Language / भाषा</h4>
                <div class="lang-switcher-v2" style="padding: 4px; display: flex !important; width: fit-content; background: #f8f9fa;">
                    <a href="<?= base_url('lang/hi') ?>" class="<?= (service('language')->getLocale() == 'hi' ? 'active' : '') ?>" style="padding: 8px 24px; font-size: 11px;">HINDI / हिंदी</a>
                    <a href="<?= base_url('lang/en') ?>" class="<?= (service('language')->getLocale() == 'en' ? 'active' : '') ?>" style="padding: 8px 24px; font-size: 11px;">ENGLISH</a>
                </div>
            </div>
        </div>
    </div>
    <div class="drawer-overlay" id="drawer-overlay"></div>

    <script>
        $(document).ready(function() {
            // Consolidated Search Triggers (Desktop & Mobile) - Delegated for Sticky support
            $(document).on('click', '.search-trigger-v2, #modern-search-btn', function() {
                $('#search-overlay-premium').css({
                    'opacity': '1',
                    'pointer-events': 'all',
                    'transform': 'translateY(0) scale(1)'
                });
                $('#search-overlay-premium input').focus();
            });

            // Global Search Close
            $(document).on('click', '#search-close-global', function() {
                $('#search-overlay-premium').css({
                    'opacity': '0',
                    'pointer-events': 'none',
                    'transform': 'translateY(-10px) scale(0.98)'
                });
            });

            // Mobile Menu Trigger (Side Drawer) - Delegated for Sticky support
            $(document).on('click', '.menu-trigger-v2, #modern-drawer-trigger, #mobile-menu-trigger', function() {
                $('#side-drawer').addClass('open');
                $('#drawer-overlay').addClass('open');
                document.body.style.overflow = 'hidden';
            });
            
            // Side Drawer Submenu Toggle
            $(document).on('click', '.drawer-submenu-toggle, .drawer-submenu-icon', function(e) {
                const $parentLi = $(this).closest('li');
                const $submenu = $parentLi.find('.drawer-submenu-list');
                const $icon = $parentLi.find('.drawer-submenu-icon');
                
                if ($submenu.length) {
                    e.preventDefault();
                    $submenu.toggleClass('d-none');
                    $icon.toggleClass('fa-rotate-90');
                }
            });

            // Standard close logic for drawer
            // Standard close logic for drawer using delegation for maximum reliability
            $(document).on('click', '#close-drawer, #drawer-overlay', function() {
                $('#side-drawer').removeClass('open');
                $('#drawer-overlay').removeClass('open');
                $('body').css('overflow', '');
            });
        });
    </script>
    <?= $this->renderSection('scripts') ?>
</body>
</html>

<?= $this->extend('frontend/layout') ?>

<?= $this->section('content') ?>
<style>
    /* ── Article Header ── */
    .article-header { padding: 40px 0 30px; background: #fff; }
    .breadcrumb-premium { font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: #9ca3af; margin-bottom: 20px; display: flex; align-items: center; gap: 8px; }
    .breadcrumb-premium a { color: #c90000; text-decoration: none; }
    .article-title { font-size: 42px; font-weight: 900; color: #111; line-height: 1.1; letter-spacing: -1.5px; margin-bottom: 25px; }
    .article-meta { display: flex; align-items: center; gap: 20px; padding-bottom: 25px; border-bottom: 1px solid #f0f0f0; margin-bottom: 30px; }
    .meta-item { display: flex; align-items: center; gap: 8px; font-size: 13px; font-weight: 700; color: #6b7280; }
    .meta-item i { color: #c90000; font-size: 14px; }
    .cat-pill { background: #c90000; color: #fff; padding: 4px 12px; border-radius: 4px; font-size: 10px; font-weight: 900; text-transform: uppercase; }

    /* ── Article Body ── */
    .feature-img-wrap { border-radius: 24px; overflow: hidden; box-shadow: 0 30px 60px rgba(0,0,0,0.12); margin-bottom: 60px; }
    .feature-img-wrap img { width: 100%; height: auto; display: block; }
    
    .article-content { font-size: 18px; line-height: 1.9; color: #333; font-family: 'Inter', sans-serif; }
    .article-content p { margin-bottom: 28px; }
    .article-content h2, .article-content h3 { font-weight: 900; color: #111; margin: 45px 0 25px; line-height: 1.2; }
    .article-content img { max-width: 100%; height: auto; border-radius: 12px; margin: 20px 0; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
    
    /* ── Share Bar ── */
    .share-bar-premium { display: flex; align-items: center; gap: 20px; padding: 25px 0; border-top: 1px solid #f0f0f0; border-bottom: 1px solid #f0f0f0; margin: 40px 0; }
    .share-label { font-weight: 900; text-transform: uppercase; font-size: 11px; color: #9ca3af; letter-spacing: 1px; }
    .share-btns-group { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
    .share-pill { display: flex; align-items: center; gap: 8px; padding: 10px 20px; border-radius: 50px; color: #fff !important; text-decoration: none !important; font-size: 12px; font-weight: 800; transition: all 0.3s; }
    .share-pill.fb { background: #1877f2; }
    .share-pill.bird { background: #1da1f2; }
    .share-pill.wa { background: #25d366; }

    /* ── Sidebars / Widgets ── */
    .sidebar-widget { background: #fff; border-radius: 16px; padding: 24px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); border: 1px solid #f0f0f0; margin-bottom: 30px; }
    .widget-title { border-left: 4px solid #c90000; padding-left: 15px; margin-bottom: 25px; }
    .widget-title h4 { font-size: 18px; font-weight: 900; color: #111; text-transform: uppercase; margin: 0; }
    
    .related-item-premium { display: flex; gap: 15px; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 1px solid #f8f8f8; text-decoration: none !important; }
    .related-thumb { width: 80px; height: 65px; border-radius: 8px; overflow: hidden; flex-shrink: 0; }
    .related-thumb img { width: 100%; height: 100%; object-fit: cover; }
    .related-cap h5 { font-size: 13px; font-weight: 700; color: #111; line-height: 1.4; margin: 0; transition: color 0.3s; }

    @media (max-width: 768px) {
        .article-title { font-size: 28px; }
        .feature-img-wrap { border-radius: 12px; margin-bottom: 30px; }
    }
</style>

<div class="article-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="breadcrumb-premium">
                    <a href="<?= base_url() ?>">Home</a> 
                    <i class="fas fa-chevron-right" style="font-size:8px;"></i> 
                    <span class="cat-pill ms-2">Visual Stories</span>
                </div>
                <h1 class="article-title"><?= esc($story['title']) ?></h1>
                
                <div class="article-meta">
                    <div class="meta-item"><i class="far fa-calendar-alt"></i> <?= date('F d, Y', strtotime($story['created_at'])) ?></div>
                    <div class="meta-item"><i class="far fa-eye"></i> <?= number_format($story['views'] ?? 0) ?> Readings</div>
                    <div class="meta-item"><i class="far fa-user"></i> By <span style="color:#111;">Visual Editor</span></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container pb-80">
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <div class="feature-img-wrap">
                <img src="<?= base_url('uploads/stories/' . ($story['image'] ?: 'default.jpg')) ?>" 
                     onerror="this.src='<?= base_url('uploads/news/default.jpg') ?>'"
                     alt="<?= esc($story['title']) ?>">
            </div>

            <div class="article-content">
                <div class="story-lead mb-5" style="font-size: 22px; font-weight: 700; color: #111; border-left: 5px solid #c90000; padding-left: 25px; line-height: 1.5;">
                    <?= ($story['description']) ?>
                </div>
                
                <div class="story-full-body">
                    <?= ($story['content']) ?>
                </div>
            </div>

            <div class="share-bar-premium">
                <span class="share-label">Share Story:</span>
                <div class="share-btns-group">
                    <a href="javascript:void(0)" class="share-pill bookmark-story-btn <?= ($isBookmarked ?? false) ? 'active' : '' ?>" data-id="<?= $story['id'] ?>" style="background: <?= ($isBookmarked ?? false) ? '#c90000' : '#475569' ?>;">
                        <i class="<?= ($isBookmarked ?? false) ? 'fas' : 'far' ?> fa-bookmark"></i>
                        <span><?= ($isBookmarked ?? false) ? 'Saved' : 'Save Story' ?></span>
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(current_url()) ?>" target="_blank" class="share-pill fb">
                        <i class="fab fa-facebook-f"></i> <span>Share</span>
                    </a>
                    <a href="https://twitter.com/intent/tweet?text=<?= urlencode($story['title']) ?>&url=<?= urlencode(current_url()) ?>" target="_blank" class="share-pill bird">
                        <i class="fab fa-twitter"></i> <span>Tweet</span>
                    </a>
                    <a href="https://api.whatsapp.com/send?text=<?= urlencode($story['title'] . ' ' . current_url()) ?>" target="_blank" class="share-pill wa">
                        <i class="fab fa-whatsapp"></i> <span>WhatsApp</span>
                    </a>
                </div>
            </div>

            <!-- INLINE CONTENT: Explore Topics -->
            <div class="mt-5 pt-3 mb-4 border-top" style="border-color: #f0f0f0 !important;">
                <h4 style="font-size: 16px; font-weight: 900; text-transform: uppercase; margin-bottom: 15px; color: #111;">Explore Related Topics</h4>
                <div class="d-flex flex-wrap gap-2">
                    <?php 
                        $tags = explode(' ', $story['title']);
                        $tags = array_filter($tags, function($t) { return strlen($t) > 4; });
                        $tags = array_slice($tags, 0, 5);
                        $tags[] = 'Visual Story';
                        foreach($tags as $tag): 
                    ?>
                        <a href="<?= base_url('search?q=' . urlencode($tag)) ?>" style="background: #f8fafc; padding: 8px 16px; border-radius: 40px; font-size: 11px; font-weight: 800; color: #64748b; text-decoration: none; text-transform: uppercase; border: 1px solid #e2e8f0; transition: all 0.3s;" onmouseover="this.style.background='#0f172a'; this.style.color='#fff';" onmouseout="this.style.background='#f8fafc'; this.style.color='#64748b';">
                            #<?= esc(trim($tag)) ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- INLINE CONTENT: Author Bio -->
            <div class="mt-4 p-4" style="background: #fff; border-radius: 16px; border: 1px solid #f0f0f0; box-shadow: 0 10px 30px rgba(0,0,0,0.03); display: flex; align-items: center; gap: 20px;">
                <div style="width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, #c90000 0%, #7f1d1d 100%); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 32px; font-weight: 900; flex-shrink: 0; box-shadow: 0 10px 20px rgba(201,0,0,0.2);">
                    V
                </div>
                <div>
                    <h5 style="font-size: 16px; font-weight: 900; color: #111; margin: 0 0 5px 0;">Published by Visual Editor</h5>
                    <p style="font-size: 13px; color: #6b7280; margin: 0; line-height: 1.5;">Our editorial desk brings you the most thoroughly researched and objective visual news designed for mobile-first consumption.</p>
                </div>
            </div>

            <!-- INLINE CONTENT: Newsletter CTA -->
            <div class="mt-4 mb-5 p-4" style="background: #0f172a; border-radius: 16px; position: relative; overflow: hidden;">
                <div style="position: absolute; top: -50px; right: -50px; width: 150px; height: 150px; background: rgba(255,255,255,0.05); border-radius: 50%;"></div>
                <div class="row align-items-center position-relative">
                    <div class="col-md-7">
                        <h4 style="color: #fff; font-size: 20px; font-weight: 900; margin-bottom: 5px;">Stay ahead of the curve.</h4>
                        <p style="color: #94a3b8; font-size: 13px; margin: 0;">Get the latest visual stories from our editors delivered directly to your inbox every morning.</p>
                    </div>
                    <div class="col-md-5 mt-3 mt-md-0 text-md-end">
                        <form action="" class="d-flex rounded-pill overflow-hidden" style="background: #fff; padding: 4px;">
                            <input type="email" placeholder="Your Email Address" style="border: none; outline: none; background: transparent; padding: 10px 15px; font-size: 13px; font-weight: 700; width: 100%;">
                            <button type="button" style="background: #c90000; color: #fff; border: none; border-radius: 40px; padding: 0 20px; font-size: 12px; font-weight: 900; text-transform: uppercase;">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>

            <script src="<?= base_url('assets/js/vendor/jquery-1.12.4.min.js') ?>"></script>
            <script>
            $(document).ready(function() {
                $('.bookmark-story-btn').on('click', function() {
                    <?php if (!session()->get('isLoggedIn')): ?>
                        window.location.href = '<?= base_url('login') ?>';
                        return;
                    <?php endif; ?>

                    var btn = $(this);
                    var storyId = btn.data('id');
                    
                    btn.css('opacity', '0.5');

                    $.post('<?= base_url('user/bookmark/toggle') ?>', {
                        story_id: storyId,
                        <?= csrf_token() ?>: '<?= csrf_hash() ?>'
                    }, function(res) {
                        btn.css('opacity', '1');
                        if (res.status === 'success') {
                            if (res.action === 'added') {
                                btn.addClass('active').css('background', '#c90000');
                                btn.find('i').removeClass('far').addClass('fas');
                                btn.find('span').text('Saved');
                            } else {
                                btn.removeClass('active').css('background', '#475569');
                                btn.find('i').removeClass('fas').addClass('far');
                                btn.find('span').text('Save Story');
                            }
                        }
                    });
                });
            });
            </script>

            <!-- Related Stories Section -->
            <?php if (!empty($relatedStories)): ?>
            <div class="mt-5 pt-4">
                <style>
                    .visual-story-card { display: block; position: relative; padding-bottom: 150%; border-radius: 24px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.05); transition: all 0.3s; }
                    .visual-story-card:hover { box-shadow: 0 15px 30px rgba(0,0,0,0.15); transform: translateY(-5px); }
                    .visual-story-card img { position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; transition: transform 0.7s ease; }
                    .visual-story-card:hover img { transform: scale(1.1); }
                    .visual-story-overlay { position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.2) 50%, transparent 100%); padding: 20px; display: flex; flex-direction: column; justify-content: flex-end; }
                </style>
                <div class="widget-title mb-4">
                    <h4 style="font-weight: 900; font-size: 20px; color: #0f172a; border-left: 4px solid #dc2626; padding-left: 15px; text-transform: uppercase; letter-spacing: 1px; margin: 0;">Related Stories</h4>
                </div>
                <div class="row g-4">
                    <?php foreach ($relatedStories as $row): ?>
                        <div class="col-md-3 col-6">
                            <a href="<?= base_url('story/' . $row['slug']) ?>" class="visual-story-card">
                                <img src="<?= base_url('uploads/stories/' . ($row['image'] ?: 'default.jpg')) ?>" alt="">
                                <div class="visual-story-overlay">
                                    <?php 
                                        $lang = service('language')->getLocale();
                                        $title = ($lang == 'hi') ? $row['title_hi'] : $row['title_en'];
                                    ?>
                                    <h5 style="color: #fff; font-weight: 900; font-size: 14px; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; margin: 0;"><?= esc($title) ?></h5>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- Back to Stories Btn -->
            <div class="mt-5 mb-5 pt-5">
                <a href="<?= base_url('visual-stories') ?>" class="btn btn-dark rounded-pill px-5 py-3 font-weight-bold" style="font-size: 13px; letter-spacing: 1px;">
                    <i class="fas fa-arrow-left me-2"></i> MORE VISUAL STORIES
                </a>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Stay Connected -->
            <div class="sidebar-widget">
                <div class="widget-title">
                    <h4>Stay <span style="color:#c90000;">Connected</span></h4>
                </div>
                <div class="social-links-wrap">
                    <a href="#" class="social-bar-premium" style="background: #1877f2; display: flex; align-items: center; justify-content: space-between; padding: 10px 15px; border-radius: 8px; margin-bottom: 8px; text-decoration: none !important; color: #fff !important; transition: all 0.3s;">
                        <span><i class="fab fa-facebook-f me-2"></i> <span style="font-size: 11px; font-weight: 800; text-transform: uppercase;">Facebook</span></span>
                        <span style="font-size: 10px; font-weight: 700; opacity: 0.9;">24K Fans</span>
                    </a>
                    <a href="#" class="social-bar-premium" style="background: #1da1f2; display: flex; align-items: center; justify-content: space-between; padding: 10px 15px; border-radius: 8px; margin-bottom: 8px; text-decoration: none !important; color: #fff !important; transition: all 0.3s;">
                        <span><i class="fab fa-twitter me-2"></i> <span style="font-size: 11px; font-weight: 800; text-transform: uppercase;">Twitter</span></span>
                        <span style="font-size: 10px; font-weight: 700; opacity: 0.9;">18K Followers</span>
                    </a>
                </div>
            </div>

            <!-- Recommendations -->
            <div class="sidebar-widget">
                <div class="widget-title">
                    <h4>Trending <span style="color: #c90000;">Visuals</span></h4>
                </div>
                <div class="related-list">
                    <?php foreach ($trending as $rel): ?>
                    <a href="<?= base_url('news/' . $rel['slug']) ?>" class="related-item-premium">
                        <div class="related-thumb">
                            <img src="<?= base_url('uploads/news/' . ($rel['image'] ?: 'default.jpg')) ?>" alt="<?= esc($rel['title']) ?>">
                        </div>
                        <div class="related-cap">
                            <h5><?= esc($rel['title']) ?></h5>
                            <span style="font-size:9px; font-weight:800; color:#999; text-transform:uppercase;"><?= date('M d, Y', strtotime($rel['publish_at'])) ?></span>
                        </div>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <!-- Ad Widget -->
            <div class="sidebar-widget d-none d-lg-block">
                <div style="border-radius:12px; overflow:hidden;">
                    <img src="<?= base_url('assets/img/news/news_card.jpg') ?>" class="w-100" alt="Ad">
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

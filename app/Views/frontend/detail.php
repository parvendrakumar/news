<?= $this->extend('frontend/layout') ?>

<?= $this->section('content') ?>

<div id="reading-progress"></div>

<!-- Premium Layout CSS Variables -->
<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        important: true,
    }
</script>

<style>
    /* ── Premium Detail Redesign ── */
    :root {
        --text-pure: #0f172a;
        --text-muted: #64748b;
        --accent-red: #dc2626;
        --bg-gray: #f8fafc;
        --border-light: #e2e8f0;
    }
    
    body { background-color: #fff; }

    /* ── Header Area (Editorial Style) ── */
    .detail-hero-section { padding: 40px 0 20px; background: #fff; }
    .breadcrumb-premium { font-size: 11px; font-weight: 900; text-transform: uppercase; letter-spacing: 1.5px; color: var(--text-muted); margin-bottom: 15px; display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
    .breadcrumb-premium a { color: var(--text-pure); text-decoration: none; transition: color 0.3s; }
    .breadcrumb-premium a:hover { color: var(--accent-red); }
    .bp-tag { background: var(--text-pure); color: #fff; padding: 4px 12px; border-radius: 4px; font-size: 10px; letter-spacing: 1px; }
    
    .article-headline { font-size: clamp(34px, 5vw, 54px); font-weight: 950; color: #000; line-height: 1.1; letter-spacing: -1.5px; margin-bottom: 25px; text-transform: capitalize; }
    
    .article-meta-modern { display: flex; align-items: center; gap: 20px; flex-wrap: wrap; padding-bottom: 20px; border-bottom: 3px solid #000; margin-bottom: 30px; }
    .meta-block { display: flex; align-items: center; gap: 8px; font-size: 13px; font-weight: 800; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px; }
    .meta-block i { color: var(--accent-red); font-size: 15px; }
    .author-name { color: var(--accent-red); font-weight: 950; }

    /* ── Featured Image ── */
    .feature-media-box { position: relative; border-radius: 12px; overflow: hidden; margin-bottom: 40px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); background: #000; }
    .feature-media-box img { width: 100%; height: auto; max-height: 600px; object-fit: cover; display: block; }
    
    /* ── Content Typography (Premium Editorial) ── */
    .article-body-pro { 
        font-size: 20px; 
        line-height: 2; 
        color: #1e293b; 
        font-family: 'Georgia', 'Times New Roman', serif; 
        padding-right: 20px; 
        letter-spacing: -0.01em;
    }
    /* ── Paragraph Rhythm & Typography ── */
    .article-body-pro p { 
        margin-bottom: 35px; 
        color: #1e293b; 
        text-align: left; 
        hyphens: auto;
        font-size: 20px;
        line-height: 1.9;
        font-weight: 400;
        letter-spacing: -0.01em;
    }

    /* Selection Highlight */
    .article-body-pro ::selection {
        background: rgba(220, 38, 38, 0.1);
        color: #dc2626;
    }

    /* Premium Links in Description */
    .article-body-pro a {
        color: #dc2626;
        text-decoration: none;
        border-bottom: 2px solid rgba(220, 38, 38, 0.1);
        transition: all 0.3s;
        font-weight: 700;
    }
    .article-body-pro a:hover {
        background: rgba(220, 38, 38, 0.05);
        border-bottom-color: #dc2626;
    }

    /* Editorial Lede Style (First Paragraph) */
    .article-body-pro > p:first-of-type {
        font-size: 24px;
        line-height: 1.7;
        color: #0f172a;
        font-weight: 600;
        margin-bottom: 50px;
        font-family: 'Outfit', sans-serif;
        letter-spacing: -0.03em;
        position: relative;
    }

    /* Signature Drop-Cap */
    .article-body-pro > p:first-of-type::first-letter { 
        float: left; 
        font-size: 90px; 
        line-height: 0.85; 
        padding-top: 12px;
        padding-right: 18px;
        font-weight: 950; 
        color: var(--accent-red); 
        font-family: 'Outfit', sans-serif; 
        text-transform: uppercase;
        filter: drop-shadow(4px 4px 0 rgba(220,38,38,0.05));
    }

    /* Reading Progress Bar */
    #reading-progress {
        position: fixed;
        top: 0;
        left: 0;
        width: 0%;
        height: 4px;
        background: linear-gradient(to right, #dc2626, #7f1d1d);
        z-index: 99999;
        box-shadow: 2px 0 10px rgba(220,38,38,0.3);
        transition: width 0.1s;
    }
    .article-body-pro h2, .article-body-pro h3 { 
        font-family: 'Outfit', sans-serif; 
        font-weight: 950; 
        color: #000; 
        margin: 60px 0 30px; 
        line-height: 1.2; 
        letter-spacing: -1px;
    }
    .article-body-pro h2 { font-size: 32px; }
    .article-body-pro h3 { font-size: 26px; }
    
    .article-body-pro img { 
        border-radius: 20px; 
        max-width: 100%; 
        height: auto; 
        margin: 40px 0; 
        box-shadow: 0 20px 40px rgba(0,0,0,0.12); 
    }
    
    .article-body-pro blockquote { 
        font-size: 26px; 
        font-weight: 400; 
        font-style: italic; 
        color: #0f172a; 
        line-height: 1.6; 
        text-align: center; 
        margin: 60px auto; 
        max-width: 90%; 
        position: relative; 
        padding: 50px 0;
        border-top: 1px solid #f1f5f9;
        border-bottom: 1px solid #f1f5f9;
    }
    .article-body-pro blockquote::before { 
        content: '\f10d'; 
        font-family: 'Font Awesome 5 Free'; 
        font-weight: 900; 
        position: absolute; 
        top: -15px; 
        left: 50%; 
        transform: translateX(-50%); 
        font-size: 30px; 
        color: var(--accent-red); 
        background: #fff;
        padding: 0 15px;
    }
    
    .article-body-pro pre { 
        background: #0f172a; 
        padding: 30px; 
        border-radius: 16px; 
        font-family: 'Fira Code', monospace; 
        font-size: 16px; 
        color: #f8fafc; 
        margin-bottom: 40px; 
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }

    /* ── Share Bar Horizontal ── */
    .share-ribbon { display: flex; align-items: center; justify-content: space-between; padding: 25px 0; border-top: 2px solid var(--border-light); border-bottom: 2px solid var(--border-light); margin: 50px 0; flex-wrap: wrap; gap: 20px; }
    .btn-save-story { display: inline-flex; align-items: center; gap: 10px; background: #fff; border: 2px solid var(--border-light); padding: 12px 25px; border-radius: 40px; font-size: 13px; font-weight: 900; color: var(--text-pure); text-transform: uppercase; letter-spacing: 1px; transition: all 0.3s; text-decoration: none; cursor: pointer; }
    .btn-save-story:hover { border-color: var(--accent-red); color: var(--accent-red); }
    .btn-save-story.active { background: var(--accent-red); border-color: var(--accent-red); color: #fff; }
    
    .social-circle-group { display: flex; gap: 10px; }
    .social-circle-btn { width: 45px; height: 45px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff !important; margin-left: 5px; font-size: 18px; text-decoration: none !important; transition: transform 0.3s, box-shadow 0.3s; }
    .social-circle-btn:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.15); }
    .sc-fb { background: #1877f2; }
    .sc-tw { background: #1da1f2; }
    .sc-wa { background: #25d366; }
    .sc-pr { background: #64748b; }

    /* ── Sidebars ── */
    .side-widget { background: #fff; border: 1px solid var(--border-light); border-radius: 20px; padding: 30px; margin-bottom: 40px; box-shadow: 0 10px 30px rgba(0,0,0,0.02); }
    .side-title { font-size: 18px; font-weight: 950; letter-spacing: -0.5px; text-transform: uppercase; color: var(--text-pure); margin-bottom: 25px; position: relative; padding-bottom: 15px; }
    .side-title::after { content: ''; position: absolute; bottom: 0; left: 0; width: 40px; height: 3px; background: var(--accent-red); border-radius: 5px; }
    
    .side-social-item { display: flex; align-items: center; justify-content: space-between; padding: 15px; border-radius: 12px; margin-bottom: 12px; color: #fff !important; text-decoration: none !important; transition: transform 0.3s; }
    .side-social-item:hover { transform: scale(1.02); }
    .ss-left { display: flex; align-items: center; gap: 12px; font-size: 14px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; }
    .ss-left i { font-size: 22px; width: 25px; text-align: center; }
    .ss-right { font-size: 11px; font-weight: 900; background: rgba(0,0,0,0.2); padding: 4px 10px; border-radius: 20px; }

    .side-related-item { display: flex; gap: 15px; padding: 15px 0; border-bottom: 1px solid var(--bg-gray); text-decoration: none !important; transition: transform 0.3s; }
    .side-related-item:hover { transform: translateX(5px); }
    .side-related-item:last-child { border-bottom: none; }
    .sri-thumb { width: 85px; height: 70px; border-radius: 10px; overflow: hidden; flex-shrink: 0; }
    .sri-thumb img { width: 100%; height: 100%; object-fit: cover; }
    .sri-text h5 { font-size: 13px; font-family: 'Inter', sans-serif; font-weight: 800; color: var(--text-pure); line-height: 1.4; margin: 0 0 5px 0; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; transition: color 0.3s; }
    .side-related-item:hover .sri-text h5 { color: var(--accent-red); }
    .sri-text span { font-size: 10px; color: var(--text-muted); font-weight: 800; text-transform: uppercase; }

    /* ── Discussion ── */
    .discussion-header { border-bottom: 2px solid var(--border-light); padding-bottom: 15px; margin-bottom: 30px; font-size: 24px; font-weight: 900; }
    .comment-bubble { background: #fff; padding: 25px; border-radius: 0 16px 16px 16px; border: 1px solid var(--border-light); box-shadow: 0 4px 10px rgba(0,0,0,0.02); }
    .comment-avatar { width: 50px; height: 50px; background: linear-gradient(135deg, var(--text-pure) 0%, #334155 100%); color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 22px; font-weight: 900; box-shadow: 0 4px 10px rgba(0,0,0,0.1); flex-shrink: 0; }
    
    .leave-reply-box { background: var(--bg-gray); padding: 40px; border-radius: 20px; border: 2px dashed var(--border-light); text-align: center; }
    .leave-reply-box .form-control { border-radius: 12px; padding: 15px; font-size: 15px; border: 1px solid var(--border-light); }
    .leave-reply-box .form-control:focus { border-color: var(--accent-red); box-shadow: 0 0 0 4px rgba(220,38,38,0.1); }

    @media (max-width: 991px) {
        .detail-hero-section { padding: 20px 0 10px; }
        .article-headline { font-size: 32px; letter-spacing: -1px; }
        .feature-media-box { margin-bottom: 25px; }
        .article-body-pro { font-size: 17px; padding-right: 0; }
        .side-widget { padding: 20px; }
    }
</style>

<div class="container pb-5">
    <div class="row">
        
        <!-- MAIN CONTENT COLUMN -->
        <div class="col-lg-8">
            
            <div class="detail-hero-section">
                <div class="breadcrumb-premium">
                    <a href="<?= base_url() ?>">Home</a> 
                    <i class="fas fa-chevron-right" style="font-size:8px; color:#cbd5e1;"></i> 
                    <span class="bp-tag"><?= esc($news['category_slug']) ?></span>
                </div>
                
                <h1 class="article-headline"><?= esc($news['title']) ?></h1>
                
                <div class="article-meta-modern">
                    <div class="meta-block">
                        <span>By <span class="author-name"><?= esc($news['custom_author'] ?? 'Editorial Desk') ?></span></span>
                    </div>
                    <i class="fas fa-circle d-none d-md-block" style="font-size:4px; color:#cbd5e1;"></i>
                    <div class="meta-block">
                        <i class="far fa-calendar-alt"></i> <?= date('F d, Y', strtotime($news['publish_at'])) ?>
                    </div>
                    <i class="fas fa-circle d-none d-md-block" style="font-size:4px; color:#cbd5e1;"></i>
                    <div class="meta-block">
                        <i class="fas fa-fire"></i> <?= number_format($news['view_count'] ?? 0) ?> Reads
                    </div>
                </div>
            </div>
            
            <?php 
                $imgDir = (isset($news['is_dedicated_video']) ? 'uploads/videos/' : 'uploads/news/');
                $displayedImg = !empty($news['image']) ? $imgDir . $news['image'] : 'uploads/news/default.jpg';
                $showFeaturedMedia = empty($news['is_video_news']); 
            ?>
            <?php if ($showFeaturedMedia): ?>
                <div class="feature-media-box">
                    <img src="<?= base_url($displayedImg) ?>" alt="<?= esc($news['title']) ?>">
                </div>
            <?php endif; ?>

            <div class="article-body-pro">
                <?php if (!empty($news['is_video_news']) && !empty($news['video_url'])): ?>
                    <div class="video-container-premium mb-5" style="border-radius:24px; overflow:hidden; box-shadow:0 30px 60px rgba(0,0,0,0.4); background:#000; position:relative; z-index:10; border:4px solid #fff;">
                        <?php 
                            $vUrl = $news['video_url'];
                            $vId = '';
                            if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $vUrl, $match)) { $vId = $match[1]; }
                            $thumb = !empty($news['image']) 
                                ? (isset($news['is_dedicated_video']) ? 'uploads/videos/' : 'uploads/news/') . $news['image']
                                : 'uploads/news/default.jpg';
                            if ($vId):
                        ?>
                            <div id="video-wrapper-<?= $vId ?>" style="position:relative; padding-bottom:56.25%; height:0; background:url('<?= base_url($thumb) ?>') center/cover no-repeat; cursor:pointer;" onclick="this.innerHTML = '<iframe style=\'position:absolute; top:0; left:0; width:100%; height:100%;\' src=\'https://www.youtube.com/embed/<?= $vId ?>?autoplay=1&rel=0\' frameborder=\'0\' allow=\'autoplay; encrypted-media\' allowfullscreen></iframe>'">
                                <div style="position:absolute; inset:0; background:rgba(0,0,0,0.4); display:flex; align-items:center; justify-content:center;">
                                    <div style="width:80px; height:80px; background:#dc2626; border-radius:50%; display:flex; align-items:center; justify-content:center; border:2px solid #fff; box-shadow:0 0 30px rgba(220,38,38,0.5);"><i class="fas fa-play" style="color:#fff; font-size:28px; margin-left:4px;"></i></div>
                                </div>
                            </div>
                        <?php else: ?>
                            <div style="position:relative; padding-bottom:56.25%; height:0;">
                                <iframe style="position:absolute; top:0; left:0; width:100%; height:100%;" src="<?= esc($vUrl) ?>" frameborder="0" allowfullscreen></iframe>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <?= $news['description'] ?>
            </div>

            <div class="share-ribbon">
                <a href="javascript:void(0)" class="btn-save-story <?= ($isBookmarked ?? false) ? 'active' : '' ?>" data-id="<?= $news['id'] ?>">
                    <i class="<?= ($isBookmarked ?? false) ? 'fas' : 'far' ?> fa-bookmark"></i>
                    <span><?= ($isBookmarked ?? false) ? 'Saved to Bookmarks' : 'Bookmark Story' ?></span>
                </a>
                <div class="social-circle-group">
                    <span style="font-size: 11px; font-weight: 800; color: var(--text-muted); text-transform: uppercase; margin-right: 10px; align-self: center;">Share:</span>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(current_url()) ?>" target="_blank" class="social-circle-btn sc-fb"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://twitter.com/intent/tweet?text=<?= urlencode($news['title']) ?>&url=<?= urlencode(current_url()) ?>" target="_blank" class="social-circle-btn sc-tw"><i class="fab fa-twitter"></i></a>
                    <a href="https://api.whatsapp.com/send?text=<?= urlencode($news['title'] . ' ' . current_url()) ?>" target="_blank" class="social-circle-btn sc-wa"><i class="fab fa-whatsapp"></i></a>
                    <a href="javascript:window.print()" class="social-circle-btn sc-pr"><i class="fas fa-print"></i></a>
                </div>
            </div>

            <!-- INLINE CONTENT: Explore Topics -->
            <div class="mt-5 pt-3 border-top border-light">
                <h4 style="font-size: 16px; font-weight: 900; text-transform: uppercase; margin-bottom: 15px; color: var(--text-pure);">Explore Related Topics</h4>
                <div class="d-flex flex-wrap gap-2">
                    <?php 
                        // Mocking some tags based on category & title for dynamics
                        $tags = explode(' ', $news['title']);
                        $tags = array_filter($tags, function($t) { return strlen($t) > 4; });
                        $tags = array_slice($tags, 0, 5);
                        $tags[] = $news['category_slug'];
                        foreach($tags as $tag): 
                    ?>
                        <a href="<?= base_url('search?q=' . urlencode($tag)) ?>" style="background: var(--bg-gray); padding: 8px 16px; border-radius: 40px; font-size: 11px; font-weight: 800; color: var(--text-muted); text-decoration: none; text-transform: uppercase; border: 1px solid var(--border-light); transition: all 0.3s;" onmouseover="this.style.background='var(--text-pure)'; this.style.color='#fff';" onmouseout="this.style.background='var(--bg-gray)'; this.style.color='var(--text-muted)';">
                            #<?= esc(trim($tag)) ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- INLINE CONTENT: Author Bio -->
            <div class="mt-5 p-4" style="background: #fff; border-radius: 16px; border: 1px solid var(--border-light); box-shadow: 0 10px 20px rgba(0,0,0,0.02); display: flex; align-items: center; gap: 20px;">
                <div style="width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, var(--accent-red) 0%, #7f1d1d 100%); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 32px; font-weight: 900; flex-shrink: 0; box-shadow: 0 10px 20px rgba(220,38,38,0.2);">
                    <?= strtoupper(substr(esc($news['custom_author'] ?? 'E'), 0, 1)) ?>
                </div>
                <div>
                    <h5 style="font-size: 16px; font-weight: 900; color: var(--text-pure); margin: 0 0 5px 0;">Published by <?= esc($news['custom_author'] ?? 'Editorial Desk') ?></h5>
                    <p style="font-size: 13px; color: var(--text-muted); margin: 0; line-height: 1.5;">Our editorial desk brings you the most thoroughly researched and objective news to keep you informed. Leading the reporting on <?= esc($news['category_slug']) ?>.</p>
                </div>
            </div>

            <!-- INLINE CONTENT: Newsletter CTA -->
            <div class="mt-4 mb-5 p-4" style="background: var(--text-pure); border-radius: 16px; position: relative; overflow: hidden;">
                <div style="position: absolute; top: -50px; right: -50px; width: 150px; height: 150px; background: rgba(255,255,255,0.05); border-radius: 50%;"></div>
                <div class="row align-items-center position-relative">
                    <div class="col-md-7">
                        <h4 style="color: #fff; font-size: 20px; font-weight: 900; margin-bottom: 5px;">Stay ahead of the curve.</h4>
                        <p style="color: #94a3b8; font-size: 13px; margin: 0;">Get the latest insights from our editors delivered directly to your inbox every morning.</p>
                    </div>
                    <div class="col-md-5 mt-3 mt-md-0 text-md-end">
                        <form action="<?= base_url('newsletter/subscribe') ?>" method="POST" class="d-flex rounded-pill overflow-hidden" style="background: #fff; padding: 4px;">
                            <?= csrf_field() ?>
                            <input type="email" name="email" placeholder="Your Email Address" required style="border: none; outline: none; background: transparent; padding: 10px 15px; font-size: 13px; font-weight: 700; width: 100%;">
                            <button type="submit" style="background: var(--accent-red); color: #fff; border: none; border-radius: 40px; padding: 0 20px; font-size: 12px; font-weight: 900; text-transform: uppercase;">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>

            <script>
            $(document).ready(function() {
                // Reading Progress Bar Logic
                $(window).scroll(function() {
                    var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
                    var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                    var scrolled = (winScroll / height) * 100;
                    document.getElementById("reading-progress").style.width = scrolled + "%";
                });

                $('.btn-save-story').on('click', function() {
                    <?php if (!session()->get('isLoggedIn')): ?>
                        window.location.href = '<?= base_url('login') ?>';
                        return;
                    <?php endif; ?>
                    var btn = $(this);
                    var newsId = btn.data('id');
                    btn.css('opacity', '0.6');
                    $.post('<?= base_url('user/bookmark/toggle') ?>', {
                        news_id: newsId,
                        <?= csrf_token() ?>: '<?= csrf_hash() ?>'
                    }, function(res) {
                        btn.css('opacity', '1');
                        if (res.status === 'success') {
                            if (res.action === 'added') {
                                btn.addClass('active');
                                btn.find('i').removeClass('far').addClass('fas');
                                btn.find('span').text('Saved to Bookmarks');
                            } else {
                                btn.removeClass('active');
                                btn.find('i').removeClass('fas').addClass('far');
                                btn.find('span').text('Bookmark Story');
                            }
                        }
                    });
                });
            });
            </script>



            <!-- Discussion / Comments -->
            <div class="mt-5 mb-5">
                <h3 class="discussion-header">Community <span style="color:var(--accent-red);">Discussion (<?= count($comments) ?>)</span></h3>
                
                <div class="mb-5">
                    <?php if (empty($comments)): ?>
                        <div style="background: var(--bg-gray); padding: 30px; border-radius: 16px; text-align: center; color: var(--text-muted); font-weight: 800;"><i class="far fa-comment-dots" style="font-size: 30px; margin-bottom: 15px; display: block;"></i> Be the first to add your perspective to this story.</div>
                    <?php endif; ?>
                    
                    <?php foreach ($comments as $com): ?>
                    <div class="d-flex gap-3 mb-4">
                        <div class="comment-avatar"><?= substr($com['name'], 0, 1) ?></div>
                        <div class="comment-bubble flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 style="margin: 0; font-size: 15px; font-weight: 900;"><?= esc($com['name']) ?></h6>
                                <span style="font-size: 11px; color: var(--text-muted); font-weight: 800;"><i class="far fa-clock"></i> <?= date('M d, Y', strtotime($com['created_at'])) ?></span>
                            </div>
                            <p style="margin: 0; font-size: 15px; line-height: 1.6; color: #475569;"><?= nl2br(esc($com['comment'])) ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="leave-reply-box">
                    <h4 style="font-size: 22px; font-weight: 900; margin-bottom: 30px;">Share Your <span style="color:var(--accent-red);">Thoughts</span></h4>
                    
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success border-0 mb-4" style="background:#ecfdf5; border-radius:12px; font-weight:700;"><i class="fas fa-check-circle me-2"></i> <?= session()->getFlashdata('success') ?></div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger border-0 mb-4" style="background:#fef2f2; border-radius:12px; font-weight:700;"><i class="fas fa-exclamation-circle me-2"></i> <?= session()->getFlashdata('error') ?></div>
                    <?php endif; ?>
                    
                    <form action="<?= base_url('comment/post') ?>" method="POST" class="row g-3 text-start">
                        <?= csrf_field() ?>
                        <input type="hidden" name="news_id" value="<?= $news['id'] ?>">
                        <div style="display: none !important;"><input type="text" name="website" tabindex="-1" autocomplete="off"></div>

                        <div class="col-12">
                            <textarea name="comment" class="form-control" rows="4" placeholder="What do you think about this?" required></textarea>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="name" class="form-control" placeholder="Full Name" required>
                        </div>
                        <div class="col-md-6">
                            <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                        </div>
                        <div class="col-12 mt-4 text-center">
                            <button type="submit" style="background: var(--text-pure); color: #fff; border: none; padding: 15px 40px; border-radius: 40px; font-weight: 900; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; transition: all 0.3s; cursor: pointer;">Post Comment <i class="fas fa-paper-plane ms-2"></i></button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Visual Stories Recommendation Below Comments -->
            <?php if (!empty($visualStories)): ?>
            <div class="mt-5 mb-5 pb-5">
                <h3 style="font-size: 24px; font-weight: 900; margin-bottom: 25px; padding-top: 25px; border-top: 2px solid var(--border-light);"><i class="fas fa-bolt text-warning"></i> Visual Highlights</h3>
                <div class="row g-4">
                    <?php foreach (array_slice($visualStories, 0, 4) as $story): ?>
                        <div class="col-md-3 col-6">
                            <a href="<?= base_url('news/' . $story['slug']) ?>" class="d-block position-relative" style="border-radius: 16px; overflow: hidden; aspect-ratio: 3/4; box-shadow: 0 10px 20px rgba(0,0,0,0.1); transition: transform 0.3s; transform: scale(1);" onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'">
                                <img src="<?= base_url('uploads/stories/' . ($story['image'] ?: 'default.jpg')) ?>" style="width: 100%; height: 100%; object-fit: cover; object-position: center; display: block;" alt="">
                                <div style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.2) 40%, transparent 100%); padding: 15px; display: flex; align-items: flex-end;">
                                    <?php $stitle = (service('language')->getLocale() == 'hi') ? $story['title_hi'] : $story['title_en']; ?>
                                    <h5 style="color: #fff; font-size: 13px; font-weight: 900; line-height: 1.4; margin: 0;"><?= esc($stitle) ?></h5>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

        </div>

        <!-- RIGHT SIDEBAR (CLEANED UP & STREAMLINED) -->
        <div class="col-lg-4 ps-lg-5 mt-5 mt-lg-0">
            
            <!-- Stay Connected Widget -->
            <div class="side-widget" style="padding: 0; border: none; background: transparent; box-shadow: none;">
                <h4 class="side-title" style="padding-left: 20px; border-left: 4px solid var(--accent-red);">Stay <span style="font-weight:400; color:var(--text-muted);">Connected</span></h4>
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
                    <a href="<?= $soc['url'] ?>" target="_blank" class="flex items-center gap-4 p-4 rounded-2xl transition-all duration-500 group" style="background: <?= $soc['light'] ?>; border: 1px solid rgba(255,255,255,0.1); text-decoration: none;">
                        <span class="w-12 h-12 flex items-center justify-center rounded-xl bg-white shadow-sm group-hover:scale-110 group-hover:rotate-6 transition-all duration-500" style="color: <?= $soc['bg'] ?>;">
                            <i class="<?= $soc['icon'] ?> text-xl"></i>
                        </span>
                        <div class="flex flex-col">
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest group-hover:text-slate-600 transition-colors"><?= $soc['label'] ?></span>
                            <span class="text-xs font-black text-slate-900 group-hover:text-red-600 transition-colors">Follow News Desk</span>
                        </div>
                        <i class="fas fa-chevron-right ms-auto text-[10px] text-slate-300 group-hover:translate-x-1 group-hover:text-red-600 transition-all"></i>
                    </a>
                    <?php endif; endforeach; ?>
                </div>
            </div>

            <!-- Trending Widget -->
            <div class="side-widget">
                <h4 class="side-title">Trending <span style="color:var(--text-muted); font-weight:400;">Now</span></h4>
                <div class="vertical-trending-slider-detail">
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

            <!-- Related Articles -->
            <div class="side-widget">
                <h4 class="side-title">Related <span style="color:var(--text-muted); font-weight:400;">Reads</span></h4>
                <div class="related-list">
                    <?php foreach ($related as $rel): ?>
                    <a href="<?= base_url('news/' . $rel['slug']) ?>" class="side-related-item">
                        <div class="sri-thumb"><img src="<?= base_url('uploads/news/' . ($rel['image'] ?: 'default.jpg')) ?>" alt="<?= esc($rel['title']) ?>"></div>
                        <div class="sri-text">
                            <h5><?= esc($rel['title']) ?></h5>
                            <span><?= date('M d, Y', strtotime($rel['publish_at'])) ?></span>
                        </div>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>

        <!-- Weekly Recap Spotlight -->
                </div>
            </div>

            <div class="mt-2">
                <?= view('frontend/partials/poll_widget') ?>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        $('.vertical-trending-slider-detail').slick({
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

        setTimeout(function() {
            $.post('<?= base_url('ajax/track-view') ?>', {
                news_id: <?= $news['id'] ?>,
                <?= csrf_token() ?>: '<?= csrf_hash() ?>'
            });
        }, 2000);
    });
</script>
<?= $this->endSection() ?>

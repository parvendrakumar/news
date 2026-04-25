<?= $this->extend('frontend/layout') ?>

<?= $this->section('content') ?>

<style>
    .category-header { background: #f9fafb; padding: 40px 0; border-bottom: 1px solid #eee; margin-bottom: 40px; }
    .category-header h1 { font-size: 36px; font-weight: 900; color: #111; letter-spacing: -1px; margin: 0; }
    .category-header .accent-line { width: 60px; height: 5px; background: #c90000; margin-top: 15px; border-radius: 2px; }
    
    .cat-card-premium { background: #fff; border-radius: 20px; padding: 30px; transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); border: 1px solid #f0f0f0; height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; text-decoration: none !important; }
    .cat-card-premium:hover { transform: translateY(-10px) scale(1.02); box-shadow: 0 20px 40px rgba(201, 0, 0, 0.1); border-color: #c90000; }
    .cat-icon-wrap { width: 80px; height: 80px; background: #fff5f5; border-radius: 24px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px; transition: all 0.3s; overflow: hidden; }
    .cat-card-premium:hover .cat-icon-wrap { background: #c90000; transform: scale(1.1); }
    .cat-icon-wrap i { font-size: 32px; color: #c90000; transition: all 0.3s; }
    .cat-card-premium:hover .cat-icon-wrap i { color: #fff; transform: rotate(10deg); }
    .cat-icon-wrap img { width: 100%; height: 100%; object-fit: cover; }
    .cat-card-premium h3 { font-size: 18px; font-weight: 900; color: #111; text-transform: uppercase; letter-spacing: 0.5px; margin: 0; }
    .cat-card-premium .news-count { font-size: 10px; font-weight: 800; color: #9ca3af; text-transform: uppercase; margin-top: 8px; }
    
    .sidebar-widget { background: #fff; border-radius: 16px; padding: 24px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); border: 1px solid #f0f0f0; margin-bottom: 30px; }
    .widget-title { border-left: 4px solid #c90000; padding-left: 15px; margin-bottom: 25px; }
    .widget-title h4 { font-size: 18px; font-weight: 900; color: #111; text-transform: uppercase; margin: 0; }
</style>

<div class="category-header">
    <div class="container">
        <div class="news-card-meta mb-2" style="font-size: 11px; font-weight: 700; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.5px; display: flex; align-items: center; gap: 10px;">
            <a href="<?= base_url() ?>" style="color: #c90000; text-decoration:none;">Home</a> 
            <i class="fas fa-chevron-right" style="font-size:8px;"></i> Categories
        </div>
        <h1 style="font-size: clamp(24px, 6vw, 42px) !important; font-weight: 950; text-transform: uppercase; letter-spacing: -2px;">Browse <span style="color: #c90000;">Categories</span></h1>
        <div class="accent-line"></div>
    </div>
</div>

<div class="container pb-60">
    <div class="row">
        <!-- Main Categories Grid -->
        <div class="col-lg-8">
            <div class="row g-4">
                <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $cat): ?>
                        <div class="col-6 col-md-4">
                            <a href="<?= base_url('category/' . $cat['slug']) ?>" class="cat-card-premium">
                                <div class="cat-icon-wrap">
                                    <?php if (!empty($cat['image'])): ?>
                                        <img src="<?= base_url('uploads/categories/' . $cat['image']) ?>" alt="<?= esc($cat['title']) ?>">
                                    <?php else: ?>
                                        <img src="<?= base_url('assets/img/default_category.png') ?>" alt="<?= esc($cat['title']) ?>">
                                    <?php endif; ?>
                                </div>
                                <h3><?= esc($cat['title']) ?></h3>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12 py-5 text-center">
                        <div style="font-size: 60px; color: #eee; margin-bottom: 20px;"><i class="fas fa-th-large"></i></div>
                        <h4 style="color: #999; font-weight: 700;">No categories found.</h4>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="sidebar-widget">
                <div class="widget-title">
                    <h4>Trending <span style="color: #c90000;">Now</span></h4>
                </div>
                <div class="vertical-trending-slider-cat">
                    <?php foreach ($trending as $item): ?>
                    <div class="trending-slide-item">
                        <a href="<?= base_url('news/' . $item['slug']) ?>" style="display: flex; align-items: center; padding: 10px 0; text-decoration: none; gap: 15px;">
                            <div style="width:60px; height:50px; border-radius:8px; overflow:hidden; flex-shrink:0;">
                                <img src="<?= base_url('uploads/news/' . ($item['image'] ?: 'default.jpg')) ?>" style="width:100%; height:100%; object-fit:cover;" alt="">
                            </div>
                            <div style="flex-grow:1;">
                                <h5 style="font-size:12px; font-weight:800; color:#111; margin:0; line-height:1.3;"><?= esc($item['title']) ?></h5>
                                <span style="font-size:8px; font-weight:800; color:#dc2626; text-transform:uppercase;"><?= esc($item['category_slug'] ?? 'News') ?></span>
                            </div>
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="sidebar-widget">
                <div class="widget-title">
                    <h4>Why <span style="color: #c90000;">Us?</span></h4>
                </div>
                <p style="font-size: 13px; color: #666; line-height: 1.6;">
                    City News provides verified and high-priority regional updates. Categorized by significance to keep you informed.
                </p>
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
            slidesToShow: 4,
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

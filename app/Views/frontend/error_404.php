<?= $this->extend('frontend/layout') ?>

<?= $this->section('content') ?>

<div class="error-section pt-100 pb-100" style="background: #fafafa; position: relative; overflow: hidden;">
    <!-- Background Decor -->
    <div style="position: absolute; top: -10%; right: -5%; font-size: 20rem; font-weight: 900; color: #f0f0f0; select: none; pointer-events: none; line-height: 1; z-index: 0;">404</div>
    
    <div class="container" style="position: relative; z-index: 1;">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-50 mb-lg-0">
                <div class="error-text-box" style="text-align: left;">
                    <span style="display: inline-block; background: #dc2626; color: #fff; padding: 5px 15px; border-radius: 30px; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 20px;">🚨 Breaking: Page Missing</span>
                    
                    <h1 style="font-size: clamp(3rem, 8vw, 5rem); font-weight: 900; color: #111; line-height: 1; margin-bottom: 25px; letter-spacing: -2px;">
                        The <span style="color: #dc2626;">Headline</span> Has Escaped Our Coverage
                    </h1>
                    
                    <p style="font-size: 1.1rem; color: #666; line-height: 1.7; margin-bottom: 40px; max-width: 500px;">
                        Our reporters are searching the archives, but the story you're looking for seems to have been retired or moved to a different beat. 
                    </p>

                    <div class="search-box mb-40" style="max-width: 450px;">
                        <form action="<?= base_url('search') ?>" method="get" style="display: flex; background: #fff; border: 2px solid #eee; border-radius: 15px; padding: 5px; box-shadow: 0 10px 30px rgba(0,0,0,0.03);">
                            <input type="text" name="q" placeholder="Keywords (e.g. Crime, Tech, Sports)..." style="flex: 1; border: none; padding: 12px 20px; outline: none; font-size: 14px; font-weight: 600;">
                            <button type="submit" style="background: #111; color: #fff; border: none; padding: 10px 25px; border-radius: 10px; font-weight: 800; transition: 0.3s;" onmouseover="this.style.background='#dc2626'" onmouseout="this.style.background='#111'">
                                <i class="fas fa-search me-2"></i> SEARCH
                            </button>
                        </form>
                    </div>

                    <div class="action-btns d-flex flex-wrap gap-3">
                        <a href="<?= base_url() ?>" class="btn-main" style="background: #dc2626; color: #fff; text-decoration: none; padding: 16px 35px; border-radius: 12px; font-weight: 900; text-transform: uppercase; font-size: 13px; letter-spacing: 1px; box-shadow: 0 10px 25px rgba(220, 38, 38, 0.25); transition: 0.3s;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 15px 30px rgba(220, 38, 38, 0.35)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 25px rgba(220, 38, 38, 0.25)'">
                            <i class="fas fa-home me-2"></i> FRONT PAGE
                        </a>
                        <a href="javascript:history.back()" class="btn-alt" style="background: #fff; color: #111; text-decoration: none; padding: 16px 35px; border-radius: 12px; font-weight: 900; text-transform: uppercase; font-size: 13px; letter-spacing: 1px; border: 2px solid #eee; transition: 0.3s;" onmouseover="this.style.background='#f9f9f9'; this.style.borderColor='#ddd'" onmouseout="this.style.background='#fff'; this.style.borderColor='#eee'">
                            <i class="fas fa-arrow-left me-2"></i> GO BACK
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 mt-50 mt-lg-0">
                <div class="error-visual" style="position: relative; text-align: center;">
                    <!-- 404 Numbers with Creative News Texture -->
                    <div style="font-size: 15rem; font-weight: 900; line-height: 1; color: #111; position: relative; z-index: 2;">
                        4<span style="color: #dc2626;">0</span>4
                    </div>
                    <!-- Decorative Elements -->
                    <div style="position: absolute; top: 20%; left: 10%; width: 50px; height: 50px; border: 8px solid #dc2626; opacity: 0.1; border-radius: 50%;"></div>
                    <div style="position: absolute; bottom: 10%; right: 20%; width: 30px; height: 30px; background: #dc2626; opacity: 0.1; transform: rotate(45deg);"></div>
                    
                    <div style="margin-top: -30px; font-size: 12px; font-weight: 900; color: #bbb; text-transform: uppercase; letter-spacing: 8px;">FILE_ERROR: NOT_FOUND</div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Animations and Extra refinement */
@keyframes float {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
    100% { transform: translateY(0px); }
}
.error-visual {
    animation: float 6s ease-in-out infinite;
}
</style>

<?= $this->endSection() ?>

<?= $this->extend('frontend/layout') ?>
<?= $this->section('content') ?>

<style>
/* ── Contact Page Styles ── */
/* ── Premium Contact Hero (Unified Design) ── */
.premium-page-banner {
    background: radial-gradient(circle at top left, #1e3a8a 0%, #0f172a 100%);
    padding: 60px 50px 80px;
    position: relative;
    overflow: hidden;
    margin-bottom: 0;
    color: #fff;
    border-radius: 24px;
    border: 1px solid rgba(255,255,255,0.05);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    animation: fadeInUpBanner 0.8s cubic-bezier(0.16, 1, 0.3, 1) both;
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

/* ── Info Cards ── */
.info-card {
    background: #fff;
    border-radius: 16px;
    padding: 28px 20px;
    text-align: center;
    box-shadow: 0 4px 24px rgba(0,0,0,.07);
    height: 100%;
    transition: transform .3s, box-shadow .3s;
}
.info-card:hover { transform: translateY(-4px); box-shadow: 0 10px 40px rgba(0,0,0,.12); }
.info-icon {
    width: 58px; height: 58px; border-radius: 50%;
    background: linear-gradient(135deg,#dc2626,#b91c1c);
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 14px; font-size: 20px; color: #fff;
}
.info-card h5 { font-size: 13px; font-weight: 800; color: #374151; margin: 0 0 8px; text-transform: uppercase; letter-spacing: 1px; }
.info-card p, .info-card a { font-size: 13px; color: #6b7280; margin: 0; text-decoration: none; }
.info-card a:hover { color: #dc2626; }

/* ── Form Card ── */
.form-card { background: #fff; border-radius: 20px; padding: 36px; box-shadow: 0 8px 40px rgba(0,0,0,.08); }
.form-card h3 { font-size: 24px; font-weight: 900; color: #1a1a1a; margin: 0 0 6px; }
.form-card .subtitle { font-size: 13px; color: #6b7280; margin: 0 0 26px; }
.field-label { font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; color: #374151; margin-bottom: 6px; display: block; }
.field-input {
    width: 100%; padding: 12px 15px;
    border: 2px solid #e5e7eb; border-radius: 10px;
    font-size: 14px; color: #1a1a1a;
    background: #f9fafb;
    outline: none; transition: border-color .3s, box-shadow .3s;
    box-sizing: border-box;
}
.field-input:focus { border-color: #dc2626; box-shadow: 0 0 0 3px rgba(220,38,38,.1); background: #fff; }
textarea.field-input { resize: vertical; min-height: 130px; }
.btn-send {
    width: 100%; background: linear-gradient(135deg,#dc2626,#b91c1c);
    color: #fff; border: none; padding: 14px;
    border-radius: 10px; font-size: 15px; font-weight: 800;
    cursor: pointer; transition: transform .2s, box-shadow .2s; letter-spacing: .4px;
}
.btn-send:hover { transform: translateY(-2px); box-shadow: 0 6px 24px rgba(220,38,38,.35); }
.err-msg { font-size: 11px; color: #dc2626; margin-top: 4px; font-weight: 700; }

.alert-ok { background:#f0fdf4; border:1px solid #86efac; border-radius:10px; padding:14px 18px; display:flex; align-items:center; gap:12px; margin-bottom:22px; }
.alert-ok i { color:#22c55e; font-size:20px; }
.alert-ok p { margin:0; font-size:14px; font-weight:700; color:#166534; }
.alert-err { background:#fef2f2; border:1px solid #fca5a5; border-radius:10px; padding:14px 18px; display:flex; align-items:center; gap:12px; margin-bottom:22px; }
.alert-err i { color:#dc2626; font-size:20px; }
.alert-err p { margin:0; font-size:14px; font-weight:700; color:#991b1b; }

.map-box { border-radius:16px; overflow:hidden; box-shadow:0 6px 30px rgba(0,0,0,.1); }
.social-link {
    display:flex; align-items:center; gap:14px;
    padding:12px 16px; border-radius:10px;
    background:#f9fafb; text-decoration:none; margin-bottom:10px;
    transition:background .2s;
}
.social-link:hover { background:#f1f5f9; }
.soc-icon { width:36px; height:36px; border-radius:50%; display:flex; align-items:center; justify-content:center; color:#fff; font-size:14px; flex-shrink:0; }
.social-link span { font-size:14px; font-weight:700; color:#374151; }
.social-link i.arrow { margin-left:auto; color:#9ca3af; font-size:11px; }
</style>

<!-- HERO -->
<div class="container mt-4">
    <div class="premium-page-banner">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="breadcrumb-premium-alt">
                    <a href="<?= base_url() ?>" style="color: rgba(59, 130, 246, 0.8); text-decoration: none;">Home</a> 
                    <i class="fas fa-chevron-right" style="font-size:8px;"></i> 
                    <span>Contact Us</span>
                </div>
                <h1 class="page-title-main">Get In <span>Touch</span>.</h1>
                <p class="page-subtitle">Have a news tip, feedback, or a general inquiry? Our editorial team is here to listen and respond.</p>
            </div>
            <div class="col-lg-4 text-end d-none d-lg-block">
                <div style="font-size: 120px; color: rgba(255,255,255,0.03); font-weight: 950; letter-spacing: -8px; line-height: 0.8; transform: rotate(-5deg); pointer-events: none;">
                    CON
                </div>
            </div>
        </div>
    </div>
</div>

<!-- INFO CARDS (floats up over hero) -->
<div class="container" style="margin-top:-28px; position:relative; z-index:10; margin-bottom:10px;">
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="info-card">
                <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
                <h5>Address</h5>
                <p><?= esc(get_setting('site_location', 'Bijnor, Uttar Pradesh, India')) ?></p>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="info-card">
                <div class="info-icon"><i class="fas fa-envelope"></i></div>
                <h5>Email Us</h5>
                <a href="mailto:<?= esc(get_setting('contact_email', 'citynewsnbd@gmail.com')) ?>"><?= esc(get_setting('contact_email', 'citynewsnbd@gmail.com')) ?></a>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="info-card">
                <div class="info-icon"><i class="fas fa-clock"></i></div>
                <h5>Working Hours</h5>
                <p>Mon – Sat: 9 AM – 6 PM</p>
                <p style="margin-top:4px;">Breaking News: 24/7</p>
            </div>
        </div>
    </div>
</div>

<!-- FORM + SIDEBAR -->
<div class="container" style="padding-bottom:60px;">
    <div class="row">

        <!-- ── Contact Form ── -->
        <div class="col-lg-7 mb-4">
            <div class="form-card">
                <h3>Send a Message</h3>
                <p class="subtitle">We reply to all messages within 24 hours on business days.</p>

                <?php if (session()->getFlashdata('success')): ?>
                <div class="alert-ok">
                    <i class="fas fa-check-circle"></i>
                    <p><?= session()->getFlashdata('success') ?></p>
                </div>
                <?php elseif (session()->getFlashdata('error')): ?>
                <div class="alert-err">
                    <i class="fas fa-exclamation-circle"></i>
                    <p><?= session()->getFlashdata('error') ?></p>
                </div>
                <?php endif; ?>

                <form action="<?= base_url('contact/submit') ?>" method="POST" id="contact-form">
                    <?= csrf_field() ?>
                    
                    <!-- Honeypot Bot-Trap (Invisible to humans) -->
                    <div style="display: none;">
                        <input type="text" name="website_verify" value="">
                    </div>

                    <div class="row">
                        <div class="col-md-6" style="margin-bottom:18px;">
                            <label class="field-label" for="cf-name">Full Name *</label>
                            <input type="text" id="cf-name" name="name" class="field-input"
                                   placeholder="Nidhi Sharma"
                                   value="<?= old('name') ?>" required>
                            <?php if (($errs = session()->getFlashdata('errors')) && !empty($errs['name'])): ?>
                            <div class="err-msg"><?= $errs['name'] ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6" style="margin-bottom:18px;">
                            <label class="field-label" for="cf-email">Email Address *</label>
                            <input type="email" id="cf-email" name="email" class="field-input"
                                   placeholder="you@example.com"
                                   value="<?= old('email') ?>" required>
                            <?php if (($errs = session()->getFlashdata('errors')) && !empty($errs['email'])): ?>
                            <div class="err-msg"><?= $errs['email'] ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6" style="margin-bottom:18px;">
                            <label class="field-label" for="cf-phone">Phone Number</label>
                            <input type="tel" id="cf-phone" name="phone" class="field-input"
                                   placeholder="+91 98765 43210"
                                   value="<?= old('phone') ?>">
                        </div>
                        <div class="col-md-6" style="margin-bottom:18px;">
                            <label class="field-label" for="cf-subject">Subject *</label>
                            <input type="text" id="cf-subject" name="subject" class="field-input"
                                   placeholder="News Tip / Feedback / Query"
                                   value="<?= old('subject') ?>" required>
                            <?php if (($errs = session()->getFlashdata('errors')) && !empty($errs['subject'])): ?>
                            <div class="err-msg"><?= $errs['subject'] ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div style="margin-bottom:22px;">
                        <label class="field-label" for="cf-message">Your Message *</label>
                        <textarea id="cf-message" name="message" class="field-input"
                                  placeholder="Write your message here..."
                                  required><?= old('message') ?></textarea>
                        <?php if (($errs = session()->getFlashdata('errors')) && !empty($errs['message'])): ?>
                        <div class="err-msg"><?= $errs['message'] ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Mathematical CAPTCHA -->
                    <div style="margin-bottom:28px; background: #fdf2f2; padding: 20px; border-radius: 12px; border: 1px dashed #fca5a5;">
                        <label class="field-label" style="color: #991b1b; margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
                            <i class="fas fa-robot"></i> Spam Verification: What is <?= $captcha_question ?>? *
                        </label>
                        <input type="number" name="captcha" class="field-input" 
                               placeholder="Solve this math problem" required 
                               style="background: #fff; border-color: #fca5a5;">
                        <p style="font-size: 10px; font-weight: 700; color: #b91c1c; margin-top: 8px; text-transform: uppercase; letter-spacing: 0.5px;">
                            <i class="fas fa-info-circle mr-1"></i> Required to protect against automated bots.
                        </p>
                    </div>

                    <button type="submit" class="btn-send" id="cf-submit">
                        <i class="fas fa-paper-plane" style="margin-right:8px;"></i>Send Message
                    </button>
                </form>
            </div>
        </div>

        <!-- ── Sidebar ── -->
        <div class="col-lg-5 mb-4">
            <!-- Map -->
            <div class="map-box mb-4">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d56188.29!2d78.0821!3d29.3726!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390bf4e7a8d1a1c1%3A0xc7d01f4b45de24a6!2sBijnor%2C%20Uttar%20Pradesh!5e0!3m2!1sen!2sin!4v1" width="100%" height="270" style="border:0; display:block;" allowfullscreen="" loading="lazy"></iframe>
            </div>

            <!-- Social links -->
            <div class="form-card" style="padding:24px;">
                <h5 style="font-size:13px; font-weight:800; text-transform:uppercase; letter-spacing:1px; margin-bottom:16px; color:#1a1a1a;">Follow City News</h5>
                <?php
                    $socials = [
                        ['icon'=>'fa-facebook-f',  'bg'=>'#1877f2', 'label'=>'Facebook',  'key'=>'facebook_url'],
                        ['icon'=>'fa-twitter',     'bg'=>'#1da1f2', 'label'=>'Twitter',   'key'=>'twitter_url'],
                        ['icon'=>'fa-instagram',   'bg'=>'#e4405f', 'label'=>'Instagram', 'key'=>'instagram_url'],
                        ['icon'=>'fa-youtube',     'bg'=>'#ff0000', 'label'=>'YouTube',   'key'=>'youtube_url'],
                    ];
                    foreach ($socials as $s):
                ?>
                <a href="<?= esc(get_setting($s['key'], '#')) ?>" target="_blank" rel="noopener" class="social-link">
                    <div class="soc-icon" style="background:<?= $s['bg'] ?>;"><i class="fab <?= $s['icon'] ?>"></i></div>
                    <span><?= $s['label'] ?></span>
                    <i class="fas fa-chevron-right arrow"></i>
                </a>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
document.getElementById('contact-form').addEventListener('submit', function() {
    var btn = document.getElementById('cf-submit');
    btn.innerHTML = '<i class="fas fa-spinner fa-spin" style="margin-right:8px;"></i>Sending...';
    btn.disabled = true;
});
</script>
<?= $this->endSection() ?>

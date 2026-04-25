<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
    <div>
        <h2 class="text-3xl font-black text-slate-800 tracking-tight">Site Settings</h2>
        <p class="text-slate-400 font-bold text-sm mt-1">Control branding, SEO, and ad banners</p>
    </div>
    <a href="<?= base_url() ?>" target="_blank"
       class="w-full md:w-auto border border-slate-200 text-slate-600 px-5 py-2.5 rounded-xl font-black text-xs hover:bg-slate-50 transition flex items-center justify-center">
        <i class="fas fa-external-link-alt mr-2"></i> VIEW WEBSITE
    </a>
</div>

<!-- Tab Nav -->
<div class="flex gap-1 mb-6 bg-slate-100 p-1 rounded-2xl w-full overflow-x-auto no-scrollbar scroll-smooth">
    <?php
    $tabs = [
        'identity'   => ['icon' => 'fa-id-card',      'label' => 'Site Identity'],
        'seo'        => ['icon' => 'fa-search',        'label' => 'SEO & Meta'],
        'social'     => ['icon' => 'fa-share-alt',     'label' => 'Social Media'],
        'protection' => ['icon' => 'fa-shield-alt',    'label' => 'Identity Shield'],
        'banners'    => ['icon' => 'fa-image',         'label' => 'Ad Banners'],
    ];
    foreach ($tabs as $id => $tab): ?>
    <button type="button"
            onclick="switchTab('<?= $id ?>')"
            id="tab-btn-<?= $id ?>"
            class="tab-btn px-5 py-2.5 rounded-xl font-black text-xs transition flex items-center gap-2">
        <i class="fas <?= $tab['icon'] ?>"></i>
        <span class="hidden sm:inline"><?= $tab['label'] ?></span>
    </button>
    <?php endforeach; ?>
</div>

<form action="<?= base_url('admin/settings/update') ?>" method="POST" enctype="multipart/form-data" id="settings-form">
<?= csrf_field() ?>

<!-- ─── TAB: Site Identity ─────────────────────────────────────────── -->
<div class="tab-panel" id="tab-identity">
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- Logo & Favicon -->
    <div class="lg:col-span-1 space-y-6">

        <!-- Site Logo -->
        <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-4 md:p-6">
            <h3 class="font-black text-slate-700 text-sm mb-4 flex items-center gap-2">
                <i class="fas fa-image text-indigo-400"></i> Site Logo
            </h3>
            <?php $logo = $kv['site_logo'] ?? ''; ?>
            <?php if ($logo): ?>
            <div class="mb-4 flex items-center justify-center bg-slate-50 rounded-xl h-20 border border-slate-100">
                <img src="<?= base_url('uploads/settings/' . $logo) ?>" alt="Logo" class="max-h-16 object-contain">
            </div>
            <?php else: ?>
            <div class="mb-4 flex items-center justify-center bg-slate-50 rounded-xl h-20 border border-dashed border-slate-200 text-slate-300">
                <i class="fas fa-image text-2xl"></i>
            </div>
            <?php endif; ?>
            <label class="block">
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Upload New Logo</span>
                <input type="file" name="site_logo" accept="image/*"
                       class="mt-2 block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:font-black file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100">
                <p class="text-[10px] text-slate-400 mt-1">PNG/SVG recommended. Max 2MB.</p>
            </label>
        </div>

        <!-- Favicon -->
        <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-6">
            <h3 class="font-black text-slate-700 text-sm mb-4 flex items-center gap-2">
                <i class="fas fa-star text-amber-400"></i> Favicon
            </h3>
            <?php $fav = $kv['favicon'] ?? ''; ?>
            <?php if ($fav): ?>
            <div class="mb-4 flex items-center justify-center bg-slate-50 rounded-xl h-16 border border-slate-100">
                <img src="<?= base_url('uploads/settings/' . $fav) ?>" alt="Favicon" class="max-h-10 object-contain">
            </div>
            <?php else: ?>
            <div class="mb-4 flex items-center justify-center bg-slate-50 rounded-xl h-16 border border-dashed border-slate-200 text-slate-300">
                <i class="fas fa-star text-xl"></i>
            </div>
            <?php endif; ?>
            <label class="block">
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Upload Favicon (ICO / PNG)</span>
                <input type="file" name="favicon" accept="image/*,.ico"
                       class="mt-2 block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:font-black file:bg-amber-50 file:text-amber-600 hover:file:bg-amber-100">
                <p class="text-[10px] text-slate-400 mt-1">32×32 or 64×64 px ideal.</p>
            </label>
        </div>
    </div>

    <!-- Site Info -->
    <div class="lg:col-span-2 space-y-5">
        <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-4 md:p-8 space-y-5">
            <h3 class="font-black text-slate-700 text-sm flex items-center gap-2">
                <i class="fas fa-globe text-green-400"></i> Portal Details
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Site Name <span class="text-red-500">*</span></label>
                    <input type="text" name="site_name" value="<?= esc($kv['site_name'] ?? 'City News') ?>"
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-300 outline-none transition text-sm font-bold text-slate-700">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Tagline</label>
                    <input type="text" name="site_tagline" value="<?= esc($kv['site_tagline'] ?? 'Your City. Your News.') ?>"
                           placeholder="Short slogan..."
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-300 outline-none transition text-sm font-bold text-slate-700">
                </div>
            </div>

            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Site Description</label>
                <textarea name="site_description" rows="3"
                          class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-300 outline-none transition text-sm font-bold text-slate-700 resize-none"
                          placeholder="What your site is about…"><?= esc($kv['site_description'] ?? '') ?></textarea>
            </div>

            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Footer About Text</label>
                <textarea name="footer_about" rows="3"
                          class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-300 outline-none transition text-sm font-bold text-slate-700 resize-none"
                          placeholder="Short description shown in the footer…"><?= esc($kv['footer_about'] ?? '') ?></textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Support Email</label>
                    <input type="email" name="contact_email" value="<?= esc($kv['contact_email'] ?? '') ?>"
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-300 outline-none transition text-sm font-bold text-slate-700">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Copyright Text</label>
                    <input type="text" name="copyright_text" value="<?= esc($kv['copyright_text'] ?? '© ' . date('Y') . ' City News. All Rights Reserved.') ?>"
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-300 outline-none transition text-sm font-bold text-slate-700">
                </div>
            </div>

            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Application Timezone <span class="text-indigo-500 font-bold ml-2">(Current Server: <?= date('t') ?> <?= date('T') ?>)</span></label>
                <select name="timezone" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-300 outline-none transition text-sm font-bold text-slate-700 appearance-none">
                    <?php 
                        $currentTimezone = $kv['timezone'] ?? config('App')->appTimezone;
                        $timezones = [
                            'UTC' => 'UTC (Universal)',
                            'Asia/Kolkata' => 'Asia/Kolkata (India)',
                            'Asia/Dubai' => 'Asia/Dubai (UAE)',
                            'Asia/Singapore' => 'Asia/Singapore',
                            'Europe/London' => 'Europe/London (UK)',
                            'Europe/Paris' => 'Europe/Paris (France)',
                            'America/New_York' => 'America/New_York (USA East)',
                            'America/Chicago' => 'America/Chicago (USA Central)',
                            'America/Los_Angeles' => 'America/Los_Angeles (USA West)',
                            'Australia/Sydney' => 'Australia/Sydney',
                            'Asia/Tokyo' => 'Asia/Tokyo (Japan)',
                            'Asia/Shanghai' => 'Asia/Shanghai (China)',
                        ];
                        foreach ($timezones as $tz => $label): ?>
                        <option value="<?= $tz ?>" <?= $currentTimezone == $tz ? 'selected' : '' ?>><?= $label ?></option>
                    <?php endforeach; ?>
                </select>
                <p class="text-[10px] text-slate-400 mt-1 uppercase font-bold tracking-wider">Updates all 'Publish At' and log timestamps across the system.</p>
            </div>
        </div>
    </div>
</div>
</div>

<!-- ─── TAB: SEO & Meta ────────────────────────────────────────────── -->
<div class="tab-panel hidden" id="tab-seo">
<div class="max-w-3xl space-y-6">

    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-4 md:p-8 space-y-5">
        <h3 class="font-black text-slate-700 text-sm flex items-center gap-2">
            <i class="fas fa-search text-blue-400"></i> Default SEO Meta Tags
            <span class="text-[10px] font-normal text-slate-400 font-bold ml-1">(used as fallbacks on pages without custom SEO)</span>
        </h3>

        <div>
            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Default Meta Title</label>
            <input type="text" name="meta_title" value="<?= esc($kv['meta_title'] ?? $kv['site_name'] ?? 'City News') ?>"
                   maxlength="70"
                   class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-300 outline-none transition text-sm font-bold text-slate-700"
                   oninput="updateCounter('meta_title', 'mt-count', 70)">
            <p class="text-[10px] text-slate-400 mt-1">
                <span id="mt-count"><?= strlen($kv['meta_title'] ?? $kv['site_name'] ?? 'City News') ?></span>/70 characters — ideal under 60
            </p>
        </div>

        <div>
            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Meta Description</label>
            <textarea name="meta_description" rows="3" maxlength="165"
                      class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-300 outline-none transition text-sm font-bold text-slate-700 resize-none"
                      oninput="updateCounter('meta_description', 'md-count', 165)"
                      placeholder="Compelling 1-2 sentence summary for search engines…"><?= esc($kv['meta_description'] ?? $kv['site_description'] ?? '') ?></textarea>
            <p class="text-[10px] text-slate-400 mt-1">
                <span id="md-count"><?= strlen($kv['meta_description'] ?? $kv['site_description'] ?? '') ?></span>/165 characters — ideal under 155
            </p>
        </div>

        <div>
            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Meta Keywords</label>
            <input type="text" name="meta_keywords" value="<?= esc($kv['meta_keywords'] ?? '') ?>"
                   placeholder="city news, local news, breaking news…"
                   class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-300 outline-none transition text-sm font-bold text-slate-700">
            <p class="text-[10px] text-slate-400 mt-1">Comma-separated keywords</p>
        </div>

        <div>
            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Meta Author</label>
            <input type="text" name="meta_author" value="<?= esc($kv['meta_author'] ?? 'City News') ?>"
                   class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-300 outline-none transition text-sm font-bold text-slate-700">
        </div>
    </div>

    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-4 md:p-8 space-y-5">
        <h3 class="font-black text-slate-700 text-sm flex items-center gap-2">
            <i class="fab fa-facebook text-blue-500"></i> Open Graph / Social Preview
        </h3>

        <div>
            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">OG Default Image (1200×630 recommended)</label>
            <?php $ogImg = $kv['og_image'] ?? ''; ?>
            <?php if ($ogImg): ?>
            <div class="mb-3 rounded-xl overflow-hidden border border-slate-100 w-56">
                <img src="<?= base_url('uploads/settings/' . $ogImg) ?>" alt="OG Image" class="w-full object-cover">
            </div>
            <?php endif; ?>
            <input type="file" name="og_image" accept="image/*"
                   class="block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:font-black file:bg-blue-50 file:text-blue-600 hover:file:bg-blue-100">
        </div>
    </div>

    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-8 space-y-5">
        <h3 class="font-black text-slate-700 text-sm flex items-center gap-2">
            <i class="fas fa-chart-line text-orange-400"></i> Analytics
        </h3>
        <div>
            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Google Analytics ID</label>
            <input type="text" name="google_analytics" value="<?= esc($kv['google_analytics'] ?? '') ?>"
                   placeholder="G-XXXXXXXXXX or UA-XXXXXXXX-X"
                   class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-300 outline-none transition text-sm font-bold text-slate-700 font-mono">
            <p class="text-[10px] text-slate-400 mt-1">Leave blank to disable analytics</p>
        </div>
    </div>

</div>
</div>

<!-- ─── TAB: Social Media ──────────────────────────────────────────── -->
<div class="tab-panel hidden" id="tab-social">
<div class="max-w-xl">
<div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-4 md:p-8 space-y-5">
    <h3 class="font-black text-slate-700 text-sm flex items-center gap-2">
        <i class="fas fa-share-alt text-pink-400"></i> Social Media Links
    </h3>
    <?php
    $socials = [
        'facebook_url'  => ['icon' => 'fab fa-facebook',  'label' => 'Facebook URL',  'color' => 'text-blue-600'],
        'twitter_url'   => ['icon' => 'fab fa-twitter',   'label' => 'Twitter / X URL', 'color' => 'text-sky-500'],
        'instagram_url' => ['icon' => 'fab fa-instagram', 'label' => 'Instagram URL', 'color' => 'text-pink-500'],
        'youtube_url'   => ['icon' => 'fab fa-youtube',   'label' => 'YouTube URL',   'color' => 'text-red-500'],
    ];
    foreach ($socials as $key => $s): ?>
    <div>
        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">
            <i class="<?= $s['icon'] ?> <?= $s['color'] ?> mr-1"></i> <?= $s['label'] ?>
        </label>
        <input type="url" name="<?= $key ?>" value="<?= esc($kv[$key] ?? '') ?>"
               placeholder="https://..."
               class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-300 outline-none transition text-sm font-bold text-slate-700">
    </div>
    <?php endforeach; ?>
</div>
</div>
</div>

<!-- ─── TAB: Identity Shield ──────────────────────────────────────── -->
<div class="tab-panel hidden" id="tab-protection">
    <div class="mb-10 flex items-center gap-4">
        <div class="h-12 w-12 bg-rose-50 text-rose-600 rounded-2xl flex items-center justify-center text-xl shadow-sm">
            <i class="fas fa-shield-alt"></i>
        </div>
        <div>
            <h3 class="text-xl font-black text-slate-800 tracking-tight leading-none">Identity Shield</h3>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mt-1">Content Protection Logic</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Right Click Protection -->
        <div class="bg-white p-6 rounded-[2.5rem] shadow-sm border border-slate-100 flex items-center justify-between group hover:shadow-xl hover:shadow-slate-100 transition duration-500">
            <div class="flex items-center gap-4">
                <div class="h-12 w-12 bg-slate-50 text-rose-400 rounded-2xl flex items-center justify-center text-lg group-hover:rotate-12 transition duration-500">
                    <i class="fas fa-mouse-pointer"></i>
                </div>
                <div>
                    <h4 class="text-sm font-black text-slate-800 uppercase tracking-tight">Right-Click Protection</h4>
                    <p class="text-[10px] font-bold text-slate-400 uppercase">Disable Context Menu</p>
                </div>
            </div>
            <label class="relative inline-flex items-center cursor-pointer">
                <input type="checkbox" name="protection_right_click" value="1" class="sr-only peer" <?= ($kv['protection_right_click'] ?? '0') == '1' ? 'checked' : '' ?>>
                <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-rose-500"></div>
            </label>
        </div>

        <!-- DevTools Guard -->
        <div class="bg-white p-6 rounded-[2.5rem] shadow-sm border border-slate-100 flex items-center justify-between group hover:shadow-xl hover:shadow-slate-100 transition duration-500">
            <div class="flex items-center gap-4">
                <div class="h-12 w-12 bg-slate-50 text-slate-400 rounded-2xl flex items-center justify-center text-lg group-hover:rotate-12 transition duration-500">
                    <i class="fas fa-terminal"></i>
                </div>
                <div>
                    <h4 class="text-sm font-black text-slate-800 uppercase tracking-tight">DevTools Guard</h4>
                    <p class="text-[10px] font-bold text-slate-400 uppercase">Block F12/Inspect Shortcuts</p>
                </div>
            </div>
            <label class="relative inline-flex items-center cursor-pointer">
                <input type="checkbox" name="protection_devtools" value="1" class="sr-only peer" <?= ($kv['protection_devtools'] ?? '0') == '1' ? 'checked' : '' ?>>
                <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-slate-800"></div>
            </label>
        </div>
    </div>

    <div class="mt-8 p-6 bg-rose-50 border border-rose-100 rounded-[2rem] flex items-start gap-4">
        <div class="h-10 w-10 bg-white text-rose-500 rounded-xl flex items-center justify-center flex-shrink-0 animate-pulse">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        <div>
            <h5 class="text-xs font-black text-rose-700 uppercase tracking-widest mb-1">Security Disclaimer</h5>
            <p class="text-[10px] font-bold text-rose-600 leading-relaxed uppercase tracking-tighter italic opacity-80">
                While Identity Shield effectively deter casual inspection and content scraping, determined adversaries may still bypass client-side protections. Use this as a first line of defense to preserve editorial integrity and proprietary layout logic.
            </p>
        </div>
    </div>
</div>

<!-- ─── TAB: Ad Banners ────────────────────────────────────────────── -->
<div class="tab-panel hidden" id="tab-banners">
<div class="max-w-3xl space-y-6">
    <?php
    $banners = [
        'header_banner'  => ['label' => 'Header Banner (Top)', 'desc' => 'Shown above the main navigation. Recommended: 728×90 px.'],
        'sidebar_banner' => ['label' => 'Sidebar Ad Banner',  'desc' => 'Right sidebar slot. Recommended: 300×250 px.'],
        'footer_banner'  => ['label' => 'Footer Ad Banner',   'desc' => 'Below all content. Recommended: 728×90 px.'],
    ];
    foreach ($banners as $bKey => $b):
        $existing = $kv[$bKey] ?? '';
    ?>
    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-6">
        <h3 class="font-black text-slate-700 text-sm mb-1"><?= $b['label'] ?></h3>
        <p class="text-[10px] text-slate-400 font-bold mb-4"><?= $b['desc'] ?></p>
        <?php if ($existing): ?>
        <div class="flex items-center gap-4 mb-4 p-3 bg-slate-50 rounded-xl border border-slate-100">
            <img src="<?= (file_exists(FCPATH . 'uploads/settings/' . $existing)) ? base_url('uploads/settings/' . $existing) : base_url('assets/img/hero/' . $existing) ?>"
                 alt="<?= $b['label'] ?>" class="h-14 object-contain rounded-lg">
            <div>
                <p class="text-xs font-black text-slate-600"><?= $existing ?></p>
                <p class="text-[10px] text-slate-400">Current image</p>
            </div>
        </div>
        <?php endif; ?>
        <input type="file" name="<?= $bKey ?>" accept="image/*"
               class="block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:font-black file:bg-slate-50 file:text-slate-600 hover:file:bg-slate-100 border border-dashed border-slate-200 rounded-xl px-3 py-4">
    </div>
    <?php endforeach; ?>
</div>
</div>

<!-- Save Button (always visible) -->
<div class="mt-8 flex flex-col md:flex-row gap-4 items-center">
    <button type="submit"
            class="w-full md:w-auto bg-indigo-600 text-white px-10 py-4 rounded-2xl font-black hover:bg-indigo-700 transition shadow-xl shadow-indigo-100 text-sm">
        <i class="fas fa-save mr-2"></i>Save All Settings
    </button>
    <p class="text-[10px] md:text-xs text-slate-400 font-bold uppercase tracking-widest text-center md:text-left">Changes apply to the live website instantly.</p>
</div>

</form>

<style>
.tab-btn          { color: #94a3b8; }
.tab-btn.active   { background: white; color: #4f46e5; box-shadow: 0 1px 4px rgba(0,0,0,.08); }
</style>

<script>
const tabs = ['identity','seo','social','protection','banners'];

function switchTab(active) {
    tabs.forEach(id => {
        document.getElementById('tab-' + id).classList.toggle('hidden', id !== active);
        document.getElementById('tab-btn-' + id).classList.toggle('active', id === active);
    });
    localStorage.setItem('settingsTab', active);
}

function updateCounter(fieldName, counterId, maxLen) {
    const el   = document.querySelector('[name="' + fieldName + '"]');
    const span = document.getElementById(counterId);
    if (el && span) span.textContent = el.value.length;
}

// Restore last active tab
const saved = localStorage.getItem('settingsTab') || 'identity';
switchTab(saved);
</script>

<?= $this->endSection() ?>

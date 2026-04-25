<?= $this->extend('admin/layout') ?>

<?= $this->section('style') ?>
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<style>
    body { font-family: 'Outfit', sans-serif; }
    .premium-glass {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.05);
    }
    .gradient-text {
        background: linear-gradient(135deg, #1e293b 0%, #dc2626 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .input-premium {
        @apply w-full px-6 py-4 rounded-2xl border border-slate-200 bg-white font-semibold text-slate-700 transition-all duration-300 shadow-sm sm:text-sm;
    }
    .input-premium:focus {
        @apply border-red-500 ring-4 ring-red-500/10 outline-none shadow-md;
    }
    .floating-save {
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        z-index: 40;
    }
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="max-w-[1400px] mx-auto pb-24">
    <!-- Header Area -->
    <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div class="space-y-2">
            <div class="flex items-center space-x-2 text-[10px] font-black text-slate-400 uppercase tracking-[0.3em]">
                <i class="fas fa-edit text-red-500"></i>
                <span>Editorial Studio</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-black text-slate-900 tracking-tight leading-none">
                Refine <span class="gradient-text">Masterpiece</span>
            </h2>
            <p class="text-slate-400 font-medium flex items-center">
                Currently editing: <span class="ml-2 px-3 py-1 bg-red-50 text-red-600 rounded-full text-xs font-bold border border-red-100 italic">"<?= esc(mb_strimwidth($hi['title'] ?? 'Untitled', 0, 50, '...')) ?>"</span>
            </p>
        </div>
        
        <div class="flex items-center gap-3">
            <a href="<?= base_url('admin/news') ?>" class="group flex items-center px-6 py-4 rounded-2xl bg-white border border-slate-100 text-slate-500 font-bold text-sm hover:bg-slate-50 hover:text-slate-800 transition-all shadow-sm">
                <i class="fas fa-chevron-left mr-3 group-hover:-translate-x-1 transition-transform"></i>
                Exit Editor
            </a>
            <button type="button" onclick="document.getElementById('newsForm').submit()" class="hidden md:flex items-center px-8 py-4 rounded-2xl bg-slate-900 text-white font-bold text-sm hover:bg-red-600 transition-all shadow-xl shadow-slate-900/10 active:scale-95">
                <i class="fas fa-cloud-upload-alt mr-3"></i>
                Synchronize Changes
            </button>
        </div>
    </div>

    <form action="<?= base_url('admin/news/update/' . $news['id']) ?>" method="POST" enctype="multipart/form-data" id="newsForm" class="relative">
        <?= csrf_field() ?>
        <input type="hidden" name="old_image" value="<?= $news['image'] ?>">
        <input type="hidden" name="existing_gallery" value='<?= $news['gallery'] ?>'>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Left: Creative Canvas -->
            <div class="lg:col-span-8 space-y-8">
                
                <!-- Translation Engine -->
                <div class="premium-glass rounded-[2.5rem] overflow-hidden">
                    <div class="flex p-2 bg-slate-100/50 m-4 rounded-[1.5rem]">
                        <button type="button" onclick="switchLang('hi')" id="tab-hi" class="flex-1 py-4 px-6 rounded-[1rem] text-xs font-black uppercase tracking-widest bg-white text-red-600 shadow-sm transition-all duration-500">
                            Hindi Transliteration
                        </button>
                        <button type="button" onclick="switchLang('en')" id="tab-en" class="flex-1 py-4 px-6 rounded-[1rem] text-xs font-black uppercase tracking-widest text-slate-400 hover:text-slate-600 transition-all duration-500">
                            Global English
                        </button>
                    </div>

                    <div class="p-8 md:p-10 pt-2">
                        <!-- Hindi Content -->
                        <div id="content-hi" class="space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-500">
                            <div class="space-y-4">
                                <label class="flex items-center space-x-2 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                    <span>Main Headline (Hindi)</span>
                                </label>
                                <input type="text" name="title_hi" id="title_hi" value="<?= esc($hi['title'] ?? '') ?>"
                                    class="w-full px-0 py-2 border-0 border-b-2 border-slate-100 bg-transparent font-black text-3xl placeholder:text-slate-200 focus:outline-none focus:border-red-500 transition-all duration-500" 
                                    placeholder="Elevate your story here..." required>
                            </div>

                            <div class="space-y-4 pt-4">
                                <label class="flex items-center space-x-2 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span>
                                    <span>Article Body</span>
                                </label>
                                <div class="rounded-3xl overflow-hidden border border-slate-100 shadow-sm">
                                    <textarea name="description_hi" id="description_hi" rows="15"><?= $hi['description'] ?? '' ?></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- English Content -->
                        <div id="content-en" class="space-y-8 hidden animate-in fade-in slide-in-from-bottom-4 duration-500">
                            <div class="space-y-4">
                                <label class="flex items-center space-x-2 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                                    <span>Headline English</span>
                                </label>
                                <input type="text" name="title_en" id="title_en" value="<?= esc($en['title'] ?? '') ?>"
                                    class="w-full px-0 py-2 border-0 border-b-2 border-slate-100 bg-transparent font-black text-3xl placeholder:text-slate-200 focus:outline-none focus:border-blue-500 transition-all duration-500" 
                                    placeholder="English headline...">
                            </div>

                            <div class="space-y-4">
                                <label class="flex items-center space-x-2 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span>
                                    <span>Body (EN)</span>
                                </label>
                                <div class="rounded-3xl overflow-hidden border border-slate-100">
                                    <textarea name="description_en" id="description_en" rows="15"><?= $en['description'] ?? '' ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SEO Engine -->
                <div class="premium-glass rounded-[2.5rem] p-8 md:p-10">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h3 class="text-xl font-black text-slate-900 tracking-tight">Search Engine Optimization</h3>
                            <p class="text-slate-400 text-xs font-bold uppercase tracking-widest">Global visibility settings</p>
                        </div>
                        <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-search"></i>
                        </div>
                    </div>

                    <div class="space-y-10">
                        <div class="translate-hi p-6 rounded-3xl bg-slate-50/50 border border-slate-100">
                             <div class="flex items-center gap-2 mb-6">
                                <span class="w-8 h-8 rounded-xl bg-red-100 text-red-600 flex items-center justify-center text-[10px] font-black italic">HI</span>
                                <h4 class="text-xs font-black text-slate-800 uppercase tracking-widest">Hindi Metadata</h4>
                             </div>
                             <div class="space-y-6">
                                <div>
                                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3">SEO Title</label>
                                    <input type="text" name="meta_title_hi" value="<?= esc($hi['meta_title'] ?? '') ?>" class="input-premium" placeholder="Primary Hindi Title...">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3">Key Tags</label>
                                    <input type="text" name="meta_keywords_hi" value="<?= esc($hi['meta_keywords'] ?? '') ?>" class="input-premium" placeholder="keywords, separated, by, commas">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3">Meta Description</label>
                                    <textarea name="meta_description_hi" rows="3" class="input-premium py-4 custom-scrollbar resize-none"><?= esc($hi['meta_description'] ?? '') ?></textarea>
                                </div>
                             </div>
                        </div>

                        <div class="translate-en p-6 rounded-3xl bg-slate-50/50 border border-slate-100 transition-all duration-500" id="seo-en-container">
                             <div class="flex items-center gap-2 mb-6">
                                <span class="w-8 h-8 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center text-[10px] font-black italic">EN</span>
                                <h4 class="text-xs font-black text-slate-800 uppercase tracking-widest">English Metadata</h4>
                             </div>
                             <div class="space-y-6">
                                <div>
                                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3">SEO Title</label>
                                    <input type="text" name="meta_title_en" value="<?= esc($en['meta_title'] ?? '') ?>" class="input-premium" placeholder="Primary English Title...">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3">Key Tags</label>
                                    <input type="text" name="meta_keywords_en" value="<?= esc($en['meta_keywords'] ?? '') ?>" class="input-premium" placeholder="keywords, tags, separated">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3">Meta Description</label>
                                    <textarea name="meta_description_en" rows="3" class="input-premium py-4 custom-scrollbar resize-none"><?= esc($en['meta_description'] ?? '') ?></textarea>
                                </div>
                             </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Operational Sidebar -->
            <div class="lg:col-span-4 space-y-8 sticky top-8">
                
                <!-- Status & Broadcast -->
                <div class="bg-slate-900 rounded-[2.5rem] p-8 shadow-2xl shadow-slate-900/30 text-white relative overflow-hidden group">
                    <div class="absolute -top-20 -right-20 w-64 h-64 bg-red-600/20 rounded-full blur-[100px] group-hover:scale-110 transition-transform duration-700"></div>
                    
                    <div class="flex items-center justify-between mb-8 relative z-10">
                        <span class="px-4 py-1.5 bg-red-600/20 text-red-500 rounded-full text-[10px] font-black uppercase tracking-widest border border-red-500/20">LIVE Station</span>
                        <div class="flex space-x-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></span>
                            <span class="w-1.5 h-1.5 rounded-full bg-red-500/50"></span>
                        </div>
                    </div>
                    
                    <div class="space-y-8 relative z-10">
                        <div class="space-y-4">
                            <label class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.2em]">Transmission Status</label>
                            <select name="status" class="w-full bg-slate-800/80 border border-slate-700 rounded-2xl px-5 py-4 font-bold text-sm focus:outline-none focus:border-red-500 transition-all appearance-none cursor-pointer text-white">
                                <option value="published" <?= $news['status'] == 'published' ? 'selected' : '' ?>>Instant Broadcast</option>
                                <option value="draft" <?= $news['status'] == 'draft' ? 'selected' : '' ?>>Locked Draft</option>
                                <option value="scheduled" <?= $news['status'] == 'scheduled' ? 'selected' : '' ?>>Programmed Release</option>
                            </select>
                        </div>

                        <div class="space-y-4">
                            <label class="block text-[9px] font-black text-slate-500 uppercase tracking-[0.2em]">Launch Sequence</label>
                            <input type="datetime-local" name="publish_at" value="<?= $news['publish_at'] ? date('Y-m-d\TH:i', strtotime($news['publish_at'])) : '' ?>" class="w-full bg-slate-800/50 border border-slate-700 rounded-2xl px-5 py-4 font-bold text-sm focus:outline-none focus:border-red-500 transition-all text-white">
                            <div class="flex items-center justify-center p-3 rounded-xl bg-slate-800/30 border border-slate-700/50">
                                <i class="far fa-clock text-red-500 mr-2 text-[10px]"></i>
                                <span class="text-[10px] font-bold text-slate-400 italic"><?= $news['publish_at'] ?: 'Awaiting Command' ?></span>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-black py-5 rounded-[1.5rem] shadow-2xl shadow-red-600/30 transition-all active:scale-[0.98] uppercase tracking-[0.3em] text-xs">
                           Commit Update
                        </button>
                        
                        <a href="<?= base_url('admin/news/delete/'.$news['id']) ?>" onclick="return confirm('Purge article permanently?')" class="block w-full text-center text-[10px] font-black text-slate-600 hover:text-red-500 uppercase tracking-widest transition-colors duration-300">Retract Article</a>
                    </div>
                </div>

                <!-- Featured Image Premium -->
                <div class="premium-glass rounded-[2.5rem] p-8 overflow-hidden">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest">Master Thumbnail</h3>
                        <div class="w-8 h-8 rounded-xl bg-slate-50 flex items-center justify-center text-slate-300">
                            <i class="fas fa-image"></i>
                        </div>
                    </div>
                    
                    <div class="relative group">
                        <?php 
                            $imagePath = ($news['image'] && file_exists('uploads/news/' . $news['image'])) 
                                        ? base_url('uploads/news/' . $news['image']) 
                                        : base_url('uploads/news/default.jpg');
                        ?>
                        <div id="image-preview" class="w-full aspect-[4/3] rounded-3xl bg-slate-100 overflow-hidden mb-6 border border-slate-100 relative shadow-inner">
                            <img id="preview-img" src="<?= $imagePath ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-end p-6">
                                <span class="text-[10px] text-white font-black uppercase tracking-widest">Current Active Asset</span>
                            </div>
                        </div>
                        
                        <label class="relative block group cursor-pointer">
                            <div class="flex items-center justify-center space-x-3 px-6 py-4 rounded-2xl bg-white border border-slate-100 shadow-sm group-hover:bg-red-50 group-hover:border-red-200 transition-all active:scale-95">
                                <i class="fas fa-camera text-slate-400 group-hover:text-red-500 transition-colors"></i>
                                <span class="text-xs font-black text-slate-600 group-hover:text-red-600 uppercase tracking-widest">Replace Media</span>
                            </div>
                            <input type="file" name="image" id="image-input" class="hidden" onchange="showPreview(event)">
                        </label>
                    </div>
                </div>

                <!-- Classification & Video Integration -->
                <div class="premium-glass rounded-[2.5rem] p-8">
                     <div class="space-y-8">
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Permanent Slug</label>
                            <input type="text" name="slug" id="slug" value="<?= esc($news['slug']) ?>" class="input-premium border-blue-50/50 text-blue-600 lowercase" required>
                        </div>

                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Broadcast Category</label>
                            <select name="category_id" class="input-premium appearance-none" required>
                                <?php foreach($categories as $cat): ?>
                                    <option value="<?= $cat['id'] ?>" <?= $cat['id'] == $news['category_id'] ? 'selected' : '' ?>><?= esc($cat['title_formatted'] ?? $cat['title']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Video Metadata Section -->
                        <div class="pt-4 border-t border-slate-50">
                            <div class="flex items-center justify-between mb-4">
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest">Video Stream Integration</label>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="video_url_status" value="active" id="videoToggle" class="sr-only peer" <?= !empty($news['video_url']) ? 'checked' : '' ?>>
                                    <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-600 shadow-inner"></div>
                                </label>
                            </div>

                            <div id="videoSection" class="<?= empty($news['video_url']) ? 'hidden' : '' ?> space-y-4">
                                <div class="relative">
                                    <input type="text" name="video_url" id="video_url" value="<?= esc($news['video_url']) ?>" 
                                           class="input-premium pl-12" placeholder="YouTube URL (e.g. https://youtu.be/...)">
                                    <i class="fab fa-youtube absolute left-5 top-1/2 -translate-y-1/2 text-red-600 text-lg"></i>
                                </div>
                                <div id="videoPreview" class="rounded-2xl overflow-hidden aspect-video bg-slate-100 hidden border border-slate-100">
                                    <!-- Dynamic Embed Load -->
                                </div>
                            </div>
                        </div>

                        <div class="pt-4 grid grid-cols-2 gap-4">
                            <label class="relative flex flex-col items-center justify-center p-6 rounded-3xl bg-slate-50/50 border border-slate-100 cursor-pointer group hover:bg-red-50/30 transition-all">
                                <input type="checkbox" name="is_breaking" value="1" class="sr-only peer" <?= $news['is_breaking'] ? 'checked' : '' ?>>
                                <div class="w-10 h-10 rounded-2xl bg-white shadow-sm flex items-center justify-center text-slate-300 group-hover:text-red-500 peer-checked:bg-red-600 peer-checked:text-white transition-all mb-3">
                                    <i class="fas fa-bolt"></i>
                                </div>
                                <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest group-hover:text-red-600 transition-colors">Breaking</span>
                            </label>

                            <label class="relative flex flex-col items-center justify-center p-6 rounded-3xl bg-slate-50/50 border border-slate-100 cursor-pointer group hover:bg-blue-50/30 transition-all">
                                <input type="checkbox" name="is_video_news" value="1" class="sr-only peer" <?= $news['is_video_news'] ? 'checked' : '' ?>>
                                <div class="w-10 h-10 rounded-2xl bg-white shadow-sm flex items-center justify-center text-slate-300 group-hover:text-blue-500 peer-checked:bg-blue-600 peer-checked:text-white transition-all mb-3">
                                    <i class="fas fa-video"></i>
                                </div>
                                <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest group-hover:text-blue-600 transition-colors">Premium Video</span>
                            </label>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        
        <!-- Floating Mobile Sync -->
        <div class="md:hidden floating-save">
             <button type="button" onclick="document.getElementById('newsForm').submit()" class="w-16 h-16 rounded-full bg-slate-900 text-white shadow-2xl flex items-center justify-center active:scale-90 transition-transform">
                <i class="fas fa-check"></i>
            </button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Premium Editor Skin
    const ckConfig = {
        height: 500,
        uiColor: '#ffffff',
        skin: 'moono-lisa',
        toolbar: [
            { name: 'document', items: [ 'Source', '-', 'Preview', 'Print' ] },
            { name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
            { name: 'editing', items: [ 'Find', 'Replace', '-', 'SelectAll' ] },
            { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
            '/',
            { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl' ] },
            { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
            { name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'SpecialChar', 'Iframe' ] },
            '/',
            { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
            { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
            { name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] }
        ],
        extraPlugins: 'justify,colorbutton,font',
        filebrowserUploadUrl: '<?= base_url('admin/news/upload') ?>?type=Files',
        filebrowserImageUploadUrl: '<?= base_url('admin/news/upload') ?>?type=Images',
        removePlugins: 'resize'
    };
    
    CKEDITOR.replace('description_hi', ckConfig);
    CKEDITOR.replace('description_en', ckConfig);

    // Language Engine
    function switchLang(lang) {
        const hiBtn = document.getElementById('tab-hi');
        const enBtn = document.getElementById('tab-en');
        const hiContent = document.getElementById('content-hi');
        const enContent = document.getElementById('content-en');
        const seoEn = document.getElementById('seo-en-container');

        if (lang === 'hi') {
            hiBtn.classList.add('bg-white', 'text-red-600', 'shadow-sm');
            hiBtn.classList.remove('text-slate-400');
            enBtn.classList.remove('bg-white', 'text-red-600', 'shadow-sm');
            enBtn.classList.add('text-slate-400');
            
            hiContent.classList.remove('hidden');
            enContent.classList.add('hidden');
            seoEn.classList.add('opacity-30', 'pointer-events-none', 'grayscale');
        } else {
            enBtn.classList.add('bg-white', 'text-red-600', 'shadow-sm');
            enBtn.classList.remove('text-slate-400');
            hiBtn.classList.remove('bg-white', 'text-red-600', 'shadow-sm');
            hiBtn.classList.add('text-slate-400');
            
            enContent.classList.remove('hidden');
            hiContent.classList.add('hidden');
            seoEn.classList.remove('opacity-30', 'pointer-events-none', 'grayscale');
        }
    }

    // Video Engine
    const videoToggle = document.getElementById('videoToggle');
    const videoSection = document.getElementById('videoSection');
    const videoInput = document.getElementById('video_url');
    const videoPreview = document.getElementById('videoPreview');

    videoToggle.addEventListener('change', function() {
        if (this.checked) {
            videoSection.classList.remove('hidden');
        } else {
            videoSection.classList.add('hidden');
        }
    });

    function updateVideoPreview() {
        const url = videoInput.value.trim();
        if (!url) {
            videoPreview.classList.add('hidden');
            return;
        }

        let videoId = '';
        if (url.includes('youtube.com/watch?v=')) {
            videoId = url.split('v=')[1].split('&')[0];
        } else if (url.includes('youtu.be/')) {
            videoId = url.split('youtu.be/')[1].split('?')[0];
        } else if (url.includes('youtube.com/embed/')) {
            videoId = url.split('embed/')[1].split('?')[0];
        }

        if (videoId) {
            videoPreview.innerHTML = `<iframe width="100%" height="100%" src="https://www.youtube.com/embed/${videoId}" frameborder="0" allowfullscreen></iframe>`;
            videoPreview.classList.remove('hidden');
        } else {
            videoPreview.classList.add('hidden');
        }
    }

    videoInput.addEventListener('input', updateVideoPreview);
    // Initial check
    if (videoInput.value) updateVideoPreview();

    // Media Preview
    function showPreview(event) {
        if (event.target.files.length > 0) {
            const src = URL.createObjectURL(event.target.files[0]);
            const preview = document.getElementById("preview-img");
            preview.src = src;
            
            // Pulse animation
            preview.animate([
                { opacity: 0, transform: 'scale(0.95)' },
                { opacity: 1, transform: 'scale(1)' }
            ], { duration: 500, easing: 'ease-out' });
        }
    }
</script>
<?= $this->endSection() ?>


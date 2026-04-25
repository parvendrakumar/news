<?= $this->extend('admin/layout') ?>

<?= $this->section('style') ?>
<style>
    .glass-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    .form-input-focus:focus {
        box-shadow: 0 0 0 4px rgba(220, 38, 38, 0.1);
        border-color: #dc2626;
        background-color: white;
    }
    .input-premium {
        @apply w-full px-6 py-4 rounded-2xl border border-slate-200 bg-white font-semibold text-slate-700 transition-all duration-300 shadow-sm sm:text-sm;
    }
    .input-premium:focus {
        @apply border-red-500 ring-4 ring-red-500/10 outline-none shadow-md;
    }
    .toggle-checkbox:checked {
        right: 0;
        border-color: #dc2626;
        background-color: #dc2626;
    }
    .toggle-checkbox:checked + .toggle-label {
        background-color: #fee2e2;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
        <h2 class="text-3xl font-black text-slate-800 tracking-tight">Create New Article</h2>
        <p class="text-slate-400 font-bold text-sm">Design and broadcast your next major headline</p>
    </div>
    <div class="flex items-center space-x-4">
        <a href="<?= base_url('admin/news') ?>" class="px-6 py-3 rounded-2xl bg-white border border-slate-200 text-slate-600 font-black text-xs uppercase tracking-widest hover:bg-slate-50 transition flex items-center shadow-sm">
            <i class="fas fa-arrow-left mr-2"></i> Discard
        </a>
    </div>
</div>

<form action="<?= base_url('admin/news/store') ?>" method="POST" enctype="multipart/form-data" id="newsForm">
    <?= csrf_field() ?>
    
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Left: Main Content -->
        <div class="lg:col-span-8 space-y-6">
            
            <!-- Language Selection Tabs -->
            <div class="bg-white rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
                <div class="flex border-b border-slate-100 bg-slate-50/50">
                    <button type="button" onclick="switchLang('hi')" id="tab-hi" class="flex-1 py-5 px-6 text-sm font-black uppercase tracking-widest border-b-2 border-red-600 text-red-600 transition">
                        Hindi (Primary)
                    </button>
                    <button type="button" onclick="switchLang('en')" id="tab-en" class="flex-1 py-5 px-6 text-sm font-black uppercase tracking-widest border-b-2 border-transparent text-slate-400 hover:text-slate-600 transition">
                        English (Optional)
                    </button>
                </div>

                <div class="p-8">
                    <!-- Hindi Content -->
                    <div id="content-hi" class="space-y-6">
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Title (Hindi)</label>
                            <input type="text" name="title_hi" id="title_hi" 
                                class="w-full px-6 py-5 rounded-2xl border border-slate-200 font-bold text-xl placeholder:text-slate-300 focus:outline-none form-input-focus transition" 
                                placeholder="Enter title in Hindi" required>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Main Content</label>
                            <textarea name="description_hi" id="description_hi" rows="15"></textarea>
                        </div>

                        <div class="space-y-10">
                            <!-- Hindi Metadata -->
                            <div class="p-6 rounded-3xl bg-slate-50/50 border border-slate-100">
                                <div class="flex items-center gap-2 mb-6">
                                    <span class="w-8 h-8 rounded-xl bg-red-100 text-red-600 flex items-center justify-center text-[10px] font-black italic">HI</span>
                                    <h4 class="text-xs font-black text-slate-800 uppercase tracking-widest">Hindi Search Intelligence</h4>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3">SEO Title</label>
                                        <input type="text" name="meta_title_hi" class="input-premium" placeholder="Primary Hindi keywords...">
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3">Meta Keywords</label>
                                        <input type="text" name="meta_keywords_hi" class="input-premium" placeholder="tag1, tag2, tag3">
                                    </div>
                                </div>
                                <div class="mt-6">
                                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3">Meta Description</label>
                                    <textarea name="meta_description_hi" rows="2" class="input-premium py-4 custom-scrollbar resize-none" placeholder="Brief summary for search results..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- English Content -->
                    <div id="content-en" class="space-y-6 hidden">
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Title (English)</label>
                            <input type="text" name="title_en" id="title_en" 
                                class="w-full px-6 py-5 rounded-2xl border border-slate-200 font-bold text-xl placeholder:text-slate-300 focus:outline-none form-input-focus transition" 
                                placeholder="Enter title in English">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Main Content (English)</label>
                            <textarea name="description_en" id="description_en" rows="15"></textarea>
                        </div>

                        <div class="space-y-10">
                            <!-- English Metadata -->
                            <div class="p-6 rounded-3xl bg-slate-50/50 border border-slate-100 opacity-40 pointer-events-none grayscale transition-all duration-500" id="seo-en-container">
                                <div class="flex items-center gap-2 mb-6">
                                    <span class="w-8 h-8 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center text-[10px] font-black italic">EN</span>
                                    <h4 class="text-xs font-black text-slate-800 uppercase tracking-widest">English Search Intelligence</h4>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3">SEO Title</label>
                                        <input type="text" name="meta_title_en" class="input-premium">
                                    </div>
                                    <div>
                                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3">Meta Keywords</label>
                                        <input type="text" name="meta_keywords_en" class="input-premium">
                                    </div>
                                </div>
                                <div class="mt-6">
                                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3">Meta Description</label>
                                    <textarea name="meta_description_en" rows="2" class="input-premium py-4 custom-scrollbar resize-none"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Media Gallery -->
            <div class="bg-white p-8 rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100">
                <h3 class="text-xs font-black text-slate-300 uppercase tracking-widest mb-6">Article Gallery</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4" id="gallery-preview">
                    <label class="aspect-square rounded-2xl border-2 border-dashed border-slate-100 hover:border-red-200 flex flex-col items-center justify-center cursor-pointer transition group bg-slate-50/50">
                        <i class="fas fa-plus text-slate-200 group-hover:text-red-400 text-2xl transition mb-2"></i>
                        <span class="text-[10px] font-black text-slate-300 group-hover:text-red-400 uppercase tracking-tighter">Add Photo</span>
                        <input type="file" name="gallery[]" multiple class="hidden" onchange="previewGallery(this)">
                    </label>
                </div>
                <p class="mt-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest italic">Multiple images supported. Formats: JPG, PNG, WEBP.</p>
            </div>
        </div>

        <!-- Right: Publishing Sidebar -->
        <div class="lg:col-span-4 space-y-6">
            
            <!-- Publish Actions -->
            <div class="bg-slate-900 p-8 rounded-[2rem] shadow-2xl shadow-slate-900/40 text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 bg-red-600/10 rounded-full blur-3xl"></div>
                
                <h3 class="text-xs font-black text-red-500 uppercase tracking-widest mb-6 relative z-10">Broadcast Station</h3>
                
                <div class="space-y-6 relative z-10">
                    <div>
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3">Publication Status</label>
                        <select name="status" class="w-full bg-slate-800/80 border border-slate-700 rounded-xl px-4 py-3 font-bold text-sm focus:outline-none focus:border-red-500 transition text-white appearance-none cursor-pointer">
                            <option value="published">Direct Broadcast</option>
                            <option value="draft">Save as Draft</option>
                            <option value="scheduled">Schedule for Later</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-3">Schedule Time</label>
                        <input type="datetime-local" name="publish_at" class="w-full bg-slate-800 border border-slate-700 rounded-xl px-4 py-3 font-bold text-sm focus:outline-none focus:border-red-500 transition text-white">
                        <p class="mt-2 text-[10px] text-slate-500 italic">Leave empty for instant publication</p>
                    </div>

                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-black py-5 rounded-2xl shadow-xl shadow-red-600/20 transition-all transform hover:-translate-y-1 uppercase tracking-[0.2em] text-sm">
                        Confirm & Publish
                    </button>
                </div>
            </div>

            <!-- Configuration -->
            <div class="bg-white p-8 rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100">
                <h3 class="text-xs font-black text-slate-300 uppercase tracking-widest mb-6">Article Metadata</h3>
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Slug (URL)</label>
                        <input type="text" name="slug" id="slug" class="w-full px-4 py-3 rounded-xl border border-slate-100 bg-slate-50 font-bold text-xs text-blue-600" placeholder="automatic-slug" required>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Category</label>
                        <select name="category_id" class="w-full px-4 py-3 rounded-xl border border-slate-100 bg-slate-50 font-bold text-sm focus:outline-none" required>
                            <option value="">Select Category</option>
                            <?php foreach($categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>"><?= esc($cat['title_formatted'] ?? $cat['title']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Author Name</label>
                        <input type="text" name="custom_author" class="w-full px-4 py-3 rounded-xl border border-slate-100 bg-slate-50 font-bold text-sm" placeholder="Optional author name">
                    </div>

                    <!-- YouTube Video Integration -->
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest">Video Stream Integration</label>
                            <label class="relative inline-flex items-center cursor-pointer scale-75 origin-right">
                                <input type="checkbox" name="video_url_status" id="yt-toggle" value="active" class="sr-only peer" onchange="toggleYtInput()">
                                <div class="w-9 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-red-600"></div>
                                <span class="ml-2 text-[9px] font-black text-slate-400 uppercase">Enable</span>
                            </label>
                        </div>
                        <div id="yt-input-container" class="relative opacity-40 pointer-events-none transition-all duration-300 scale-95 origin-top space-y-4">
                            <div class="relative">
                                <input type="url" name="video_url" id="video_url_input" class="w-full pl-10 pr-4 py-3 rounded-xl border border-slate-100 bg-slate-50 font-bold text-sm text-red-600 focus:outline-none focus:border-red-500" placeholder="https://www.youtube.com/watch?v=...">
                                <div class="absolute left-3 top-1/2 -translate-y-1/2 text-red-500">
                                    <i class="fab fa-youtube"></i>
                                </div>
                            </div>
                            <div id="videoPreview" class="rounded-2xl overflow-hidden aspect-video bg-slate-100 hidden border border-slate-100">
                                <!-- Dynamic Embed -->
                            </div>
                        </div>
                    </div>

                    <script>
                        function toggleYtInput() {
                            const checkbox = document.getElementById('yt-toggle');
                            const container = document.getElementById('yt-input-container');
                            const input = document.getElementById('video_url_input');
                            const preview = document.getElementById('videoPreview');
                            
                            if (checkbox.checked) {
                                container.classList.remove('opacity-40', 'pointer-events-none', 'scale-95');
                                container.classList.add('opacity-100', 'scale-100');
                                input.placeholder = "Enter YouTube URL...";
                            } else {
                                container.classList.add('opacity-40', 'pointer-events-none', 'scale-95');
                                container.classList.remove('opacity-100', 'scale-100');
                                input.value = ""; 
                                input.placeholder = "Video Disabled";
                                preview.classList.add('hidden');
                                preview.innerHTML = '';
                            }
                        }

                        document.getElementById('video_url_input').addEventListener('input', function() {
                            const url = this.value.trim();
                            const preview = document.getElementById('videoPreview');
                            if (!url) {
                                preview.classList.add('hidden');
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
                                preview.innerHTML = `<iframe width="100%" height="100%" src="https://www.youtube.com/embed/${videoId}" frameborder="0" allowfullscreen></iframe>`;
                                preview.classList.remove('hidden');
                            } else {
                                preview.classList.add('hidden');
                            }
                        });
                    </script>

                    <div class="pt-4 space-y-4">
                        <div class="flex items-center justify-between p-4 rounded-2xl bg-slate-50 border border-slate-100">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-lg bg-red-100 text-red-600 flex items-center justify-center mr-3">
                                    <i class="fas fa-bolt text-xs"></i>
                                </div>
                                <span class="text-xs font-black text-slate-700 uppercase tracking-tight">Breaking News</span>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_breaking" value="1" class="sr-only peer">
                                <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-600"></div>
                            </label>
                        </div>

                        <div class="flex items-center justify-between p-4 rounded-2xl bg-slate-50 border border-slate-100">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center mr-3">
                                    <i class="fas fa-video text-xs"></i>
                                </div>
                                <span class="text-xs font-black text-slate-700 uppercase tracking-tight">Video Content</span>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_video_news" value="1" class="sr-only peer">
                                <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Featured Image -->
            <div class="bg-white p-8 rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100">
                <h3 class="text-xs font-black text-slate-300 uppercase tracking-widest mb-6">Prominent Asset</h3>
                <div class="relative group">
                    <div id="image-preview" class="hidden w-full aspect-video rounded-2xl bg-slate-100 overflow-hidden mb-4 border border-slate-200">
                        <img id="preview-img" src="#" class="w-full h-full object-cover">
                        <button type="button" onclick="removeImage()" class="absolute top-2 right-2 w-8 h-8 bg-black/50 text-white rounded-full flex items-center justify-center hover:bg-black transition">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    
                    <label id="upload-label" class="w-full aspect-video flex flex-col items-center justify-center rounded-2xl border-2 border-dashed border-slate-200 hover:border-red-400 transition cursor-pointer bg-slate-50 hover:bg-red-50/10">
                        <div class="w-16 h-16 rounded-2xl bg-white shadow-sm flex items-center justify-center text-red-500 mb-4 group-hover:scale-110 transition">
                            <i class="fas fa-cloud-upload-alt text-2xl"></i>
                        </div>
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Select Cover Image</span>
                        <input type="file" name="image" id="image-input" class="hidden" onchange="showPreview(event)">
                    </label>
                </div>
            </div>

            <!-- Boost Views -->
            <div class="bg-white p-8 rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100 border-l-4 border-l-indigo-500">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xs font-black text-indigo-500 uppercase tracking-widest">Growth Accelerator</h3>
                    <i class="fas fa-chart-line text-slate-200"></i>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Artificial Traffic Boost</label>
                    <div class="relative">
                        <input type="number" name="initial_views" class="w-full px-5 py-4 rounded-xl border border-slate-100 bg-slate-50 font-bold text-sm" placeholder="0" value="0">
                        <div class="absolute right-4 top-1/2 -translate-y-1/2 text-[10px] font-black text-slate-300 uppercase">Views</div>
                    </div>
                    <p class="mt-3 text-[10px] text-slate-400 font-bold italic">Instantly increase the reported view count for this article.</p>
                </div>
            </div>

        </div>
    </div>
</form>

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
            { name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'SpecialChar', 'PageBreak', 'Iframe' ] },
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

    // Language Switcher
    function switchLang(lang) {
        const hiBtn = document.getElementById('tab-hi');
        const enBtn = document.getElementById('tab-en');
        const hiContent = document.getElementById('content-hi');
        const enContent = document.getElementById('content-en');

        if (lang === 'hi') {
            hiBtn.classList.add('border-red-600', 'text-red-600');
            hiBtn.classList.remove('border-transparent', 'text-slate-400');
            enBtn.classList.remove('border-red-600', 'text-red-600');
            enBtn.classList.add('border-transparent', 'text-slate-400');
            hiContent.classList.remove('hidden');
            enContent.classList.add('hidden');
        } else {
            enBtn.classList.add('border-red-600', 'text-red-600');
            enBtn.classList.remove('border-transparent', 'text-slate-400');
            hiBtn.classList.remove('border-red-600', 'text-red-600');
            hiBtn.classList.add('border-transparent', 'text-slate-400');
            enContent.classList.remove('hidden');
            hiContent.classList.add('hidden');
        }
    }

    // Auto-slug Generator
    function generateSlug(text) {
        return text.toString().toLowerCase()
            .replace(/\s+/g, '-')           // Replace spaces with -
            .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
            .replace(/\-\-+/g, '-')         // Replace multiple - with single -
            .replace(/^-+/, '')             // Trim - from start of text
            .replace(/-+$/, '');            // Trim - from end of text
    }

    const titleHi = document.getElementById('title_hi');
    const titleEn = document.getElementById('title_en');
    const slugInput = document.getElementById('slug');

    titleHi.addEventListener('keyup', function() {
        if (slugInput.value === '' || slugInput.dataset.manual !== 'true') {
            // Hindi slugs are complex, we usually fallback to EN or manual entry
            // But if they type English in the Hindi field, we can use it
        }
    });

    titleEn.addEventListener('keyup', function() {
        if (slugInput.dataset.manual !== 'true') {
            slugInput.value = generateSlug(this.value);
        }
    });

    slugInput.addEventListener('change', function() {
        this.dataset.manual = 'true';
    });

    // Image Preview
    function showPreview(event) {
        if (event.target.files.length > 0) {
            const src = URL.createObjectURL(event.target.files[0]);
            const preview = document.getElementById("preview-img");
            preview.src = src;
            document.getElementById("image-preview").classList.remove('hidden');
            document.getElementById("upload-label").classList.add('hidden');
        }
    }

    function removeImage() {
        document.getElementById("image-input").value = "";
        document.getElementById("image-preview").classList.add('hidden');
        document.getElementById("upload-label").classList.remove('hidden');
    }

    // Gallery Preview
    function previewGallery(input) {
        const previewContainer = document.getElementById('gallery-preview');
        // Clear existing previews except the upload button
        const uploadBtn = previewContainer.querySelector('label');
        
        if (input.files) {
            Array.from(input.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = "aspect-square rounded-2xl bg-white border border-slate-100 overflow-hidden relative group";
                    div.innerHTML = `
                        <img src="${e.target.result}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                            <i class="fas fa-check text-white"></i>
                        </div>
                    `;
                    previewContainer.insertBefore(div, uploadBtn);
                }
                reader.readAsDataURL(file);
            });
        }
    }
</script>
<?= $this->endSection() ?>

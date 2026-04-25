<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
        <h2 class="text-3xl font-black text-slate-800 tracking-tight">Create Visual Story</h2>
        <p class="text-slate-400 font-bold text-sm">Design an interactive vertical experience</p>
    </div>
    <a href="<?= base_url('admin/stories') ?>" class="text-slate-400 hover:text-slate-600 font-black text-xs uppercase tracking-widest flex items-center">
        <i class="fas fa-arrow-left mr-2"></i> Back to List
    </a>
</div>

<form action="<?= base_url('admin/stories/store') ?>" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <?= csrf_field() ?>
    
    <div class="lg:col-span-8 space-y-6">
        <div class="bg-white p-4 md:p-8 rounded-[2rem] shadow-sm border border-slate-100">
            <h3 class="text-xs font-black text-slate-300 uppercase tracking-widest mb-6">Vertical Content</h3>
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Headline (Hindi)</label>
                    <input type="text" name="title_hi" class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-yellow-500 outline-none font-bold" placeholder="खबर का शीर्षक हिंदी में..." required>
                </div>
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Headline (English)</label>
                    <input type="text" name="title_en" class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-yellow-500 outline-none font-bold" placeholder="Enter headline in English...">
                </div>
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Story Narrative (Hindi)</label>
                    <textarea name="content_hi" id="content_hi" rows="6" class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-yellow-500 outline-none font-medium" placeholder="कहानी का विवरण यहाँ लिखें..."></textarea>
                </div>
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Story Narrative (English)</label>
                    <textarea name="content_en" id="content_en" rows="6" class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-yellow-500 outline-none font-medium" placeholder="Write story narrative in English..."></textarea>
                </div>
            </div>
        </div>

        <div class="bg-white p-4 md:p-8 rounded-[2rem] shadow-sm border border-slate-100">
            <h3 class="text-xs font-black text-slate-300 uppercase tracking-widest mb-6">SEO Optimization</h3>
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Meta Title</label>
                    <input type="text" name="meta_title" class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 outline-none font-bold" placeholder="SEO Title for Google...">
                </div>
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Meta Keywords</label>
                    <input type="text" name="meta_keywords" class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 outline-none font-bold" placeholder="trending, news, stories...">
                </div>
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Meta Description</label>
                    <textarea name="meta_description" rows="3" class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 outline-none font-medium" placeholder="Summarize for search results..."></textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="lg:col-span-4 space-y-6">
        <div class="bg-white p-4 md:p-8 rounded-[2rem] shadow-sm border border-slate-100">
            <h3 class="text-xs font-black text-slate-300 uppercase tracking-widest mb-6">Media & Visuals</h3>
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-4">Vertical Poster (9:16)</label>
                    <div class="relative group cursor-pointer h-80 rounded-3xl border-2 border-dashed border-slate-200 flex flex-col items-center justify-center bg-slate-50 hover:bg-yellow-50 hover:border-yellow-200 transition">
                        <input type="file" name="image" class="absolute inset-0 opacity-0 cursor-pointer z-10" required onchange="previewImage(this)">
                        <div id="image-placeholder" class="text-center">
                            <i class="fas fa-camera text-4xl text-slate-200 mb-4 group-hover:text-yellow-300 transition"></i>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Upload Vertical Cover</p>
                        </div>
                        <img id="image-preview" class="absolute inset-0 w-full h-full object-cover rounded-[1.4rem] hidden">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Story Status</label>
                    <select name="status" class="w-full px-5 py-3 rounded-xl border border-slate-200 font-bold text-slate-700 outline-none">
                        <option value="published">Live & Published</option>
                        <option value="draft">Save as Draft</option>
                    </select>
                </div>

                <button type="submit" class="w-full bg-yellow-500 text-white font-black py-4 rounded-2xl hover:bg-yellow-600 shadow-xl shadow-yellow-100 transition uppercase tracking-widest text-sm">
                    Publish Story
                </button>
            </div>
        </div>
    </div>
</form>

<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('image-preview').src = e.target.result;
                document.getElementById('image-preview').classList.remove('hidden');
                document.getElementById('image-placeholder').classList.add('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    CKEDITOR.replace('content_hi');
    CKEDITOR.replace('content_en');
</script>

<?= $this->endSection() ?>

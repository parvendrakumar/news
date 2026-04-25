<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
        <h2 class="text-3xl font-black text-slate-800 tracking-tight">Publish Video News</h2>
        <p class="text-slate-400 font-bold text-sm">Add a new video bulletin to your portal</p>
    </div>
    <a href="<?= base_url('admin/videos') ?>" class="text-slate-400 hover:text-slate-600 font-black text-xs uppercase tracking-widest flex items-center">
        <i class="fas fa-arrow-left mr-2"></i> Back to Library
    </a>
</div>

<form action="<?= base_url('admin/videos/store') ?>" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <?= csrf_field() ?>
    
    <div class="lg:col-span-8 space-y-6">
        <div class="bg-white p-4 md:p-8 rounded-[2rem] shadow-sm border border-slate-100">
            <h3 class="text-xs font-black text-slate-300 uppercase tracking-widest mb-6">Bulletin Details</h3>
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Video Title (Hindi)</label>
                    <input type="text" name="title_hi" class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-blue-500 outline-none font-bold" placeholder="वीडियो का शीर्षक हिंदी में..." required>
                </div>
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Video Title (English)</label>
                    <input type="text" name="title_en" class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-blue-500 outline-none font-bold" placeholder="Enter video title in English...">
                </div>
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Author Name</label>
                    <input type="text" name="author_name" value="<?= session()->get('fullName') ?>" class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:border-blue-500 outline-none font-bold text-slate-600" placeholder="Editor Name...">
                </div>
                <div class="p-6 bg-blue-50/50 rounded-3xl border border-blue-100/50">
                    <label class="block text-sm font-black text-blue-700 mb-2 italic">Video URL (YouTube/Direct)</label>
                    <input type="url" name="video_url" class="w-full px-5 py-4 rounded-2xl border border-blue-200 focus:border-blue-500 outline-none font-bold text-blue-900 shadow-sm" placeholder="https://www.youtube.com/watch?v=..." required>
                </div>
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Bulletin Narrative (Hindi)</label>
                    <textarea name="description_hi" id="description_hi" rows="6" class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-blue-500 outline-none font-medium"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Bulletin Narrative (English)</label>
                    <textarea name="description_en" id="description_en" rows="6" class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-blue-500 outline-none font-medium"></textarea>
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
                    <input type="text" name="meta_keywords" class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 outline-none font-bold" placeholder="video, news, update...">
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
            <h3 class="text-xs font-black text-slate-300 uppercase tracking-widest mb-6">Thumbnails & Media</h3>
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-4">Video Thumbnail (16:9)</label>
                    <div class="relative group cursor-pointer h-48 rounded-3xl border-2 border-dashed border-slate-200 flex flex-col items-center justify-center bg-slate-50 hover:bg-blue-50 hover:border-blue-200 transition">
                        <input type="file" name="thumbnail" class="absolute inset-0 opacity-0 cursor-pointer z-10" onchange="previewImage(this)">
                        <div id="image-placeholder" class="text-center">
                            <i class="fas fa-play-circle text-4xl text-slate-200 mb-4 group-hover:text-blue-300 transition"></i>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Upload Cover Image</p>
                        </div>
                        <img id="image-preview" class="absolute inset-0 w-full h-full object-cover rounded-[1.4rem] hidden">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Publishing Status</label>
                    <select name="status" class="w-full px-5 py-3 rounded-xl border border-slate-200 font-bold text-slate-700 outline-none">
                        <option value="published">Live & Published</option>
                        <option value="draft">Save as Draft</option>
                    </select>
                </div>

                <button type="submit" class="w-full bg-blue-600 text-white font-black py-4 rounded-2xl hover:bg-blue-700 shadow-xl shadow-blue-100 transition uppercase tracking-widest text-sm">
                    Publish Video
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
    
    CKEDITOR.replace('description_hi');
    CKEDITOR.replace('description_en');
</script>

<?= $this->endSection() ?>

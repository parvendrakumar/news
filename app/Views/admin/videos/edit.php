<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
        <h2 class="text-3xl font-black text-slate-800 tracking-tight">Edit Video Bulletin</h2>
        <p class="text-slate-400 font-bold text-sm">Update your multimedia news content</p>
    </div>
    <a href="<?= base_url('admin/videos') ?>" class="text-slate-400 hover:text-slate-600 font-black text-xs uppercase tracking-widest flex items-center">
        <i class="fas fa-arrow-left mr-2"></i> Back to Library
    </a>
</div>

<form action="<?= base_url('admin/videos/update/' . $video['id']) ?>" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <?= csrf_field() ?>
    <input type="hidden" name="old_thumbnail" value="<?= $video['thumbnail'] ?>">
    
    <div class="lg:col-span-8 space-y-6">
        <div class="bg-white p-4 md:p-8 rounded-[2rem] shadow-sm border border-slate-100">
            <h3 class="text-xs font-black text-slate-300 uppercase tracking-widest mb-6">Bulletin Details</h3>
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Video Title (Hindi)</label>
                    <input type="text" name="title_hi" value="<?= esc($video['title_hi']) ?>" class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-blue-500 outline-none font-bold" placeholder="वीडियो का शीर्षक हिंदी में..." required>
                </div>
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Video Title (English)</label>
                    <input type="text" name="title_en" value="<?= esc($video['title_en']) ?>" class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-blue-500 outline-none font-bold" placeholder="Enter video title in English...">
                </div>
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Author Name</label>
                    <input type="text" name="author_name" value="<?= esc($video['author_name'] ?? session()->get('fullName')) ?>" class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:border-blue-500 outline-none font-bold text-slate-600" placeholder="Editor Name...">
                </div>
                <div class="p-6 bg-blue-50/50 rounded-3xl border border-blue-100/50">
                    <label class="block text-sm font-black text-blue-700 mb-2 italic">Video URL (YouTube/Direct)</label>
                    <input type="url" name="video_url" value="<?= esc($video['video_url']) ?>" class="w-full px-5 py-4 rounded-2xl border border-blue-200 focus:border-blue-500 outline-none font-bold text-blue-900 shadow-sm" required>
                </div>
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Bulletin Narrative (Hindi)</label>
                    <textarea name="description_hi" id="description_hi" rows="6" class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-blue-500 outline-none font-medium"><?= $video['description_hi'] ?></textarea>
                </div>
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Bulletin Narrative (English)</label>
                    <textarea name="description_en" id="description_en" rows="6" class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-blue-500 outline-none font-medium"><?= $video['description_en'] ?></textarea>
                </div>
            </div>
        </div>

        <div class="bg-white p-4 md:p-8 rounded-[2rem] shadow-sm border border-slate-100">
            <h3 class="text-xs font-black text-slate-300 uppercase tracking-widest mb-6">SEO Optimization</h3>
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Meta Title</label>
                    <input type="text" name="meta_title" value="<?= esc($video['meta_title'] ?? '') ?>" class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 outline-none font-bold" placeholder="SEO Title for Google...">
                </div>
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Meta Keywords</label>
                    <input type="text" name="meta_keywords" value="<?= esc($video['meta_keywords'] ?? '') ?>" class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 outline-none font-bold" placeholder="video, news, update...">
                </div>
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Meta Description</label>
                    <textarea name="meta_description" rows="3" class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 outline-none font-medium" placeholder="Summarize for search results..."><?= $video['meta_description'] ?? '' ?></textarea>
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
                        <input type="file" name="thumbnail" class="absolute inset-0 opacity-0 cursor-pointer z-10 z-10" onchange="previewImage(this)">
                        <?php if ($video['thumbnail']): ?>
                            <img id="image-preview" src="<?= base_url('uploads/videos/' . $video['thumbnail']) ?>" class="absolute inset-0 w-full h-full object-cover rounded-[1.4rem]">
                        <?php else: ?>
                            <div id="image-placeholder" class="text-center">
                                <i class="fas fa-play-circle text-4xl text-slate-200 mb-4 group-hover:text-blue-300 transition"></i>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Update Thumbnail</p>
                            </div>
                            <img id="image-preview" class="absolute inset-0 w-full h-full object-cover rounded-[1.4rem] hidden">
                        <?php endif; ?>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Publishing Status</label>
                    <select name="status" class="w-full px-5 py-3 rounded-xl border border-slate-200 font-bold text-slate-700 outline-none">
                        <option value="published" <?= $video['status'] == 'published' ? 'selected' : '' ?>>Live & Published</option>
                        <option value="draft" <?= $video['status'] == 'draft' ? 'selected' : '' ?>>Save as Draft</option>
                    </select>
                </div>

                <div class="bg-blue-50 p-4 rounded-2xl border border-blue-100">
                    <div class="flex items-center text-blue-700 font-black text-xs uppercase tracking-widest mb-2">
                        <i class="far fa-chart-bar mr-2"></i> Bulletin Reach
                    </div>
                    <div class="text-2xl font-black text-slate-800"><?= number_format($video['views']) ?> <span class="text-xs font-bold text-slate-400 uppercase tracking-tighter">Live Views</span></div>
                </div>

                <button type="submit" class="w-full bg-slate-800 text-white font-black py-4 rounded-2xl hover:bg-slate-900 shadow-xl transition uppercase tracking-widest text-sm">
                    Update Video
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
                const preview = document.getElementById('image-preview');
                const placeholder = document.getElementById('image-placeholder');
                
                if (preview) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                if (placeholder) {
                    placeholder.classList.add('hidden');
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    CKEDITOR.replace('description_hi');
    CKEDITOR.replace('description_en');
</script>

<?= $this->endSection() ?>

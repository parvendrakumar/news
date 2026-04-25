<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
        <h2 class="text-3xl font-black text-slate-800 tracking-tight">Edit Visual Story</h2>
        <p class="text-slate-400 font-bold text-sm">Update your interactive vertical experience</p>
    </div>
    <a href="<?= base_url('admin/stories') ?>" class="text-slate-400 hover:text-slate-600 font-black text-xs uppercase tracking-widest flex items-center">
        <i class="fas fa-arrow-left mr-2"></i> Back to List
    </a>
</div>

<form action="<?= base_url('admin/stories/update/' . $story['id']) ?>" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <?= csrf_field() ?>
    <input type="hidden" name="old_image" value="<?= $story['image'] ?>">
    
    <div class="lg:col-span-8 space-y-6">
        <div class="bg-white p-4 md:p-8 rounded-[2rem] shadow-sm border border-slate-100">
            <h3 class="text-xs font-black text-slate-300 uppercase tracking-widest mb-6">Vertical Content</h3>
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Headline (Hindi)</label>
                    <input type="text" name="title_hi" value="<?= esc($story['title_hi']) ?>" class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-yellow-500 outline-none font-bold" placeholder="खबर का शीर्षक हिंदी में..." required>
                </div>
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Headline (English)</label>
                    <input type="text" name="title_en" value="<?= esc($story['title_en']) ?>" class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-yellow-500 outline-none font-bold" placeholder="Enter headline in English...">
                </div>
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Story Narrative (Hindi)</label>
                    <textarea name="content_hi" id="content_hi" rows="6" class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-yellow-500 outline-none font-medium"><?= $story['content_hi'] ?></textarea>
                </div>
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Story Narrative (English)</label>
                    <textarea name="content_en" id="content_en" rows="6" class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-yellow-500 outline-none font-medium"><?= $story['content_en'] ?></textarea>
                </div>
            </div>
        </div>

        <div class="bg-white p-4 md:p-8 rounded-[2rem] shadow-sm border border-slate-100">
            <h3 class="text-xs font-black text-slate-300 uppercase tracking-widest mb-6">SEO Optimization</h3>
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Meta Title</label>
                    <input type="text" name="meta_title" value="<?= esc($story['meta_title'] ?? '') ?>" class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 outline-none font-bold" placeholder="SEO Title for Google...">
                </div>
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Meta Keywords</label>
                    <input type="text" name="meta_keywords" value="<?= esc($story['meta_keywords'] ?? '') ?>" class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 outline-none font-bold" placeholder="trending, news, stories...">
                </div>
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Meta Description</label>
                    <textarea name="meta_description" rows="3" class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 outline-none font-medium" placeholder="Summarize for search results..."><?= $story['meta_description'] ?? '' ?></textarea>
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
                        <input type="file" name="image" class="absolute inset-0 opacity-0 cursor-pointer z-10" onchange="previewImage(this)">
                        
                        <?php if ($story['image']): ?>
                            <img id="image-preview" src="<?= base_url('uploads/stories/' . $story['image']) ?>" class="absolute inset-0 w-full h-full object-cover rounded-[1.4rem]">
                            <div id="image-placeholder" class="hidden text-center z-10">
                                <i class="fas fa-camera text-4xl text-slate-200 mb-4 group-hover:text-yellow-300 transition"></i>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Change Cover</p>
                            </div>
                        <?php else: ?>
                            <div id="image-placeholder" class="text-center">
                                <i class="fas fa-camera text-4xl text-slate-200 mb-4 group-hover:text-yellow-300 transition"></i>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Upload Cover</p>
                            </div>
                            <img id="image-preview" class="absolute inset-0 w-full h-full object-cover rounded-[1.4rem] hidden">
                        <?php endif; ?>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Story Status</label>
                    <select name="status" class="w-full px-5 py-3 rounded-xl border border-slate-200 font-bold text-slate-700 outline-none">
                        <option value="published" <?= $story['status'] == 'published' ? 'selected' : '' ?>>Live & Published</option>
                        <option value="draft" <?= $story['status'] == 'draft' ? 'selected' : '' ?>>Save as Draft</option>
                    </select>
                </div>

                <div class="bg-yellow-50 p-4 rounded-2xl border border-yellow-100">
                    <div class="flex items-center text-yellow-700 font-black text-xs uppercase tracking-widest mb-2">
                        <i class="far fa-chart-bar mr-2"></i> Current Reach
                    </div>
                    <div class="text-2xl font-black text-slate-800"><?= number_format($story['views']) ?> <span class="text-xs font-bold text-slate-400 uppercase tracking-tighter">Total Views</span></div>
                </div>

                <button type="submit" class="w-full bg-slate-800 text-white font-black py-4 rounded-2xl hover:bg-slate-900 shadow-xl transition uppercase tracking-widest text-sm">
                    Update Story
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

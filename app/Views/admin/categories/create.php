<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
        <h2 class="text-3xl font-black text-slate-800 tracking-tight">Create New Category</h2>
        <p class="text-slate-400 font-bold text-sm">Orchestrate a new news segment for your portal</p>
    </div>
    <a href="<?= base_url('admin/categories') ?>" class="text-slate-400 hover:text-slate-600 font-black text-xs uppercase tracking-widest flex items-center">
        <i class="fas fa-arrow-left mr-2"></i> Back to Categories
    </a>
</div>

<div class="max-w-4xl">
    <div class="bg-white p-6 md:p-8 rounded-[2rem] shadow-sm border border-slate-100">
        <form action="<?= base_url('admin/categories/store') ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
            <?= csrf_field() ?>
            
            <div class="mb-8">
                <label class="block text-sm font-black text-slate-700 mb-2">Category Featured Image</label>
                <div class="relative group">
                    <input type="file" name="image" id="category_image" class="hidden" accept="image/*" onchange="previewImage(this)">
                    <label for="category_image" class="flex flex-col items-center justify-center w-full h-48 border-2 border-dashed border-slate-200 rounded-[2rem] bg-slate-50 cursor-pointer group-hover:bg-slate-100 group-hover:border-red-600 transition-all overflow-hidden sticky-image-label">
                        <div id="image_placeholder" class="flex flex-col items-center justify-center">
                            <div class="w-12 h-12 bg-white rounded-2xl shadow-sm flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                                <i class="fas fa-cloud-upload-alt text-red-600"></i>
                            </div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Click to upload image</p>
                        </div>
                        <img id="image_preview" class="hidden w-full h-full object-cover">
                    </label>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Title (Hindi)</label>
                    <input type="text" name="title_hi" class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-red-600 outline-none font-bold" placeholder="Enter category title in Hindi" required>
                </div>
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Title (English)</label>
                    <input type="text" name="title_en" class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-red-600 outline-none font-bold" placeholder="Enter category title in English">
                </div>
            </div>

            <div>
                <label class="block text-sm font-black text-slate-700 mb-2">URL Slug</label>
                <input type="text" name="slug" class="w-full px-5 py-3 rounded-xl border border-slate-200 font-bold text-blue-600 bg-blue-50/30" placeholder="e.g. cinema-world" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Parent Category</label>
                    <select name="parent_id" class="w-full px-5 py-3 rounded-xl border border-slate-200 font-bold text-slate-700 appearance-none bg-white">
                        <option value="0">-- None (Root) --</option>
                        <?php foreach ($parents as $p): ?>
                            <option value="<?= $p['id'] ?>"><?= $p['title'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Operational Status</label>
                    <select name="status" class="w-full px-5 py-3 rounded-xl border border-slate-200 font-bold text-slate-700 appearance-none bg-white">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Sort Order</label>
                    <input type="number" name="sort_order" class="w-full px-5 py-3 rounded-xl border border-slate-200 font-bold text-slate-700 bg-white" placeholder="0" value="0">
                </div>
            </div>

            <div class="pt-6 border-t border-slate-50">
                <h3 class="text-[10px] font-black text-slate-300 uppercase tracking-widest mb-6">Discovery & SEO</h3>
                <div class="space-y-6">
                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Meta Title</label>
                        <input type="text" name="meta_title" class="w-full px-5 py-3 rounded-xl border border-slate-100 bg-slate-50 font-bold text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Meta Description</label>
                        <textarea name="meta_description" rows="3" class="w-full px-5 py-3 rounded-xl border border-slate-100 bg-slate-50 font-bold text-sm resize-none" placeholder="Describe this section for search engines..."></textarea>
                    </div>
                </div>
            </div>

            <div class="pt-8">
                <button type="submit" class="w-full bg-slate-900 text-white font-black py-4 rounded-2xl hover:bg-red-600 shadow-xl transition uppercase tracking-widest text-sm">
                    Initialize Category
                </button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('image_preview').src = e.target.result;
                document.getElementById('image_preview').classList.remove('hidden');
                document.getElementById('image_placeholder').classList.add('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<?= $this->endSection() ?>

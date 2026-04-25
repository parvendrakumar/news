<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
        <h2 class="text-3xl font-black text-slate-800 tracking-tight">Edit Ad Slot</h2>
        <p class="text-slate-400 font-bold text-sm">Modify monetization parameters</p>
    </div>
    <a href="<?= base_url('admin/ads') ?>" class="text-slate-400 hover:text-slate-600 font-black text-xs uppercase tracking-widest flex items-center">
        <i class="fas fa-arrow-left mr-2"></i> Back to Manager
    </a>
</div>

<form action="<?= base_url('admin/ads/update/' . $ad['id']) ?>" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <?= csrf_field() ?>
    <input type="hidden" name="old_image" value="<?= $ad['image'] ?>">
    
    <div class="lg:col-span-8 space-y-6">
        <div class="bg-white p-4 md:p-8 rounded-[2rem] shadow-sm border border-slate-100">
            <h3 class="text-xs font-black text-slate-300 uppercase tracking-widest mb-6">Slot Configuration</h3>
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Internal Slot Name</label>
                    <input type="text" name="slot_name" value="<?= esc($ad['slot_name']) ?>" class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-green-500 outline-none font-bold uppercase tracking-wide" placeholder="E.G. HOMEPAGE_TOP_BANNER" required>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-black text-slate-700 mb-2">Display Placement</label>
                        <select name="target_page" id="target_page" class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-green-500 outline-none font-bold text-slate-600 appearance-none bg-slate-50" onchange="toggleCategorySelect()">
                            <option value="all" <?= $ad['target_page'] == 'all' ? 'selected' : '' ?>>All Pages (Global)</option>
                            <option value="home" <?= $ad['target_page'] == 'home' ? 'selected' : '' ?>>Home Page Only</option>
                            <option value="category" <?= $ad['target_page'] == 'category' ? 'selected' : '' ?>>Category Pages Only</option>
                            <option value="news_detail" <?= $ad['target_page'] == 'news_detail' ? 'selected' : '' ?>>News Detail Pages Only</option>
                        </select>
                    </div>

                    <div id="category_select_container" class="<?= $ad['target_page'] == 'category' ? '' : 'hidden' ?>">
                        <label class="block text-sm font-black text-slate-700 mb-2">Specific Category (Optional)</label>
                        <select name="target_category_id" class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-green-500 outline-none font-bold text-slate-600 appearance-none bg-slate-50">
                            <option value="0">-- All Categories --</option>
                            <?php foreach($categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>" <?= $ad['target_category_id'] == $cat['id'] ? 'selected' : '' ?>><?= $cat['title'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-4">Advertisement Type</label>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <label class="relative cursor-pointer group">
                            <input type="radio" name="ad_type" value="image" class="peer sr-only" <?= $ad['ad_type'] == 'image' ? 'checked' : '' ?> onchange="toggleAdType('image')">
                            <div class="p-4 bg-slate-50 border border-slate-100 rounded-2xl peer-checked:bg-green-50 peer-checked:border-green-200 transition group-hover:bg-slate-100">
                                <div class="font-black text-xs text-slate-600 peer-checked:text-green-700 uppercase tracking-widest">Static Image</div>
                                <div class="text-[10px] text-slate-400 font-bold mt-1">Upload JPG/PNG banners</div>
                            </div>
                        </label>
                        <label class="relative cursor-pointer group">
                            <input type="radio" name="ad_type" value="google_ads" class="peer sr-only" <?= $ad['ad_type'] == 'google_ads' ? 'checked' : '' ?> onchange="toggleAdType('google')">
                            <div class="p-4 bg-slate-50 border border-slate-100 rounded-2xl peer-checked:bg-yellow-50 peer-checked:border-yellow-200 transition group-hover:bg-slate-100">
                                <div class="font-black text-xs text-slate-600 peer-checked:text-yellow-700 uppercase tracking-widest">AdSense</div>
                                <div class="text-[10px] text-slate-400 font-bold mt-1">Google Ads Integration</div>
                            </div>
                        </label>
                        <label class="relative cursor-pointer group">
                            <input type="radio" name="ad_type" value="custom_code" class="peer sr-only" <?= $ad['ad_type'] == 'custom_code' ? 'checked' : '' ?> onchange="toggleAdType('custom')">
                            <div class="p-4 bg-slate-50 border border-slate-100 rounded-2xl peer-checked:bg-indigo-50 peer-checked:border-indigo-200 transition group-hover:bg-slate-100">
                                <div class="font-black text-xs text-slate-600 peer-checked:text-indigo-700 uppercase tracking-widest">Custom Code</div>
                                <div class="text-[10px] text-slate-400 font-bold mt-1">HTML/JS/Third Party</div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Type Specific Fields -->
                <div id="image-fields" class="<?= $ad['ad_type'] == 'image' ? '' : 'hidden' ?> space-y-6">
                    <div>
                        <label class="block text-sm font-black text-slate-700 mb-4">Banner Image</label>
                        <div class="relative group cursor-pointer h-40 rounded-3xl border-2 border-dashed border-slate-200 flex flex-col items-center justify-center bg-slate-50 hover:bg-green-50 hover:border-green-200 transition">
                            <input type="file" name="image" class="absolute inset-0 opacity-0 cursor-pointer z-10" onchange="previewImage(this)">
                            
                            <?php if ($ad['image']): ?>
                                <img id="image-preview" src="<?= base_url('uploads/ads/' . $ad['image']) ?>" class="absolute inset-0 w-full h-full object-contain rounded-[1.4rem]">
                            <?php else: ?>
                                <div id="image-placeholder" class="text-center">
                                    <i class="fas fa-image text-4xl text-slate-200 mb-3 group-hover:text-green-300 transition"></i>
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Upload Banner</p>
                                </div>
                                <img id="image-preview" class="absolute inset-0 w-full h-full object-contain rounded-[1.4rem] hidden">
                            <?php endif; ?>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-black text-slate-700 mb-2">Target URL (Link)</label>
                        <input type="url" name="link" value="<?= esc($ad['link']) ?>" class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-green-500 outline-none font-bold text-slate-600" placeholder="https://external-link.com/...">
                    </div>
                </div>

                <div id="code-fields" class="<?= $ad['ad_type'] != 'image' ? '' : 'hidden' ?>">
                    <label class="block text-sm font-black text-slate-700 mb-2">External Code / JS Snippet</label>
                    <textarea name="custom_code" rows="10" class="w-full px-5 py-4 rounded-3xl border border-slate-200 focus:border-indigo-500 outline-none font-mono text-xs bg-slate-900 text-green-400" placeholder="<script>...</script>"><?= $ad['custom_code'] ?></textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="lg:col-span-4 space-y-6">
        <div class="bg-white p-4 md:p-8 rounded-[2rem] shadow-sm border border-slate-100">
            <h3 class="text-xs font-black text-slate-300 uppercase tracking-widest mb-6">Management</h3>
            <div class="space-y-6">
                <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl border border-slate-100">
                    <div class="font-black text-xs text-slate-600 uppercase tracking-widest">Slot Status</div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" class="sr-only peer" <?= $ad['is_active'] ? 'checked' : '' ?>>
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600"></div>
                    </label>
                </div>

                <button type="submit" class="w-full bg-slate-800 text-white font-black py-4 rounded-2xl hover:bg-slate-900 shadow-xl transition uppercase tracking-widest text-sm">
                    Persist Changes
                </button>
            </div>
        </div>
    </div>
</form>

<script>
    function toggleCategorySelect() {
        const targetPage = document.getElementById('target_page').value;
        const container = document.getElementById('category_select_container');
        if (targetPage === 'category') {
            container.classList.remove('hidden');
        } else {
            container.classList.add('hidden');
        }
    }

    function toggleAdType(type) {
        const imageFields = document.getElementById('image-fields');
        const codeFields = document.getElementById('code-fields');
        
        if (type === 'image') {
            imageFields.classList.remove('hidden');
            codeFields.classList.add('hidden');
        } else {
            imageFields.classList.remove('hidden'); // Show both for easier editing or just hide image?
            // Usually, only show the one selected.
            imageFields.classList.add('hidden');
            codeFields.classList.remove('hidden');
        }
    }

    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('image-preview').src = e.target.result;
                document.getElementById('image-preview').classList.remove('hidden');
                const placeholder = document.getElementById('image-placeholder');
                if (placeholder) placeholder.classList.add('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<?= $this->endSection() ?>

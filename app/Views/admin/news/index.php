<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
    <div>
        <h2 class="text-3xl font-black text-slate-800 tracking-tight">News Articles</h2>
        <p class="text-slate-400 font-bold text-sm">Manage and publish your news content</p>
    </div>
    <div class="flex flex-wrap gap-2 w-full md:w-auto">
        <a href="<?= base_url('admin/news/bulk-upload') ?>" class="flex-1 md:flex-none bg-slate-100 text-slate-700 px-6 py-3 rounded-2xl font-black hover:bg-slate-200 transition border border-slate-200 flex items-center justify-center">
            <i class="fas fa-file-upload mr-2 text-xs"></i> BULK UPLOAD
        </a>
        <a href="<?= base_url('admin/news/create') ?>" class="flex-1 md:flex-none bg-red-600 text-white px-8 py-3 rounded-2xl font-black hover:bg-red-700 transition shadow-xl shadow-red-200 flex items-center justify-center">
            <i class="fas fa-plus mr-2 text-xs"></i> NEW ARTICLE
        </a>
    </div>
</div>

<div class="mb-6">
    <form action="<?= base_url('admin/news') ?>" method="GET" class="flex flex-col md:flex-row gap-4">
        <div class="flex-1 relative">
            <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
            <input type="text" name="search" value="<?= esc($search ?? '') ?>" placeholder="Search news..." 
                   class="w-full pl-12 pr-4 py-3 rounded-2xl border border-slate-200 focus:border-red-500 outline-none font-bold text-slate-700 shadow-sm">
        </div>
        <div class="flex gap-2">
            <button type="submit" class="flex-1 md:flex-none bg-slate-800 text-white px-8 py-3 rounded-2xl font-black hover:bg-slate-900 transition shadow-lg uppercase text-xs tracking-widest">FILTER</button>
            <?php if (!empty($search)): ?>
                <a href="<?= base_url('admin/news') ?>" class="flex-1 md:flex-none bg-slate-100 text-slate-500 px-8 py-3 rounded-2xl font-black hover:bg-slate-200 transition flex items-center justify-center text-xs tracking-widest">RESET</a>
            <?php endif; ?>
        </div>
    </form>
</div>

<form action="<?= base_url('admin/news/bulk-delete') ?>" method="POST" id="bulk-delete-form" onsubmit="return confirm('Are you sure you want to delete the selected items?')">
    <?= csrf_field() ?>
    <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden relative">
        <!-- Bulk Action Toolbar (appears when items selected) -->
        <div id="bulk-actions-toolbar" class="hidden absolute top-0 left-0 right-0 bg-red-600 text-white p-4 z-10 flex items-center justify-between animate-in slide-in-from-top duration-300">
            <div class="flex items-center gap-4 ml-4">
                <span class="text-xs font-black uppercase tracking-widest"><span id="selected-count">0</span> items selected</span>
            </div>
            <div class="flex items-center gap-2 mr-4">
                <button type="submit" class="bg-white text-red-600 px-6 py-2 rounded-xl text-xs font-black hover:bg-slate-50 transition">
                    DELETE SELECTED
                </button>
                <button type="button" onclick="cancelSelection()" class="text-white/80 hover:text-white px-4 py-2 text-xs font-bold transition">
                    CANCEL
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50/50 border-b border-slate-100">
                    <tr>
                        <th class="pl-8 py-5 w-10">
                            <input type="checkbox" id="select-all" class="h-4 w-4 rounded border-slate-300 text-red-600 focus:ring-red-500 cursor-pointer">
                        </th>
                        <th class="px-4 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Article</th>
                        <th class="px-4 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Category</th>
                        <th class="px-4 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Status</th>
                        <th class="px-4 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Published</th>
                        <th class="px-4 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    <?php foreach ($news as $item): ?>
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="pl-8 py-6">
                            <input type="checkbox" name="ids[]" value="<?= $item['id'] ?>" class="news-checkbox h-4 w-4 rounded border-slate-300 text-red-600 focus:ring-red-500 cursor-pointer">
                        </td>
                        <td class="px-4 py-6">
                            <div class="flex items-center">
                                <img src="<?= base_url('uploads/news/' . ($item['image'] ?: 'default.jpg')) ?>" class="w-14 h-14 rounded-2xl object-cover shadow-sm mr-4 border border-slate-100">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <div class="font-black text-slate-800 leading-tight"><?= $item['title_hi'] ?></div>
                                        <?php if($item['video_url']): ?>
                                            <i class="fab fa-youtube text-red-600 text-xs shadow-sm shadow-red-100 rounded-full" title="YouTube Video Available"></i>
                                        <?php endif; ?>
                                    </div>
                                    <div class="font-bold text-slate-400 text-xs leading-tight mt-1"><?= $item['title_en'] ?></div>
                                    <div class="text-[10px] font-bold text-blue-500 mt-1 uppercase tracking-tighter italic">/<?= $item['slug'] ?></div>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-6">
                            <span class="text-xs font-black text-white bg-slate-900 px-3 py-1 rounded-lg uppercase tracking-wider">
                                <?= esc($item['category_name'] ?? 'Uncategorized') ?>
                            </span>
                        </td>
                        <td class="px-4 py-6">
                            <a href="<?= base_url('admin/news/toggle-status/' . $item['id']) ?>" title="Click to toggle status">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest <?= $item['status'] == 'published' ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' ?>">
                                    <span class="h-1.5 w-1.5 rounded-full mr-2 <?= $item['status'] == 'published' ? 'bg-green-500' : 'bg-amber-500' ?>"></span>
                                    <?= $item['status'] ?>
                                </span>
                            </a>
                        </td>
                        <td class="px-4 py-6 text-xs font-bold text-slate-400">
                            <?= date('M d, Y', strtotime($item['publish_at'])) ?>
                        </td>
                        <td class="px-4 py-6">
                            <div class="flex items-center justify-center space-x-3">
                                <a href="<?= base_url('admin/news/edit/' . $item['id']) ?>" class="h-9 w-9 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center hover:bg-blue-600 hover:text-white transition">
                                    <i class="fas fa-edit text-xs"></i>
                                </a>
                                <a href="<?= base_url('admin/news/delete/' . $item['id']) ?>" onclick="return confirm('Are you sure you want to delete this article? This action cannot be undone.')" class="h-9 w-9 bg-red-50 text-red-600 rounded-xl flex items-center justify-center hover:bg-red-600 hover:text-white transition">
                                    <i class="fas fa-trash-alt text-xs"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <?php if ($pager): ?>
        <div class="px-8 py-6 bg-slate-50/30 border-t border-slate-50 mt-4">
            <div class="flex justify-center">
                <?= $pager->links('default', 'admin_full') ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</form>

<script>
    const selectAll = document.getElementById('select-all');
    const newsCheckboxes = document.querySelectorAll('.news-checkbox');
    const bulkToolbar = document.getElementById('bulk-actions-toolbar');
    const selectedCount = document.getElementById('selected-count');

    function updateToolbar() {
        const checkedCount = document.querySelectorAll('.news-checkbox:checked').length;
        if (checkedCount > 0) {
            bulkToolbar.classList.remove('hidden');
            selectedCount.textContent = checkedCount;
        } else {
            bulkToolbar.classList.add('hidden');
            selectAll.checked = false;
        }
    }

    if (selectAll) {
        selectAll.addEventListener('change', function() {
            newsCheckboxes.forEach(cb => {
                cb.checked = this.checked;
            });
            updateToolbar();
        });
    }

    newsCheckboxes.forEach(cb => {
        cb.addEventListener('change', updateToolbar);
    });

    function cancelSelection() {
        selectAll.checked = false;
        newsCheckboxes.forEach(cb => cb.checked = false);
        updateToolbar();
    }
</script>

<?= $this->endSection() ?>

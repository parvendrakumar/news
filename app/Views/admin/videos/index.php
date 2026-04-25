<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
    <div>
        <h2 class="text-3xl font-black text-slate-800 tracking-tight">Video News Library</h2>
        <p class="text-slate-400 font-bold text-sm">Manage standalone video bulletins</p>
    </div>
    <div class="flex flex-wrap gap-2 w-full md:w-auto">
        <a href="<?= base_url('admin/videos/bulk-upload') ?>" class="flex-1 md:flex-none bg-slate-100 text-slate-700 px-6 py-3 rounded-2xl font-black hover:bg-slate-200 transition border border-slate-200 flex items-center justify-center">
            <i class="fas fa-file-upload mr-2 text-xs"></i> BULK UPLOAD
        </a>
        <a href="<?= base_url('admin/videos/create') ?>" class="flex-1 md:flex-none bg-blue-600 text-white px-8 py-3 rounded-2xl font-black hover:bg-blue-700 transition shadow-xl shadow-blue-100 flex items-center justify-center">
            <i class="fas fa-play mr-2 text-xs"></i> PUBLISH VIDEO
        </a>
    </div>
</div>

<form action="<?= base_url('admin/videos/bulk-delete') ?>" method="POST" id="bulk-delete-videos-form" onsubmit="return confirm('Are you sure you want to delete the selected videos?')">
    <?= csrf_field() ?>
    <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden relative">
        <!-- Bulk Action Toolbar -->
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
                        <th class="px-4 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Video Bulletin</th>
                        <th class="px-4 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Status</th>
                        <th class="px-4 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    <?php foreach ($videos as $item): ?>
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="pl-8 py-6">
                            <input type="checkbox" name="ids[]" value="<?= $item['id'] ?>" class="video-checkbox h-4 w-4 rounded border-slate-300 text-red-600 focus:ring-red-500 cursor-pointer">
                        </td>
                        <td class="px-4 py-6">
                            <div class="flex items-center">
                                <div class="relative group">
                                    <img src="<?= base_url('uploads/videos/' . ($item['thumbnail'] ?: 'default.jpg')) ?>" class="w-24 h-14 rounded-xl object-cover shadow-sm mr-4 border border-slate-100">
                                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                                        <div class="bg-blue-600/80 h-8 w-8 rounded-full flex items-center justify-center text-white text-[10px]">
                                            <i class="fas fa-play"></i>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="font-black text-slate-800 leading-tight"><?= $item['title_hi'] ?></div>
                                    <div class="text-[10px] font-bold text-slate-400 mt-1 uppercase tracking-tighter italic">By <span class="text-blue-600"><?= $item['author_name'] ?: 'Editor' ?></span></div>
                                    <div class="text-[10px] font-bold text-slate-400 mt-1 uppercase tracking-tighter">URL: <span class="text-blue-500 italic"><?= $item['video_url'] ?></span></div>
                                    <div class="text-[10px] font-bold text-slate-300 mt-1 uppercase tracking-widest"><i class="far fa-eye mr-1"></i> <?= number_format($item['views']) ?> Views</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-6 text-center">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest <?= $item['status'] == 'published' ? 'bg-green-100 text-green-700' : 'bg-slate-100 text-slate-500' ?>">
                                <?= $item['status'] ?>
                            </span>
                        </td>
                        <td class="px-4 py-6">
                            <div class="flex items-center justify-center space-x-3">
                                <a href="<?= base_url('admin/videos/edit/' . $item['id']) ?>" class="h-9 w-9 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center hover:bg-blue-600 hover:text-white transition">
                                    <i class="fas fa-edit text-xs"></i>
                                </a>
                                <a href="<?= base_url('admin/videos/delete/' . $item['id']) ?>" onclick="return confirm('Delete this video bulletin?')" class="h-9 w-9 bg-red-50 text-red-600 rounded-xl flex items-center justify-center hover:bg-red-600 hover:text-white transition">
                                    <i class="fas fa-trash-alt text-xs"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if (empty($videos)): ?>
                    <tr>
                        <td colspan="4" class="px-8 py-20 text-center text-slate-300 font-bold italic">No video bulletins found. Start publishing multimedia content!</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</form>

<script>
    const selectAll = document.getElementById('select-all');
    const videoCheckboxes = document.querySelectorAll('.video-checkbox');
    const bulkToolbar = document.getElementById('bulk-actions-toolbar');
    const selectedCount = document.getElementById('selected-count');

    function updateToolbar() {
        const checkedCount = document.querySelectorAll('.video-checkbox:checked').length;
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
            videoCheckboxes.forEach(cb => {
                cb.checked = this.checked;
            });
            updateToolbar();
        });
    }

    videoCheckboxes.forEach(cb => {
        cb.addEventListener('change', updateToolbar);
    });

    function cancelSelection() {
        selectAll.checked = false;
        videoCheckboxes.forEach(cb => cb.checked = false);
        updateToolbar();
    }
</script>

<?= $this->endSection() ?>

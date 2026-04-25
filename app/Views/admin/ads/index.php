<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
    <div>
        <h2 class="text-3xl font-black text-slate-800 tracking-tight">Ad Manager</h2>
        <p class="text-slate-400 font-bold text-sm">Orchestrate monetization slots across the portal</p>
    </div>
    <div class="flex flex-wrap gap-2 w-full md:w-auto">
        <a href="<?= base_url('admin/ads/bulk-upload') ?>" class="flex-1 md:flex-none bg-slate-100 text-slate-700 px-6 py-3 rounded-2xl font-black hover:bg-slate-200 transition border border-slate-200 flex items-center justify-center">
            <i class="fas fa-file-upload mr-2 text-xs"></i> BULK UPLOAD
        </a>
        <a href="<?= base_url('admin/ads/create') ?>" class="flex-1 md:flex-none bg-green-600 text-white px-8 py-3 rounded-2xl font-black hover:bg-green-700 transition shadow-xl shadow-green-100 flex items-center justify-center">
            <i class="fas fa-plus mr-2 text-xs"></i> NEW AD SLOT
        </a>
    </div>
</div>

<div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-slate-50/50 border-b border-slate-100">
                <tr>
                    <th class="px-4 md:px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Slot Name</th>
                    <th class="px-4 md:px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Type</th>
                    <th class="px-4 md:px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Placement</th>
                    <th class="px-4 md:px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Status</th>
                    <th class="px-4 md:px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                <?php foreach ($ads as $item): ?>
                <tr class="hover:bg-slate-50/50 transition">
                    <td class="px-4 md:px-8 py-6">
                        <div class="font-black text-slate-800 leading-tight uppercase tracking-wide"><?= $item['slot_name'] ?></div>
                        <div class="text-[10px] font-bold text-slate-400 mt-1 uppercase tracking-widest">Updated: <?= date('d M, Y', strtotime($item['updated_at'] ?? 'now')) ?></div>
                    </td>
                    <td class="px-4 md:px-8 py-6">
                        <span class="px-3 py-1 bg-slate-100 text-slate-600 rounded-lg text-[10px] font-black uppercase tracking-widest border border-slate-200">
                            <?= str_replace('_', ' ', $item['ad_type']) ?>
                        </span>
                    </td>
                    <td class="px-4 md:px-8 py-6 text-center">
                        <span class="text-[10px] font-black uppercase tracking-widest text-indigo-500 bg-indigo-50 px-3 py-1 rounded-lg border border-indigo-100">
                            <?= $item['target_page'] ?: 'All Pages' ?>
                        </span>
                        <?php if(!empty($item['category_title'])): ?>
                            <div class="text-[9px] font-black text-slate-400 mt-2 uppercase tracking-tighter">
                                Category: <span class="text-blue-600"><?= $item['category_title'] ?></span>
                            </div>
                        <?php endif; ?>
                    </td>
                    <td class="px-4 md:px-8 py-6">
                        <?php if ($item['is_active']): ?>
                            <span class="inline-flex items-center text-green-600 text-[10px] font-black uppercase tracking-widest">
                                <span class="h-2 w-2 rounded-full bg-green-500 mr-2 animate-pulse"></span> Active
                            </span>
                        <?php else: ?>
                            <span class="inline-flex items-center text-slate-400 text-[10px] font-black uppercase tracking-widest">
                                <span class="h-2 w-2 rounded-full bg-slate-300 mr-2"></span> Paused
                            </span>
                        <?php endif; ?>
                    </td>
                    <td class="px-4 md:px-8 py-6">
                        <div class="flex items-center justify-center space-x-3">
                            <a href="<?= base_url('admin/ads/edit/' . $item['id']) ?>" class="h-9 w-9 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center hover:bg-blue-600 hover:text-white transition">
                                <i class="fas fa-edit text-xs"></i>
                            </a>
                            <a href="<?= base_url('admin/ads/delete/' . $item['id']) ?>" onclick="return confirm('Remove this ad slot?')" class="h-9 w-9 bg-red-50 text-red-600 rounded-xl flex items-center justify-center hover:bg-red-600 hover:text-white transition">
                                <i class="fas fa-trash-alt text-xs"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($ads)): ?>
                <tr>
                    <td colspan="4" class="px-8 py-20 text-center text-slate-300 font-bold italic">No ad slots defined yet. Start monetizing your traffic!</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>

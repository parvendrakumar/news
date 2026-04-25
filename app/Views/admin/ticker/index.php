<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
    <div>
        <h2 class="text-3xl font-black text-slate-800 tracking-tight">Breaking Ticker</h2>
        <p class="text-slate-400 font-bold text-sm">Manage scrolling flash news alerts</p>
    </div>
    <div class="flex flex-wrap gap-2 w-full md:w-auto">
        <a href="<?= base_url('admin/ticker/bulk-upload') ?>" class="flex-1 md:flex-none bg-slate-100 text-slate-700 px-6 py-3 rounded-2xl font-black hover:bg-slate-200 transition border border-slate-200 flex items-center justify-center">
            <i class="fas fa-file-upload mr-2 text-xs"></i> BULK UPLOAD
        </a>
        <a href="<?= base_url('admin/ticker/create') ?>" class="flex-1 md:flex-none bg-red-600 text-white px-8 py-3 rounded-2xl font-black hover:bg-red-700 transition shadow-xl shadow-red-100 flex items-center justify-center">
            <i class="fas fa-bolt mr-2 text-xs"></i> NEW ALERTS
        </a>
    </div>
</div>

<div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-slate-50/50 border-b border-slate-100">
                <tr>
                    <th class="px-4 md:px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Flash Content</th>
                    <th class="px-4 md:px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Link</th>
                    <th class="px-4 md:px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                <?php foreach ($tickers as $item): ?>
                <tr class="hover:bg-slate-50/50 transition">
                    <td class="px-4 md:px-8 py-6">
                        <div class="flex items-center">
                            <div class="h-10 w-10 rounded-xl <?= $item['is_active'] ? 'bg-red-50 text-red-600' : 'bg-slate-50 text-slate-300' ?> flex items-center justify-center mr-4">
                                <i class="fas fa-bullhorn text-sm"></i>
                            </div>
                            <div>
                                <div class="font-black text-slate-800 leading-tight"><?= $item['content_hi'] ?></div>
                                <div class="text-[10px] font-bold text-slate-400 mt-1 uppercase tracking-widest"><?= $item['content_en'] ?></div>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6 text-xs font-bold text-blue-500 italic">
                        <?= $item['link'] ?: 'None' ?>
                    </td>
                    <td class="px-4 md:px-8 py-6">
                        <div class="flex items-center justify-center space-x-3">
                            <a href="<?= base_url('admin/ticker/edit/' . $item['id']) ?>" class="h-9 w-9 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center hover:bg-blue-600 hover:text-white transition">
                                <i class="fas fa-edit text-xs"></i>
                            </a>
                            <a href="<?= base_url('admin/ticker/delete/' . $item['id']) ?>" onclick="return confirm('Remove this alert?')" class="h-9 w-9 bg-red-50 text-red-600 rounded-xl flex items-center justify-center hover:bg-red-600 hover:text-white transition">
                                <i class="fas fa-trash-alt text-xs"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($tickers)): ?>
                <tr>
                    <td colspan="3" class="px-8 py-20 text-center text-slate-300 font-bold italic">No flash alerts found. Start pushing breaking news!</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="flex justify-between items-center mb-8">
    <div>
        <h2 class="text-3xl font-black text-slate-800 tracking-tight">Database Backups</h2>
        <p class="text-slate-400 font-bold text-sm">Secure your news ecosystem with one-click data redundancy</p>
    </div>
    <a href="<?= base_url('admin/backups/run') ?>" class="bg-green-600 text-white px-8 py-3 rounded-2xl font-black hover:bg-green-700 transition shadow-xl shadow-green-100 flex items-center">
        <i class="fas fa-file-export mr-2 text-xs"></i> GENERATE NEW BACKUP
    </a>
</div>

<div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-slate-50/50 border-b border-slate-100">
                <tr>
                    <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Backup Archive</th>
                    <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Size</th>
                    <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Generated On</th>
                    <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                <?php foreach ($backups as $file): ?>
                <tr class="hover:bg-slate-50/50 transition">
                    <td class="px-8 py-6">
                        <div class="flex items-center">
                            <div class="h-10 w-10 rounded-xl bg-green-50 text-green-600 flex items-center justify-center mr-4">
                                <i class="fas fa-database text-sm"></i>
                            </div>
                            <div class="font-black text-slate-800 tracking-tight text-xs"><?= $file['name'] ?></div>
                        </div>
                    </td>
                    <td class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                        <?= $file['size'] ?>
                    </td>
                    <td class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                        <?= $file['date'] ?>
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex items-center justify-center space-x-3">
                            <a href="<?= base_url('admin/backups/download/' . $file['name']) ?>" class="h-9 w-9 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center hover:bg-blue-600 hover:text-white transition">
                                <i class="fas fa-download text-xs"></i>
                            </a>
                            <a href="<?= base_url('admin/backups/delete/' . $file['name']) ?>" onclick="return confirm('Permanently delete this backup archive?')" class="h-9 w-9 bg-red-50 text-red-600 rounded-xl flex items-center justify-center hover:bg-red-600 hover:text-white transition">
                                <i class="fas fa-trash-alt text-xs"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($backups)): ?>
                <tr>
                    <td colspan="4" class="px-8 py-20 text-center text-slate-300 font-bold italic">No backup archives found. Generate your first backup now!</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="mt-8 p-6 bg-blue-50/50 rounded-[2rem] border border-blue-100/50 flex items-start">
    <div class="h-10 w-10 bg-blue-600 text-white rounded-xl flex items-center justify-center shrink-0 mr-4 shadow-lg shadow-blue-100">
        <i class="fas fa-shield-alt text-sm"></i>
    </div>
    <div>
        <h4 class="text-xs font-black text-blue-700 uppercase tracking-widest mb-1">Disaster Recovery Protocol</h4>
        <p class="text-[10px] font-bold text-blue-500 leading-relaxed uppercase tracking-tighter">
            We recommend generating a full database backup before performing any bulk news updates, category restructuring, or system upgrades. Each backup file contains a full snapshot of your articles, visual stories, ad slots, and settings.
        </p>
    </div>
</div>

<?= $this->endSection() ?>

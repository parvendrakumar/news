<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="dashboard-modern-wrapper">
    <!-- Header Strategy -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Notification <span class="text-red-600">Center</span></h1>
            <p class="text-slate-500 font-medium">Manage and broadcast system alerts to your users.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="<?= base_url('admin/notifications/create') ?>" class="px-6 py-3 bg-slate-900 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-red-600 transition-all flex items-center gap-2 shadow-lg shadow-slate-200">
                <i class="fas fa-paper-plane"></i> Send New Alert
            </a>
        </div>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="mb-8 p-4 bg-green-50 border border-green-100 text-green-700 rounded-2xl font-bold flex items-center gap-3 animate-in fade-in slide-in-from-top-4">
            <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
        <div class="p-8 border-b border-slate-50 flex items-center justify-between bg-slate-50/50">
            <h3 class="font-black text-slate-800 uppercase tracking-widest text-xs">Recent Notifications</h3>
            <span class="px-4 py-1.5 bg-white border border-slate-100 rounded-xl text-[10px] font-black text-slate-400 uppercase tracking-widest">
                Total: <?= count($notifications) ?>
            </span>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th class="px-8 py-5 text-left text-[10px] font-black text-slate-400 uppercase tracking-widest">Recipient</th>
                        <th class="px-8 py-5 text-left text-[10px] font-black text-slate-400 uppercase tracking-widest">Message Details</th>
                        <th class="px-8 py-5 text-center text-[10px] font-black text-slate-400 uppercase tracking-widest">Status</th>
                        <th class="px-8 py-5 text-right text-[10px] font-black text-slate-400 uppercase tracking-widest">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    <?php if (empty($notifications)): ?>
                        <tr>
                            <td colspan="4" class="px-8 py-20 text-center">
                                <div class="w-16 h-16 bg-slate-50 text-slate-300 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
                                    <i class="fas fa-bell-slash"></i>
                                </div>
                                <p class="text-slate-400 font-bold uppercase text-[10px] tracking-widest">No notifications sent yet</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                    
                    <?php foreach ($notifications as $n): ?>
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 bg-slate-100 rounded-xl flex items-center justify-center text-slate-400 font-black text-xs">
                                        <?= substr($n['user_name'] ?? 'U', 0, 1) ?>
                                    </div>
                                    <div>
                                        <div class="font-black text-slate-800 text-sm"><?= esc($n['user_name'] ?: 'Unknown') ?></div>
                                        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">User ID: #<?= $n['user_id'] ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex flex-col gap-1 max-w-md">
                                    <div class="font-black text-slate-800 text-sm flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-<?= $n['type'] == 'success' ? 'green' : ($n['type'] == 'warning' ? 'amber' : ($n['type'] == 'error' ? 'red' : 'blue')) ?>-500 shadow-lg shadow-<?= $n['type'] == 'success' ? 'green' : ($n['type'] == 'warning' ? 'amber' : ($n['type'] == 'error' ? 'red' : 'blue')) ?>-200"></span>
                                        <?= esc($n['title']) ?>
                                    </div>
                                    <div class="text-slate-500 text-xs line-clamp-1"><?= esc($n['message']) ?></div>
                                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">
                                        <i class="far fa-clock mr-1"></i> <?= date('d M Y, H:i', strtotime($n['created_at'])) ?>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-center">
                                <?php if ($n['is_read']): ?>
                                    <span class="px-3 py-1 bg-slate-100 text-slate-400 rounded-lg text-[9px] font-black uppercase tracking-wider">Read</span>
                                <?php else: ?>
                                    <span class="px-3 py-1 bg-red-50 text-red-600 rounded-lg text-[9px] font-black uppercase tracking-wider animate-pulse">Unread</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <a href="<?= base_url('admin/notifications/delete/' . $n['id']) ?>" 
                                       class="h-9 w-9 bg-red-50 text-red-600 rounded-xl flex items-center justify-center hover:bg-red-600 hover:text-white transition-all shadow-sm shadow-red-100"
                                       onclick="return confirm('Delete this notification permanently?')">
                                        <i class="fas fa-trash-alt text-xs"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

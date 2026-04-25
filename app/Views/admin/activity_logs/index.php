<?= $this->extend('admin/layout') ?>

<?= $this->section('style') ?>
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<style>
    body { font-family: 'Outfit', sans-serif; }
    .premium-card {
        background: white;
        border-radius: 2.5rem;
        border: 1px solid #f1f5f9;
        box-shadow: 0 10px 30px -10px rgba(0,0,0,0.03);
        overflow: hidden;
    }
    .action-badge {
        font-size: 9px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        padding: 4px 12px;
        border-radius: 12px;
    }
    .badge-create { background: #f0fdf4; color: #16a34a; border: 1px solid #dcfce7; }
    .badge-update { background: #eff6ff; color: #3b82f6; border: 1px solid #dbeafe; }
    .badge-delete { background: #fef2f2; color: #ef4444; border: 1px solid #fee2e2; }
    .badge-login { background: #faf5ff; color: #9333ea; border: 1px solid #f3e8ff; }
    .badge-default { background: #f8fafc; color: #64748b; border: 1px solid #f1f5f9; }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="max-w-[1200px] mx-auto">
    <!-- Header -->
    <div class="mb-12 flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div class="space-y-2">
            <div class="flex items-center space-x-2 text-[10px] font-black text-slate-400 uppercase tracking-[0.3em]">
                <i class="fas fa-shield-alt text-red-500"></i>
                <span>Audit Infrastructure</span>
            </div>
            <h2 class="text-4xl font-black text-slate-900 tracking-tight leading-none">
                Activity <span class="bg-gradient-to-r from-slate-900 to-slate-500 bg-clip-text text-transparent italic underline decoration-red-500 decoration-4 underline-offset-8">Intelligence</span>
            </h2>
            <p class="text-slate-400 font-medium">A forensic audit trail of all administrative orchestrations within the portal.</p>
        </div>
        
        <div class="flex items-center space-x-6">
             <div class="relative group">
                <input type="text" id="logSearch" placeholder="Search events..." class="pl-10 pr-4 py-3 bg-white border border-slate-100 rounded-2xl text-xs font-bold text-slate-600 focus:outline-none focus:ring-4 focus:ring-red-500/5 focus:border-red-500 transition-all w-64 shadow-sm">
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-red-500 transition-colors"></i>
            </div>

            <!-- On/Off Toggle -->
            <a href="<?= base_url('admin/activity-logs/toggle') ?>" class="flex items-center space-x-3 p-1.5 pr-4 rounded-2xl bg-white border border-slate-100 shadow-sm hover:bg-slate-50 transition-all">
                <div class="w-10 h-10 rounded-xl <?= $logStatus == '1' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' ?> flex items-center justify-center">
                    <i class="fas <?= $logStatus == '1' ? 'fa-toggle-on' : 'fa-toggle-off' ?> text-lg"></i>
                </div>
                <div class="flex flex-col">
                    <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Logging</span>
                    <span class="text-[10px] font-black <?= $logStatus == '1' ? 'text-green-600' : 'text-red-600' ?> uppercase"><?= $logStatus == '1' ? 'Active' : 'Disabled' ?></span>
                </div>
            </a>
        </div>
    </div>

    <!-- Timeline Style Audit Trail -->
    <div class="premium-card">
        <div class="p-8 border-b border-slate-50 bg-slate-50/20 flex items-center justify-between">
            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Chronological Events</span>
            <div class="flex space-x-1">
                <span class="w-1.5 h-1.5 rounded-full bg-slate-200"></span>
                <span class="w-1.5 h-1.5 rounded-full bg-slate-200"></span>
                <span class="w-1.5 h-1.5 rounded-full bg-slate-200"></span>
            </div>
        </div>
        
        <div class="divide-y divide-slate-50">
            <?php foreach ($logs as $log): 
                $action = strtolower($log['action']);
                $badgeClass = 'badge-default';
                $icon = 'fa-info-circle';
                
                if (strpos($action, 'create') !== false || strpos($action, 'add') !== false) {
                    $badgeClass = 'badge-create';
                    $icon = 'fa-plus-circle';
                } elseif (strpos($action, 'update') !== false || strpos($action, 'edit') !== false) {
                    $badgeClass = 'badge-update';
                    $icon = 'fa-pen-fancy';
                } elseif (strpos($action, 'delete') !== false || strpos($action, 'remove') !== false) {
                    $badgeClass = 'badge-delete';
                    $icon = 'fa-trash-alt';
                } elseif (strpos($action, 'login') !== false) {
                    $badgeClass = 'badge-login';
                    $icon = 'fa-key';
                }
            ?>
            <div class="p-8 hover:bg-slate-50/50 transition-all duration-300 flex flex-col md:flex-row md:items-center justify-between gap-6 log-row">
                <div class="flex items-start space-x-6">
                    <!-- User Avatar -->
                    <div class="relative flex-shrink-0">
                        <div class="h-12 w-12 rounded-2xl bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-400 font-black text-sm">
                            <?= substr($log['fullName'] ?? 'S', 0, 1) ?>
                        </div>
                        <div class="absolute -bottom-1 -right-1 w-6 h-6 rounded-lg bg-white shadow-sm flex items-center justify-center text-[10px] text-slate-400 border border-slate-100">
                             <i class="fas <?= $icon ?>"></i>
                        </div>
                    </div>

                    <!-- Details -->
                    <div class="space-y-1">
                        <div class="flex items-center space-x-3">
                            <span class="font-black text-slate-900 tracking-tight text-sm"><?= $log['fullName'] ?: 'System Engine' ?></span>
                            <span class="action-badge <?= $badgeClass ?>"><?= str_replace('_', ' ', $log['action']) ?></span>
                        </div>
                        <p class="text-xs font-semibold text-slate-500 leading-relaxed log-details"><?= $log['details'] ?></p>
                        <div class="flex items-center space-x-4 pt-1">
                            <span class="text-[9px] font-black text-slate-400 uppercase flex items-center">
                                <i class="fas fa-map-marker-alt mr-1.5 text-slate-300"></i>
                                <?= $log['ip_address'] ?>
                            </span>
                             <span class="text-[9px] font-black text-slate-400 uppercase flex items-center">
                                <i class="fas fa-desktop mr-1.5 text-slate-300"></i>
                                Admin Portal
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Timestamp -->
                <div class="text-right flex-shrink-0">
                    <div class="text-xs font-black text-slate-900 tracking-tighter italic">
                        <?= date('h:i A', strtotime($log['created_at'])) ?>
                    </div>
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">
                        <?= date('d M Y', strtotime($log['created_at'])) ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

            <?php if (empty($logs)): ?>
            <div class="py-32 flex flex-col items-center justify-center text-center opacity-40">
                <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center text-slate-300 mb-6 text-2xl">
                    <i class="fas fa-ghost"></i>
                </div>
                <p class="font-black text-xs uppercase tracking-[0.3em]">Neural silence detected</p>
                <p class="text-[10px] font-medium mt-2">No administrative disturbances found in the audit trail.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    document.getElementById('logSearch').addEventListener('input', function(e) {
        const term = e.target.value.toLowerCase();
        document.querySelectorAll('.log-row').forEach(row => {
            const text = row.querySelector('.log-details').textContent.toLowerCase();
            const name = row.querySelector('span.font-black').textContent.toLowerCase();
            if (text.includes(term) || name.includes(term)) {
                row.style.display = 'flex';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>

<?= $this->endSection() ?>

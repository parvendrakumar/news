<?= $this->extend('user/layout') ?>

<?= $this->section('content') ?>

<div class="mb-10 animate-in fade-in slide-in-from-bottom-4 duration-700">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm shadow-slate-100">
        <div class="space-y-2">
            <h1 class="text-4xl font-black text-slate-800 tracking-tighter">My <span class="text-red-600">Notifications</span></h1>
            <p class="text-slate-400 font-bold text-sm uppercase tracking-widest flex items-center gap-2">
                Stay updated with the latest alerts and news
            </p>
        </div>
    </div>
</div>

<?php if (empty($notifications)): ?>
    <div class="bg-white p-12 rounded-[2.5rem] border border-slate-100 shadow-sm text-center">
        <div class="w-24 h-24 bg-red-50 text-red-200 rounded-full flex items-center justify-center text-4xl mx-auto mb-6">
            <i class="fas fa-bell-slash"></i>
        </div>
        <h3 class="text-2xl font-black text-slate-800 mb-2">No New Alerts</h3>
        <p class="text-slate-400 font-bold text-sm uppercase tracking-widest leading-relaxed max-w-md mx-auto">
            Your inbox is clean! We'll notify you when there's an update on your followed categories or comments.
        </p>
    </div>
<?php else: ?>
    <div class="space-y-4">
        <?php foreach ($notifications as $n): ?>
            <?php 
                $icon = 'info-circle';
                $color = 'blue';
                if ($n['type'] == 'success') { $icon = 'check-circle'; $color = 'green'; }
                elseif ($n['type'] == 'warning') { $icon = 'exclamation-triangle'; $color = 'amber'; }
                elseif ($n['type'] == 'error') { $icon = 'times-circle'; $color = 'red'; }
            ?>
            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex gap-6 items-start hover:shadow-md transition">
                <div class="w-12 h-12 bg-<?= $color ?>-50 text-<?= $color ?>-600 rounded-2xl flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-<?= $icon ?> text-xl"></i>
                </div>
                <div class="flex-1 space-y-1">
                    <div class="flex items-center justify-between">
                        <h4 class="font-black text-slate-800"><?= esc($n['title']) ?></h4>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest"><?= date('H:i, d M', strtotime($n['created_at'])) ?></span>
                    </div>
                    <p class="text-slate-500 font-medium text-sm leading-relaxed"><?= esc($n['message']) ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?= $this->endSection() ?>

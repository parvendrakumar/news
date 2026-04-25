<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="mb-8">
    <h2 class="text-3xl font-black text-slate-800 tracking-tight">Global Module Manager</h2>
    <p class="text-slate-400 font-bold text-sm">Master switchboard to orchestrate portal-wide strategic features</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    <?php foreach ($modules as $m): 
        $icon = 'cube';
        $color = 'slate';
        if($m['module_key'] == 'visual_stories') { $icon = 'layer-group'; $color = 'pink'; }
        if($m['module_key'] == 'video_news') { $icon = 'video'; $color = 'red'; }
        if($m['module_key'] == 'ad_manager') { $icon = 'ad'; $color = 'emerald'; }
        if($m['module_key'] == 'breaking_ticker') { $icon = 'bolt'; $color = 'amber'; }
        if($m['module_key'] == 'polls') { $icon = 'poll'; $color = 'orange'; }
        if($m['module_key'] == 'subscribers') { $icon = 'users'; $color = 'purple'; }
        if($m['module_key'] == 'smtp') { $icon = 'server'; $color = 'blue'; }
        if($m['module_key'] == 'sms') { $icon = 'sms'; $color = 'yellow'; }
        if($m['module_key'] == 'whatsapp') { $icon = 'whatsapp'; $color = 'green'; }
        if($m['module_key'] == 'telegram') { $icon = 'telegram'; $color = 'sky'; }
        if($m['module_key'] == 'live_tv') { $icon = 'satellite-dish'; $color = 'red'; }
    ?>
    <div class="bg-white p-6 md:p-8 rounded-[2.5rem] shadow-sm border border-slate-100 flex flex-col justify-between hover:shadow-2xl hover:shadow-slate-100 transition duration-500 group">
        <div>
            <div class="flex items-center justify-between mb-8">
                <div class="h-14 w-14 bg-<?= $color ?>-50 text-<?= $color ?>-600 rounded-[1.25rem] flex items-center justify-center text-2xl group-hover:rotate-12 transition duration-500">
                    <i class="fab fa-<?= $icon == 'sms' || $icon == 'cube' || $icon == 'layer-group' || $icon == 'video' || $icon == 'ad' || $icon == 'bolt' || $icon == 'poll' || $icon == 'users' || $icon == 'server' ? '' : $icon ?> <?= $icon == 'sms' || $icon == 'cube' || $icon == 'layer-group' || $icon == 'video' || $icon == 'ad' || $icon == 'bolt' || $icon == 'poll' || $icon == 'users' || $icon == 'server' ? 'fas fa-'.$icon : '' ?>"></i>
                </div>
                <div>
                    <a href="<?= base_url('admin/modules/toggle/' . $m['id']) ?>" class="relative inline-flex items-center cursor-pointer">
                        <div class="w-14 h-7 <?= $m['is_enabled'] ? 'bg-green-500' : 'bg-slate-200' ?> rounded-full transition duration-300"></div>
                        <div class="absolute left-1 top-1 bg-white w-5 h-5 rounded-full shadow-md transition duration-300 <?= $m['is_enabled'] ? 'translate-x-7' : '' ?>"></div>
                    </a>
                </div>
            </div>
            <h3 class="text-lg font-black text-slate-800 tracking-tight leading-tight mb-2 uppercase"><?= $m['module_name'] ?></h3>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic">
                Ref: <?= $m['module_key'] ?>
            </p>
        </div>
        
        <div class="mt-8 pt-6 border-t border-slate-50 flex items-center justify-between">
            <div class="flex items-center">
                <div class="h-2 w-2 <?= $m['is_enabled'] ? 'bg-green-500 shadow-[0_0_8px_rgba(34,197,94,0.6)]' : 'bg-slate-300' ?> rounded-full mr-3"></div>
                <span class="text-[10px] font-black <?= $m['is_enabled'] ? 'text-green-600' : 'text-slate-400' ?> uppercase tracking-widest">
                    <?= $m['is_enabled'] ? 'Live & Operational' : 'Offline / Disabled' ?>
                </span>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<div class="mt-12 p-6 md:p-10 bg-gradient-to-br from-slate-900 via-slate-800 to-black rounded-[2.5rem] md:rounded-[3rem] text-white relative overflow-hidden shadow-3xl shadow-slate-200">
    <div class="absolute right-0 top-0 opacity-10 pointer-events-none">
        <i class="fas fa-shield-alt text-[20rem] -mr-20 -mt-20"></i>
    </div>
    <div class="relative z-10">
        <h3 class="text-2xl font-black mb-4 flex items-center">
            <i class="fas fa-microchip mr-4 text-green-400"></i> Core Orchestration Logic
        </h3>
        <p class="text-sm text-slate-400 font-bold leading-relaxed max-w-2xl mb-8 uppercase tracking-widest text-justify">
            The Module Manager acts as the portal's master nervous system. Disabling a module here instantly seated its specific persistence nodes and frontend rendering logic across the entire platform. Use this for high-level site maintenance or feature staggered deployment.
        </p>
        <div class="flex flex-col sm:flex-row sm:items-center gap-4 sm:space-x-6">
            <div class="flex items-center text-[10px] font-black text-green-400 uppercase tracking-widest">
                <i class="fas fa-check-circle mr-2"></i> Atomic Status Toggling
            </div>
            <div class="flex items-center text-[10px] font-black text-blue-400 uppercase tracking-widest">
                <i class="fas fa-info-circle mr-2"></i> Auto-Audit Logged
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="mb-8">
    <h2 class="text-3xl font-black text-slate-800 tracking-tight">News Templates</h2>
    <p class="text-slate-400 font-bold text-sm">Orchestrate the narrative identity of your multi-channel broadcasts</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <?php foreach ($templates as $t): 
        $icon = 'paper-plane';
        $color = 'blue';
        if($t['module'] == 'sms') { $icon = 'sms'; $color = 'yellow'; }
        if($t['module'] == 'whatsapp') { $icon = 'whatsapp'; $color = 'green'; }
        if($t['module'] == 'telegram') { $icon = 'telegram'; $color = 'sky'; }
    ?>
    <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 flex flex-col justify-between hover:shadow-xl hover:shadow-slate-100 transition duration-500 group">
        <div>
            <div class="flex items-center justify-between mb-6">
                <div class="h-12 w-12 bg-<?= $color ?>-50 text-<?= $color ?>-600 rounded-2xl flex items-center justify-center text-xl group-hover:scale-110 transition duration-500">
                    <i class="fab fa-<?= $icon == 'sms' || $icon == 'paper-plane' ? '' : $icon ?> <?= $icon == 'sms' || $icon == 'paper-plane' ? 'fas fa-'.$icon : '' ?>"></i>
                </div>
                <span class="px-3 py-1 bg-slate-50 text-slate-400 rounded-lg text-[9px] font-black uppercase tracking-widest border border-slate-100 italic">
                    <?= $t['module'] ?>
                </span>
            </div>
            <h3 class="text-sm font-black text-slate-800 uppercase tracking-widest mb-2"><?= $t['template_name'] ?></h3>
            <p class="text-[10px] font-bold text-slate-400 line-clamp-3 leading-relaxed mb-6">
                <?= esc($t['content']) ?>
            </p>
        </div>
        
        <div class="pt-4 border-t border-slate-50 flex items-center justify-between">
            <div class="flex items-center">
                <div class="h-1.5 w-1.5 <?= $t['is_active'] ? 'bg-green-500' : 'bg-slate-300' ?> rounded-full mr-2"></div>
                <span class="text-[9px] font-black <?= $t['is_active'] ? 'text-green-600' : 'text-slate-400' ?> uppercase tracking-widest">
                    <?= $t['is_active'] ? 'Active' : 'Draft' ?>
                </span>
            </div>
            <a href="<?= base_url('admin/templates/edit/' . $t['id']) ?>" class="text-[10px] font-black text-blue-600 uppercase tracking-widest hover:underline">
                Configure <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<div class="mt-12 p-8 bg-slate-900 rounded-[2rem] text-white overflow-hidden relative shadow-2xl shadow-slate-200">
    <div class="absolute -right-20 -bottom-20 text-white/5 text-[15rem] leading-none select-none">
        <i class="fas fa-bolt"></i>
    </div>
    <div class="relative z-10 max-w-2xl">
        <h3 class="text-xl font-black mb-4 flex items-center">
            <i class="fas fa-magic mr-3 text-pink-500"></i> Dynamic Variable Orchestration
        </h3>
        <p class="text-xs text-slate-400 font-bold leading-relaxed mb-6 uppercase tracking-widest">
            Your News Templates support industrial-grade placeholder injection. These variables are automatically seated with live content during the broadcast lifecycle.
        </p>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-white/5 p-4 rounded-2xl border border-white/5">
                <span class="text-pink-400 font-black text-[10px] block mb-1 underline">{title}</span>
                <span class="text-white/40 text-[9px] font-bold uppercase tracking-tighter">News Headline</span>
            </div>
            <div class="bg-white/5 p-4 rounded-2xl border border-white/5">
                <span class="text-pink-400 font-black text-[10px] block mb-1 underline">{url}</span>
                <span class="text-white/40 text-[9px] font-bold uppercase tracking-tighter">Direct News Link</span>
            </div>
            <div class="bg-white/5 p-4 rounded-2xl border border-white/5">
                <span class="text-pink-400 font-black text-[10px] block mb-1 underline">{summary}</span>
                <span class="text-white/40 text-[9px] font-bold uppercase tracking-tighter">Short Description</span>
            </div>
            <div class="bg-white/5 p-4 rounded-2xl border border-white/5">
                <span class="text-pink-400 font-black text-[10px] block mb-1 underline">{category}</span>
                <span class="text-white/40 text-[9px] font-bold uppercase tracking-tighter">News Vertical</span>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

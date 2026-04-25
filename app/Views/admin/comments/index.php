<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="mb-8">
    <h2 class="text-3xl font-black text-slate-800 tracking-tight">Comment Moderation</h2>
    <p class="text-slate-400 font-bold text-sm">Review and manage user discussions</p>
</div>

<div class="space-y-6">
    <?php if (!empty($comments)): ?>
        <?php foreach ($comments as $com): ?>
            <div class="bg-white p-6 md:p-8 rounded-[2rem] shadow-sm border border-slate-100 flex flex-col md:flex-row justify-between items-start transition hover:border-slate-300">
                <div class="flex-1 w-full">
                    <div class="flex flex-wrap items-center gap-2 mb-4">
                        <span class="text-[10px] font-black <?= $com['status'] == 'approved' ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' ?> px-3 py-1 rounded-full uppercase tracking-widest border border-current opacity-70"><?= $com['status'] ?></span>
                        <span class="text-slate-400 text-xs font-bold">on article</span>
                        <span class="text-slate-800 font-black text-xs underline decoration-red-500/20 underline-offset-4 truncate max-w-[200px]"><?= $com['news_title'] ?></span>
                    </div>
                    
                    <div class="flex items-center mb-3">
                        <div class="h-10 w-10 bg-slate-100 text-slate-500 rounded-full flex items-center justify-center font-black text-xs mr-3">
                            <?= substr($com['name'], 0, 1) ?>
                        </div>
                        <div>
                            <h4 class="font-black text-slate-800 tracking-tight"><?= $com['name'] ?></h4>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter"><?= $com['email'] ?></p>
                        </div>
                    </div>

                    <p class="text-slate-600 leading-relaxed font-medium bg-slate-50/50 p-4 rounded-2xl italic border-l-4 border-slate-200">"<?= esc($com['comment']) ?>"</p>
                    <div class="mt-4 text-[10px] font-black text-slate-300 uppercase tracking-widest flex items-center">
                        <i class="far fa-clock mr-1"></i> <?= date('M d, Y • H:i', strtotime($com['created_at'])) ?>
                    </div>
                </div>
                
                <div class="flex md:flex-col space-y-0 md:space-y-2 space-x-2 md:space-x-0 mt-6 md:mt-0 ml-0 md:ml-8 w-full md:w-auto">
                    <?php if ($com['status'] == 'pending'): ?>
                        <a href="<?= base_url('admin/comments/approve/' . $com['id']) ?>" class="flex-1 md:w-32 bg-green-600 text-white px-6 py-3 rounded-2xl font-black text-[11px] text-center hover:bg-green-700 shadow-lg shadow-green-100 transition tracking-widest">APPROVE</a>
                    <?php endif; ?>
                    <a href="<?= base_url('admin/comments/delete/' . $com['id']) ?>" onclick="return confirm('Delete this comment permanently?')" class="flex-1 md:w-32 bg-slate-100 text-red-600 px-6 py-3 rounded-2xl font-black text-[11px] text-center hover:bg-red-50 transition tracking-widest uppercase">Delete</a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="text-center py-24 bg-white rounded-[3rem] border-4 border-dashed border-slate-50 flex flex-col items-center">
            <div class="h-20 w-20 bg-slate-50 text-slate-200 rounded-full flex items-center justify-center mb-6 text-3xl">
                <i class="fas fa-check-double"></i>
            </div>
            <p class="text-slate-400 font-black text-xl tracking-tight">Everything is clear!</p>
            <p class="text-slate-300 text-sm font-bold">No pending comments to moderate right now.</p>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>

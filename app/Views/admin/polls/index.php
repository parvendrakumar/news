<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
    <div>
        <h2 class="text-3xl font-black text-slate-800 tracking-tight">Polls & Surveys</h2>
        <p class="text-slate-400 font-bold text-sm">Review audience opinion and sentiment</p>
    </div>
    <a href="<?= base_url('admin/polls/create') ?>" class="w-full md:w-auto bg-orange-600 text-white px-8 py-3 rounded-2xl font-black hover:bg-orange-700 transition shadow-xl shadow-orange-100 flex items-center justify-center">
        <i class="fas fa-plus mr-2 text-xs"></i> CREATE POLL
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    <?php foreach ($polls as $poll): ?>
    <div class="bg-white p-6 md:p-8 rounded-[2rem] shadow-sm border border-slate-100 flex flex-col justify-between">
        <div>
            <div class="flex justify-between items-start mb-4">
                <span class="px-3 py-1 bg-orange-50 text-orange-600 text-[10px] font-black uppercase tracking-widest rounded-lg border border-orange-100">
                    Live Survey
                </span>
                <a href="<?= base_url('admin/polls/delete/' . $poll['id']) ?>" onclick="return confirm('Remove this poll?')" class="text-slate-300 hover:text-red-500 transition">
                    <i class="fas fa-trash-alt"></i>
                </a>
            </div>
            <h3 class="text-lg font-black text-slate-800 leading-tight mb-2"><?= $poll['question_hi'] ?></h3>
            <p class="text-xs font-bold text-slate-400 mb-6 italic"><?= $poll['question_en'] ?></p>

            <div class="space-y-4">
                <?php 
                $totalVotes = array_sum(array_column($poll['options'], 'votes'));
                foreach ($poll['options'] as $option): 
                    $percent = $totalVotes > 0 ? round(($option['votes'] / $totalVotes) * 100) : 0;
                ?>
                <div>
                    <div class="flex justify-between text-[10px] font-black uppercase tracking-widest mb-1">
                        <span class="text-slate-500"><?= $option['option_hi'] ?></span>
                        <span class="text-orange-600"><?= $percent ?>% (<?= $option['votes'] ?>)</span>
                    </div>
                    <div class="h-2 w-full bg-slate-100 rounded-full overflow-hidden">
                        <div class="h-full bg-orange-500 rounded-full" style="width: <?= $percent ?>%"></div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        
        <div class="mt-8 pt-6 border-t border-slate-50 flex items-center justify-between">
            <div class="text-[10px] font-black text-slate-300 uppercase tracking-widest">
                <i class="far fa-calendar-alt mr-1"></i> Starting: <?= date('d M, Y', strtotime($poll['created_at'])) ?>
            </div>
            <div class="text-[10px] font-black text-slate-800 uppercase tracking-widest">
                Total: <?= number_format($totalVotes) ?> Votes
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    
    <?php if (empty($polls)): ?>
    <div class="md:col-span-2 bg-slate-50 border-2 border-dashed border-slate-200 rounded-[2rem] p-20 text-center">
        <div class="text-slate-300 font-black italic">No active surveys. Launch a poll to engage your readers!</div>
    </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>

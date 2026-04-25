<?= $this->extend('user/layout') ?>

<?= $this->section('content') ?>

<div class="mb-10 animate-in fade-in slide-in-from-bottom-4 duration-700">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm shadow-slate-100">
        <div class="space-y-2">
            <h1 class="text-4xl font-black text-slate-800 tracking-tighter">Set Your <span class="text-blue-600">Interests</span></h1>
            <p class="text-slate-400 font-bold text-sm uppercase tracking-widest flex items-center gap-2">
                Personalize your news feed by following categories you love
            </p>
        </div>
        <div class="flex items-center gap-2 px-6 py-3 bg-blue-50 text-blue-600 rounded-2xl font-black text-xs uppercase tracking-widest">
            <i class="fas fa-check-circle"></i>
            <?= count($selectedIds) ?> Followed
        </div>
    </div>
</div>

<div class="bg-white p-8 md:p-12 rounded-[2.5rem] border border-slate-100 shadow-sm">
    <?php if (session()->getFlashdata('success')): ?>
        <div class="mb-8 p-4 bg-green-50 border border-green-100 text-green-700 rounded-2xl font-bold flex items-center gap-3">
            <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('user/interests/save') ?>" method="POST">
        <?= csrf_field() ?>
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-12">
            <?php foreach ($categories as $cat): ?>
                <?php $isSelected = in_array($cat['id'], $selectedIds); ?>
                <label class="relative cursor-pointer group">
                    <input type="checkbox" name="categories[]" value="<?= $cat['id'] ?>" class="hidden peer" <?= $isSelected ? 'checked' : '' ?>>
                    <div class="h-full p-6 rounded-3xl border-2 transition-all duration-300 flex flex-col items-center justify-center text-center gap-4 peer-checked:border-blue-500 peer-checked:bg-blue-50 group-hover:border-slate-200 border-slate-50 bg-slate-50/50">
                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-2xl transition-all duration-500 peer-checked:bg-blue-600 peer-checked:text-white bg-white text-slate-300 shadow-sm">
                            <i class="fas fa-newspaper"></i>
                        </div>
                        <div>
                            <span class="block font-black text-slate-800 tracking-tight group-hover:text-blue-600 transition"><?= esc($cat['title']) ?></span>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Explore <?= esc($cat['title']) ?></span>
                        </div>
                        
                        <!-- Checked Indicator -->
                        <div class="absolute top-4 right-4 w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center scale-0 peer-checked:scale-100 transition-transform shadow-lg">
                            <i class="fas fa-check text-[10px]"></i>
                        </div>
                    </div>
                </label>
            <?php endforeach; ?>
        </div>

        <div class="flex items-center justify-between pt-10 border-t border-slate-100">
            <button type="submit" class="px-12 py-5 bg-slate-900 text-white rounded-[2rem] font-black text-xs uppercase tracking-widest hover:bg-blue-600 hover:shadow-2xl hover:shadow-blue-200 transition-all active:scale-95">
                Save My Preferences
            </button>
            <p class="text-[10px] font-black text-slate-300 uppercase tracking-widest hidden sm:block">
                Choose at least 3 categories for better recommendations
            </p>
        </div>
    </form>
</div>

<?= $this->endSection() ?>

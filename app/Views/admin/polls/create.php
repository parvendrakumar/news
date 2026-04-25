<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
        <h2 class="text-3xl font-black text-slate-800 tracking-tight">Create New Poll</h2>
        <p class="text-slate-400 font-bold text-sm">Launch a new engagement survey</p>
    </div>
    <a href="<?= base_url('admin/polls') ?>" class="text-slate-400 hover:text-slate-600 font-black text-xs uppercase tracking-widest flex items-center">
        <i class="fas fa-arrow-left mr-2"></i> Back to Polls
    </a>
</div>

<form action="<?= base_url('admin/polls/store') ?>" method="POST" class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <?= csrf_field() ?>
    
    <div class="lg:col-span-8 space-y-6">
        <div class="bg-white p-4 md:p-8 rounded-[2rem] shadow-sm border border-slate-100">
            <h3 class="text-xs font-black text-slate-300 uppercase tracking-widest mb-6">Survey Configuration</h3>
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Question (Hindi)</label>
                    <input type="text" name="question_hi" class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-orange-500 outline-none font-bold" placeholder="आपकी राय क्या है?..." required>
                </div>
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Question (English)</label>
                    <input type="text" name="question_en" class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-orange-500 outline-none font-bold" placeholder="What is your opinion?...">
                </div>

                <div class="pt-6 border-t border-slate-50">
                    <div class="flex items-center justify-between mb-4">
                        <label class="block text-sm font-black text-slate-700">Poll Options</label>
                        <button type="button" onclick="addOption()" class="text-[10px] font-black text-orange-600 uppercase tracking-widest hover:text-orange-700">
                            + Add Option
                        </button>
                    </div>
                    <div id="options-container" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4 bg-slate-50 rounded-2xl border border-slate-100">
                            <input type="text" name="options_hi[]" class="px-5 py-3 rounded-xl border border-slate-200 focus:border-orange-500 outline-none font-bold text-sm" placeholder="विकल्प 1 (हिन्दी)" required>
                            <input type="text" name="options_en[]" class="px-5 py-3 rounded-xl border border-slate-200 focus:border-orange-500 outline-none font-bold text-sm" placeholder="Option 1 (English)">
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4 bg-slate-50 rounded-2xl border border-slate-100">
                            <input type="text" name="options_hi[]" class="px-5 py-3 rounded-xl border border-slate-200 focus:border-orange-500 outline-none font-bold text-sm" placeholder="विकल्प 2 (हिन्दी)" required>
                            <input type="text" name="options_en[]" class="px-5 py-3 rounded-xl border border-slate-200 focus:border-orange-500 outline-none font-bold text-sm" placeholder="Option 2 (English)">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="lg:col-span-4 space-y-6">
        <div class="bg-white p-4 md:p-8 rounded-[2rem] shadow-sm border border-slate-100">
            <h3 class="text-xs font-black text-slate-300 uppercase tracking-widest mb-6">Management</h3>
            <div class="space-y-6">
                <div class="p-4 bg-orange-50 rounded-2xl border border-orange-100 flex items-center">
                    <i class="fas fa-info-circle text-orange-400 mr-3"></i>
                    <p class="text-[10px] font-bold text-orange-700 leading-tight">Polls will be visible on the frontend homepage immediately after publication.</p>
                </div>

                <button type="submit" class="w-full bg-slate-800 text-white font-black py-4 rounded-2xl hover:bg-slate-900 shadow-xl transition uppercase tracking-widest text-sm">
                    Publish Survey
                </button>
            </div>
        </div>
    </div>
</form>

<script>
    let optionCount = 2;
    function addOption() {
        optionCount++;
        const container = document.getElementById('options-container');
        const div = document.createElement('div');
        div.className = 'grid grid-cols-1 md:grid-cols-2 gap-4 p-4 bg-slate-50 rounded-2xl border border-slate-100';
        div.innerHTML = `
            <input type="text" name="options_hi[]" class="px-5 py-3 rounded-xl border border-slate-200 focus:border-orange-500 outline-none font-bold text-sm" placeholder="विकल्प ${optionCount} (हिन्दी)" required>
            <input type="text" name="options_en[]" class="px-5 py-3 rounded-xl border border-slate-200 focus:border-orange-500 outline-none font-bold text-sm" placeholder="Option ${optionCount} (English)">
        `;
        container.appendChild(div);
    }
</script>

<?= $this->endSection() ?>

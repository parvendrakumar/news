<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="mb-8 flex items-center justify-between">
    <div>
        <h2 class="text-3xl font-black text-slate-800 tracking-tight">Edit News Template</h2>
        <p class="text-slate-400 font-bold text-sm">Configure dynamic content mapping for <?= strtoupper($template['module']) ?></p>
    </div>
    <a href="<?= base_url('admin/templates') ?>" class="text-slate-400 hover:text-slate-600 font-black text-[10px] uppercase tracking-widest flex items-center">
        <i class="fas fa-arrow-left mr-2"></i> Back to Templates
    </a>
</div>

<form action="<?= base_url('admin/templates/update/' . $template['id']) ?>" method="POST" class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <?= csrf_field() ?>
    
    <div class="lg:col-span-8 space-y-6">
        <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100">
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center">
                    <div class="h-10 w-10 bg-slate-100 rounded-xl flex items-center justify-center text-slate-400 mr-4">
                        <i class="fas fa-pen-nib"></i>
                    </div>
                    <h3 class="text-xs font-black text-slate-300 uppercase tracking-widest">Template Composition</h3>
                </div>
                <span class="px-4 py-2 bg-pink-50 text-pink-600 rounded-xl text-[10px] font-black uppercase tracking-widest border border-pink-100">
                    Target: <?= $template['module'] ?>
                </span>
            </div>

            <div class="space-y-6">
                <?php if($template['module'] == 'email'): ?>
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">Email Subject Line</label>
                    <input type="text" name="subject" value="<?= esc($template['subject']) ?>" class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:border-pink-500 outline-none font-bold text-slate-700" placeholder="Breaking News: {title}">
                </div>
                <?php endif; ?>

                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">Broadcast Content / Body</label>
                    <textarea name="content" rows="8" class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-pink-500 outline-none font-bold text-slate-700 leading-relaxed" placeholder="Type your dynamic template here..."><?= esc($template['content']) ?></textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="lg:col-span-4 space-y-6">
        <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100">
            <h3 class="text-xs font-black text-slate-300 uppercase tracking-widest mb-6">Variable Seat Mapping</h3>
            <div class="space-y-4">
                <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100 italic">
                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2">Available Placeholders:</p>
                    <div class="flex flex-wrap gap-2">
                        <?php foreach(explode(',', $template['placeholders']) as $p): ?>
                        <span class="px-2 py-1 bg-white border border-slate-200 rounded-lg text-[10px] font-black text-pink-600"><?= trim($p) ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="p-4 bg-pink-50 rounded-2xl border border-pink-100 flex items-start">
                    <i class="fas fa-info-circle text-pink-400 mt-1 mr-3"></i>
                    <p class="text-[10px] font-bold text-pink-800 leading-relaxed uppercase tracking-tighter">
                        Ensure you include <span class="underline">{url}</span> in every template to maximize click-through rates and website traffic.
                    </p>
                </div>

                <div class="pt-6 border-t border-slate-50">
                    <div class="flex items-center mb-6">
                        <label class="relative inline-flex items-center cursor-pointer mr-3">
                            <input type="checkbox" name="is_active" value="1" class="sr-only peer" <?= $template['is_active'] ? 'checked' : '' ?>>
                            <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-pink-600"></div>
                        </label>
                        <span class="text-[10px] font-black text-slate-600 uppercase tracking-widest">Template Status</span>
                    </div>

                    <button type="submit" class="w-full bg-slate-900 text-white font-black py-4 rounded-2xl hover:bg-black shadow-xl transition uppercase tracking-widest text-sm">
                        Save Changes
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<?= $this->endSection() ?>

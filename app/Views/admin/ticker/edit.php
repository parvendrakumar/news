<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
        <h2 class="text-3xl font-black text-slate-800 tracking-tight">Edit Flash Alert</h2>
        <p class="text-slate-400 font-bold text-sm">Update your breaking news ticker message</p>
    </div>
    <a href="<?= base_url('admin/ticker') ?>" class="text-slate-400 hover:text-slate-600 font-black text-xs uppercase tracking-widest flex items-center">
        <i class="fas fa-arrow-left mr-2"></i> Back to Ticker
    </a>
</div>

<form action="<?= base_url('admin/ticker/update/' . $ticker['id']) ?>" method="POST" class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <?= csrf_field() ?>
    
    <div class="lg:col-span-8 space-y-6">
        <div class="bg-white p-4 md:p-8 rounded-[2rem] shadow-sm border border-slate-100">
            <h3 class="text-xs font-black text-slate-300 uppercase tracking-widest mb-6">Alert Content</h3>
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Ticker Message (Hindi)</label>
                    <textarea name="content_hi" rows="3" class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-red-500 outline-none font-bold" placeholder="खबर यहाँ लिखें..." required><?= esc($ticker['content_hi']) ?></textarea>
                </div>
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Ticker Message (English)</label>
                    <textarea name="content_en" rows="3" class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-red-500 outline-none font-bold" placeholder="Write message in English..."><?= esc($ticker['content_en']) ?></textarea>
                </div>
                <div>
                    <label class="block text-sm font-black text-slate-700 mb-2">Source Link (Optional)</label>
                    <input type="url" name="link" value="<?= esc($ticker['link']) ?>" class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:border-red-500 outline-none font-bold text-blue-600" placeholder="https://news-location.com/...">
                </div>
            </div>
        </div>
    </div>

    <div class="lg:col-span-4 space-y-6">
        <div class="bg-white p-4 md:p-8 rounded-[2rem] shadow-sm border border-slate-100">
            <h3 class="text-xs font-black text-slate-300 uppercase tracking-widest mb-6">Status</h3>
            <div class="space-y-6">
                <div class="flex items-center justify-between p-4 bg-red-50 rounded-2xl border border-red-100">
                    <div class="font-black text-xs text-red-700 uppercase tracking-widest flex items-center">
                        <span class="h-2 w-2 rounded-full bg-red-600 mr-2 animate-pulse"></span> Broadcast Live
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" class="sr-only peer" <?= $ticker['is_active'] ? 'checked' : '' ?>>
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-600"></div>
                    </label>
                </div>

                <button type="submit" class="w-full bg-slate-800 text-white font-black py-4 rounded-2xl hover:bg-slate-900 shadow-xl transition uppercase tracking-widest text-sm">
                    Update Flash
                </button>
            </div>
        </div>
    </div>
</form>

<?= $this->endSection() ?>

<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="mb-8 flex items-center justify-between">
    <div>
        <h2 class="text-3xl font-black text-slate-800 tracking-tight">WhatsApp Business Setup</h2>
        <p class="text-slate-400 font-bold text-sm">Configure hyper-engaging direct news broadcasts via Meta Cloud API</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <!-- Main Configuration -->
    <div class="lg:col-span-8">
        <form action="<?= base_url('admin/whatsapp/update') ?>" method="POST" class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100">
            <?= csrf_field() ?>
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center">
                    <div class="h-10 w-10 bg-slate-100 rounded-xl flex items-center justify-center text-slate-400 mr-4">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                    <h3 class="text-xs font-black text-slate-300 uppercase tracking-widest">Meta API Configuration</h3>
                </div>
                <span class="px-3 py-1 bg-green-50 text-green-700 rounded-lg text-[10px] font-black uppercase tracking-widest border border-green-100 italic">Cloud API v17.0+</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="md:col-span-2">
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">Base API URL</label>
                    <input type="url" name="api_url" value="<?= esc($whatsapp['api_url'] ?? '') ?>" class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:border-green-500 outline-none font-bold text-slate-600" placeholder="https://graph.facebook.com/v17.0/">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">Temporary / Permanent Token (Bearer)</label>
                    <textarea name="api_key" rows="2" class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:border-green-500 outline-none font-bold text-slate-600 text-xs" placeholder="EAAG..."><?= esc($whatsapp['api_key'] ?? '') ?></textarea>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">Phone Number ID</label>
                    <input type="text" name="phone_number_id" value="<?= esc($whatsapp['phone_number_id'] ?? '') ?>" class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:border-green-500 outline-none font-bold text-slate-600" placeholder="105...">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">Business Account ID (WABA)</label>
                    <input type="text" name="waba_id" value="<?= esc($whatsapp['waba_id'] ?? '') ?>" class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:border-green-500 outline-none font-bold text-slate-600" placeholder="102...">
                </div>
            </div>

            <div class="mt-8 flex items-center justify-between p-4 bg-slate-50 rounded-2xl border border-slate-100">
                <div class="flex items-center">
                    <label class="relative inline-flex items-center cursor-pointer mr-3">
                        <input type="checkbox" name="is_active" value="1" class="sr-only peer" <?= ($whatsapp['is_active'] ?? 0) ? 'checked' : '' ?>>
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600"></div>
                    </label>
                    <span class="text-[10px] font-black text-slate-600 uppercase tracking-widest">Enable WhatsApp Broadcasting</span>
                </div>
                <button type="submit" class="bg-slate-900 text-white px-8 py-3 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-black transition shadow-xl">
                    <i class="fas fa-save mr-2"></i> Update API Settings
                </button>
            </div>
        </form>
    </div>

    <!-- Right Sidebar -->
    <div class="lg:col-span-4 space-y-8">
        <!-- Test Broadcast -->
        <div class="bg-green-600 p-8 rounded-[2rem] text-white shadow-xl shadow-green-200 relative overflow-hidden">
            <div class="absolute -right-8 -top-8 text-white/5 text-9xl">
                <i class="fab fa-whatsapp"></i>
            </div>
            <div class="relative z-10">
                <h3 class="text-xl font-black mb-4 flex items-center">
                    <i class="fas fa-paper-plane mr-2 text-white italic"></i> Test Dispatch
                </h3>
                <p class="text-xs text-green-100 font-bold leading-relaxed mb-6">
                    Launch a template-based test message to verify your Meta Cloud authentication and Phone ID matching.
                </p>
                <form action="<?= base_url('admin/whatsapp/test') ?>" method="POST" class="space-y-4">
                    <?= csrf_field() ?>
                    <input type="text" name="test_mobile" class="w-full px-5 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder:text-white/40 outline-none font-bold" placeholder="Mobile (e.g. 91...)" required>
                    <input type="text" name="test_template" class="w-full px-5 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder:text-white/40 outline-none font-bold" placeholder="Template Name (e.g. hello_world)" required>
                    <button type="submit" class="w-full bg-white text-green-600 font-black py-4 rounded-xl hover:bg-green-50 transition shadow-lg uppercase tracking-widest text-xs">
                        Push Test Message
                    </button>
                </form>
            </div>
        </div>

        <!-- Meta Developer Guide -->
        <div class="bg-slate-50 p-8 rounded-[2rem] border border-slate-200">
            <div class="flex items-center text-slate-800 font-black text-xs uppercase tracking-widest mb-6">
                <i class="fas fa-tools mr-2 text-blue-500"></i> Meta Developer Portal
            </div>
            <div class="space-y-4">
                <p class="text-[9px] font-bold text-slate-400 leading-relaxed uppercase tracking-widest">
                    To use this module, you must register an application on <span class="text-blue-600 underline">developers.facebook.com</span> and enable the WhatsApp product.
                </p>
                <div class="space-y-2">
                    <div class="flex items-center text-[10px] font-black text-slate-600">
                        <i class="fas fa-check-circle text-green-500 mr-2"></i> Cloud API Setup
                    </div>
                    <div class="flex items-center text-[10px] font-black text-slate-600">
                        <i class="fas fa-check-circle text-green-500 mr-2"></i> Verified Phone ID
                    </div>
                    <div class="flex items-center text-[10px] font-black text-slate-600">
                        <i class="fas fa-check-circle text-green-500 mr-2"></i> Template Approval
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

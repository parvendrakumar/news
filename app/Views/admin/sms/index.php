<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="mb-8 flex items-center justify-between">
    <div>
        <h2 class="text-3xl font-black text-slate-800 tracking-tight">SMS Gateway Setup</h2>
        <p class="text-slate-400 font-bold text-sm">Orchestrate high-urgency mobile alerts and DLT-compliant notifications</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <!-- Main Configuration -->
    <div class="lg:col-span-8">
        <form action="<?= base_url('admin/sms/update') ?>" method="POST" class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100">
            <?= csrf_field() ?>
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center">
                    <div class="h-10 w-10 bg-slate-100 rounded-xl flex items-center justify-center text-slate-400 mr-4">
                        <i class="fas fa-broadcast-tower"></i>
                    </div>
                    <h3 class="text-xs font-black text-slate-300 uppercase tracking-widest">Gateway Configuration</h3>
                </div>
                <span class="px-3 py-1 bg-yellow-50 text-yellow-700 rounded-lg text-[10px] font-black uppercase tracking-widest border border-yellow-100 italic">DLT Enabled</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="md:col-span-2">
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">Gateway API URL</label>
                    <input type="url" name="api_url" value="<?= esc($sms['api_url'] ?? '') ?>" class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:border-yellow-500 outline-none font-bold text-slate-600" placeholder="https://api.gateway.com/sendmsg?">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">API Key / Token</label>
                    <input type="password" name="api_key" value="<?= esc($sms['api_key'] ?? '') ?>" class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:border-yellow-500 outline-none font-bold text-slate-600" placeholder="••••••••••••">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">Gateway Provider Name</label>
                    <input type="text" name="gateway_name" value="<?= esc($sms['gateway_name'] ?? '') ?>" class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:border-yellow-500 outline-none font-bold text-slate-600" placeholder="MSG91 / Twilio / Textlocal">
                </div>
            </div>

            <div class="pt-8 border-t border-slate-50">
                <div class="flex items-center mb-6">
                    <div class="h-10 w-10 bg-slate-100 rounded-xl flex items-center justify-center text-slate-400 mr-4">
                        <i class="fas fa-id-card"></i>
                    </div>
                    <h3 class="text-xs font-black text-slate-300 uppercase tracking-widest">Sender & DLT Compliance</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">Sender ID</label>
                        <input type="text" name="sender_id" value="<?= esc($sms['sender_id'] ?? '') ?>" class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:border-yellow-500 outline-none font-bold text-slate-600" placeholder="CITYNS">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">Entity ID (DLT)</label>
                        <input type="text" name="entity_id" value="<?= esc($sms['entity_id'] ?? '') ?>" class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:border-yellow-500 outline-none font-bold text-slate-600" placeholder="1234567890">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">Default Template ID</label>
                        <input type="text" name="template_id" value="<?= esc($sms['template_id'] ?? '') ?>" class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:border-yellow-500 outline-none font-bold text-slate-600" placeholder="1107... ">
                    </div>
                </div>
            </div>

            <div class="mt-8 flex items-center justify-between p-4 bg-slate-50 rounded-2xl border border-slate-100">
                <div class="flex items-center">
                    <label class="relative inline-flex items-center cursor-pointer mr-3">
                        <input type="checkbox" name="is_active" value="1" class="sr-only peer" <?= ($sms['is_active'] ?? 0) ? 'checked' : '' ?>>
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-yellow-600"></div>
                    </label>
                    <span class="text-[10px] font-black text-slate-600 uppercase tracking-widest">Enable SMS Gateway</span>
                </div>
                <button type="submit" class="bg-slate-900 text-white px-8 py-3 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-black transition shadow-xl">
                    <i class="fas fa-save mr-2"></i> Update SMS Settings
                </button>
            </div>
        </form>
    </div>

    <!-- Right Sidebar -->
    <div class="lg:col-span-4 space-y-8">
        <!-- Test Connection -->
        <div class="bg-slate-900 p-8 rounded-[2rem] text-white shadow-xl relative overflow-hidden">
            <div class="absolute -right-8 -top-8 text-white/5 text-9xl">
                <i class="fas fa-mobile-alt"></i>
            </div>
            <div class="relative z-10">
                <h3 class="text-xl font-black mb-4 flex items-center">
                    <i class="fas fa-rocket mr-2 text-yellow-500"></i> Transmission Test
                </h3>
                <p class="text-xs text-slate-400 font-bold leading-relaxed mb-6">
                    Verify your API authentication and DLT template matching by sending a high-priority test alert.
                </p>
                <form action="<?= base_url('admin/sms/test') ?>" method="POST" class="space-y-4">
                    <?= csrf_field() ?>
                    <input type="text" name="test_mobile" class="w-full px-5 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder:text-white/30 outline-none font-bold italic" placeholder="Mobile with Code (e.g. 91...)" required>
                    <textarea name="test_message" rows="3" class="w-full px-5 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder:text-white/30 outline-none font-bold text-xs" placeholder="Type test message here..." required></textarea>
                    <button type="submit" class="w-full bg-yellow-500 text-slate-900 font-black py-4 rounded-xl hover:bg-yellow-400 transition shadow-lg uppercase tracking-widest text-xs">
                        Push Test Alert
                    </button>
                </form>
            </div>
        </div>

        <!-- DLT Instructions -->
        <div class="bg-yellow-50/50 p-8 rounded-[2rem] border border-yellow-100/50">
            <div class="flex items-center text-yellow-700 font-black text-xs uppercase tracking-widest mb-6">
                <i class="fas fa-shield-check mr-2"></i> DLT Compliance Info
            </div>
            <div class="space-y-4">
                <p class="text-[9px] font-bold text-slate-500 leading-relaxed uppercase tracking-widest">
                    For Indian gateways (MSG91, Textlocal), <span class="text-yellow-700">Entity ID</span> and <span class="text-yellow-700">Template ID</span> are mandatory to prevent transmission failure.
                </p>
                <div class="p-4 bg-white rounded-2xl border border-yellow-100 italic">
                    <p class="text-[10px] font-black text-slate-400">Sample Template:</p>
                    <p class="text-[10px] font-bold text-slate-700">Your OTP for City News is {#var#}. Do not share it.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

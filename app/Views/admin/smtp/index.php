<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="mb-8 flex items-center justify-between">
    <div>
        <h2 class="text-3xl font-black text-slate-800 tracking-tight">SMTP Mailer Setup</h2>
        <p class="text-slate-400 font-bold text-sm">Configure secure email communication for system alerts and newsletters</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <!-- Main Configuration -->
    <div class="lg:col-span-8">
        <form action="<?= base_url('admin/smtp/update') ?>" method="POST" class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100">
            <?= csrf_field() ?>
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center">
                    <div class="h-10 w-10 bg-slate-100 rounded-xl flex items-center justify-center text-slate-400 mr-4">
                        <i class="fas fa-server"></i>
                    </div>
                    <h3 class="text-xs font-black text-slate-300 uppercase tracking-widest">Server Configuration</h3>
                </div>
                <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-lg text-[10px] font-black uppercase tracking-widest border border-blue-100 italic">Protocol: SMTP</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">SMTP Host</label>
                    <input type="text" name="smtp_host" value="<?= esc($smtp['smtp_host'] ?? '') ?>" class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:border-blue-500 outline-none font-bold text-slate-600" placeholder="smtp.gmail.com">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">SMTP Port</label>
                    <input type="text" name="smtp_port" value="<?= esc($smtp['smtp_port'] ?? '') ?>" class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:border-blue-500 outline-none font-bold text-slate-600" placeholder="587">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">SMTP Username</label>
                    <input type="text" name="smtp_user" value="<?= esc($smtp['smtp_user'] ?? '') ?>" class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:border-blue-500 outline-none font-bold text-slate-600" placeholder="support@domain.com">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">SMTP Password</label>
                    <div class="relative">
                        <input type="password" name="smtp_pass" id="smtp_pass" value="<?= esc($smtp['smtp_pass'] ?? '') ?>" class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:border-blue-500 outline-none font-bold text-slate-600" placeholder="••••••••••••">
                        <button type="button" onclick="togglePass()" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-300 hover:text-slate-500">
                            <i class="far fa-eye"></i>
                        </button>
                    </div>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">Encryption Type</label>
                    <select name="smtp_crypto" class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:border-blue-500 outline-none font-bold text-slate-600 appearance-none bg-no-repeat bg-[right_1.25rem_center] bg-[length:1em]">
                        <option value="tls" <?= ($smtp['smtp_crypto'] ?? '') == 'tls' ? 'selected' : '' ?>>TLS (Recommended)</option>
                        <option value="ssl" <?= ($smtp['smtp_crypto'] ?? '') == 'ssl' ? 'selected' : '' ?>>SSL (Port 465)</option>
                        <option value="none" <?= ($smtp['smtp_crypto'] ?? '') == 'none' ? 'selected' : '' ?>>None (Port 25)</option>
                    </select>
                </div>
            </div>

            <div class="pt-8 border-t border-slate-50">
                <div class="flex items-center mb-6">
                    <div class="h-10 w-10 bg-slate-100 rounded-xl flex items-center justify-center text-slate-400 mr-4">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <h3 class="text-xs font-black text-slate-300 uppercase tracking-widest">Authorized Sender Details</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">Sender Email Address</label>
                        <input type="email" name="from_email" value="<?= esc($smtp['from_email'] ?? '') ?>" class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:border-blue-500 outline-none font-bold text-slate-600" placeholder="support@domain.com">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">Sender Display Name</label>
                        <input type="text" name="from_name" value="<?= esc($smtp['from_name'] ?? '') ?>" class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:border-blue-500 outline-none font-bold text-slate-600" placeholder="City News Support">
                    </div>
                </div>
            </div>

            <div class="mt-8 flex items-center justify-between p-4 bg-slate-50 rounded-2xl border border-slate-100">
                <div class="flex items-center">
                    <label class="relative inline-flex items-center cursor-pointer mr-3">
                        <input type="checkbox" name="is_active" value="1" class="sr-only peer" <?= ($smtp['is_active'] ?? 0) ? 'checked' : '' ?>>
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    </label>
                    <span class="text-[10px] font-black text-slate-600 uppercase tracking-widest">Enable System Mailer</span>
                </div>
                <button type="submit" class="bg-slate-900 text-white px-8 py-3 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-black transition shadow-xl">
                    <i class="fas fa-save mr-2"></i> Update SMTP Settings
                </button>
            </div>
        </form>
    </div>

    <!-- Right Sidebar -->
    <div class="lg:col-span-4 space-y-8">
        <!-- Test Connection -->
        <div class="bg-blue-600 p-8 rounded-[2rem] text-white shadow-xl shadow-blue-200 relative overflow-hidden">
            <div class="absolute -right-8 -top-8 text-white/5 text-9xl">
                <i class="fas fa-bolt"></i>
            </div>
            <div class="relative z-10">
                <h3 class="text-xl font-black mb-4 flex items-center">
                    <i class="fas fa-bolt mr-2 brightness-150"></i> Connection Test
                </h3>
                <p class="text-xs text-blue-100 font-bold leading-relaxed mb-6">
                    Enter a recipient email below to verify if your SMTP configuration is properly authenticated with your server.
                </p>
                <form action="<?= base_url('admin/smtp/test') ?>" method="POST" class="space-y-4">
                    <?= csrf_field() ?>
                    <input type="email" name="test_email" class="w-full px-5 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder:text-white/40 outline-none font-bold" placeholder="recipient@example.com" required>
                    <button type="submit" class="w-full bg-white text-blue-600 font-black py-4 rounded-xl hover:bg-blue-50 transition shadow-lg uppercase tracking-widest text-xs">
                        Run Test Email
                    </button>
                </form>
            </div>
        </div>

        <!-- Helpful Presets -->
        <div class="bg-amber-50/50 p-8 rounded-[2rem] border border-amber-100/50">
            <div class="flex items-center text-amber-600 font-black text-xs uppercase tracking-widest mb-6">
                <i class="fas fa-lightbulb mr-2"></i> Common Setups
            </div>
            <div class="space-y-6">
                <div>
                    <h5 class="text-[10px] font-black text-slate-800 uppercase tracking-widest mb-1">Gmail / Workspace</h5>
                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-tighter leading-tight">Host: smtp.gmail.com<br>Port: 587 (TLS)<br>Note: Use App Password</p>
                </div>
                <div class="pt-4 border-t border-amber-100">
                    <h5 class="text-[10px] font-black text-slate-800 uppercase tracking-widest mb-1">Outlook / Office365</h5>
                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-tighter leading-tight">Host: smtp.office365.com<br>Port: 587 (STARTTLS)</p>
                </div>
                <div class="pt-4 border-t border-amber-100">
                    <h5 class="text-[10px] font-black text-slate-800 uppercase tracking-widest mb-1">SendGrid</h5>
                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-tighter leading-tight">Host: smtp.sendgrid.net<br>Port: 587 (TLS)<br>User: apikey</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePass() {
        const pass = document.getElementById('smtp_pass');
        pass.type = pass.type === 'password' ? 'text' : 'password';
    }
</script>

<?= $this->endSection() ?>

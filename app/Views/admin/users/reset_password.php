<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="flex items-center gap-4 mb-8">
    <a href="<?= base_url('admin/users') ?>" class="h-10 w-10 flex items-center justify-center rounded-xl bg-slate-100 text-slate-500 hover:bg-slate-200 transition">
        <i class="fas fa-arrow-left text-sm"></i>
    </a>
    <div>
        <h2 class="text-3xl font-black text-slate-800 tracking-tight">Reset Password</h2>
        <p class="text-slate-400 font-bold text-sm">Set a new password for <span class="text-slate-600"><?= esc($user['full_name'] ?: $user['username']) ?></span></p>
    </div>
</div>

<?php if (session()->getFlashdata('errors')): ?>
<div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-2xl">
    <p class="font-black text-sm mb-2"><i class="fas fa-exclamation-circle mr-2"></i>Please fix the following errors:</p>
    <ul class="list-disc list-inside space-y-1 text-sm">
        <?php foreach ((array)session()->getFlashdata('errors') as $err): ?>
            <li><?= esc($err) ?></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

<div class="max-w-md">
<div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-8">
    <form action="<?= base_url('admin/users/reset-password/' . $user['id']) ?>" method="POST" class="space-y-6">
        <?= csrf_field() ?>

        <div>
            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">New Password <span class="text-red-500">*</span></label>
            <div class="relative">
                <input type="password" name="password" id="new_password"
                       class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-300 outline-none transition text-sm font-bold text-slate-700 pr-12"
                       placeholder="Min 6 characters" required>
                <button type="button" onclick="togglePass('new_password', this)" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600">
                    <i class="fas fa-eye text-sm"></i>
                </button>
            </div>
        </div>

        <div>
            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Confirm Password <span class="text-red-500">*</span></label>
            <div class="relative">
                <input type="password" name="password_confirm" id="confirm_password"
                       class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-300 outline-none transition text-sm font-bold text-slate-700 pr-12"
                       placeholder="Re-enter password" required>
                <button type="button" onclick="togglePass('confirm_password', this)" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600">
                    <i class="fas fa-eye text-sm"></i>
                </button>
            </div>
        </div>

        <!-- Strength meter -->
        <div id="strength-bar" class="h-1.5 rounded-full bg-slate-100 overflow-hidden">
            <div id="strength-fill" class="h-full w-0 rounded-full transition-all duration-300 bg-red-400"></div>
        </div>
        <p id="strength-label" class="text-xs font-bold text-slate-400 -mt-4"></p>

        <div class="pt-2 flex gap-3">
            <button type="submit" class="flex-1 bg-amber-500 text-white font-black py-4 rounded-xl hover:bg-amber-600 transition shadow-lg shadow-amber-100 text-sm">
                <i class="fas fa-key mr-2"></i>Reset Password
            </button>
            <a href="<?= base_url('admin/users/edit/' . $user['id']) ?>" class="px-6 py-4 border border-slate-200 text-slate-500 font-black rounded-xl hover:bg-slate-50 transition text-sm">
                Cancel
            </a>
        </div>
    </form>
</div>
</div>

<script>
function togglePass(fieldId, btn) {
    const field = document.getElementById(fieldId);
    const icon  = btn.querySelector('i');
    field.type  = field.type === 'password' ? 'text' : 'password';
    icon.classList.toggle('fa-eye');
    icon.classList.toggle('fa-eye-slash');
}

document.getElementById('new_password').addEventListener('input', function() {
    const val  = this.value;
    const fill = document.getElementById('strength-fill');
    const lbl  = document.getElementById('strength-label');
    let score  = 0;
    if (val.length >= 6)  score++;
    if (val.length >= 10) score++;
    if (/[A-Z]/.test(val)) score++;
    if (/[0-9]/.test(val)) score++;
    if (/[^A-Za-z0-9]/.test(val)) score++;

    const levels = [
        { pct: '10%',  color: 'bg-red-400',    label: 'Very Weak' },
        { pct: '30%',  color: 'bg-orange-400',  label: 'Weak' },
        { pct: '55%',  color: 'bg-yellow-400',  label: 'Fair' },
        { pct: '80%',  color: 'bg-blue-400',    label: 'Strong' },
        { pct: '100%', color: 'bg-green-500',   label: 'Very Strong' },
    ];
    const lvl = levels[Math.min(score, 4)];
    fill.style.width = val.length ? lvl.pct : '0';
    fill.className   = `h-full rounded-full transition-all duration-300 ${lvl.color}`;
    lbl.textContent  = val.length ? lvl.label : '';
});
</script>

<?= $this->endSection() ?>

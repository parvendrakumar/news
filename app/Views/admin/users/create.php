<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="flex items-center gap-4 mb-8">
    <a href="<?= base_url('admin/users') ?>" class="h-10 w-10 flex items-center justify-center rounded-xl bg-slate-100 text-slate-500 hover:bg-slate-200 transition">
        <i class="fas fa-arrow-left text-sm"></i>
    </a>
    <div>
        <h2 class="text-3xl font-black text-slate-800 tracking-tight">Add Team Member</h2>
        <p class="text-slate-400 font-bold text-sm">Create a new staff account</p>
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

<div class="max-w-2xl">
<div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-8">
    <form action="<?= base_url('admin/users/store') ?>" method="POST" class="space-y-6">
        <?= csrf_field() ?>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Full Name <span class="text-red-500">*</span></label>
                <input type="text" name="full_name" value="<?= old('full_name') ?>"
                       class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-300 outline-none transition text-sm font-bold text-slate-700"
                       placeholder="Jane Smith" required>
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Username <span class="text-red-500">*</span></label>
                <input type="text" name="username" value="<?= old('username') ?>"
                       class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-300 outline-none transition text-sm font-bold text-slate-700"
                       placeholder="janesmith" required>
            </div>
        </div>

        <div>
            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Email Address <span class="text-red-500">*</span></label>
            <input type="email" name="email" value="<?= old('email') ?>"
                   class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-300 outline-none transition text-sm font-bold text-slate-700"
                   placeholder="jane@citynews.com" required>
        </div>

        <div>
            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Password <span class="text-red-500">*</span></label>
            <div class="relative">
                <input type="password" name="password" id="password"
                       class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-300 outline-none transition text-sm font-bold text-slate-700 pr-12"
                       placeholder="Min 6 characters" required>
                <button type="button" onclick="togglePass('password', this)" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 transition">
                    <i class="fas fa-eye text-sm"></i>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Assign Role <span class="text-red-500">*</span></label>
                <select name="role_id" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-300 outline-none transition text-sm font-bold text-slate-700" required>
                    <option value="">— Select Role —</option>
                    <?php foreach ($roles as $role): ?>
                        <option value="<?= $role['id'] ?>" <?= old('role_id') == $role['id'] ? 'selected' : '' ?>><?= esc($role['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Account Status</label>
                <select name="status" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-300 outline-none transition text-sm font-bold text-slate-700">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
        </div>

        <div class="pt-2 flex gap-3">
            <button type="submit" id="submit-btn"
                    class="flex-1 bg-indigo-600 text-white font-black py-4 rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-100 text-sm">
                <i class="fas fa-user-plus mr-2"></i>Create Account
            </button>
            <a href="<?= base_url('admin/users') ?>" class="px-6 py-4 border border-slate-200 text-slate-500 font-black rounded-xl hover:bg-slate-50 transition text-sm">
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
    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        field.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
}
</script>

<?= $this->endSection() ?>

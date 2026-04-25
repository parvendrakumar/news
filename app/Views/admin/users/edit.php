<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="flex items-center gap-4 mb-8">
    <a href="<?= base_url('admin/users') ?>" class="h-10 w-10 flex items-center justify-center rounded-xl bg-slate-100 text-slate-500 hover:bg-slate-200 transition">
        <i class="fas fa-arrow-left text-sm"></i>
    </a>
    <div>
        <h2 class="text-3xl font-black text-slate-800 tracking-tight">Edit Team Member</h2>
        <p class="text-slate-400 font-bold text-sm">Update account details for <span class="text-slate-600"><?= esc($user['full_name'] ?: $user['username']) ?></span></p>
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
    <form action="<?= base_url('admin/users/update/' . $user['id']) ?>" method="POST" class="space-y-6">
        <?= csrf_field() ?>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Full Name <span class="text-red-500">*</span></label>
                <input type="text" name="full_name" value="<?= esc(old('full_name', $user['full_name'])) ?>"
                       class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-300 outline-none transition text-sm font-bold text-slate-700"
                       required>
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Username <span class="text-red-500">*</span></label>
                <input type="text" name="username" value="<?= esc(old('username', $user['username'])) ?>"
                       class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-300 outline-none transition text-sm font-bold text-slate-700"
                       required>
            </div>
        </div>

        <div>
            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Email Address <span class="text-red-500">*</span></label>
            <input type="email" name="email" value="<?= esc(old('email', $user['email'])) ?>"
                   class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-300 outline-none transition text-sm font-bold text-slate-700"
                   required>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Assign Role <span class="text-red-500">*</span></label>
                <select name="role_id" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-300 outline-none transition text-sm font-bold text-slate-700" required>
                    <?php foreach ($roles as $role): ?>
                        <option value="<?= $role['id'] ?>" <?= old('role_id', $user['role_id']) == $role['id'] ? 'selected' : '' ?>>
                            <?= esc($role['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Account Status</label>
                <select name="status" class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-300 outline-none transition text-sm font-bold text-slate-700">
                    <option value="active"   <?= old('status', $user['status'] ?? 'active') == 'active'   ? 'selected' : '' ?>>Active</option>
                    <option value="inactive" <?= old('status', $user['status'] ?? 'active') == 'inactive' ? 'selected' : '' ?>>Inactive</option>
                </select>
            </div>
        </div>

        <div class="pt-2 flex flex-col sm:flex-row gap-3">
            <button type="submit" class="flex-1 bg-indigo-600 text-white font-black py-4 rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-100 text-sm">
                <i class="fas fa-save mr-2"></i>Save Changes
            </button>
            <a href="<?= base_url('admin/users/reset-password/' . $user['id']) ?>"
               class="px-6 py-4 border border-amber-200 text-amber-600 font-black rounded-xl hover:bg-amber-50 transition text-sm text-center">
                <i class="fas fa-key mr-2"></i>Reset Password
            </a>
            <a href="<?= base_url('admin/users') ?>" class="px-6 py-4 border border-slate-200 text-slate-500 font-black rounded-xl hover:bg-slate-50 transition text-sm text-center">
                Cancel
            </a>
        </div>
    </form>
</div>

<!-- Danger Zone -->
<?php if ($user['id'] != session()->get('userId')): ?>
<div class="mt-6 bg-white rounded-[2rem] shadow-sm border border-red-100 p-8">
    <h3 class="font-black text-red-600 text-sm mb-2"><i class="fas fa-exclamation-triangle mr-2"></i>Danger Zone</h3>
    <p class="text-sm text-slate-400 font-bold mb-4">Permanently delete this user account. This action cannot be undone.</p>
    <a href="<?= base_url('admin/users/delete/' . $user['id']) ?>"
       onclick="return confirm('Delete <?= esc($user['full_name'] ?: $user['username']) ?>? This cannot be undone.')"
       class="inline-flex items-center px-5 py-2.5 bg-red-600 text-white font-black text-sm rounded-xl hover:bg-red-700 transition">
        <i class="fas fa-trash mr-2"></i>Delete Account
    </a>
</div>
<?php endif; ?>

</div>

<?= $this->endSection() ?>

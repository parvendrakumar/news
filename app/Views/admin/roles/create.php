<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="flex items-center gap-4 mb-8">
    <a href="<?= base_url('admin/roles') ?>" class="h-10 w-10 flex items-center justify-center rounded-xl bg-slate-100 text-slate-500 hover:bg-slate-200 transition">
        <i class="fas fa-arrow-left text-sm"></i>
    </a>
    <div>
        <h2 class="text-3xl font-black text-slate-800 tracking-tight">Create Role</h2>
        <p class="text-slate-400 font-bold text-sm">Define a new access level for your team</p>
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

<div class="max-w-xl">
<div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-8">
    <form action="<?= base_url('admin/roles/store') ?>" method="POST" class="space-y-6">
        <?= csrf_field() ?>

        <div>
            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Role Name <span class="text-red-500">*</span></label>
            <input type="text" name="name" value="<?= old('name') ?>"
                   class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-300 outline-none transition text-sm font-bold text-slate-700"
                   placeholder="e.g. Sub-Editor" required>
        </div>

        <div>
            <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Permissions</label>
            <div class="grid grid-cols-2 gap-3">
                <?php
                $allPerms = [
                    'news'       => 'News Management',
                    'categories' => 'Categories',
                    'comments'   => 'Comments',
                    'users'      => 'User Management',
                    'settings'   => 'Site Settings',
                    'media'      => 'Media Upload',
                ];
                foreach ($allPerms as $key => $label): ?>
                <label class="flex items-center gap-3 p-3 rounded-xl border border-slate-100 bg-slate-50 hover:bg-indigo-50 hover:border-indigo-200 cursor-pointer transition has-[:checked]:bg-indigo-50 has-[:checked]:border-indigo-300">
                    <input type="checkbox" name="permissions[<?= $key ?>]" value="1"
                           class="h-4 w-4 rounded text-indigo-600 accent-indigo-600">
                    <span class="text-sm font-bold text-slate-600"><?= $label ?></span>
                </label>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="pt-2 flex gap-3">
            <button type="submit" class="flex-1 bg-indigo-600 text-white font-black py-4 rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-100 text-sm">
                <i class="fas fa-shield-alt mr-2"></i>Create Role
            </button>
            <a href="<?= base_url('admin/roles') ?>" class="px-6 py-4 border border-slate-200 text-slate-500 font-black rounded-xl hover:bg-slate-50 transition text-sm">
                Cancel
            </a>
        </div>
    </form>
</div>
</div>

<?= $this->endSection() ?>

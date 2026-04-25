<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
    <div>
        <h2 class="text-3xl font-black text-slate-800 tracking-tight">Role Management</h2>
        <p class="text-slate-400 font-bold text-sm mt-1">Define access levels for your team</p>
    </div>
    <div class="flex items-center gap-3">
        <a href="<?= base_url('admin/users') ?>" class="flex-1 md:flex-none border border-slate-200 text-slate-600 px-5 py-2.5 rounded-xl font-black text-xs hover:bg-slate-50 transition flex items-center justify-center">
            <i class="fas fa-users mr-2"></i> MEMBERS
        </a>
        <a href="<?= base_url('admin/roles/create') ?>" class="flex-1 md:flex-none bg-indigo-600 text-white px-6 py-2.5 rounded-xl font-black text-xs hover:bg-indigo-700 transition shadow-lg shadow-indigo-100 flex items-center justify-center">
            <i class="fas fa-plus mr-2"></i> NEW ROLE
        </a>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
    <?php foreach ($roles as $role):
        $perms = json_decode($role['permissions'] ?? '{}', true) ?: [];
        $badgeColors = ['Admin' => 'bg-red-100 text-red-600 border-red-200', 'Editor' => 'bg-blue-100 text-blue-600 border-blue-200', 'Reporter' => 'bg-green-100 text-green-600 border-green-200'];
        $badgeClass  = $badgeColors[$role['name']] ?? 'bg-slate-100 text-slate-600 border-slate-200';
    ?>
    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm p-4 md:p-6 flex flex-col gap-4 group hover:shadow-md transition">
        <div class="flex items-start justify-between">
            <div>
                <span class="text-[10px] font-black uppercase tracking-widest border px-3 py-1 rounded-lg <?= $badgeClass ?>">
                    <?= esc($role['name']) ?>
                </span>
                <div class="mt-3 text-2xl font-black text-slate-800"><?= $role['user_count'] ?>
                    <span class="text-sm font-bold text-slate-400">member<?= $role['user_count'] != 1 ? 's' : '' ?></span>
                </div>
            </div>
            <div class="h-10 w-10 bg-slate-100 rounded-xl flex items-center justify-center text-slate-400">
                <i class="fas fa-shield-alt"></i>
            </div>
        </div>

        <!-- Permissions preview -->
        <div class="flex-1">
            <?php if (!empty($perms)): ?>
            <div class="flex flex-wrap gap-1.5">
                <?php foreach (array_slice((array)$perms, 0, 6) as $perm => $val): ?>
                    <span class="text-[10px] font-black uppercase tracking-wide bg-slate-100 text-slate-500 px-2.5 py-1 rounded-lg"><?= esc($perm) ?></span>
                <?php endforeach; ?>
            </div>
            <?php else: ?>
            <span class="text-xs text-slate-300 font-bold italic">No permissions defined</span>
            <?php endif; ?>
        </div>

        <div class="flex gap-2 pt-2 border-t border-slate-100 md:opacity-0 md:group-hover:opacity-100 transition">
            <a href="<?= base_url('admin/roles/edit/' . $role['id']) ?>"
               class="flex-1 py-2 text-center text-xs font-black text-indigo-600 bg-indigo-50 rounded-xl hover:bg-indigo-100 transition">
                <i class="fas fa-pen mr-1"></i> Edit
            </a>
            <?php if ($role['user_count'] == 0): ?>
            <a href="<?= base_url('admin/roles/delete/' . $role['id']) ?>"
               onclick="return confirm('Delete role \'<?= esc($role['name']) ?>\'?')"
               class="flex-1 py-2 text-center text-xs font-black text-red-600 bg-red-50 rounded-xl hover:bg-red-100 transition">
                <i class="fas fa-trash mr-1"></i> Delete
            </a>
            <?php else: ?>
            <span class="flex-1 py-2 text-center text-xs font-black text-slate-300 bg-slate-50 rounded-xl cursor-not-allowed" title="Cannot delete: users assigned">
                <i class="fas fa-lock mr-1"></i> In Use
            </span>
            <?php endif; ?>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?= $this->endSection() ?>

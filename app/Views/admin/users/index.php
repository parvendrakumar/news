<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
    <div>
        <h2 class="text-3xl font-black text-slate-800 tracking-tight">Team Management</h2>
        <p class="text-slate-400 font-bold text-sm mt-1">Manage staff accounts, roles & permissions</p>
    </div>
    <div class="flex items-center gap-3">
        <a href="<?= base_url('admin/users/bulk-upload') ?>" class="border border-slate-200 text-slate-600 px-5 py-2.5 rounded-xl font-black text-xs hover:bg-slate-50 transition flex items-center">
            <i class="fas fa-file-upload mr-2"></i> BULK UPLOAD
        </a>
        <a href="<?= base_url('admin/roles') ?>" class="border border-slate-200 text-slate-600 px-5 py-2.5 rounded-xl font-black text-xs hover:bg-slate-50 transition flex items-center">
            <i class="fas fa-shield-alt mr-2"></i> ROLES
        </a>
        <a href="<?= base_url('admin/users/create') ?>" class="bg-indigo-600 text-white px-6 py-2.5 rounded-xl font-black text-xs hover:bg-indigo-700 transition shadow-lg shadow-indigo-100 flex items-center">
            <i class="fas fa-user-plus mr-2"></i> NEW MEMBER
        </a>
    </div>
</div>

<!-- Filters -->
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4 mb-6">
    <form method="GET" action="" class="flex flex-col sm:flex-row gap-3">
        <div class="flex-1 relative">
            <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 text-sm"></i>
            <input type="text" name="search" value="<?= esc($search ?? '') ?>"
                   placeholder="Search by name, username or email…"
                   class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-100 rounded-xl text-sm font-bold text-slate-600 focus:outline-none focus:bg-white focus:border-indigo-300 transition">
        </div>
        <select name="role" class="px-4 py-2.5 bg-slate-50 border border-slate-100 rounded-xl text-sm font-bold text-slate-600 focus:outline-none focus:bg-white focus:border-indigo-300 transition">
            <option value="">All Roles</option>
            <?php foreach ($roles as $r): ?>
                <option value="<?= $r['id'] ?>" <?= ($role ?? '') == $r['id'] ? 'selected' : '' ?>><?= esc($r['name']) ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit" class="px-6 py-2.5 bg-slate-800 text-white rounded-xl text-xs font-black hover:bg-slate-700 transition">FILTER</button>
        <?php if (!empty($search) || !empty($role)): ?>
            <a href="<?= base_url('admin/users') ?>" class="px-4 py-2.5 border border-slate-200 text-slate-500 rounded-xl text-xs font-black hover:bg-slate-50 transition">CLEAR</a>
        <?php endif; ?>
    </form>
</div>

<div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
    <?php if (empty($users)): ?>
        <div class="text-center py-24">
            <div class="h-16 w-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-users text-slate-300 text-2xl"></i>
            </div>
            <p class="font-black text-slate-400 text-sm">No users found</p>
            <a href="<?= base_url('admin/users/create') ?>" class="mt-4 inline-block text-indigo-600 font-bold text-sm hover:underline">Create the first user →</a>
        </div>
    <?php else: ?>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-slate-50/50 border-b border-slate-100">
                <tr>
                    <th class="px-4 md:px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Member</th>
                    <th class="hidden md:table-cell px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Email</th>
                    <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Role</th>
                    <th class="hidden sm:table-cell px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Status</th>
                    <th class="hidden lg:table-cell px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Joined</th>
                    <th class="px-6 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                <?php foreach ($users as $u): ?>
                <?php
                    $colors = ['bg-indigo-100 text-indigo-600', 'bg-emerald-100 text-emerald-600', 'bg-amber-100 text-amber-600', 'bg-pink-100 text-pink-600', 'bg-sky-100 text-sky-600'];
                    $colorClass = $colors[$u['id'] % count($colors)];
                    $isSelf = $u['id'] == session()->get('userId');
                ?>
                <tr class="hover:bg-slate-50/50 transition group">
                    <td class="px-4 md:px-8 py-5">
                        <div class="flex items-center gap-4">
                            <div class="h-10 w-10 <?= $colorClass ?> rounded-xl flex items-center justify-center font-black text-sm flex-shrink-0">
                                <?= strtoupper(substr($u['full_name'] ?: $u['username'], 0, 1)) ?>
                            </div>
                            <div>
                                <div class="font-black text-slate-800 text-sm leading-tight">
                                    <?= esc($u['full_name'] ?: '—') ?>
                                    <?php if ($isSelf): ?>
                                        <span class="ml-2 text-[9px] bg-indigo-100 text-indigo-600 px-2 py-0.5 rounded-full font-black uppercase tracking-widest">You</span>
                                    <?php endif; ?>
                                </div>
                                <div class="text-xs text-slate-400 font-bold">@<?= esc($u['username']) ?></div>
                                <div class="md:hidden text-[10px] font-bold text-blue-500 mt-0.5"><?= esc($u['email']) ?></div>
                            </div>
                        </div>
                    </td>
                    <td class="hidden md:table-cell px-6 py-5 text-sm font-bold text-slate-500"><?= esc($u['email']) ?></td>
                    <td class="px-6 py-5">
                        <span class="text-[10px] font-black uppercase tracking-widest border px-3 py-1 rounded-lg
                            <?= $u['role_name'] == 'Admin' ? 'text-red-600 border-red-200 bg-red-50' : 'text-slate-500 border-slate-200 bg-white' ?>">
                            <?= esc($u['role_name'] ?? '—') ?>
                        </span>
                    </td>
                    <td class="hidden sm:table-cell px-6 py-5 text-center">
                        <?php if (!$isSelf): ?>
                        <a href="<?= base_url('admin/users/toggle-status/' . $u['id']) ?>" title="Toggle Status" class="inline-flex items-center gap-2 text-[10px] font-black uppercase tracking-widest hover:opacity-70 transition <?= ($u['status'] ?? 'active') == 'active' ? 'text-green-600' : 'text-slate-400' ?>">
                            <span class="h-2 w-2 rounded-full <?= ($u['status'] ?? 'active') == 'active' ? 'bg-green-500' : 'bg-slate-300' ?>"></span>
                            <?= ucfirst($u['status'] ?? 'active') ?>
                        </a>
                        <?php else: ?>
                        <span class="inline-flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-green-600">
                            <span class="h-2 w-2 rounded-full bg-green-500"></span>Active
                        </span>
                        <?php endif; ?>
                    </td>
                    <td class="hidden lg:table-cell px-6 py-5 text-xs font-bold text-slate-400"><?= date('M d, Y', strtotime($u['created_at'])) ?></td>
                    <td class="px-6 py-5 text-right">
                        <div class="inline-flex items-center gap-2 md:opacity-0 md:group-hover:opacity-100 transition">
                            <a href="<?= base_url('admin/users/edit/' . $u['id']) ?>" title="Edit"
                               class="h-8 w-8 flex items-center justify-center rounded-lg bg-slate-100 text-slate-500 hover:bg-indigo-100 hover:text-indigo-600 transition text-xs">
                                <i class="fas fa-pen"></i>
                            </a>
                            <a href="<?= base_url('admin/users/reset-password/' . $u['id']) ?>" title="Reset Password"
                               class="h-8 w-8 flex items-center justify-center rounded-lg bg-slate-100 text-slate-500 hover:bg-amber-100 hover:text-amber-600 transition text-xs">
                                <i class="fas fa-key"></i>
                            </a>
                            <?php if (!$isSelf): ?>
                            <a href="<?= base_url('admin/users/delete/' . $u['id']) ?>" title="Delete"
                               onclick="return confirm('Delete this user? This action cannot be undone.')"
                               class="h-8 w-8 flex items-center justify-center rounded-lg bg-slate-100 text-slate-500 hover:bg-red-100 hover:text-red-600 transition text-xs">
                                <i class="fas fa-trash"></i>
                            </a>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php if ($pager): ?>
    <div class="px-8 py-5 border-t border-slate-100 text-sm">
        <?= $pager->links() ?>
    </div>
    <?php endif; ?>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>

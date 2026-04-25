<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="mb-8">
    <h2 class="text-3xl font-black text-slate-800 tracking-tight">Email Subscribers</h2>
    <p class="text-slate-400 font-bold text-sm">Manage your growing newsletter audience</p>
</div>

<div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-slate-50/50 border-b border-slate-100">
                <tr>
                    <th class="px-4 md:px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Subscriber Email</th>
                    <th class="px-4 md:px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Joined Date</th>
                    <th class="px-4 md:px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Status</th>
                    <th class="px-4 md:px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                <?php foreach ($subscribers as $item): ?>
                <tr class="hover:bg-slate-50/50 transition">
                    <td class="px-4 md:px-8 py-6">
                        <div class="font-black text-slate-800 tracking-tight text-sm"><?= $item['email'] ?></div>
                    </td>
                    <td class="px-8 py-6 text-xs font-bold text-slate-400">
                        <?= date('d M, Y', strtotime($item['created_at'])) ?>
                    </td>
                    <td class="px-4 md:px-8 py-6">
                        <span class="px-3 py-1 bg-purple-50 text-purple-600 rounded-lg text-[10px] font-black uppercase tracking-widest border border-purple-100">
                            Active
                        </span>
                    </td>
                    <td class="px-8 py-6 text-center">
                        <a href="<?= base_url('admin/subscribers/delete/' . $item['id']) ?>" onclick="return confirm('Remove this subscriber?')" class="h-9 w-9 inline-flex bg-red-50 text-red-600 rounded-xl items-center justify-center hover:bg-red-600 hover:text-white transition">
                            <i class="fas fa-user-minus text-xs"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($subscribers)): ?>
                <tr>
                    <td colspan="4" class="px-8 py-20 text-center text-slate-300 font-bold italic">No subscribers yet. Keep building your audience!</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>

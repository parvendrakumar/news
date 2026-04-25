<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="mb-8">
    <h2 class="text-3xl font-black text-slate-800 tracking-tight">Contact Messages</h2>
    <p class="text-slate-400 font-bold text-sm">Review inquiries and feedback from your readers</p>
</div>

<div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-slate-50/50 border-b border-slate-100">
                <tr>
                    <th class="px-4 md:px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Sender Info</th>
                    <th class="px-4 md:px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Message Segment</th>
                    <th class="px-4 md:px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Date</th>
                    <th class="px-4 md:px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                <?php foreach ($messages as $item): ?>
                <tr class="hover:bg-slate-50/50 transition">
                    <td class="px-4 md:px-8 py-6">
                        <div class="font-black text-slate-800 tracking-tight text-sm"><?= $item['name'] ?></div>
                        <div class="text-[10px] font-bold text-blue-500 mt-1 uppercase tracking-tighter italic"><?= $item['email'] ?></div>
                    </td>
                    <td class="px-8 py-6 max-w-md">
                        <div class="text-[11px] font-bold text-slate-600 line-clamp-2 leading-relaxed">
                            <span class="text-slate-900 font-black uppercase text-[10px] block mb-1">Subject: <?= esc($item['subject'] ?? 'General Inquiry') ?></span>
                            <?= esc($item['message']) ?>
                        </div>
                    </td>
                    <td class="px-8 py-6 text-xs font-bold text-slate-400">
                        <?= date('d M, Y', strtotime($item['created_at'])) ?>
                    </td>
                    <td class="px-8 py-6 text-center">
                        <div class="flex items-center justify-center space-x-2">
                             <!-- Simple View Logic could go here -->
                            <a href="<?= base_url('admin/contact-messages/delete/' . $item['id']) ?>" onclick="return confirm('Archive/Delete this message?')" class="h-9 w-9 bg-red-50 text-red-600 rounded-xl flex items-center justify-center hover:bg-red-600 hover:text-white transition shadow-sm">
                                <i class="fas fa-trash-alt text-xs"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($messages)): ?>
                <tr>
                    <td colspan="4" class="px-8 py-20 text-center text-slate-300 font-bold italic">Inbox is currently empty.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>

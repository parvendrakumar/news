<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="dashboard-modern-wrapper">
    <!-- Header Strategy -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Compose <span class="text-red-600">Notification</span></h1>
            <p class="text-slate-500 font-medium">Create and dispatch alerts to specific users or your entire audience.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="<?= base_url('admin/notifications') ?>" class="px-6 py-3 bg-white border border-slate-100 text-slate-400 rounded-2xl font-black text-xs uppercase tracking-widest hover:text-red-600 transition-all flex items-center gap-2 shadow-sm">
                <i class="fas fa-arrow-left"></i> Back to Center
            </a>
        </div>
    </div>

    <div class="max-w-4xl">
        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
            <div class="p-8 border-b border-slate-50 bg-slate-50/50">
                <h3 class="font-black text-slate-800 uppercase tracking-widest text-xs">Message Configuration</h3>
            </div>
            
            <div class="p-8 md:p-12">
                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="mb-8 p-4 bg-red-50 border border-red-100 text-red-600 rounded-2xl font-bold flex flex-col gap-1">
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <div class="flex items-center gap-2"><i class="fas fa-exclamation-circle text-xs"></i> <?= $error ?></div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('admin/notifications/store') ?>" method="POST" class="space-y-8">
                    <?= csrf_field() ?>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Target Recipient</label>
                        <select name="user_id" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold text-slate-800 focus:ring-2 focus:ring-red-500 transition-all appearance-none cursor-pointer">
                            <option value="all">Broadcast to ALL Active Users</option>
                            <?php foreach ($users as $user): ?>
                                <option value="<?= $user['id'] ?>"><?= esc($user['full_name']) ?> (<?= esc($user['email']) ?>)</option>
                            <?php endforeach; ?>
                        </select>
                        <p class="text-[10px] text-slate-400 font-medium ml-1 mt-2 tracking-wide italic">* Selecting "ALL Users" will trigger a system-wide alert.</p>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Notification Title</label>
                        <input type="text" name="title" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold text-slate-800 focus:ring-2 focus:ring-red-500 transition-all placeholder:text-slate-300" placeholder="e.g. Welcome to the Platform!" value="<?= old('title') ?>" required>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Detailed Message</label>
                        <textarea name="message" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 font-bold text-slate-800 focus:ring-2 focus:ring-red-500 transition-all placeholder:text-slate-300" rows="5" placeholder="Describe the notification in detail..." required><?= old('message') ?></textarea>
                    </div>

                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Alert Classification</label>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <label class="relative cursor-pointer group">
                                <input type="radio" name="type" value="info" class="hidden peer" checked>
                                <div class="px-4 py-3 rounded-xl border-2 border-transparent bg-slate-50 text-slate-400 font-black text-[10px] uppercase tracking-widest text-center peer-checked:border-blue-500 peer-checked:bg-blue-50 peer-checked:text-blue-600 transition-all">
                                    Info (Blue)
                                </div>
                            </label>
                            <label class="relative cursor-pointer group">
                                <input type="radio" name="type" value="success" class="hidden peer">
                                <div class="px-4 py-3 rounded-xl border-2 border-transparent bg-slate-50 text-slate-400 font-black text-[10px] uppercase tracking-widest text-center peer-checked:border-green-500 peer-checked:bg-green-50 peer-checked:text-green-600 transition-all">
                                    Success (Green)
                                </div>
                            </label>
                            <label class="relative cursor-pointer group">
                                <input type="radio" name="type" value="warning" class="hidden peer">
                                <div class="px-4 py-3 rounded-xl border-2 border-transparent bg-slate-50 text-slate-400 font-black text-[10px] uppercase tracking-widest text-center peer-checked:border-amber-500 peer-checked:bg-amber-50 peer-checked:text-amber-600 transition-all">
                                    Warning (Yellow)
                                </div>
                            </label>
                            <label class="relative cursor-pointer group">
                                <input type="radio" name="type" value="error" class="hidden peer">
                                <div class="px-4 py-3 rounded-xl border-2 border-transparent bg-slate-50 text-slate-400 font-black text-[10px] uppercase tracking-widest text-center peer-checked:border-red-500 peer-checked:bg-red-50 peer-checked:text-red-600 transition-all">
                                    Priority (Red)
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="pt-10 border-t border-slate-50 flex items-center justify-between">
                        <button type="submit" class="px-10 py-4 bg-red-600 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-slate-900 transition-all shadow-lg shadow-red-100 flex items-center gap-3">
                            <i class="fas fa-paper-plane"></i> Dispatch Notification
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="mb-8">
    <h2 class="text-3xl font-black text-slate-800 tracking-tight">Invite Team Member</h2>
    <p class="text-slate-400 font-bold text-sm">Send an automated invitation with login credentials</p>
</div>

<div class="max-w-3xl">
    <form action="<?= base_url('admin/users/invite') ?>" method="POST" class="space-y-6">
        <?= csrf_field() ?>
        
        <?php if (session()->get('errors')): ?>
            <div class="bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-2xl mb-6">
                <ul class="list-disc list-inside text-xs font-bold uppercase tracking-widest">
                    <?php foreach (session()->get('errors') as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-8 md:p-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Full Name</label>
                    <input type="text" name="full_name" value="<?= old('full_name') ?>" placeholder="e.g. John Doe" required
                           class="w-full px-6 py-4 rounded-2xl border border-slate-200 focus:border-red-500 outline-none font-bold text-slate-700 transition-all shadow-sm">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Email Address</label>
                    <input type="email" name="email" value="<?= old('email') ?>" placeholder="john@example.com" required
                           class="w-full px-6 py-4 rounded-2xl border border-slate-200 focus:border-red-500 outline-none font-bold text-slate-700 transition-all shadow-sm">
                </div>

                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Assign Role</label>
                    <select name="role_id" required
                            class="w-full px-6 py-4 rounded-2xl border border-slate-200 focus:border-red-500 outline-none font-bold text-slate-700 transition-all shadow-sm appearance-none cursor-pointer">
                        <?php foreach($roles as $role): ?>
                            <option value="<?= $role['id'] ?>" <?= strtolower($role['name']) == 'user' ? 'selected' : '' ?>><?= $role['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="flex items-center">
                    <div class="bg-blue-50 p-4 rounded-2xl flex items-start gap-3 border border-blue-100">
                        <i class="fas fa-info-circle text-blue-500 mt-1"></i>
                        <p class="text-[10px] font-bold text-blue-700 leading-relaxed uppercase tracking-wider">
                            The system will automatically generate a secure password and send it to the user's email.
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-10 pt-8 border-t border-slate-50 flex items-center justify-between">
                <a href="<?= base_url('admin/users') ?>" class="text-slate-400 font-black text-xs uppercase tracking-widest hover:text-slate-600 transition">
                    <i class="fas fa-arrow-left mr-2"></i> Cancel
                </a>
                <button type="submit" class="bg-red-600 text-white px-10 py-4 rounded-2xl font-black hover:bg-red-700 transition shadow-xl shadow-red-200 uppercase text-xs tracking-widest flex items-center">
                    <i class="fas fa-paper-plane mr-2"></i> Send Invitation
                </button>
            </div>
        </div>
    </form>
</div>

<?= $this->endSection() ?>

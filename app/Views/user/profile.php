<?= $this->extend('user/layout') ?>

<?= $this->section('content') ?>

<div class="mb-10 animate-in fade-in slide-in-from-bottom-4 duration-700">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm shadow-slate-100">
        <div class="space-y-2">
            <h1 class="text-4xl font-black text-slate-800 tracking-tighter">My <span class="text-indigo-600">Profile</span></h1>
            <p class="text-slate-400 font-bold text-sm uppercase tracking-widest flex items-center gap-2">
                Manage your identity and subscription preferences
            </p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <div class="lg:col-span-8">
        <div class="bg-white p-8 md:p-10 rounded-[2.5rem] border border-slate-100 shadow-sm">
            <?php if (session()->getFlashdata('success')): ?>
                <div class="mb-8 p-4 bg-green-50 border border-green-100 text-green-700 rounded-2xl font-bold flex items-center gap-3">
                    <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="mb-8 p-4 bg-red-50 border border-red-100 text-red-700 rounded-2xl font-bold">
                    <?php foreach(session()->getFlashdata('errors') as $error): ?>
                        <p class="flex items-center gap-3"><i class="fas fa-exclamation-circle text-sm"></i> <?= $error ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('user/profile/update') ?>" method="POST" class="space-y-8">
                <?= csrf_field() ?>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-3">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest px-1">Full Name</label>
                        <div class="relative">
                            <i class="fas fa-user absolute left-5 top-1/2 -translate-y-1/2 text-slate-300"></i>
                            <input type="text" name="full_name" value="<?= esc($user['full_name']) ?>" class="w-full pl-12 pr-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:bg-white focus:border-indigo-500 outline-none font-bold text-slate-700 transition" placeholder="Your Name">
                        </div>
                    </div>
                    <div class="space-y-3">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest px-1">Email Address</label>
                        <div class="relative">
                            <i class="fas fa-envelope absolute left-5 top-1/2 -translate-y-1/2 text-slate-300"></i>
                            <input type="email" name="email" value="<?= esc($user['email']) ?>" class="w-full pl-12 pr-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:bg-white focus:border-indigo-500 outline-none font-bold text-slate-700 transition" placeholder="name@example.com">
                        </div>
                    </div>
                </div>

                <div class="pt-6 border-t border-slate-50">
                    <button type="submit" class="px-10 py-4 bg-slate-800 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-indigo-600 transition shadow-xl shadow-slate-100">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="lg:col-span-4 space-y-8">
        <div class="bg-indigo-900 p-8 rounded-[2.5rem] shadow-2xl relative overflow-hidden group">
            <div class="relative z-10">
                <h3 class="text-white font-black text-xl mb-2">Account Status</h3>
                <p class="text-indigo-300 text-sm font-bold mb-6">Your member account is fully verified and active.</p>
                
                <div class="space-y-4">
                    <div class="flex items-center justify-between text-xs py-3 border-b border-white/10">
                        <span class="text-indigo-200 font-bold uppercase tracking-widest">Joined</span>
                        <span class="text-white font-black"><?= date('M d, Y', strtotime($user['created_at'])) ?></span>
                    </div>
                    <div class="flex items-center justify-between text-xs py-3 border-b border-white/10">
                        <span class="text-indigo-200 font-bold uppercase tracking-widest">Type</span>
                        <span class="text-white font-black uppercase">Subscriber</span>
                    </div>
                </div>
            </div>
            <i class="fas fa-shield-check absolute -right-4 -bottom-4 text-9xl text-white/5 group-hover:rotate-12 transition"></i>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

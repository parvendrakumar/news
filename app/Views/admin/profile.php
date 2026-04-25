<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="max-w-4xl mx-auto">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Admin <span class="text-red-600">Profile</span></h1>
            <p class="text-slate-500 font-medium">Manage your personal information and security settings.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Sidebar Info -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white rounded-[2rem] border border-slate-100 p-8 shadow-sm flex flex-col items-center group">
                <div class="relative mb-6">
                    <div class="h-32 w-32 rounded-[2.5rem] bg-slate-100 overflow-hidden border-4 border-white shadow-xl group-hover:scale-105 transition-transform duration-500">
                        <?php if ($user['avatar']): ?>
                            <img src="<?= base_url('uploads/avatars/' . $user['avatar']) ?>" class="h-full w-full object-cover">
                        <?php else: ?>
                            <div class="h-full w-full flex items-center justify-center bg-red-50 text-red-600 text-4xl font-black">
                                <?= substr($user['full_name'], 0, 1) ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <label for="avatarInput" class="absolute -bottom-2 -right-2 h-10 w-10 bg-slate-900 text-white rounded-2xl flex items-center justify-center cursor-pointer hover:bg-red-600 transition-colors shadow-lg border-4 border-white">
                        <i class="fas fa-camera text-sm"></i>
                    </label>
                </div>
                <h3 class="text-xl font-black text-slate-800 tracking-tight"><?= esc($user['full_name']) ?></h3>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1"><?= esc($user['username']) ?></p>
                <div class="mt-4 px-3 py-1 bg-red-50 text-red-600 text-[10px] font-black uppercase tracking-widest rounded-full">Administrator</div>
            </div>

            <div class="bg-slate-900 rounded-[2rem] p-8 text-white shadow-xl shadow-slate-900/20">
                <h4 class="font-black text-sm uppercase tracking-widest text-slate-500 mb-6">Account Stats</h4>
                <div class="space-y-6">
                    <div class="flex justify-between items-center">
                        <span class="text-xs font-bold text-slate-400">Joined Date</span>
                        <span class="text-xs font-black"><?= date('M d, Y', strtotime($user['created_at'])) ?></span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-xs font-bold text-slate-400">Status</span>
                        <span class="text-[10px] font-black px-2 py-1 bg-green-500/20 text-green-400 rounded-lg">ACTIVE</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Settings -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Basic Info Form -->
            <div class="bg-white rounded-[2rem] border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden">
                <div class="p-8 border-b border-slate-50">
                    <h3 class="font-black text-xl text-slate-900 tracking-tight">Basic <span class="text-red-600">Information</span></h3>
                </div>
                <div class="p-8">
                    <form action="<?= base_url('admin/profile/update') ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
                        <?= csrf_field() ?>
                        <input type="file" id="avatarInput" name="avatar" class="hidden" onchange="previewImage(this)">
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Username</label>
                                <input type="text" value="<?= esc($user['username']) ?>" disabled class="w-full h-12 px-4 bg-slate-50 border border-slate-100 rounded-xl text-slate-400 font-bold focus:outline-none cursor-not-allowed">
                            </div>
                            <div>
                                <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Full Name</label>
                                <input type="text" name="full_name" value="<?= esc($user['full_name']) ?>" class="w-full h-12 px-4 bg-white border border-slate-200 rounded-xl text-slate-800 font-bold focus:border-red-600 focus:ring-4 focus:ring-red-600/5 transition-all outline-none" required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Email Address</label>
                            <input type="email" name="email" value="<?= esc($user['email']) ?>" class="w-full h-12 px-4 bg-white border border-slate-200 rounded-xl text-slate-800 font-bold focus:border-red-600 focus:ring-4 focus:ring-red-600/5 transition-all outline-none" required>
                        </div>

                        <div class="pt-4">
                            <button type="submit" class="h-12 px-8 bg-slate-900 text-white rounded-xl text-sm font-black hover:bg-red-600 transition-all shadow-lg shadow-slate-900/10 hover:shadow-red-600/30">Save Profile Updates</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Password Change -->
            <div class="bg-white rounded-[2rem] border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden">
                <div class="p-8 border-b border-slate-50">
                    <h3 class="font-black text-xl text-slate-900 tracking-tight">Security <span class="text-red-600">Settings</span></h3>
                </div>
                <div class="p-8">
                    <form action="<?= base_url('admin/profile/password') ?>" method="POST" class="space-y-6">
                        <?= csrf_field() ?>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">New Password</label>
                                <input type="password" name="password" placeholder="••••••••" class="w-full h-12 px-4 bg-white border border-slate-200 rounded-xl text-slate-800 font-bold focus:border-red-600 focus:ring-4 focus:ring-red-600/5 transition-all outline-none" required>
                            </div>
                            <div>
                                <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Confirm Password</label>
                                <input type="password" name="password_confirm" placeholder="••••••••" class="w-full h-12 px-4 bg-white border border-slate-200 rounded-xl text-slate-800 font-bold focus:border-red-600 focus:ring-4 focus:ring-red-600/5 transition-all outline-none" required>
                            </div>
                        </div>

                        <div class="pt-4">
                            <button type="submit" class="h-12 px-8 bg-white border-2 border-slate-900 text-slate-900 rounded-xl text-sm font-black hover:bg-slate-900 hover:text-white transition-all">Update Secure Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        // Automatically submit for avatar change if desired, or just preview
        if(confirm('Do you want to upload this avatar?')) {
            input.form.submit();
        }
    }
}
</script>
<?= $this->endSection() ?>

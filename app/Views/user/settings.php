<?= $this->extend('user/layout') ?>

<?= $this->section('content') ?>

<div class="mb-10 animate-in fade-in slide-in-from-bottom-4 duration-700">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm shadow-slate-100">
        <div class="space-y-2">
            <h1 class="text-4xl font-black text-slate-800 tracking-tighter">Account <span class="text-slate-500">Settings</span></h1>
            <p class="text-slate-400 font-bold text-sm uppercase tracking-widest flex items-center gap-2">
                Manage your security and privacy preferences
            </p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <div class="lg:col-span-8 space-y-8">
        <!-- Profile Card (Merged) -->
        <div class="bg-white p-8 md:p-10 rounded-[2.5rem] border border-slate-100 shadow-sm">
            <h3 class="text-xl font-black text-slate-800 tracking-tight mb-8">Personal Information</h3>
            
            <form action="<?= base_url('user/profile/update') ?>" method="POST" enctype="multipart/form-data" class="space-y-8">
                <?= csrf_field() ?>
                
                <!-- Avatar Upload -->
                <div class="flex flex-col md:flex-row items-center gap-8 pb-8 border-b border-slate-50">
                    <div class="relative group">
                        <img id="avatar-preview" src="<?= base_url('uploads/avatars/' . (!empty($user['avatar']) ? $user['avatar'] : 'default.png')) ?>" class="w-24 h-24 rounded-[2rem] object-cover ring-4 ring-slate-50 shadow-xl transition-transform group-hover:scale-105" alt="Avatar">
                        <label for="avatar-input" class="absolute -bottom-2 -right-2 w-8 h-8 bg-red-600 text-white rounded-xl flex items-center justify-center cursor-pointer shadow-lg hover:bg-slate-800 transition">
                            <i class="fas fa-camera text-xs"></i>
                        </label>
                        <input type="file" name="avatar" id="avatar-input" class="hidden" accept="image/*" onchange="previewImage(this)">
                    </div>
                    <div class="text-center md:text-left space-y-1">
                        <h4 class="font-black text-slate-800">Profile Picture</h4>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">JPG, PNG or GIF. Max 2MB.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-3">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest px-1">Full Name</label>
                        <div class="relative">
                            <i class="fas fa-user absolute left-5 top-1/2 -translate-y-1/2 text-slate-300"></i>
                            <input type="text" name="full_name" value="<?= esc($user['full_name']) ?>" class="w-full pl-12 pr-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:bg-white focus:border-red-500 outline-none font-bold text-slate-700 transition" placeholder="Your Name">
                        </div>
                    </div>
                    <div class="space-y-3">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest px-1">Email Address</label>
                        <div class="relative">
                            <i class="fas fa-envelope absolute left-5 top-1/2 -translate-y-1/2 text-slate-300"></i>
                            <input type="email" name="email" value="<?= esc($user['email']) ?>" class="w-full pl-12 pr-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:bg-white focus:border-red-500 outline-none font-bold text-slate-700 transition" placeholder="name@example.com">
                        </div>
                    </div>
                </div>
                <div class="pt-4">
                    <button type="submit" class="px-8 py-3 bg-red-600 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-red-700 transition shadow-lg shadow-red-100">
                        Update Identity
                    </button>
                </div>
            </form>
        </div>

        <!-- Security Card -->
        <div class="bg-white p-8 md:p-10 rounded-[2.5rem] border border-slate-100 shadow-sm">
            <h3 class="text-xl font-black text-slate-800 tracking-tight mb-8">Security & Password</h3>
            
            <form action="<?= base_url('user/settings/password') ?>" method="POST" class="space-y-6">
                <?= csrf_field() ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-3">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest px-1">New Password</label>
                        <div class="relative">
                            <i class="fas fa-lock absolute left-5 top-1/2 -translate-y-1/2 text-slate-300"></i>
                            <input type="password" name="password" class="w-full pl-12 pr-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:bg-white focus:border-slate-300 outline-none font-bold text-slate-700 transition">
                        </div>
                    </div>
                    <div class="space-y-3">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest px-1">Confirm New Password</label>
                        <div class="relative">
                            <i class="fas fa-key absolute left-5 top-1/2 -translate-y-1/2 text-slate-300"></i>
                            <input type="password" name="password_confirm" class="w-full pl-12 pr-6 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:bg-white focus:border-slate-300 outline-none font-bold text-slate-700 transition">
                        </div>
                    </div>
                </div>
                <div class="pt-4">
                    <button type="submit" class="px-8 py-3 bg-slate-800 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-slate-900 transition">
                        Update Security
                    </button>
                </div>
            </form>
        </div>

        <!-- Preferences Card -->
        <div class="bg-white p-8 md:p-10 rounded-[2.5rem] border border-slate-100 shadow-sm">
            <h3 class="text-xl font-black text-slate-800 tracking-tight mb-8">System Preferences</h3>
            <div class="space-y-6">
                <div class="flex items-center justify-between p-6 bg-slate-50 rounded-3xl border border-slate-100">
                    <div>
                        <h4 class="font-black text-slate-800 text-sm">Newsletter</h4>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Receive daily news highlights via email</p>
                    </div>
                    <div class="w-12 h-6 bg-green-500 rounded-full relative p-1 cursor-pointer">
                        <div class="w-4 h-4 bg-white rounded-full absolute right-1"></div>
                    </div>
                </div>

                <div class="flex items-center justify-between p-6 bg-slate-50 rounded-3xl border border-slate-100">
                    <div>
                        <h4 class="font-black text-slate-800 text-sm">Push Notifications</h4>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Get instant alerts for breaking news</p>
                    </div>
                    <div class="w-12 h-6 bg-slate-200 rounded-full relative p-1 cursor-pointer">
                        <div class="w-4 h-4 bg-white rounded-full absolute left-1"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Sidebar -->
    <div class="lg:col-span-4 space-y-8">
        <div class="bg-slate-900 p-8 rounded-[2.5rem] shadow-2xl relative overflow-hidden group">
            <div class="relative z-10">
                <h3 class="text-white font-black text-xl mb-4">Privacy Policy</h3>
                <p class="text-slate-400 text-sm font-bold mb-6 leading-relaxed">Your data is yours. We never share your personal information with third parties.</p>
                <a href="<?= base_url('page/privacy-policy') ?>" class="text-xs font-black text-white uppercase tracking-widest flex items-center gap-2 hover:translate-x-2 transition">
                    Read More
                    <i class="fas fa-chevron-right text-[8px]"></i>
                </a>
            </div>
            <i class="fas fa-lock absolute -right-6 -bottom-6 text-[120px] text-white/5 opacity-10 group-hover:rotate-12 transition duration-700"></i>
        </div>
    </div>
</div>

<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatar-preview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<?= $this->endSection() ?>

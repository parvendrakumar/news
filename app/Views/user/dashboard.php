<?= $this->extend('user/layout') ?>

<?= $this->section('content') ?>

<div class="mb-10 animate-in fade-in slide-in-from-bottom-4 duration-700">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm shadow-slate-100">
        <div class="space-y-2">
            <h1 class="text-4xl font-black text-slate-800 tracking-tighter">Namaste, <span class="text-red-600"><?= explode(' ', session()->get('fullName') ?? 'User')[0] ?>!</span></h1>
            <p class="text-slate-400 font-bold text-sm uppercase tracking-widest flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                Welcome back to your personalized news hub
            </p>
        </div>
        <div class="flex gap-4">
            <div class="bg-slate-50 p-4 rounded-3xl border border-slate-100 min-w-[140px] text-center">
                <span class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Last Login</span>
                <span class="text-slate-800 font-black text-sm"><?= date('H:i, d M', strtotime(session()->get('last_login') ?? 'now')) ?></span>
            </div>
            <div class="bg-red-50 p-4 rounded-3xl border border-red-100 min-w-[140px] text-center">
                <span class="block text-[10px] font-black text-red-400 uppercase tracking-widest mb-1">Membership</span>
                <span class="text-red-800 font-black text-sm italic">Standard</span>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <!-- Quick Stats -->
    <div class="lg:col-span-8 space-y-8">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm hover:shadow-xl transition-all group overflow-hidden relative">
                <div class="relative z-10">
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition duration-500">
                        <i class="fas fa-bookmark text-xl"></i>
                    </div>
                    <div class="text-4xl font-black text-slate-800 mb-1 group-hover:translate-x-2 transition duration-500"><?= $savedStoriesCount ?? 0 ?></div>
                    <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Saved Stories</div>
                </div>
                <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-blue-50/30 rounded-full blur-2xl group-hover:bg-blue-100/50 transition duration-700"></div>
            </div>

            <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm hover:shadow-xl transition-all group overflow-hidden relative">
                <div class="relative z-10">
                    <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition duration-500">
                        <i class="fas fa-comment-alt text-xl"></i>
                    </div>
                    <div class="text-4xl font-black text-slate-800 mb-1 group-hover:translate-x-2 transition duration-500"><?= $discussionsCount ?? 0 ?></div>
                    <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Discussions</div>
                </div>
                <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-indigo-50/30 rounded-full blur-2xl group-hover:bg-indigo-100/50 transition duration-700"></div>
            </div>

            <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm hover:shadow-xl transition-all group overflow-hidden relative">
                <div class="relative z-10">
                    <div class="w-12 h-12 bg-green-50 text-green-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition duration-500">
                        <i class="fas fa-newspaper text-xl"></i>
                    </div>
                    <div class="text-4xl font-black text-slate-800 mb-1 group-hover:translate-x-2 transition duration-500"><?= $newTodayCount ?? 0 ?></div>
                    <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest">New Today</div>
                </div>
                <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-green-50/30 rounded-full blur-2xl group-hover:bg-green-100/50 transition duration-700"></div>
            </div>
        </div>

        <!-- Latest Recommended -->
        <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm">
            <div class="flex items-center justify-between mb-8">
                <h3 class="text-xl font-black text-slate-800 tracking-tight flex items-center gap-3">
                    <i class="fas fa-sparkles text-red-600"></i>
                    Recommended for You
                </h3>
                <?php if (!empty($recommendedNews)): ?>
                    <a href="<?= base_url('user/interests') ?>" class="text-[10px] font-black text-slate-400 uppercase tracking-widest hover:text-blue-600 transition">Update Interests</a>
                <?php endif; ?>
            </div>
            
            <?php if (empty($recommendedNews)): ?>
                <div class="flex flex-col items-center justify-center py-20 text-center space-y-4">
                    <div class="w-20 h-20 bg-slate-50 text-slate-200 rounded-full flex items-center justify-center text-4xl">
                        <i class="fas fa-folder-open"></i>
                    </div>
                    <div>
                        <h4 class="font-black text-slate-800">No Preferences Set</h4>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Select your interests to see personalized news</p>
                    </div>
                    <a href="<?= base_url('user/interests') ?>" class="mt-4 px-8 py-3 bg-slate-800 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-red-600 transition shadow-xl">Set Favorites</a>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <?php foreach ($recommendedNews as $row): ?>
                        <a href="<?= base_url('news/' . $row['slug']) ?>" class="group block bg-slate-50 p-4 rounded-3xl border border-slate-100 hover:border-blue-100 transition shadow-sm hover:shadow-xl hover:shadow-blue-50">
                            <div class="flex gap-4">
                                <img src="<?= base_url('uploads/news/' . ($row['image'] ?: 'default.jpg')) ?>" class="w-24 h-24 rounded-2xl object-cover shadow-sm group-hover:scale-105 transition duration-500" alt="">
                                <div class="flex-1 space-y-2">
                                    <div class="flex items-center justify-between">
                                        <span class="px-2 py-0.5 bg-blue-100 text-blue-600 rounded-full text-[9px] font-black uppercase tracking-tighter">New Update</span>
                                        <span class="text-[9px] font-black text-slate-300"><?= date('d M', strtotime($row['created_at'])) ?></span>
                                    </div>
                                    <h4 class="font-black text-slate-800 text-xs leading-relaxed group-hover:text-blue-600 transition line-clamp-2"><?= esc($row['title']) ?></h4>
                                    <span class="inline-flex items-center gap-1 text-[9px] font-black text-blue-500 uppercase tracking-widest">
                                        Read Now <i class="fas fa-arrow-right text-[7px]"></i>
                                    </span>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- User Profile Summary Sidebar -->
    <div class="lg:col-span-4 space-y-8">
        <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden relative">
            <h3 class="text-xs font-black text-slate-300 uppercase tracking-widest mb-8">Quick Profile</h3>
            
            <div class="flex flex-col items-center text-center space-y-4 mb-8">
                <div class="relative group">
                    <img src="<?= base_url('uploads/avatars/' . (session()->get('avatar') ?: 'default.png')) ?>" class="w-24 h-24 rounded-[2rem] object-cover ring-4 ring-slate-50" alt="Profile">
                    <div class="absolute inset-0 bg-slate-900/40 rounded-[2rem] opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center">
                        <i class="fas fa-camera text-white"></i>
                    </div>
                </div>
                <div>
                    <h4 class="font-black text-slate-800 text-xl leading-tight"><?= session()->get('full_name') ?></h4>
                    <p class="text-slate-400 font-bold text-sm tracking-tight"><?= session()->get('email') ?></p>
                </div>
            </div>
            
            <div class="space-y-4">
                <div class="p-5 bg-slate-50 rounded-2xl border border-slate-100 group hover:border-blue-200 transition">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Email Status</span>
                        <span class="px-2 py-0.5 bg-green-100 text-green-700 rounded-full font-black text-[9px] uppercase tracking-tighter">Verified</span>
                    </div>
                </div>
                
                <a href="<?= base_url('user/profile') ?>" class="block w-full text-center py-4 bg-slate-800 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-slate-950 transition shadow-sm">
                    Manage Account
                </a>
            </div>
        </div>

        <!-- News Subscription Info -->
        <div class="bg-indigo-600 p-8 rounded-[2.5rem] shadow-xl relative overflow-hidden group">
            <h3 class="text-white font-black text-xl mb-4 relative z-10">Premium<br>Access</h3>
            <p class="text-white/60 text-sm font-bold mb-6 relative z-10 leading-relaxed">Get unlimited access to deep investigative stories.</p>
            <button class="bg-white text-indigo-600 px-6 py-3 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-indigo-50 transition relative z-10">Upgrade Now</button>
            <i class="fas fa-award absolute -right-6 -bottom-6 text-[120px] text-white/10 group-hover:rotate-12 transition duration-700"></i>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

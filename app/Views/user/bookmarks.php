<?= $this->extend('user/layout') ?>

<?= $this->section('content') ?>

<div class="mb-10 animate-in fade-in slide-in-from-bottom-4 duration-700">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm shadow-slate-100">
        <div class="space-y-2">
            <h1 class="text-4xl font-black text-slate-800 tracking-tighter">My <span class="text-blue-600">Bookmarks</span></h1>
            <p class="text-slate-400 font-bold text-sm uppercase tracking-widest flex items-center gap-2">
                Stories you've saved for later reading
            </p>
        </div>
    </div>
</div>

<?php if (empty($savedNews) && empty($savedStories)): ?>
    <div class="bg-white p-12 rounded-[2.5rem] border border-slate-100 shadow-sm text-center">
        <div class="w-24 h-24 bg-blue-50 text-blue-200 rounded-full flex items-center justify-center text-4xl mx-auto mb-6">
            <i class="fas fa-bookmark"></i>
        </div>
        <h3 class="text-2xl font-black text-slate-800 mb-2">No Saved Content</h3>
        <p class="text-slate-400 font-bold text-sm uppercase tracking-widest leading-relaxed max-w-md mx-auto mb-8">
            You haven't bookmarked any news or visual stories yet. Explore trending content and save them here.
        </p>
        <a href="<?= base_url() ?>" class="inline-flex items-center gap-3 px-10 py-4 bg-slate-800 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-blue-600 transition shadow-xl shadow-slate-100">
            Explore News
            <i class="fas fa-arrow-right"></i>
        </a>
    </div>
<?php else: ?>
    
    <?php if (!empty($savedNews)): ?>
    <div class="mb-8 ml-4">
        <h2 class="text-xl font-black text-slate-800 flex items-center gap-3">
            <span class="w-8 h-8 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center text-xs"><i class="fas fa-newspaper"></i></span>
            Saved News
        </h2>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
        <?php foreach ($savedNews as $row): ?>
            <a href="<?= base_url('news/' . $row['slug']) ?>" class="group block bg-white p-5 rounded-[2.5rem] border border-slate-100 hover:border-blue-200 transition-all hover:shadow-2xl hover:shadow-blue-50">
                <div class="relative rounded-3xl overflow-hidden mb-6 aspect-video shadow-sm">
                    <img src="<?= base_url('uploads/news/' . ($row['image'] ?: 'default.jpg')) ?>" class="w-full h-full object-cover group-hover:scale-110 transition duration-700" alt="">
                    <div class="absolute top-4 right-4">
                        <div class="w-10 h-10 bg-white/90 backdrop-blur-md text-blue-600 rounded-xl flex items-center justify-center shadow-sm">
                            <i class="fas fa-bookmark"></i>
                        </div>
                    </div>
                </div>
                <div class="space-y-3">
                    <div class="flex items-center gap-2">
                        <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest"><?= date('M d, Y', strtotime($row['created_at'])) ?></span>
                    </div>
                    <h3 class="font-black text-slate-800 text-sm leading-relaxed group-hover:text-blue-600 transition line-clamp-2"><?= esc($row['title']) ?></h3>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <?php if (!empty($savedStories)): ?>
    <div class="mb-8 ml-4">
        <h2 class="text-xl font-black text-slate-800 flex items-center gap-3">
            <span class="w-8 h-8 bg-orange-100 text-orange-600 rounded-lg flex items-center justify-center text-xs"><i class="fas fa-bolt"></i></span>
            Saved Visual Stories
        </h2>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php foreach ($savedStories as $row): ?>
            <a href="<?= base_url('news/' . $row['slug']) ?>" class="group block bg-white p-5 rounded-[2.5rem] border border-slate-100 hover:border-orange-200 transition-all hover:shadow-2xl hover:shadow-orange-50">
                <div class="relative rounded-3xl overflow-hidden mb-6 aspect-video shadow-sm">
                    <img src="<?= base_url('uploads/stories/' . ($row['image'] ?: 'default.jpg')) ?>" class="w-full h-full object-cover group-hover:scale-110 transition duration-700" alt="">
                    <div class="absolute top-4 right-4">
                        <div class="w-10 h-10 bg-white/90 backdrop-blur-md text-orange-600 rounded-xl flex items-center justify-center shadow-sm">
                            <i class="fas fa-bookmark"></i>
                        </div>
                    </div>
                </div>
                <div class="space-y-3">
                    <div class="flex items-center gap-2">
                        <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest"><?= date('M d, Y', strtotime($row['created_at'])) ?></span>
                    </div>
                    <?php 
                        $lang = service('language')->getLocale();
                        $title = ($lang == 'hi') ? $row['title_hi'] : $row['title_en'];
                    ?>
                    <h3 class="font-black text-slate-800 text-sm leading-relaxed group-hover:text-orange-600 transition line-clamp-2"><?= esc($title) ?></h3>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

<?php endif; ?>

<?= $this->endSection() ?>

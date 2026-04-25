<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="mb-10">
    <div class="flex items-center gap-3 mb-2">
        <span class="text-xs font-black text-red-600 bg-red-50 px-3 py-1 rounded-full uppercase tracking-widest">Search Engine Optimization</span>
    </div>
    <h2 class="text-4xl font-black text-slate-800 tracking-tight">Sitemap <span class="text-red-600 italic">Generator</span></h2>
    <p class="text-slate-400 font-bold text-sm mt-2">Manage XML sitemaps for search engine indexing protocols.</p>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="bg-green-100 text-green-700 p-5 rounded-3xl mb-8 font-bold border border-green-200 flex items-center gap-3">
        <i class="fas fa-check-circle text-lg"></i>
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
    
    <!-- Status Card -->
    <div class="lg:col-span-5 bg-white p-10 rounded-[3rem] shadow-sm border border-slate-100 relative overflow-hidden">
        <div class="absolute top-0 right-0 p-8 opacity-5">
            <i class="fas fa-map text-9xl"></i>
        </div>
        
        <div class="relative z-10 space-y-10">
            <div class="flex items-center gap-4">
                <div class="h-12 w-12 bg-orange-50 text-orange-500 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-wave-square"></i>
                </div>
                <h3 class="text-xl font-black text-slate-800">Current Status</h3>
            </div>

            <div class="bg-slate-50 p-6 rounded-3xl border border-slate-100 flex items-center justify-between">
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Last Generated</label>
                    <div class="text-lg font-black text-slate-700">
                        <?= date('M d, Y H:i:s', strtotime($last_generated)) ?>
                    </div>
                </div>
                <div class="h-10 w-10 bg-green-100 text-green-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-calendar-check"></i>
                </div>
            </div>

            <div class="bg-slate-50 p-6 rounded-3xl border border-slate-100">
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Sitemap URL</label>
                <div class="flex items-center gap-3">
                    <input type="text" readonly value="<?= $sitemap_url ?>" 
                           class="flex-1 bg-white border border-slate-200 rounded-xl px-4 py-3 text-xs font-bold text-blue-600">
                    <a href="<?= $sitemap_url ?>" target="_blank" 
                       class="h-11 w-11 bg-white border border-slate-200 text-slate-400 hover:text-blue-600 hover:border-blue-200 rounded-xl flex items-center justify-center transition shadow-sm">
                        <i class="fas fa-external-link-alt"></i>
                    </a>
                </div>
            </div>

            <div class="pt-6 border-t border-slate-100 grid grid-cols-2 gap-4">
                <div>
                    <span class="block text-[10px] font-black text-slate-400 uppercase tracking-widest">Articles Indexed</span>
                    <span class="text-2xl font-black text-slate-800"><?= $news_stats['total'] ?></span>
                </div>
                <div>
                    <span class="block text-[10px] font-black text-slate-400 uppercase tracking-widest">Categories Listed</span>
                    <span class="text-2xl font-black text-slate-800"><?= $news_stats['cats'] ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Generator Action -->
    <div class="lg:col-span-7 bg-white p-12 rounded-[3rem] shadow-sm border border-slate-100 flex flex-col items-center justify-center text-center">
        <div class="mb-8">
            <div class="h-24 w-24 bg-blue-600 text-white rounded-[2rem] flex items-center justify-center shadow-2xl shadow-blue-200 animate-pulse">
                <i class="fas fa-sync-alt text-4xl"></i>
            </div>
        </div>
        
        <h3 class="text-3xl font-black text-slate-800 mb-4">Generate Protocol</h3>
        <p class="text-slate-400 font-bold max-w-sm mx-auto mb-10 leading-relaxed">
            Initiate a full scan of your catalog and static pages to construct an updated XML sitemap for Google Search Console.
        </p>

        <form action="<?= base_url('admin/seo/generate') ?>" method="POST">
            <?= csrf_field() ?>
            <button type="submit" 
                    class="bg-slate-900 text-white px-12 py-5 rounded-3xl font-black hover:bg-black transition shadow-2xl shadow-slate-200 flex items-center gap-3 group uppercase tracking-widest text-sm">
                <i class="fas fa-bolt text-orange-400 group-hover:scale-125 transition"></i>
                Execute Generator
            </button>
        </form>

        <p class="text-[10px] text-slate-400 font-black uppercase mt-10 tracking-[0.2em]">Recommended: Weekly Update</p>
    </div>

</div>

<?= $this->endSection() ?>

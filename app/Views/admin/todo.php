<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="h-[60vh] flex flex-col items-center justify-center text-center">
    <div class="h-32 w-32 bg-slate-100 text-slate-300 rounded-full flex items-center justify-center mb-8 text-5xl">
        <i class="fas fa-tools"></i>
    </div>
    <h2 class="text-4xl font-black text-slate-800 tracking-tight mb-4">Feature Under Construction</h2>
    <p class="text-slate-400 font-bold max-w-md mx-auto leading-relaxed">
        We are currently building this high-fidelity management module to give you full control over your media ecosystem. Stay tuned!
    </p>
    <div class="mt-10 flex space-x-4">
        <a href="<?= base_url('admin/dashboard') ?>" class="bg-slate-800 text-white px-8 py-3 rounded-2xl font-black hover:bg-slate-900 transition shadow-lg">Back to Dashboard</a>
        <div class="bg-red-50 text-red-600 px-8 py-3 rounded-2xl font-black border border-red-100 uppercase tracking-widest text-[11px] flex items-center">
            <span class="h-2 w-2 rounded-full bg-red-600 mr-2 animate-pulse"></span>
            Building Mode Active
        </div>
    </div>
</div>

<?= $this->endSection() ?>

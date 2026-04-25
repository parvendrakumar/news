<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="mb-8">
    <a href="<?= base_url('admin/categories') ?>" class="text-slate-400 font-bold text-sm hover:text-blue-600 transition flex items-center gap-2">
        <i class="fas fa-arrow-left text-xs"></i> BACK TO CATEGORIES
    </a>
    <h2 class="text-3xl font-black text-slate-800 tracking-tight mt-2">Bulk Categories Upload</h2>
    <p class="text-slate-400 font-bold text-sm">Upload multiple news categories at once using a CSV file</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Upload Section -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100 p-8 md:p-12">
            <form action="<?= base_url('admin/categories/bulk-store') ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                
                <div class="mb-8">
                    <label class="block text-sm font-black text-slate-700 uppercase tracking-widest mb-4">Select CSV File</label>
                    <div class="relative group">
                        <div class="absolute inset-0 bg-slate-50 border-2 border-dashed border-slate-200 rounded-3xl group-hover:bg-slate-100 group-hover:border-blue-200 transition-all duration-300"></div>
                        <input type="file" name="csv_file" accept=".csv" required
                               class="relative w-full h-48 opacity-0 cursor-pointer z-10">
                        <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                            <i class="fas fa-cloud-upload-alt text-4xl text-slate-300 group-hover:text-blue-400 group-hover:scale-110 transition-all duration-300 mb-4"></i>
                            <p class="text-slate-400 font-bold text-sm">Click or drag & drop your <span class="text-slate-800">CSV file</span> here</p>
                            <p class="text-slate-300 font-medium text-xs mt-1">Maximum size: 2MB</p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit" class="bg-blue-600 text-white px-10 py-4 rounded-2xl font-black hover:bg-blue-700 transition shadow-xl shadow-blue-200 flex items-center justify-center">
                        <i class="fas fa-upload mr-3 text-xs"></i> START UPLOAD
                    </button>
                    <a href="<?= base_url('admin/categories/bulk-format') ?>" class="bg-slate-100 text-slate-700 px-8 py-4 rounded-2xl font-black hover:bg-slate-200 transition border border-slate-200">
                        <i class="fas fa-download mr-2 text-xs"></i> DOWNLOAD TEMPLATE
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Instructions Section -->
    <div class="lg:col-span-1">
        <div class="bg-slate-900 rounded-[2rem] p-8 text-white h-full relative overflow-hidden shadow-2xl">
            <div class="absolute top-0 right-0 p-8 opacity-10">
                <i class="fas fa-info-circle text-8xl"></i>
            </div>
            
            <h3 class="text-xl font-black mb-6 flex items-center gap-3">
                <span class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-xs">1</span>
                Instructions
            </h3>
            
            <ul class="space-y-6">
                <li class="flex gap-4">
                    <div class="mt-1 text-blue-500"><i class="fas fa-check-circle"></i></div>
                    <div>
                        <p class="font-black text-sm uppercase tracking-wider mb-1">CSV Encoding</p>
                        <p class="text-slate-400 text-sm font-medium leading-relaxed">Save your file as <strong class="text-white">CSV (UTF-8)</strong> to ensure Hindi characters work.</p>
                    </div>
                </li>
                <li class="flex gap-4">
                    <div class="mt-1 text-blue-500"><i class="fas fa-check-circle"></i></div>
                    <div>
                        <p class="font-black text-sm uppercase tracking-wider mb-1">Parent Category</p>
                        <p class="text-slate-400 text-sm font-medium leading-relaxed">Use <strong class="text-white">0</strong> for main categories, or use the parent's ID for subcategories.</p>
                    </div>
                </li>
                <li class="flex gap-4">
                    <div class="mt-1 text-blue-500"><i class="fas fa-check-circle"></i></div>
                    <div>
                        <p class="font-black text-sm uppercase tracking-wider mb-1">Mandatory</p>
                        <p class="text-slate-400 text-sm font-medium leading-relaxed">Slug, Title (HI), and Title (EN) are mandatory.</p>
                    </div>
                </li>
                <li class="flex gap-4">
                    <div class="mt-1 text-blue-500"><i class="fas fa-check-circle"></i></div>
                    <div>
                        <p class="font-black text-sm uppercase tracking-wider mb-1">Sort Order</p>
                        <p class="text-slate-400 text-sm font-medium leading-relaxed">Lower numbers (0, 1, 2) appear first in the menu. Default is <strong class="text-white">0</strong>.</p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="mt-12">
    <h3 class="text-xl font-black text-slate-800 mb-6 uppercase tracking-widest text-center">Main Category IDs (for Subcategories)</h3>
    <div class="flex flex-wrap justify-center gap-3">
        <div class="bg-slate-100 border border-slate-200 px-4 py-2 rounded-xl flex items-center gap-3 shadow-sm">
            <span class="w-8 h-8 bg-slate-900 text-white rounded-lg flex items-center justify-center font-black text-xs">0</span>
            <span class="font-bold text-slate-700 text-sm">Main Level (No Parent)</span>
        </div>
        <?php foreach($parents as $p): ?>
            <div class="bg-white border border-slate-200 px-4 py-2 rounded-xl flex items-center gap-3 shadow-sm">
                <span class="w-8 h-8 bg-blue-600 text-white rounded-lg flex items-center justify-center font-black text-xs"><?= $p['id'] ?></span>
                <span class="font-bold text-slate-700 text-sm"><?= $p['title'] ?></span>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?= $this->endSection() ?>

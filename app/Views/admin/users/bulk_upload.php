<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="mb-8">
    <a href="<?= base_url('admin/users') ?>" class="text-slate-400 font-bold text-sm hover:text-indigo-600 transition flex items-center gap-2">
        <i class="fas fa-arrow-left text-xs"></i> BACK TO TEAM
    </a>
    <h2 class="text-3xl font-black text-slate-800 tracking-tight mt-2">Bulk Member Upload</h2>
    <p class="text-slate-400 font-bold text-sm">Onboard multiple team members at once using a CSV file</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Upload Section -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100 p-8 md:p-12">
            <form action="<?= base_url('admin/users/bulk-store') ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                
                <div class="mb-8">
                    <label class="block text-sm font-black text-slate-700 uppercase tracking-widest mb-4">Select CSV File</label>
                    <div class="relative group">
                        <div class="absolute inset-0 bg-slate-50 border-2 border-dashed border-slate-200 rounded-3xl group-hover:bg-slate-100 group-hover:border-indigo-200 transition-all duration-300"></div>
                        <input type="file" name="csv_file" accept=".csv" required
                               class="relative w-full h-48 opacity-0 cursor-pointer z-10">
                        <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                            <i class="fas fa-cloud-upload-alt text-4xl text-slate-300 group-hover:text-indigo-400 group-hover:scale-110 transition-all duration-300 mb-4"></i>
                            <p class="text-slate-400 font-bold text-sm">Click or drag & drop your <span class="text-slate-800">CSV file</span> here</p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit" class="bg-indigo-600 text-white px-10 py-4 rounded-2xl font-black hover:bg-indigo-700 transition shadow-xl shadow-indigo-100 flex items-center justify-center">
                        <i class="fas fa-upload mr-3 text-xs"></i> START UPLOAD
                    </button>
                    <a href="<?= base_url('admin/users/bulk-format') ?>" class="bg-slate-100 text-slate-700 px-8 py-4 rounded-2xl font-black hover:bg-slate-200 transition border border-slate-100">
                        <i class="fas fa-download mr-2 text-xs"></i> DOWNLOAD TEMPLATE
                    </a>
                </div>
            </form>
        </div>

        <div class="mt-8 bg-white rounded-3xl border border-slate-100 p-6">
            <h4 class="font-black text-slate-800 text-sm uppercase tracking-widest mb-4 flex items-center gap-2">
                <i class="fas fa-id-badge text-indigo-500"></i> Role ID Reference
            </h4>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <?php foreach ($roles as $r): ?>
                <div class="bg-slate-50 p-3 rounded-xl border border-slate-100 text-center">
                    <div class="text-[10px] font-black text-slate-400 uppercase tracking-tighter mb-1"><?= esc($r['name']) ?></div>
                    <div class="text-lg font-black text-indigo-600">ID: <?= $r['id'] ?></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Instructions Section -->
    <div class="lg:col-span-1">
        <div class="bg-slate-900 rounded-[2rem] p-8 text-white h-full relative overflow-hidden shadow-2xl">
            <div class="absolute top-0 right-0 p-8 opacity-10">
                <i class="fas fa-users-cog text-8xl"></i>
            </div>
            
            <h3 class="text-xl font-black mb-6 flex items-center gap-3">
                <span class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center text-xs">1</span>
                Important
            </h3>
            
            <ul class="space-y-6">
                <li class="flex gap-4">
                    <div class="mt-1 text-indigo-500"><i class="fas fa-check-circle"></i></div>
                    <div>
                        <p class="font-black text-sm uppercase tracking-wider mb-1">Uniqueness</p>
                        <p class="text-slate-400 text-sm font-medium leading-relaxed">System will skip existing <strong class="text-white">usernames</strong> and <strong class="text-white">emails</strong> to prevent duplicates.</p>
                    </div>
                </li>
                <li class="flex gap-4">
                    <div class="mt-1 text-indigo-500"><i class="fas fa-check-circle"></i></div>
                    <div>
                        <p class="font-black text-sm uppercase tracking-wider mb-1">Security</p>
                        <p class="text-slate-400 text-sm font-medium leading-relaxed">Default password if left blank is <strong class="text-white">User@123</strong>. All passwords will be securely hashed.</p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

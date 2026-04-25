<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="media-library-wrapper">
    <!-- Header Strategy -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Media <span class="text-indigo-600">Intelligence</span></h1>
            <p class="text-slate-500 font-medium">Centralized asset archival suite.</p>
        </div>
        <div class="flex flex-col sm:flex-row items-center gap-3 w-full md:w-auto">
            <form action="<?= base_url('admin/media') ?>" method="GET" class="relative w-full sm:w-64">
                <input type="text" name="q" value="<?= esc($search) ?>" placeholder="Search assets..." class="w-full bg-white border border-slate-100 rounded-2xl pl-10 pr-4 py-2 text-sm font-bold shadow-sm focus:ring-2 focus:ring-indigo-500 outline-none transition-all">
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 text-xs"></i>
                <?php if($search): ?>
                    <a href="<?= base_url('admin/media') ?>" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-300 hover:text-red-500"><i class="fas fa-times-circle"></i></a>
                <?php endif; ?>
            </form>
            
            <div class="relative group w-full sm:w-auto">
                <button class="w-full sm:w-auto px-6 py-2 bg-indigo-600 text-white rounded-2xl text-sm font-black shadow-lg shadow-indigo-200 hover:bg-slate-900 transition flex items-center justify-center gap-2">
                    <i class="fas fa-cloud-upload-alt"></i> Bulk Actions <i class="fas fa-chevron-down text-[10px] opacity-50"></i>
                </button>
                <div class="absolute right-0 top-full mt-2 w-56 bg-white border border-slate-100 rounded-2xl shadow-xl py-3 hidden group-hover:block z-50">
                    <div class="px-4 py-1 text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Standard Upload</div>
                    <label class="flex items-center gap-3 px-4 py-2 hover:bg-indigo-50 cursor-pointer text-xs font-bold text-slate-600 transition">
                        <i class="fas fa-images text-indigo-500"></i> Choose Files...
                        <form action="<?= base_url('admin/media/upload') ?>" method="POST" enctype="multipart/form-data" class="hidden">
                            <?= csrf_field() ?>
                            <input type="file" name="files[]" multiple onchange="this.form.submit()">
                        </form>
                    </label>
                    <div class="mt-2 px-4 py-1 text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1 border-t border-slate-50 pt-2">Advanced Import</div>
                    <button onclick="document.getElementById('importModal').classList.remove('hidden')" class="w-full flex items-center gap-3 px-4 py-2 hover:bg-indigo-50 cursor-pointer text-xs font-bold text-slate-600 transition">
                        <i class="fas fa-file-csv text-green-500"></i> Bulk URL Import (CSV)
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Bar -->
    <div class="flex items-center gap-6 mb-8 overflow-x-auto pb-2">
        <div class="flex items-center gap-2 bg-white px-4 py-2 rounded-xl border border-slate-100 shadow-sm">
            <span class="text-xs font-black text-slate-400 uppercase tracking-widest">Total Assets:</span>
            <span class="text-sm font-black text-indigo-600"><?= number_format($totalFiles) ?></span>
        </div>
        <div class="flex items-center gap-2 bg-white px-4 py-2 rounded-xl border border-slate-100 shadow-sm">
            <span class="text-xs font-black text-slate-400 uppercase tracking-widest">Storage:</span>
            <span class="text-sm font-black text-slate-800"><?= number_format($totalSize / 1048576, 2) ?> MB</span>
        </div>
        <?php if($search): ?>
        <div class="flex items-center gap-2 bg-indigo-50 px-4 py-2 rounded-xl border border-indigo-100 shadow-sm">
            <span class="text-xs font-black text-indigo-400 uppercase tracking-widest">Search Result:</span>
            <span class="text-sm font-black text-indigo-600">"<?= esc($search) ?>"</span>
        </div>
        <?php endif; ?>
    </div>

    <!-- Asset Grid -->
    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6" id="mediaGrid">
        <?php if(empty($files)): ?>
            <div class="col-span-full py-20 text-center">
                <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-300 text-3xl">
                    <i class="fas fa-folder-open"></i>
                </div>
                <h3 class="text-xl font-black text-slate-800">No assets found</h3>
                <p class="text-slate-400 font-bold">Try adjusting your search or upload new files.</p>
            </div>
        <?php else: ?>
            <?php foreach($files as $file): ?>
            <div class="asset-card group bg-white p-3 rounded-[1.5rem] border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 cursor-pointer" data-name="<?= strtolower($file['name']) ?>">
                <div class="aspect-square rounded-[1rem] overflow-hidden bg-slate-100 mb-3 relative">
                    <img src="<?= $file['url'] ?>" class="h-full w-full object-cover transition duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-indigo-900/60 opacity-0 group-hover:opacity-100 transition flex items-center justify-center gap-2">
                        <button class="h-8 w-8 bg-white text-indigo-600 rounded-lg flex items-center justify-center hover:bg-indigo-600 hover:text-white transition tooltip" onclick="copyToClipboard('<?= $file['url'] ?>')" title="Copy URL">
                            <i class="fas fa-link text-xs"></i>
                        </button>
                        <a href="<?= $file['url'] ?>" target="_blank" class="h-8 w-8 bg-white text-slate-600 rounded-lg flex items-center justify-center hover:bg-slate-900 hover:text-white transition">
                            <i class="fas fa-eye text-xs"></i>
                        </a>
                    </div>
                </div>
                <div class="px-1">
                    <div class="text-[10px] font-black text-slate-800 truncate mb-1"><?= esc($file['name']) ?></div>
                    <div class="flex items-center justify-between">
                        <span class="text-[9px] font-bold text-slate-400"><?= number_format($file['size'] / 1024, 1) ?> KB</span>
                        <span class="text-[9px] font-black text-indigo-500 uppercase tracking-tighter"><?= pathinfo($file['name'], PATHINFO_EXTENSION) ?></span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <?php if($totalPages > 1): ?>
    <div class="mt-12 flex justify-center">
        <div class="flex items-center gap-2 bg-white p-2 rounded-2xl border border-slate-100 shadow-sm">
            <?php if($currentPage > 1): ?>
                <a href="<?= base_url('admin/media?page=' . ($currentPage - 1) . ($search ? '&q='.esc($search) : '')) ?>" class="h-10 px-4 flex items-center justify-center rounded-xl text-xs font-black text-slate-600 hover:bg-slate-50 transition border border-transparent hover:border-slate-100">
                    <i class="fas fa-chevron-left mr-2"></i> PREV
                </a>
            <?php endif; ?>

            <div class="flex items-center gap-1">
                <?php 
                $start = max(1, $currentPage - 2);
                $end = min($totalPages, $currentPage + 2);
                for($i = $start; $i <= $end; $i++): 
                ?>
                    <a href="<?= base_url('admin/media?page=' . $i . ($search ? '&q='.esc($search) : '')) ?>" 
                       class="h-10 w-10 flex items-center justify-center rounded-xl text-xs font-black transition <?= $i == $currentPage ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-100' : 'text-slate-400 hover:bg-slate-50 hover:text-slate-600' ?>">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>
            </div>

            <?php if($currentPage < $totalPages): ?>
                <a href="<?= base_url('admin/media?page=' . ($currentPage + 1) . ($search ? '&q='.esc($search) : '')) ?>" class="h-10 px-4 flex items-center justify-center rounded-xl text-xs font-black text-slate-600 hover:bg-slate-50 transition border border-transparent hover:border-slate-100">
                    NEXT <i class="fas fa-chevron-right ml-2"></i>
                </a>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>
</div>

<!-- Import Modal -->
<div id="importModal" class="hidden fixed inset-0 z-[100] flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="this.parentElement.classList.add('hidden')"></div>
    <div class="relative bg-white w-full max-w-lg rounded-[2.5rem] shadow-2xl p-8 md:p-12 overflow-hidden">
        <div class="absolute top-0 right-0 p-8">
            <button onclick="document.getElementById('importModal').classList.add('hidden')" class="text-slate-300 hover:text-slate-600 transition text-2xl">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <h3 class="text-2xl font-black text-slate-800 mb-2">Bulk URL Import</h3>
        <p class="text-slate-400 font-bold text-sm mb-8">Import multiple assets using a CSV of image URLs</p>

        <form action="<?= base_url('admin/media/import-csv') ?>" method="POST" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="mb-8">
                <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-4">Select Template File</label>
                <div class="relative group">
                    <div class="absolute inset-0 bg-slate-50 border-2 border-dashed border-slate-200 rounded-3xl group-hover:bg-indigo-50 group-hover:border-indigo-200 transition-all duration-300"></div>
                    <input type="file" name="csv_file" accept=".csv" required class="relative w-full h-32 opacity-0 cursor-pointer z-10">
                    <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                        <i class="fas fa-file-csv text-3xl text-slate-300 group-hover:text-green-500 transition mb-2"></i>
                        <p class="text-slate-400 font-bold text-xs">Drop CSV here or click to browse</p>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <button type="submit" class="flex-1 bg-indigo-600 text-white py-4 rounded-2xl font-black hover:bg-slate-900 transition shadow-xl shadow-indigo-100 flex items-center justify-center gap-2">
                    <i class="fas fa-upload text-xs"></i> START IMPORT
                </button>
                <a href="<?= base_url('admin/media/format') ?>" class="px-6 py-4 bg-slate-50 text-slate-500 rounded-2xl font-black hover:bg-slate-100 transition border border-slate-100" title="Download Format">
                    <i class="fas fa-download"></i>
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Drag & Drop Overlay (Flash) -->
<div id="dragOverlay" class="hidden fixed inset-0 z-[110] bg-indigo-600/90 backdrop-blur-md flex items-center justify-center border-[20px] border-white/20">
    <div class="text-center text-white">
        <div class="w-32 h-32 bg-white/10 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fas fa-cloud-upload-alt text-6xl animate-bounce"></i>
        </div>
        <h2 class="text-4xl font-black mb-2 uppercase tracking-tighter">Release to Upload</h2>
        <p class="text-indigo-100 font-bold">Your assets will be archived immediately.</p>
    </div>
</div>

<style>
    .media-library-wrapper {
        animation: fadeIn 0.8s ease-out;
    }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

    .asset-card:hover {
        transform: translateY(-5px);
        border-color: #6366f1;
    }
</style>

<?= $this->section('scripts') ?>
<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            alert('URL copied to operational clipboard!');
        });
    }

    /* Server-side search implemented, client-side live filter removed for performance */

    // Drag & Drop Integration
    const overlay = document.getElementById('dragOverlay');
    
    window.addEventListener('dragenter', e => {
        e.preventDefault();
        overlay.classList.remove('hidden');
    });

    overlay.addEventListener('dragleave', e => {
        overlay.classList.add('hidden');
    });

    overlay.addEventListener('dragover', e => e.preventDefault());

    overlay.addEventListener('drop', e => {
        e.preventDefault();
        overlay.classList.add('hidden');
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            const formData = new FormData();
            formData.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');
            for (let i = 0; i < files.length; i++) {
                formData.append('files[]', files[i]);
            }

            // Perform Upload
            fetch('<?= base_url('admin/media/upload') ?>', {
                method: 'POST',
                body: formData
            }).then(() => window.location.reload());
        }
    });

    console.log("Media Intelligence Suite Initialized.");
</script>
<?= $this->endSection() ?>
<?= $this->endSection() ?>

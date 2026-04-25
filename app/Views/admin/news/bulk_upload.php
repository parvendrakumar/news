<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="mb-8">
    <a href="<?= base_url('admin/news') ?>" class="text-slate-400 font-bold text-sm hover:text-red-600 transition flex items-center gap-2">
        <i class="fas fa-arrow-left text-xs"></i> BACK TO ARTICLES
    </a>
    <h2 class="text-3xl font-black text-slate-800 tracking-tight mt-2">Bulk News Upload</h2>
    <p class="text-slate-400 font-bold text-sm">Upload multiple news articles at once using a CSV file</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Upload Section -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100 p-8 md:p-12">
            <form action="<?= base_url('admin/news/bulk-store') ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                
                <div class="mb-8">
                    <label class="block text-sm font-black text-slate-700 uppercase tracking-widest mb-4">Select CSV File</label>
                    <div class="relative group">
                        <div class="absolute inset-0 bg-slate-50 border-2 border-dashed border-slate-200 rounded-3xl group-hover:bg-slate-100 group-hover:border-red-200 transition-all duration-300"></div>
                        <input type="file" name="csv_file" id="csv_input" accept=".csv" required
                               class="relative w-full h-48 opacity-0 cursor-pointer z-10">
                        <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                            <i class="fas fa-file-csv text-4xl text-slate-300 group-hover:text-red-400 group-hover:scale-110 transition-all duration-300 mb-4"></i>
                            <p class="text-slate-400 font-bold text-sm" id="filename_display">Click or drag & drop your <span class="text-slate-800">CSV file</span> here</p>
                            <p class="text-slate-300 font-medium text-xs mt-1">Maximum size: 5MB</p>
                        </div>
                    </div>
                </div>

                <div id="previewContainer" class="hidden mb-8 animate-in fade-in slide-in-from-bottom-5 duration-700">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="text-xs font-black text-slate-400 uppercase tracking-widest flex items-center gap-2">
                            <i class="fas fa-eye text-red-500"></i> Local Content Preview
                        </h4>
                        <span id="rowCount" class="text-[10px] font-black text-slate-500 bg-slate-100 px-3 py-1 rounded-full"></span>
                    </div>
                    <div class="rounded-3xl border border-slate-100 overflow-hidden shadow-inner bg-slate-50/30">
                        <div class="max-h-96 overflow-auto custom-scrollbar">
                            <table class="w-full text-left border-collapse">
                                <thead class="sticky top-0 bg-white border-b border-slate-200 z-10">
                                    <tr id="previewHeader"></tr>
                                </thead>
                                <tbody id="previewBody"></tbody>
                            </table>
                        </div>
                    </div>
                    <p class="mt-4 text-[10px] text-slate-400 font-bold italic flex items-center gap-2">
                        <i class="fas fa-info-circle"></i> This is a temporary preview from your device. Data is <b>not yet saved</b>.
                    </p>
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit" class="bg-red-600 text-white px-10 py-4 rounded-2xl font-black hover:bg-red-700 transition shadow-xl shadow-red-200 flex items-center justify-center">
                        <i class="fas fa-upload mr-3 text-xs"></i> START UPLOAD
                    </button>
                    <a href="<?= base_url('admin/news/bulk-format') ?>" class="bg-slate-100 text-slate-700 px-8 py-4 rounded-2xl font-black hover:bg-slate-200 transition border border-slate-200">
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
                <span class="w-8 h-8 bg-red-600 rounded-lg flex items-center justify-center text-xs">1</span>
                Instructions
            </h3>
            
            <ul class="space-y-6">
                <li class="flex gap-4">
                    <div class="mt-1 text-red-500"><i class="fas fa-check-circle"></i></div>
                    <div>
                        <p class="font-black text-sm uppercase tracking-wider mb-1">Format</p>
                        <p class="text-slate-400 text-sm font-medium leading-relaxed">Only <strong class="text-white">.CSV</strong> files are supported. Please use UTF-8 encoding for Hindi content.</p>
                    </div>
                </li>
                <li class="flex gap-4">
                    <div class="mt-1 text-red-500"><i class="fas fa-check-circle"></i></div>
                    <div>
                        <p class="font-black text-sm uppercase tracking-wider mb-1">Categories</p>
                        <p class="text-slate-400 text-sm font-medium leading-relaxed">Use the <strong class="text-white">Category ID</strong>. You can find these in the Categories section.</p>
                    </div>
                </li>
                <li class="flex gap-4">
                    <div class="mt-1 text-red-500"><i class="fas fa-check-circle"></i></div>
                    <div>
                        <p class="font-black text-sm uppercase tracking-wider mb-1">Mandatory Fields</p>
                        <p class="text-slate-400 text-sm font-medium leading-relaxed">Category ID, Slug, and Title/Description (Hindi) are required for each row.</p>
                    </div>
                </li>
            </ul>

            <div class="mt-12 p-6 bg-white/5 rounded-3xl border border-white/10">
                <p class="text-xs font-black text-red-400 uppercase tracking-widest mb-2">Pro Tip</p>
                <p class="text-slate-400 text-xs font-medium leading-relaxed">After uploading, images must be added manually by editing individual articles.</p>
            </div>
        </div>
    </div>
</div>

<div class="mt-12">
    <h3 class="text-xl font-black text-slate-800 mb-6 uppercase tracking-widest text-center">Available Categories (Reference)</h3>
    <div class="flex flex-wrap justify-center gap-3">
        <?php foreach($categories as $cat): ?>
            <div class="bg-white border border-slate-200 px-4 py-2 rounded-xl flex items-center gap-3 shadow-sm" title="<?= esc($cat['title_en'] ?? '') ?>">
                <span class="w-8 h-8 bg-slate-900 text-white rounded-lg flex items-center justify-center font-black text-xs"><?= $cat['id'] ?></span>
                <span class="font-bold text-slate-700 text-sm">
                    <?= esc($cat['title_hi'] ?? '') ?>
                    <?php if(!empty($cat['title_en'])): ?>
                        <span class="text-slate-400 font-normal text-xs ml-1">(<?= esc($cat['title_en']) ?>)</span>
                    <?php endif; ?>
                </span>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    document.getElementById('csv_input').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (!file) return;

        // Display filename
        document.getElementById('filename_display').innerHTML = `Selected: <span class="text-slate-800">${file.name}</span>`;

        const reader = new FileReader();
        reader.onload = function(event) {
            const content = event.target.result;
            const lines = content.split('\n');
            if (lines.length === 0) return;

            // Simple CSV parsing (handling basic cases, not full RFC compliance but enough for templates)
            const headers = lines[0].split(',').map(h => h.trim().replace(/^"|"$/g, ''));
            const rows = lines.slice(1).filter(line => line.trim() !== '');

            // Render Header
            const headerRow = document.getElementById('previewHeader');
            headerRow.innerHTML = '';
            headers.forEach(h => {
                const th = document.createElement('th');
                th.className = "px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest whitespace-nowrap text-left border-b border-slate-200";
                th.innerText = h;
                headerRow.appendChild(th);
            });

            // Render Body
            const tbody = document.getElementById('previewBody');
            tbody.innerHTML = '';
            
            // Preview max 10 rows for performance
            const previewLimit = 10;
            rows.slice(0, previewLimit).forEach(row => {
                const tr = document.createElement('tr');
                tr.className = "border-b border-slate-50 hover:bg-white/50 transition-colors";
                
                // Regex to handle CSV split with quotes correctly
                const cells = row.match(/(".*?"|[^",]+)(?=\s*,|\s*$)/g) || row.split(',');
                
                cells.forEach((c, idx) => {
                    const cleanC = c.trim().replace(/^"|"$/g, '');
                    const td = document.createElement('td');
                    td.className = "px-6 py-3 text-xs font-bold text-slate-600 truncate max-w-[200px]";
                    td.title = cleanC;
                    td.innerText = cleanC || '-';
                    tr.appendChild(td);
                });
                tbody.appendChild(tr);
            });

            if (rows.length > previewLimit) {
                const moreTr = document.createElement('tr');
                moreTr.innerHTML = `<td colspan="${headers.length}" class="px-6 py-4 text-center text-[10px] font-black text-slate-300 uppercase italic">... and ${rows.length - previewLimit} more articles ...</td>`;
                tbody.appendChild(moreTr);
            }

            document.getElementById('rowCount').innerText = `${rows.length} ARTICLES DETECTED`;
            document.getElementById('previewContainer').classList.remove('hidden');
        };
        reader.readAsText(file);
    });
</script>
<?= $this->endSection() ?>

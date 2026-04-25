<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
    <div>
        <h2 class="text-3xl font-black text-slate-800 tracking-tight">Post Categories</h2>
        <p class="text-slate-400 font-bold text-sm">Organize news into sections</p>
    </div>
    <div class="flex flex-wrap gap-2 w-full md:w-auto">
        <a href="<?= base_url('admin/categories/bulk-upload') ?>" class="flex-1 md:flex-none bg-slate-100 text-slate-700 px-6 py-3 rounded-2xl font-black hover:bg-slate-200 transition border border-slate-200 flex items-center justify-center">
            <i class="fas fa-file-upload mr-2 text-xs"></i> BULK UPLOAD
        </a>
        <a href="<?= base_url('admin/categories/create') ?>" class="flex-1 md:flex-none bg-blue-600 text-white px-8 py-3 rounded-2xl font-black hover:bg-blue-700 transition shadow-xl shadow-blue-200 flex items-center justify-center">
            <i class="fas fa-folder-plus mr-2 text-xs"></i> NEW CATEGORY
        </a>
    </div>
</div>

<div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
    <!-- Search Bar -->
    <div class="px-8 py-6 border-b border-slate-50 bg-slate-50/20">
        <form action="<?= base_url('admin/categories') ?>" method="GET" class="relative max-w-md">
            <input type="text" name="search" value="<?= esc($search ?? '') ?>" 
                   placeholder="Search categories by name or slug..." 
                   class="w-full pl-12 pr-4 py-3 bg-white border border-slate-200 rounded-xl focus:border-blue-500 outline-none font-bold text-slate-700 transition">
            <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                <i class="fas fa-search"></i>
            </div>
            <?php if(!empty($search)): ?>
                <a href="<?= base_url('admin/categories') ?>" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-300 hover:text-red-500 transition">
                    <i class="fas fa-times-circle"></i>
                </a>
            <?php endif; ?>
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-slate-50/50 border-b border-slate-100">
                <tr>
                    <th class="px-4 md:px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Category Name</th>
                    <th class="px-4 md:px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest">Slug</th>
                    <th class="px-4 md:px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Sort Order</th>
                    <th class="px-4 md:px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Status</th>
                    <th class="px-4 md:px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                <?php foreach ($categories as $cat): ?>
                <tr class="hover:bg-slate-50/50 transition">
                    <td class="px-4 md:px-8 py-6">
                        <div class="flex items-center">
                            <div class="h-10 w-10 bg-slate-100 text-slate-400 rounded-xl flex items-center justify-center mr-4">
                                <i class="fas fa-folder"></i>
                            </div>
                            <div class="font-black text-slate-800 leading-tight"><?= $cat['title'] ?></div>
                        </div>
                    </td>
                    <td class="px-4 md:px-8 py-6">
                        <code class="text-[10px] font-black text-blue-600 bg-blue-50 px-2 py-1 rounded-lg uppercase tracking-tight">/<?= $cat['slug'] ?></code>
                    </td>
                    <td class="px-8 py-6 text-center font-bold text-slate-600">
                        <?= esc($cat['sort_order']) ?>
                    </td>
                    <td class="px-8 py-6 text-center">
                        <a href="<?= base_url('admin/categories/toggle-status/' . $cat['id']) ?>" title="Toggle Category Status">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest <?= $cat['status'] == 'active' ? 'bg-green-100 text-green-700' : 'bg-slate-100 text-slate-400' ?>">
                                <?= $cat['status'] ?>
                            </span>
                        </a>
                    </td>
                    <td class="px-4 md:px-8 py-6">
                        <div class="flex items-center justify-center space-x-3">
                            <a href="<?= base_url('admin/categories/edit/' . $cat['id']) ?>" class="h-9 w-9 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center hover:bg-blue-600 hover:text-white transition">
                                <i class="fas fa-edit text-xs"></i>
                            </a>
                            <a href="<?= base_url('admin/categories/delete/' . $cat['id']) ?>" onclick="return confirm('Delete this category? Articles in this category will become uncategorized.')" class="h-9 w-9 bg-red-50 text-red-600 rounded-xl flex items-center justify-center hover:bg-red-600 hover:text-white transition">
                                <i class="fas fa-trash-alt text-xs"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($categories)): ?>
                    <tr>
                        <td colspan="5" class="px-8 py-20 text-center">
                            <div class="text-slate-300 mb-2"><i class="fas fa-search-minus text-4xl"></i></div>
                            <p class="text-slate-400 font-bold">No categories found matching your search.</p>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination Section -->
    <?php if ($pager): ?>
        <div class="px-8 py-6 bg-slate-50/50 border-t border-slate-100 admin-pagination">
            <?= $pager->links() ?>
        </div>
    <?php endif; ?>
</div>

<style>
    .admin-pagination nav ul { display: flex; gap: 8px; justify-content: center; }
    .admin-pagination li { list-style: none; }
    .admin-pagination li a, .admin-pagination li span { 
        display: flex; align-items: center; justify-content: center;
        min-width: 40px; height: 40px; border-radius: 10px;
        background: #fff; border: 1px solid #e2e8f0;
        font-weight: 800; font-size: 13px; color: #64748b;
        transition: all 0.3s; text-decoration: none;
    }
    .admin-pagination li.active span { background: #2563eb; color: #fff; border-color: #2563eb; }
    .admin-pagination li a:hover { border-color: #2563eb; color: #2563eb; }
</style>

<?= $this->endSection() ?>

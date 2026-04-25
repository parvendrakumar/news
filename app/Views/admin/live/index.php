<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
        <h2 class="text-3xl font-black text-slate-800 tracking-tight">Live TV Setup</h2>
        <p class="text-slate-400 font-bold text-sm">Configure 24/7 digital television broadcasting</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <!-- Main Configuration -->
    <div class="lg:col-span-8">
        <form action="<?= base_url('admin/live/update') ?>" method="POST" class="bg-white p-4 md:p-8 rounded-[2rem] shadow-sm border border-slate-100">
            <?= csrf_field() ?>
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center">
                    <div class="h-10 w-10 bg-red-50 text-red-600 rounded-xl flex items-center justify-center mr-4">
                        <i class="fas fa-play-circle animate-pulse"></i>
                    </div>
                    <h3 class="text-xs font-black text-slate-300 uppercase tracking-widest">Stream Orchestration</h3>
                </div>
                <span class="px-3 py-1 bg-red-50 text-red-600 rounded-lg text-[10px] font-black uppercase tracking-widest border border-red-100 italic">24/7 Broadcasting</span>
            </div>

            <div class="space-y-6 mb-8">
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">Broadcast Title</label>
                    <input type="text" name="stream_title" value="<?= esc($live['stream_title'] ?? '') ?>" class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:border-red-500 outline-none font-bold text-slate-700" placeholder="City News Live TV">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">Stream Embed URL</label>
                    <textarea name="stream_url" rows="3" class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:border-red-500 outline-none font-bold text-slate-700 text-xs italic" placeholder="https://www.youtube.com/embed/..."><?= esc($live['stream_url'] ?? '') ?></textarea>
                    <p class="text-[9px] font-bold text-slate-400 mt-2 uppercase tracking-tighter">Enter the official embed code URL from YouTube, Facebook, or your streaming provider.</p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">Streaming Provider</label>
                        <select name="provider" class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:border-red-500 outline-none font-bold text-slate-600 appearance-none bg-[url('data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2224%22%20height%3D%2224%22%20viewBox%3D%220%200%2024%2024%22%20fill%3D%22none%22%20stroke%3D%22%23cbd5e1%22%20stroke-width%3D%222%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%3E%3Cpolyline%20points%3D%226%209%2012%2015%2018%209%22%3E%3C%2Fpolyline%3E%3C%2Fsvg%3E')] bg-no-repeat bg-[right_1.25rem_center] bg-[length:1.2em]">
                            <option value="youtube" <?= ($live['provider'] ?? '') == 'youtube' ? 'selected' : '' ?>>YouTube Live</option>
                            <option value="facebook" <?= ($live['provider'] ?? '') == 'facebook' ? 'selected' : '' ?>>Facebook Live</option>
                            <option value="other" <?= ($live['provider'] ?? '') == 'other' ? 'selected' : '' ?>>Other / Custom</option>
                        </select>
                    </div>
                    <div class="flex items-center pt-2 sm:pt-6">
                        <label class="relative inline-flex items-center cursor-pointer mr-3">
                            <input type="checkbox" name="is_active" value="1" class="sr-only peer" <?= ($live['is_active'] ?? 0) ? 'checked' : '' ?>>
                            <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-red-600"></div>
                        </label>
                        <span class="text-[10px] font-black text-slate-600 uppercase tracking-widest">Enable Live TV</span>
                    </div>
                </div>
            </div>

            <button type="submit" class="bg-slate-900 text-white px-10 py-4 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-black transition shadow-2xl shadow-slate-200 block w-full md:w-auto">
                <i class="fas fa-save mr-2"></i> Update Broadcast Content
            </button>
        </form>
    </div>

    <!-- Right Sidebar -->
    <div class="lg:col-span-4 space-y-8">
        <!-- Live Preview -->
        <div class="bg-slate-900 p-4 md:p-8 rounded-[2rem] text-white shadow-xl relative overflow-hidden">
            <div class="absolute -right-8 -top-8 text-white/5 text-9xl">
                <i class="fas fa-video"></i>
            </div>
            <div class="relative z-10">
                <h3 class="text-xl font-black mb-4 flex items-center">
                    <i class="fas fa-eye mr-2 text-red-500"></i> Broadcast Preview
                </h3>
                <div class="aspect-video bg-black rounded-2xl overflow-hidden border border-white/10 shadow-inner mb-6">
                    <?php if($live['is_active']): ?>
                        <iframe width="100%" height="100%" src="<?= $live['stream_url'] ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <?php else: ?>
                        <div class="w-full h-full flex flex-col items-center justify-center text-slate-600 italic px-6 text-center">
                            <i class="fas fa-video-slash text-4xl mb-4 opacity-50"></i>
                            <p class="text-[10px] font-black uppercase tracking-widest">Broadcast Offline</p>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="p-4 bg-white/5 rounded-2xl border border-white/10">
                    <div class="flex items-center justify-between text-[10px] font-black uppercase tracking-widest mb-2">
                        <span class="text-slate-400 italic">Current Status:</span>
                        <span class="<?= $live['is_active'] ? 'text-green-400' : 'text-slate-500' ?>"><?= $live['is_active'] ? 'ON AIR' : 'OFF AIR' ?></span>
                    </div>
                    <div class="flex items-center justify-between text-[10px] font-black uppercase tracking-widest">
                        <span class="text-slate-400 italic">Provider:</span>
                        <span class="text-red-400"><?= strtoupper($live['provider']) ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Setup Guide -->
        <div class="bg-red-50/50 p-4 md:p-8 rounded-[2rem] border border-red-100/50">
            <div class="flex items-center text-red-700 font-black text-xs uppercase tracking-widest mb-6">
                <i class="fas fa-lightbulb mr-2"></i> YouTube Live Setup
            </div>
            <div class="space-y-4">
                <p class="text-[9px] font-bold text-slate-500 leading-relaxed uppercase tracking-widest">
                    To embed your YouTube Live stream, go to your Live Dashboard and copy the <span class="text-red-700">Embed URL</span> from the share options.
                </p>
                <div class="p-4 bg-white rounded-2xl border border-red-100 italic">
                    <p class="text-[10px] font-black text-slate-400 uppercase mb-1">Format Example:</p>
                    <p class="text-[9px] font-bold text-slate-700 break-all leading-tight">youtube.com/embed/live_stream?channel=UCYOUR_CHANNEL_ID</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="mb-8 flex items-center justify-between">
    <div>
        <h2 class="text-3xl font-black text-slate-800 tracking-tight">Telegram Bot Setup</h2>
        <p class="text-slate-400 font-bold text-sm">Configure lightning-fast news broadcasting to your Telegram community</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <!-- Main Configuration -->
    <div class="lg:col-span-8">
        <form action="<?= base_url('admin/telegram/update') ?>" method="POST" class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100">
            <?= csrf_field() ?>
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center">
                    <div class="h-10 w-10 bg-slate-100 rounded-xl flex items-center justify-center text-slate-400 mr-4">
                        <i class="fab fa-telegram"></i>
                    </div>
                    <h3 class="text-xs font-black text-slate-300 uppercase tracking-widest">Bot API Configuration</h3>
                </div>
                <span class="px-3 py-1 bg-sky-50 text-sky-700 rounded-lg text-[10px] font-black uppercase tracking-widest border border-sky-100 italic">API v6.0+</span>
            </div>

            <div class="space-y-6 mb-8">
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">Bot Token (from @BotFather)</label>
                    <input type="password" name="bot_token" value="<?= esc($telegram['bot_token'] ?? '') ?>" class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:border-sky-500 outline-none font-bold text-slate-600" placeholder="00000000:AA-EXAMPLE...">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">Channel @Username or Chat ID</label>
                    <input type="text" name="channel_id" value="<?= esc($telegram['channel_id'] ?? '') ?>" class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:border-sky-500 outline-none font-bold text-slate-600" placeholder="@citynews_official">
                </div>
            </div>

            <div class="mt-8 flex items-center justify-between p-4 bg-slate-50 rounded-2xl border border-slate-100">
                <div class="flex items-center">
                    <label class="relative inline-flex items-center cursor-pointer mr-3">
                        <input type="checkbox" name="is_active" value="1" class="sr-only peer" <?= ($telegram['is_active'] ?? 0) ? 'checked' : '' ?>>
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-sky-600"></div>
                    </label>
                    <span class="text-[10px] font-black text-slate-600 uppercase tracking-widest">Enable Telegram Broadcasting</span>
                </div>
                <button type="submit" class="bg-slate-900 text-white px-8 py-3 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-black transition shadow-xl">
                    <i class="fas fa-save mr-2"></i> Update Bot Settings
                </button>
            </div>
        </form>
    </div>

    <!-- Right Sidebar -->
    <div class="lg:col-span-4 space-y-8">
        <!-- Test Broadcast -->
        <div class="bg-sky-600 p-8 rounded-[2rem] text-white shadow-xl shadow-sky-200 relative overflow-hidden">
            <div class="absolute -right-8 -top-8 text-white/5 text-9xl">
                <i class="fab fa-telegram-plane"></i>
            </div>
            <div class="relative z-10">
                <h3 class="text-xl font-black mb-4 flex items-center">
                    <i class="fas fa-paper-plane mr-2 text-white italic"></i> Push Test
                </h3>
                <p class="text-xs text-sky-100 font-bold leading-relaxed mb-6">
                    Launch an instantaneous test message to verify if your Bot has 'Post' permissions in your target channel.
                </p>
                <form action="<?= base_url('admin/telegram/test') ?>" method="POST" class="space-y-4">
                    <?= csrf_field() ?>
                    <input type="hidden" name="test_message" value="test">
                    <button type="submit" class="w-full bg-white text-sky-600 font-black py-4 rounded-xl hover:bg-sky-50 transition shadow-lg uppercase tracking-widest text-xs">
                        Push Bot Alert
                    </button>
                </form>
            </div>
        </div>

        <!-- BotFather Guide -->
        <div class="bg-slate-50 p-8 rounded-[2rem] border border-slate-200">
            <div class="flex items-center text-slate-800 font-black text-xs uppercase tracking-widest mb-6">
                <i class="fas fa-robot mr-2 text-sky-500"></i> Bot Activation
            </div>
            <div class="space-y-4">
                <p class="text-[9px] font-bold text-slate-400 leading-relaxed uppercase tracking-widest">
                    1. Direct message <span class="text-sky-600">@BotFather</span> on Telegram.
                </p>
                <p class="text-[9px] font-bold text-slate-400 leading-relaxed uppercase tracking-widest">
                    2. Use /newbot and copy the API token.
                </p>
                <p class="text-[9px] font-bold text-slate-400 leading-relaxed uppercase tracking-widest italic">
                    Note: Add your bot as an 'Administrator' to your channel with Post permissions.
                </p>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

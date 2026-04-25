<?= $this->extend('frontend/layout') ?>

<?= $this->section('content') ?>

<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        important: true,
    }
</script>

<style>
    .auth-container {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
        background: radial-gradient(circle at top right, #fff5f5, transparent),
                    radial-gradient(circle at bottom left, #f8fafc, transparent);
    }
    input:-webkit-autofill,
    input:-webkit-autofill:hover, 
    input:-webkit-autofill:focus {
        -webkit-box-shadow: 0 0 0px 1000px white inset !important;
    }
</style>

<div class="auth-container">
    <div class="max-w-xl w-full bg-white rounded-[2.5rem] shadow-2xl p-8 md:p-12 border border-slate-100">
        <div class="text-center mb-10">
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Create <span class="text-red-600">Account</span></h1>
            <p class="text-slate-400 font-bold text-sm mt-2 uppercase tracking-widest">Join our news community today</p>
        </div>

        <?php if (session()->getFlashdata('errors')): ?>
            <div class="bg-red-50 text-red-600 p-5 rounded-2xl mb-8 text-sm border border-red-100">
                <ul class="list-disc list-inside font-bold space-y-1">
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('register') ?>" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <?= csrf_field() ?>
            
            <div class="md:col-span-2">
                <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Full Name</label>
                <input type="text" name="full_name" value="<?= old('full_name') ?>" class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:border-red-600 focus:ring-4 focus:ring-red-100 outline-none transition font-bold" placeholder="Nidhi Sharma" required>
            </div>

            <div>
                <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Username</label>
                <input type="text" name="username" value="<?= old('username') ?>" class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:border-red-600 focus:ring-4 focus:ring-red-100 outline-none transition font-bold" placeholder="nidhi_news" required>
            </div>

            <div>
                <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Email Address</label>
                <input type="email" name="email" value="<?= old('email') ?>" class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:border-red-600 focus:ring-4 focus:ring-red-100 outline-none transition font-bold" placeholder="name@example.com" required>
            </div>

            <div>
                <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Password</label>
                <input type="password" name="password" class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:border-red-600 focus:ring-4 focus:ring-red-100 outline-none transition font-bold" placeholder="••••••••" required>
            </div>

            <div>
                <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Confirm Password</label>
                <input type="password" name="confirm_password" class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:border-red-600 focus:ring-4 focus:ring-red-100 outline-none transition font-bold" placeholder="••••••••" required>
            </div>

            <div class="md:col-span-2 pt-4">
                <button type="submit" class="w-full bg-slate-900 text-white font-black py-4 rounded-xl hover:bg-red-600 transition shadow-xl uppercase tracking-widest text-sm">
                    Complete Registration
                </button>
            </div>
        </form>

        <div class="text-center mt-10 text-xs font-bold text-slate-400 uppercase tracking-widest">
            Already have an account? <a href="<?= base_url('login') ?>" class="text-red-600 font-black hover:underline">Sign In Instead</a>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

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
        padding: 60px 20px;
        background: radial-gradient(circle at top right, #f8fafc, transparent),
                    radial-gradient(circle at bottom left, #fff5f5, transparent);
    }
</style>

<div class="auth-container">
    <div class="max-w-md w-full bg-white rounded-3xl shadow-2xl p-8 md:p-10 border border-slate-100">
        <div class="text-center mb-10">
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Login with <span class="text-red-600">OTP</span></h1>
            <p class="text-slate-400 font-bold text-sm mt-2 uppercase tracking-widest">Enter your email for a secure code</p>
        </div>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="bg-red-50 text-red-600 p-4 rounded-xl mb-6 text-sm font-bold border border-red-100 text-center">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="bg-green-50 text-green-600 p-4 rounded-xl mb-6 text-sm font-bold border border-green-100 text-center">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('auth/send-login-otp') ?>" method="POST" class="space-y-6">
            <?= csrf_field() ?>
            <div>
                <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Email Address</label>
                <input type="email" name="email" class="w-full px-5 py-4 rounded-xl border border-slate-200 focus:border-red-600 focus:ring-4 focus:ring-red-100 outline-none transition font-bold text-slate-900" placeholder="name@example.com" required autofocus>
            </div>
            
            <button type="submit" class="w-full bg-slate-900 text-white font-black py-4 rounded-xl hover:bg-red-600 transition shadow-xl uppercase tracking-widest text-sm">
                Send Secure Code
            </button>
        </form>

        <div class="text-center mt-10 text-xs font-bold text-slate-400 uppercase tracking-widest">
            Remember your password? <a href="<?= base_url('login') ?>" class="text-red-600 font-black hover:underline">Sign in with password</a>
        </div>
        
        <div class="text-center mt-8">
            <a href="<?= base_url() ?>" class="text-[10px] font-black text-slate-300 uppercase tracking-widest hover:text-red-600 transition">
                <i class="fas fa-arrow-left mr-2"></i> Back to home
            </a>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

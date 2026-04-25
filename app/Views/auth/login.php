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
        min-height: 70vh;
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
    <div class="max-w-md w-full bg-white rounded-3xl shadow-2xl p-8 md:p-10 border border-slate-100">
        <div class="text-center mb-10">
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Welcome <span class="text-red-600">Back</span></h1>
            <p class="text-slate-400 font-bold text-sm mt-2 uppercase tracking-widest">Sign in to your account</p>
        </div>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="bg-red-50 text-red-600 p-4 rounded-xl mb-6 text-sm font-bold border border-red-100">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="bg-green-50 text-green-600 p-4 rounded-xl mb-6 text-sm font-bold border border-green-100">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('errors')): ?>
            <div class="bg-red-50 text-red-600 p-4 rounded-xl mb-6 text-sm border border-red-100">
                <ul class="list-disc list-inside font-bold">
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('login') ?>" method="POST" class="space-y-5">
            <?= csrf_field() ?>
            <div>
                <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Email Address</label>
                <input type="email" name="email" value="<?= old('email') ?>" class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:border-red-600 focus:ring-4 focus:ring-red-100 outline-none transition font-bold" placeholder="name@example.com" required>
            </div>
            <div>
                <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Password</label>
                <div class="relative group">
                    <input type="password" name="password" id="password" class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:border-red-600 focus:ring-4 focus:ring-red-100 outline-none transition pr-12 font-bold" placeholder="••••••••" required>
                    <button type="button" onclick="togglePassword()" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-300 hover:text-red-600 transition p-1">
                        <i id="eye-icon" class="fas fa-eye"></i>
                    </button>
                </div>
            </div>

            <?php if ($showCaptcha ?? false): ?>
            <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100 space-y-3 overflow-hidden">
                <label class="block text-xs font-black text-slate-400 uppercase tracking-widest">Security Verification</label>
                <div class="flex items-center gap-2">
                    <div class="bg-white flex-none w-28 py-3 rounded-xl font-mono text-xl font-bold tracking-[0.2em] border-2 border-dashed border-red-200 select-none shadow-sm text-red-600 flex items-center justify-center h-[52px]">
                        <span style="transform: rotate(<?= rand(-5, 5) ?>deg);"><?= $captchaCode ?></span>
                    </div>
                    <input type="text" name="captcha" id="captcha_input" class="flex-1 min-w-0 px-3 py-3 rounded-xl border border-slate-200 focus:border-red-600 focus:ring-4 focus:ring-red-100 outline-none transition uppercase font-bold text-center text-sm" placeholder="CODE" required maxlength="4">
                </div>
            </div>
            <?php endif; ?>

            <div class="flex items-center justify-between text-xs font-black uppercase tracking-widest">
                <label class="flex items-center text-slate-400 cursor-pointer">
                    <input type="checkbox" class="rounded text-red-600 mr-2 border-slate-300"> Remember me
                </label>
                <a href="<?= base_url('auth/forgot-password') ?>" class="text-red-600 hover:underline">Forgot password?</a>
            </div>
            
            <button type="submit" class="w-full bg-slate-900 text-white font-black py-4 rounded-xl hover:bg-red-600 transition shadow-xl uppercase tracking-widest text-sm">
                Sign In
            </button>
        </form>

        <div class="relative py-8 text-center">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-slate-100"></div>
            </div>
            <span class="relative bg-white px-3 text-[10px] font-black text-slate-300 uppercase tracking-[0.3em]">or</span>
        </div>

        <div class="space-y-4">
            <a href="<?= base_url('auth/login-otp') ?>" class="w-full border-2 border-slate-900 text-slate-900 font-black py-4 rounded-xl hover:bg-slate-900 hover:text-white transition flex items-center justify-center gap-2 group uppercase tracking-widest text-xs">
                <span>Login with OTP</span>
                <i class="fas fa-shield-alt group-hover:animate-pulse"></i>
            </a>
        </div>

        <div class="text-center mt-10 text-xs font-bold text-slate-400 uppercase tracking-widest">
            Don't have an account? <a href="<?= base_url('register') ?>" class="text-red-600 font-black hover:underline">Register</a>
        </div>
    </div>
</div>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        }
    }
</script>

<?= $this->endSection() ?>

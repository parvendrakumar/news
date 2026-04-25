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
        background: radial-gradient(circle at top right, #fff5f5, transparent),
                    radial-gradient(circle at bottom left, #f8fafc, transparent);
    }
    .otp-input:focus {
        border-color: #dc2626 !important;
        box-shadow: 0 0 0 4px rgba(220, 38, 38, 0.1) !important;
    }
</style>

<div class="auth-container">
    <div class="max-w-md w-full bg-white rounded-3xl shadow-2xl p-8 md:p-10 border border-slate-100">
        <div class="text-center mb-10">
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">2-Step <span class="text-red-600">Verification</span></h1>
            <p class="text-slate-400 font-bold text-sm mt-2 uppercase tracking-widest">Enter the 6-digit code sent to you</p>
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

        <form action="<?= base_url('auth/attempt-verify-otp') ?>" method="POST" class="space-y-6">
            <?= csrf_field() ?>
            <div>
                <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-3 text-center">One-Time Password (OTP)</label>
                <input type="text" name="otp" maxlength="6" class="otp-input w-full text-center text-3xl tracking-[1.2rem] px-5 py-4 rounded-2xl border border-slate-200 outline-none transition font-black text-slate-900 bg-slate-50" placeholder="000000" required autofocus>
            </div>
            
            <button type="submit" class="w-full bg-slate-900 text-white font-black py-4 rounded-xl hover:bg-red-600 transition shadow-xl uppercase tracking-widest text-sm">
                Verify & Proceed
            </button>
        </form>

        <div class="text-center mt-10 text-xs font-bold text-slate-400 uppercase tracking-widest">
            Didn't receive the code? 
            <a href="<?= base_url('auth/resend-otp') ?>" id="resendBtn" class="text-red-600 font-black hover:underline px-2 py-1">Resend code</a>
            <span id="timer" class="hidden text-slate-300 italic"> (Resend in 30s)</span>
        </div>

        <div class="text-center mt-8">
            <a href="<?= base_url('login') ?>" class="text-[10px] font-black text-slate-300 uppercase tracking-widest hover:text-red-600 transition">
                <i class="fas fa-arrow-left mr-2"></i> Back to login
            </a>
        </div>
    </div>
</div>

<script>
    const resendBtn = document.getElementById('resendBtn');
    const timerSpan = document.getElementById('timer');
    let timeLeft = 30;

    resendBtn.addEventListener('click', (e) => {
        if (timeLeft < 30) {
            e.preventDefault();
            return;
        }
    });

    function startTimer() {
        resendBtn.classList.add('hidden');
        timerSpan.classList.remove('hidden');
        
        const interval = setInterval(() => {
            timeLeft--;
            timerSpan.innerText = ` (Resend in ${timeLeft}s)`;
            
            if (timeLeft <= 0) {
                clearInterval(interval);
                resendBtn.classList.remove('hidden');
                timerSpan.classList.add('hidden');
                timeLeft = 30;
            }
        }, 1000);
    }

    <?php if (session()->getFlashdata('success')): ?>
        startTimer();
    <?php endif; ?>
</script>

<?= $this->endSection() ?>

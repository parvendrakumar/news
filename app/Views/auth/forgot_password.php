<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - City News</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .glass {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-red-600 to-gray-900 min-h-screen flex items-center justify-center p-4">

    <div class="max-w-md w-full glass rounded-3xl shadow-2xl p-10">
        <div class="text-center mb-10">
            <h1 class="text-3xl font-bold text-gray-900">Forgot Password</h1>
            <p class="text-gray-500 mt-2">Enter your email to reset your password</p>
        </div>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="bg-red-50 text-red-600 p-4 rounded-xl mb-6 text-sm font-bold">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="bg-green-50 text-green-600 p-4 rounded-xl mb-6 text-sm font-bold">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('auth/send-reset-link') ?>" method="POST" class="space-y-6">
            <?= csrf_field() ?>
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Email Address</label>
                <input type="email" name="email" class="w-full px-5 py-4 rounded-xl border border-gray-200 focus:border-red-600 focus:ring-4 focus:ring-red-100 outline-none transition" placeholder="name@example.com" required autofocus>
            </div>
            
            <button type="submit" class="w-full bg-red-600 text-white font-bold py-4 rounded-xl hover:bg-red-700 transition shadow-lg shadow-red-200">
                Send Reset Link
            </button>
        </form>

        <div class="text-center mt-10 text-sm text-gray-500">
            Remembered? <a href="<?= base_url('login') ?>" class="text-red-600 font-bold hover:underline">Back to Login</a>
        </div>
    </div>

</body>
</html>

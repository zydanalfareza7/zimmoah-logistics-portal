<!DOCTYPE html>
<html lang="id" class="h-full bg-[#FECE00] text-black">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Staff Login - Zimmoah Operations Portal</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="min-h-full flex items-center justify-center p-4 bg-[#FECE00]">
    <div class="max-w-md w-full bg-white rounded-3xl p-8 sm:p-10 shadow-2xl border-2 border-black/15 space-y-6">
        <!-- Brand Header -->
        <div class="text-center space-y-3">
            <div class="inline-flex items-center justify-center bg-[#FECE00] px-6 py-3.5 rounded-2xl shadow-sm border border-black/10">
                <img src="{{ asset('images/zimmoah-logo.svg') }}" alt="ZIMMOAH" class="h-14 w-auto">
            </div>
            <p class="text-xs font-bold uppercase tracking-widest text-neutral-800">Operations &amp; Helpdesk Portal</p>
            <p class="text-xs text-neutral-600">Masuk ke panel Helpdesk, Rekrutmen HR & Manajemen Kargo.</p>
        </div>

        @if ($errors->any())
            <div class="bg-rose-50 border border-rose-200 text-rose-700 text-xs p-3.5 rounded-xl font-medium">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-xs font-bold text-neutral-800 uppercase tracking-wider mb-1">Email Staf *</label>
                <input type="email" name="email" value="{{ old('email', 'admin@zimmoah.com') }}" required autofocus
                    class="w-full px-4 py-3 border-2 border-neutral-300 rounded-xl text-sm focus:outline-none focus:border-black">
            </div>

            <div>
                <label class="block text-xs font-bold text-neutral-800 uppercase tracking-wider mb-1">Kata Sandi *</label>
                <input type="password" name="password" value="password123" required
                    class="w-full px-4 py-3 border-2 border-neutral-300 rounded-xl text-sm focus:outline-none focus:border-black">
            </div>

            <div class="flex items-center justify-between text-xs">
                <label class="flex items-center space-x-2 text-neutral-700 cursor-pointer">
                    <input type="checkbox" name="remember" class="w-4 h-4 text-black rounded border-neutral-300">
                    <span>Ingat sesi saya</span>
                </label>
            </div>

            <button type="submit" class="w-full bg-black hover:bg-neutral-800 text-[#FECE00] font-black text-sm py-3.5 rounded-xl transition shadow-lg">
                Masuk ke Workspace
            </button>
        </form>

        <!-- Demo Credentials Hint -->
        <div class="bg-[#FFFBE6] p-4 rounded-2xl border border-[#FECE00] text-[11px] text-neutral-800 space-y-1.5">
            <span class="font-black text-black uppercase tracking-wider block">Akun Uji Coba Tersedia:</span>
            <p>&bull; <strong>Super Admin:</strong> <code class="text-black font-bold">admin@zimmoah.com</code> / <code class="text-black font-bold">password123</code></p>
            <p>&bull; <strong>Helpdesk Agent:</strong> <code class="text-black font-bold">agent@zimmoah.com</code> / <code class="text-black font-bold">password123</code></p>
            <p>&bull; <strong>HR Recruiter:</strong> <code class="text-black font-bold">hr@zimmoah.com</code> / <code class="text-black font-bold">password123</code></p>
        </div>

        <div class="text-center pt-1">
            <a href="{{ route('home') }}" class="text-xs text-neutral-700 hover:text-black font-bold hover:underline">
                &larr; Kembali ke Website Publik
            </a>
        </div>
    </div>
</body>
</html>

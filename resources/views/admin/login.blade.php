<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-900 text-slate-800">
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
<body class="min-h-full flex items-center justify-center p-4 bg-[#0B1522]">
    <div class="max-w-md w-full bg-white rounded-3xl p-8 sm:p-10 shadow-2xl space-y-6">
        <!-- Brand Header -->
        <div class="text-center space-y-2">
            <div class="w-12 h-12 rounded-2xl bg-[#FECE00] text-slate-950 flex items-center justify-center font-black text-2xl mx-auto shadow-md">
                <svg class="w-6 h-6 fill-current" viewBox="0 0 48 48"><path d="M12 14h24v4.5L19.5 30H36v5H12v-4.5L28.5 19H12v-5z"/></svg>
            </div>
            <h1 class="text-2xl font-black text-slate-900 tracking-tight">ZIMMOAH OPERATIONS</h1>
            <p class="text-xs text-slate-500">Masuk ke panel Helpdesk, Rekrutmen HR & Manajemen Kargo.</p>
        </div>

        @if ($errors->any())
            <div class="bg-rose-50 border border-rose-200 text-rose-700 text-xs p-3.5 rounded-xl font-medium">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Email Staf *</label>
                <input type="email" name="email" value="{{ old('email', 'admin@zimmoah.com') }}" required autofocus
                    class="w-full px-4 py-3 border border-slate-300 rounded-xl text-sm focus:outline-none focus:border-[#FECE00]">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Kata Sandi *</label>
                <input type="password" name="password" value="password123" required
                    class="w-full px-4 py-3 border border-slate-300 rounded-xl text-sm focus:outline-none focus:border-[#FECE00]">
            </div>

            <div class="flex items-center justify-between text-xs">
                <label class="flex items-center space-x-2 text-slate-600 cursor-pointer">
                    <input type="checkbox" name="remember" class="w-4 h-4 text-[#FECE00] rounded border-slate-300">
                    <span>Ingat sesi saya</span>
                </label>
            </div>

            <button type="submit" class="w-full bg-[#FECE00] hover:bg-[#E5B800] text-slate-950 font-black text-sm py-3.5 rounded-xl transition shadow-lg">
                Masuk ke Workspace
            </button>
        </form>

        <!-- Demo Credentials Hint -->
        <div class="bg-slate-50 p-4 rounded-2xl border border-slate-200/80 text-[11px] text-slate-600 space-y-1.5">
            <span class="font-bold text-slate-800 uppercase tracking-wider block">Akun Uji Coba Tersedia:</span>
            <p>&bull; <strong>Super Admin:</strong> <code class="text-slate-800">admin@zimmoah.com</code> / <code class="text-slate-800">password123</code></p>
            <p>&bull; <strong>Helpdesk Agent:</strong> <code class="text-slate-800">agent@zimmoah.com</code> / <code class="text-slate-800">password123</code></p>
            <p>&bull; <strong>HR Recruiter:</strong> <code class="text-slate-800">hr@zimmoah.com</code> / <code class="text-slate-800">password123</code></p>
        </div>

        <div class="text-center pt-1">
            <a href="{{ route('home') }}" class="text-xs text-slate-500 hover:text-[#00A3E0] font-semibold">
                &larr; Kembali ke Website Publik
            </a>
        </div>
    </div>
</body>
</html>

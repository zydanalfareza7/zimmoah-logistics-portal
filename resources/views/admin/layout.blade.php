<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-100 text-slate-800">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Zimmoah Operational Back-Office & Helpdesk' }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="min-h-full flex flex-col md:flex-row antialiased">

    <!-- Sidebar Navigation -->
    <aside class="w-full md:w-64 bg-[#0B1522] text-white flex-shrink-0 flex flex-col justify-between border-r border-slate-800">
        <div>
            <!-- Admin Brand -->
            <div class="p-6 border-b border-slate-800/80 flex items-center space-x-3">
                <div class="w-8 h-8 rounded-lg bg-[#00A3E0] text-white flex items-center justify-center font-black text-lg">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><polygon points="12,2 15,9 22,9 17,14 19,21 12,17 5,21 7,14 2,9 9,9"/></svg>
                </div>
                <div>
                    <h2 class="text-base font-extrabold tracking-wider">ZIMMOAH</h2>
                    <span class="text-[9px] uppercase tracking-widest text-[#00A3E0] font-bold block -mt-1">OPERATIONS HUB</span>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="p-4 space-y-1.5 text-xs font-semibold">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.dashboard') ? 'bg-[#00A3E0] text-white shadow-md' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span>Dashboard Utama</span>
                </a>

                <a href="{{ route('admin.tickets.index') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.tickets.*') ? 'bg-[#00A3E0] text-white shadow-md' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                    <div class="flex items-center space-x-3">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                        <span>Helpdesk & Tiket</span>
                    </div>
                </a>

                <a href="{{ route('admin.applications.index') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.applications.*') ? 'bg-[#00A3E0] text-white shadow-md' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                    <div class="flex items-center space-x-3">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        <span>HR ATS & Pelamar</span>
                    </div>
                </a>

                <div class="pt-4 border-t border-slate-800/80 my-2">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500 px-3.5 block mb-1">Tautan Publik</span>
                    <a href="{{ route('home') }}" target="_blank" class="flex items-center space-x-3 px-3.5 py-2 rounded-xl text-slate-400 hover:text-white hover:bg-slate-800/60">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        <span>Buka Website Publik</span>
                    </a>
                </div>
            </nav>
        </div>

        <!-- User Badge & Logout -->
        <div class="p-4 border-t border-slate-800/80 bg-slate-900/60">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2.5">
                    <div class="w-8 h-8 rounded-full bg-[#00A3E0]/20 text-[#00A3E0] border border-[#00A3E0]/40 flex items-center justify-center font-bold text-xs">
                        {{ substr(Auth::user()->name, 0, 2) }}
                    </div>
                    <div>
                        <span class="text-xs font-bold text-slate-200 block truncate w-32">{{ Auth::user()->name }}</span>
                        <span class="text-[10px] text-slate-400 block truncate">{{ Auth::user()->email }}</span>
                    </div>
                </div>

                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" title="Logout" class="text-slate-400 hover:text-rose-400 p-1.5 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Content Workspace -->
    <main class="flex-1 overflow-y-auto p-6 md:p-10">
        <!-- Flash Messages -->
        @if (session('success'))
            <div class="mb-6 bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-r-lg shadow-sm text-xs font-semibold text-emerald-800">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="mb-6 bg-rose-50 border-l-4 border-rose-500 p-4 rounded-r-lg shadow-sm text-xs font-semibold text-rose-800">
                {{ session('error') }}
            </div>
        @endif

        @yield('admin_content')
    </main>
</body>
</html>

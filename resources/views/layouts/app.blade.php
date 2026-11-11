<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50 text-slate-800">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Zimmoah Logistics - Forwarding, Warehousing, Trucking & Consolidation' }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="min-h-full flex flex-col antialiased selection:bg-[#FECE00] selection:text-slate-950">

    <!-- 1. DUAL-TIER HEADER WITH ZIMMOAH SIGNATURE PALETTE -->
    <header class="sticky top-0 z-50 bg-[#0B131F] border-b border-slate-800 text-white shadow-lg">
        <!-- Top Utility Bar -->
        <div class="border-b border-slate-800/80 text-xs py-2 px-4 sm:px-8 bg-[#070D16]">
            <div class="max-w-7xl mx-auto flex items-center justify-between">
                <!-- Search / AI Assistant -->
                <div class="flex items-center space-x-4">
                    <form action="{{ route('tracking') }}" method="GET" class="relative hidden md:flex items-center">
                        <span class="absolute left-3 text-slate-400">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </span>
                        <input type="text" name="tracking_number" placeholder="Track Cargo / Ask Zimmoah..." 
                            class="pl-8 pr-3 py-1 bg-slate-900 border border-slate-700/80 rounded-full text-xs text-white placeholder-slate-400 focus:outline-none focus:border-[#FECE00] transition w-56">
                    </form>
                    <span class="hidden lg:inline-flex items-center gap-1.5 text-slate-400 text-[11px]">
                        <span class="w-2 h-2 rounded-full bg-[#FECE00] animate-pulse"></span>
                        Operasional Seluruh Cabang Normal
                    </span>
                </div>

                <!-- Right Utility Menu -->
                <div class="flex items-center space-x-5 text-slate-300 ml-auto">
                    <div class="flex items-center space-x-1 cursor-pointer hover:text-[#FECE00] transition">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                        <span class="font-bold">English | Korean | Indonesian</span>
                    </div>

                    <a href="{{ route('tickets.track') }}" class="hover:text-[#FECE00] transition flex items-center space-x-1">
                        <svg class="w-3.5 h-3.5 text-[#FECE00]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>Support & Tiket</span>
                    </a>

                    <a href="{{ route('contact') }}" class="hover:text-[#FECE00] transition hidden sm:inline-block">Kontak Cabang</a>

                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="text-[#FECE00] font-bold hover:underline flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Panel Staf ({{ Auth::user()->name }})
                        </a>
                    @else
                        <a href="{{ route('admin.login') }}" class="bg-[#FECE00] hover:bg-[#E5B800] text-slate-950 font-black px-3.5 py-1 rounded-full transition shadow-sm">
                            Staff Login
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Main Primary Navigation -->
        <div class="max-w-7xl mx-auto px-4 sm:px-8 py-3.5 flex items-center justify-between">
            <!-- Official Zimmoah Logo -->
            <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                <!-- Iconic Z Emblem -->
                <div class="w-10 h-10 rounded-xl bg-[#FECE00] text-slate-950 flex items-center justify-center font-black shadow-md group-hover:scale-105 transition-transform flex-shrink-0">
                    <svg class="w-6 h-6 fill-current" viewBox="0 0 48 48">
                        <path d="M12 14h24v4.5L19.5 30H36v5H12v-4.5L28.5 19H12v-5z"/>
                    </svg>
                </div>
                <div class="flex flex-col">
                    <span class="text-2xl font-black tracking-wider text-white">ZIMMOAH</span>
                    <span class="text-[9px] uppercase tracking-widest text-[#FECE00] font-extrabold -mt-1">GLOBAL LOGISTICS</span>
                </div>
            </a>

            <!-- Desktop Nav Links -->
            <nav class="hidden md:flex items-center space-x-8 text-sm font-semibold">
                <a href="{{ route('schedules.index') }}" class="hover:text-[#FECE00] transition {{ request()->routeIs('schedules.*') ? 'text-[#FECE00] font-bold border-b-2 border-[#FECE00] pb-1' : 'text-slate-200' }}">Schedules</a>
                <a href="{{ route('tracking') }}" class="hover:text-[#FECE00] transition {{ request()->routeIs('tracking') ? 'text-[#FECE00] font-bold border-b-2 border-[#FECE00] pb-1' : 'text-slate-200' }}">Tracking</a>
                
                <!-- Services Dropdown -->
                <div class="relative group">
                    <button class="flex items-center space-x-1 hover:text-[#FECE00] transition text-slate-200 py-2">
                        <span>Services</span>
                        <svg class="w-3.5 h-3.5 transition group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div class="absolute left-0 mt-0 w-64 bg-[#0F1A2A] rounded-2xl shadow-2xl border border-slate-700/80 py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        <a href="{{ route('services.forwarding') }}" class="block px-4 py-2.5 text-xs text-slate-200 hover:bg-[#FECE00] hover:text-slate-950 transition rounded-lg mx-1">
                            <span class="font-extrabold block">Freight Forwarding</span>
                            <span class="text-slate-400 group-hover:text-slate-800 text-[11px]">Ocean & Air Cargo International</span>
                        </a>
                        <a href="{{ route('services.warehousing') }}" class="block px-4 py-2.5 text-xs text-slate-200 hover:bg-[#FECE00] hover:text-slate-950 transition rounded-lg mx-1">
                            <span class="font-extrabold block">Warehousing</span>
                            <span class="text-slate-400 group-hover:text-slate-800 text-[11px]">Gudang Transit & Customs Clearance</span>
                        </a>
                        <a href="{{ route('services.trucking') }}" class="block px-4 py-2.5 text-xs text-slate-200 hover:bg-[#FECE00] hover:text-slate-950 transition rounded-lg mx-1">
                            <span class="font-extrabold block">Trucking</span>
                            <span class="text-slate-400 group-hover:text-slate-800 text-[11px]">Inland Fleet & Trailer Transport</span>
                        </a>
                        <a href="{{ route('services.consolidation') }}" class="block px-4 py-2.5 text-xs text-slate-200 hover:bg-[#FECE00] hover:text-slate-950 transition rounded-lg mx-1">
                            <span class="font-extrabold block">Consolidation</span>
                            <span class="text-slate-400 group-hover:text-slate-800 text-[11px]">LCL / FCL Containerized Schedule</span>
                        </a>
                    </div>
                </div>

                <a href="{{ route('career.index') }}" class="hover:text-[#FECE00] transition {{ request()->routeIs('career.*') ? 'text-[#FECE00] font-bold border-b-2 border-[#FECE00] pb-1' : 'text-slate-200' }}">
                    Career
                    <span class="ml-1 text-[10px] bg-[#FECE00] text-slate-950 px-1.5 py-0.5 rounded-full font-black">Hiring</span>
                </a>
                <a href="{{ route('company.profile') }}" class="hover:text-[#FECE00] transition {{ request()->routeIs('company.profile') ? 'text-[#FECE00] font-bold border-b-2 border-[#FECE00] pb-1' : 'text-slate-200' }}">Company</a>
            </nav>

            <!-- CTA Button (Yellow Accent) -->
            <div class="hidden sm:flex items-center space-x-3">
                <a href="{{ route('tickets.create') }}" class="bg-[#FECE00] hover:bg-[#E5B800] text-slate-950 text-xs font-black px-5 py-2.5 rounded-full shadow-md hover:shadow-lg transition flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Buka Tiket Inquiry
                </a>
            </div>

            <!-- Mobile Menu Toggle Button -->
            <button id="mobileMenuBtn" class="md:hidden text-slate-300 hover:text-[#FECE00] p-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/></svg>
            </button>
        </div>

        <!-- Mobile Drawer -->
        <div id="mobileMenu" class="hidden md:hidden bg-[#070D16] border-t border-slate-800 px-6 py-4 space-y-3 text-sm">
            <a href="{{ route('schedules.index') }}" class="block py-2 text-slate-200 hover:text-[#FECE00]">Schedules</a>
            <a href="{{ route('tracking') }}" class="block py-2 text-slate-200 hover:text-[#FECE00]">Tracking</a>
            <div class="py-1 border-y border-slate-800/80">
                <span class="text-xs uppercase text-[#FECE00] font-extrabold tracking-wider">Layanan</span>
                <a href="{{ route('services.forwarding') }}" class="block py-1.5 text-xs text-slate-300 hover:text-white">Freight Forwarding</a>
                <a href="{{ route('services.warehousing') }}" class="block py-1.5 text-xs text-slate-300 hover:text-white">Warehousing</a>
                <a href="{{ route('services.trucking') }}" class="block py-1.5 text-xs text-slate-300 hover:text-white">Trucking</a>
                <a href="{{ route('services.consolidation') }}" class="block py-1.5 text-xs text-slate-300 hover:text-white">Consolidation</a>
            </div>
            <a href="{{ route('career.index') }}" class="block py-2 text-slate-200 hover:text-[#FECE00]">Career (Rekrutmen)</a>
            <a href="{{ route('company.profile') }}" class="block py-2 text-slate-200 hover:text-[#FECE00]">Company Profile</a>
            <a href="{{ route('tickets.create') }}" class="block py-2 text-[#FECE00] font-extrabold">Buka Tiket / Bantuan</a>
        </div>
    </header>

    <!-- 2. FLASH NOTIFICATIONS -->
    <div class="max-w-7xl mx-auto px-4 sm:px-8 mt-4 w-full">
        @if (session('success'))
            <div class="bg-amber-50 border-l-4 border-[#FECE00] p-4 rounded-r-xl shadow-sm flex items-start justify-between">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5 text-amber-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <p class="text-sm font-bold text-slate-900">{{ session('success') }}</p>
                </div>
                <button onclick="this.parentElement.remove()" class="text-slate-400 hover:text-slate-700 text-lg">&times;</button>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-rose-50 border-l-4 border-rose-500 p-4 rounded-r-xl shadow-sm flex items-start justify-between">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5 text-rose-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    <p class="text-sm font-medium text-rose-800">{{ session('error') }}</p>
                </div>
                <button onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-700 text-lg">&times;</button>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-rose-50 border-l-4 border-rose-500 p-4 rounded-r-xl shadow-sm">
                <p class="text-sm font-bold text-rose-800">Mohon perbaiki kesalahan berikut:</p>
                <ul class="list-disc list-inside text-xs text-rose-700 mt-1 space-y-0.5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <!-- 3. MAIN CONTENT -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- 4. FLOATING FEEDBACK TAB (ZIMMOAH YELLOW PALETTE) -->
    <div class="fixed right-0 top-1/2 -translate-y-1/2 z-40 hidden sm:block">
        <a href="{{ route('tickets.create') }}" class="bg-[#FECE00] hover:bg-[#E5B800] text-slate-950 font-black text-xs uppercase tracking-widest px-3 py-2 rounded-l-md shadow-xl flex items-center space-x-2 -rotate-90 origin-bottom-right transition transform hover:-translate-x-1">
            <span>Feedback & Inquiry</span>
        </a>
    </div>

    <!-- 5. ZIMMOAH CORPORATE FOOTER -->
    <footer class="bg-[#0B131F] text-slate-300 border-t border-slate-800 mt-20">
        <!-- Main Footer Links & Offices -->
        <div class="max-w-7xl mx-auto px-4 sm:px-8 py-16 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
            <!-- Col 1: Brand & Bio -->
            <div class="space-y-4">
                <div class="flex items-center space-x-3">
                    <div class="w-9 h-9 rounded-xl bg-[#FECE00] text-slate-950 flex items-center justify-center font-black">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 48 48">
                            <path d="M12 14h24v4.5L19.5 30H36v5H12v-4.5L28.5 19H12v-5z"/>
                        </svg>
                    </div>
                    <span class="text-xl font-black tracking-wider text-white">ZIMMOAH</span>
                </div>
                <p class="text-xs text-slate-400 leading-relaxed">
                    Penyedia layanan logistik, trucking, pergudangan, dan freight forwarding global terintegrasi dengan jaringan rute Asia-Pasifik dan domestik Indonesia.
                </p>
                <div class="pt-2">
                    <a href="{{ route('tickets.create') }}" class="inline-flex items-center space-x-2 text-xs font-bold text-[#FECE00] hover:underline">
                        <span>Pusat Dukungan Tiket Online</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>

            <!-- Col 2: Services & Quick Links -->
            <div>
                <h4 class="text-sm font-black text-white uppercase tracking-wider mb-4 border-b border-slate-800 pb-2">Layanan Logistik</h4>
                <ul class="space-y-2.5 text-xs text-slate-400">
                    <li><a href="{{ route('services.forwarding') }}" class="hover:text-[#FECE00] transition">Air & Ocean Freight Forwarding</a></li>
                    <li><a href="{{ route('services.warehousing') }}" class="hover:text-[#FECE00] transition">Warehousing & Bonded Storage</a></li>
                    <li><a href="{{ route('services.trucking') }}" class="hover:text-[#FECE00] transition">Inland Trucking & Trailer Fleet</a></li>
                    <li><a href="{{ route('services.consolidation') }}" class="hover:text-[#FECE00] transition">Consolidation Services (LCL/FCL)</a></li>
                    <li><a href="{{ route('schedules.index') }}" class="hover:text-[#FECE00] transition">Jadwal Keberangkatan Kapal & Pesawat</a></li>
                    <li><a href="{{ route('career.index') }}" class="hover:text-[#FECE00] transition">Karir & Rekrutmen Perusahaan</a></li>
                </ul>
            </div>

            <!-- Col 3: Head Office & Airport -->
            <div>
                <h4 class="text-sm font-black text-white uppercase tracking-wider mb-4 border-b border-slate-800 pb-2">Kantor Jakarta</h4>
                <div class="space-y-3 text-xs text-slate-400">
                    <div>
                        <strong class="text-white block">Jakarta Head Office</strong>
                        <span>Kirana Boutique Office, Jl. Kirana Avenue 2 Blok D2 No. 10-11 Kelapa Gading, Jakarta Utara 14240</span>
                        <p class="mt-1 text-slate-400">Tel: +62-21 2937 5570 | Fax: +62-21 2937 5571</p>
                        <p class="text-[#FECE00] font-semibold">zimmoah@zimmoah.com</p>
                    </div>
                    <div class="pt-2 border-t border-slate-800/60">
                        <strong class="text-white block">Airport Office (Soekarno-Hatta)</strong>
                        <span>Wisma Soewarna Suite 2-F, Soewarna Bisnis Park, Bandara Soekarno-Hatta</span>
                        <p class="mt-1 text-slate-400">Tel: +62-21 5591 1663 | Fax: +62-21 5591 1640</p>
                        <p class="text-[#FECE00] font-semibold">aircargo@zimmoah.com</p>
                    </div>
                </div>
            </div>

            <!-- Col 4: Semarang Office & Legal -->
            <div>
                <h4 class="text-sm font-black text-white uppercase tracking-wider mb-4 border-b border-slate-800 pb-2">Kantor Cabang Daerah</h4>
                <div class="space-y-3 text-xs text-slate-400">
                    <div>
                        <strong class="text-white block">Semarang Office</strong>
                        <span>Jl. Puri Anjasmoro Block EE1 No. 17A, Tawangsari, Semarang Barat, Kota Semarang 50144</span>
                        <p class="mt-1 text-slate-400">Tel: +62-24 7643 4641 | Fax: +62-24 7643 4168</p>
                        <p class="text-[#FECE00] font-semibold">semarang@zimmoah.com</p>
                    </div>
                    <div class="pt-4 border-t border-slate-800/60">
                        <span class="text-[11px] text-slate-500 block leading-relaxed">
                            Terdaftar dan diawasi oleh Asosiasi Logistik & Forwarder Indonesia (ALFI) & Kemenhub RI.
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Copyright Bar -->
        <div class="border-t border-slate-800/80 py-6 px-4 sm:px-8 text-xs text-slate-500">
            <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-4">
                <p>&copy; {{ date('Y') }} PT Zimmoah Trans Global. All rights reserved. Powered by Laravel & PHP 8.4.</p>
                <div class="flex items-center space-x-6">
                    <a href="#" class="hover:text-slate-300">Kebijakan Privasi (UU PDP)</a>
                    <a href="#" class="hover:text-slate-300">Syarat & Ketentuan Pengiriman</a>
                    <a href="{{ route('admin.login') }}" class="hover:text-[#FECE00]">Internal Portal</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        const mobileBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        if (mobileBtn && mobileMenu) {
            mobileBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }
    </script>
</body>
</html>

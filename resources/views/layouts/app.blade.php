<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#FFFDF5] text-neutral-950">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/zimmoah-favicon.svg') }}">
    <title>{{ $title ?? 'Zimmoah Logistics - Forwarding, Warehousing, Trucking & Consolidation' }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="min-h-full flex flex-col antialiased selection:bg-black selection:text-[#FECE00]">

    <!-- 1. ZIMMOAH SIGNATURE HEADER (THIN BLACK TOP BAR + BOLD #FECE00 YELLOW NAVBAR LIKE ZIMMOAH.COM) -->
    <header class="sticky top-0 z-50 shadow-md">
        <!-- Top Utility Strip (Sleek Black Bar matching zimmoah.com top trim) -->
        <div class="bg-black text-neutral-200 text-xs py-2 px-4 sm:px-8 border-b border-black">
            <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">
                <!-- Search & Operational Status -->
                <div class="flex items-center space-x-4">
                    <form action="{{ route('tracking') }}" method="GET" class="relative hidden md:flex items-center">
                        <span class="absolute left-3 text-neutral-400">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </span>
                        <input type="text" name="tracking_number" placeholder="{{ __('messages.search_placeholder') }}"
                            class="pl-8 pr-3 py-1 bg-neutral-900 border border-neutral-700 rounded-full text-xs text-white placeholder-neutral-400 focus:outline-none focus:border-[#FECE00] transition w-56">
                    </form>
                    <span class="hidden lg:inline-flex items-center gap-1.5 text-neutral-300 text-[11px]">
                        <span class="w-2 h-2 rounded-full bg-[#FECE00] animate-pulse"></span>
                        {{ __('messages.ops_normal') }}
                    </span>
                </div>

                <!-- Right Utility Menu -->
                <div class="flex items-center space-x-5 text-neutral-200 ml-auto">
                    @php $currentLocale = app()->getLocale(); @endphp
                    <div class="flex items-center space-x-1.5" aria-label="Language Switcher">
                        <svg class="w-3.5 h-3.5 text-[#FECE00]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                        <a href="{{ route('locale.switch', 'en') }}" class="transition {{ $currentLocale === 'en' ? 'text-[#FECE00] font-black underline underline-offset-4' : 'text-neutral-300 hover:text-white font-semibold' }}">English</a>
                        <span class="text-neutral-600">|</span>
                        <a href="{{ route('locale.switch', 'ko') }}" class="transition {{ $currentLocale === 'ko' ? 'text-[#FECE00] font-black underline underline-offset-4' : 'text-neutral-300 hover:text-white font-semibold' }}">한국어</a>
                        <span class="text-neutral-600">|</span>
                        <a href="{{ route('locale.switch', 'id') }}" class="transition {{ $currentLocale === 'id' ? 'text-[#FECE00] font-black underline underline-offset-4' : 'text-neutral-300 hover:text-white font-semibold' }}">Indonesian</a>
                    </div>

                    <a href="{{ route('tickets.track') }}" class="hover:text-[#FECE00] transition flex items-center space-x-1">
                        <svg class="w-3.5 h-3.5 text-[#FECE00]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>{{ __('messages.support_tickets') }}</span>
                    </a>

                    <a href="{{ route('contact') }}" class="hover:text-[#FECE00] transition hidden sm:inline-block">{{ __('messages.branch_contact') }}</a>

                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="text-[#FECE00] font-bold hover:underline flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            {{ __('messages.staff_panel') }} ({{ Auth::user()->name }})
                        </a>
                    @else
                        <a href="{{ route('admin.login') }}" class="bg-[#FECE00] hover:bg-white text-black font-black px-3.5 py-1 rounded-full transition shadow-sm">
                            {{ __('messages.staff_login') }}
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Main Primary Navigation (Signature Zimmoah Yellow #FECE00) -->
        <div class="bg-[#FECE00] text-black border-b-2 border-black/15">
            <div class="max-w-7xl mx-auto px-4 sm:px-8 py-2.5 flex items-center justify-between">
                <!-- Official Zimmoah.com Stacked Vector Logo (White Squircle Z + ZIMMOAH AH Wave) -->
                <a href="{{ route('home') }}" class="flex items-center group" aria-label="ZIMMOAH Home">
                    <img src="{{ asset('images/zimmoah-logo.svg') }}" alt="ZIMMOAH" class="h-12 sm:h-14 w-auto group-hover:scale-105 transition-transform">
                    <span class="sr-only">ZIMMOAH</span>
                </a>

                <!-- Desktop Nav Links -->
                <nav class="hidden md:flex items-center space-x-7 text-sm font-bold text-black">
                    <a href="{{ route('schedules.index') }}" class="hover:opacity-70 transition {{ request()->routeIs('schedules.*') ? 'font-black border-b-2 border-black pb-1' : '' }}">{{ __('messages.nav_schedules') }}</a>
                    <a href="{{ route('tracking') }}" class="hover:opacity-70 transition {{ request()->routeIs('tracking') ? 'font-black border-b-2 border-black pb-1' : '' }}">{{ __('messages.nav_tracking') }}</a>

                    <!-- Services Dropdown (Crisp White Card with High Contrast Black Text & Yellow Hover) -->
                    <div class="relative group">
                        <button class="flex items-center space-x-1 hover:opacity-75 transition text-black py-2 font-bold">
                            <span>{{ __('messages.nav_services') }}</span>
                            <svg class="w-3.5 h-3.5 transition group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div class="absolute left-0 mt-0 w-72 bg-white rounded-2xl shadow-2xl border-2 border-black/15 py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                            <a href="{{ route('services.forwarding') }}" class="group/item block px-4 py-2.5 text-xs text-black hover:bg-[#FECE00] transition rounded-xl mx-1.5">
                                <span class="font-black block text-sm text-black">{{ __('messages.svc_forwarding') }}</span>
                                <span class="text-neutral-600 group-hover/item:text-black text-[11px] font-medium block mt-0.5">{{ __('messages.svc_forwarding_desc') }}</span>
                            </a>
                            <a href="{{ route('services.warehousing') }}" class="group/item block px-4 py-2.5 text-xs text-black hover:bg-[#FECE00] transition rounded-xl mx-1.5">
                                <span class="font-black block text-sm text-black">{{ __('messages.svc_warehousing') }}</span>
                                <span class="text-neutral-600 group-hover/item:text-black text-[11px] font-medium block mt-0.5">{{ __('messages.svc_warehousing_desc') }}</span>
                            </a>
                            <a href="{{ route('services.trucking') }}" class="group/item block px-4 py-2.5 text-xs text-black hover:bg-[#FECE00] transition rounded-xl mx-1.5">
                                <span class="font-black block text-sm text-black">{{ __('messages.svc_trucking') }}</span>
                                <span class="text-neutral-600 group-hover/item:text-black text-[11px] font-medium block mt-0.5">{{ __('messages.svc_trucking_desc') }}</span>
                            </a>
                            <a href="{{ route('services.consolidation') }}" class="group/item block px-4 py-2.5 text-xs text-black hover:bg-[#FECE00] transition rounded-xl mx-1.5">
                                <span class="font-black block text-sm text-black">{{ __('messages.svc_consolidation') }}</span>
                                <span class="text-neutral-600 group-hover/item:text-black text-[11px] font-medium block mt-0.5">{{ __('messages.svc_consolidation_desc') }}</span>
                            </a>
                        </div>
                    </div>

                    <a href="{{ route('career.index') }}" class="hover:opacity-70 transition flex items-center {{ request()->routeIs('career.*') ? 'font-black border-b-2 border-black pb-1' : '' }}">
                        {{ __('messages.nav_career') }}
                        <span class="ml-1.5 text-[10px] bg-black text-[#FECE00] px-2 py-0.5 rounded-full font-black">{{ __('messages.nav_hiring') }}</span>
                    </a>

                    <!-- Company Dropdown (All Official Zimmoah.com Corporate Sections) -->
                    <div class="relative group">
                        <button class="flex items-center space-x-1 hover:opacity-75 transition text-black py-2 font-bold {{ request()->routeIs('company.*') || request()->routeIs('contact') ? 'font-black border-b-2 border-black' : '' }}">
                            <span>{{ __('messages.nav_company') }}</span>
                            <svg class="w-3.5 h-3.5 transition group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div class="absolute right-0 mt-0 w-80 bg-white rounded-2xl shadow-2xl border-2 border-black/15 py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                            <a href="{{ route('company.profile') }}" class="group/item block px-4 py-2 text-xs text-black hover:bg-[#FECE00] transition rounded-xl mx-1.5">
                                <span class="font-black block text-sm text-black">{{ __('messages.cmp_profile') }}</span>
                                <span class="text-neutral-600 group-hover/item:text-black text-[11px] font-medium block">{{ __('messages.cmp_profile_desc') }}</span>
                            </a>
                            <a href="{{ route('company.ceo') }}" class="group/item block px-4 py-2 text-xs text-black hover:bg-[#FECE00] transition rounded-xl mx-1.5">
                                <span class="font-black block text-sm text-black">{{ __('messages.cmp_ceo') }}</span>
                                <span class="text-neutral-600 group-hover/item:text-black text-[11px] font-medium block">{{ __('messages.cmp_ceo_desc') }}</span>
                            </a>
                            <a href="{{ route('company.history') }}" class="group/item block px-4 py-2 text-xs text-black hover:bg-[#FECE00] transition rounded-xl mx-1.5">
                                <span class="font-black block text-sm text-black">{{ __('messages.cmp_history') }}</span>
                                <span class="text-neutral-600 group-hover/item:text-black text-[11px] font-medium block">{{ __('messages.cmp_history_desc') }}</span>
                            </a>
                            <a href="{{ route('company.cip') }}" class="group/item block px-4 py-2 text-xs text-black hover:bg-[#FECE00] transition rounded-xl mx-1.5">
                                <span class="font-black block text-sm text-black">{{ __('messages.cmp_cip') }}</span>
                                <span class="text-neutral-600 group-hover/item:text-black text-[11px] font-medium block">{{ __('messages.cmp_cip_desc') }}</span>
                            </a>
                            <a href="{{ route('company.license') }}" class="group/item block px-4 py-2 text-xs text-black hover:bg-[#FECE00] transition rounded-xl mx-1.5">
                                <span class="font-black block text-sm text-black">{{ __('messages.cmp_license') }}</span>
                                <span class="text-neutral-600 group-hover/item:text-black text-[11px] font-medium block">{{ __('messages.cmp_license_desc') }}</span>
                            </a>
                            <a href="{{ route('company.organization') }}" class="group/item block px-4 py-2 text-xs text-black hover:bg-[#FECE00] transition rounded-xl mx-1.5">
                                <span class="font-black block text-sm text-black">{{ __('messages.cmp_organization') }}</span>
                                <span class="text-neutral-600 group-hover/item:text-black text-[11px] font-medium block">{{ __('messages.cmp_organization_desc') }}</span>
                            </a>
                            <a href="{{ route('company.branches') }}" class="group/item block px-4 py-2 text-xs text-black hover:bg-[#FECE00] transition rounded-xl mx-1.5">
                                <span class="font-black block text-sm text-black">{{ __('messages.cmp_branches') }}</span>
                                <span class="text-neutral-600 group-hover/item:text-black text-[11px] font-medium block">{{ __('messages.cmp_branches_desc') }}</span>
                            </a>
                            <a href="{{ route('contact') }}" class="group/item block px-4 py-2 text-xs text-black hover:bg-[#FECE00] transition rounded-xl mx-1.5">
                                <span class="font-black block text-sm text-black">{{ __('messages.cmp_directory') }}</span>
                                <span class="text-neutral-600 group-hover/item:text-black text-[11px] font-medium block">{{ __('messages.cmp_directory_desc') }}</span>
                            </a>
                        </div>
                    </div>
                </nav>

                <!-- CTA Button (Solid Black + Signature Yellow Text) -->
                <div class="hidden sm:flex items-center space-x-3">
                    <a href="{{ route('tickets.create') }}" class="bg-black hover:bg-neutral-800 text-[#FECE00] text-xs font-black px-5 py-2.5 rounded-full shadow-md hover:shadow-lg transition flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                        {{ __('messages.open_inquiry_ticket') }}
                    </a>
                </div>

                <!-- Mobile Menu Toggle Button -->
                <button id="mobileMenuBtn" class="md:hidden text-black hover:bg-black/10 rounded-xl p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16m-7 6h7"/></svg>
                </button>
            </div>
        </div>

        <!-- Mobile Drawer (Zimmoah Yellow) -->
        <div id="mobileMenu" class="hidden md:hidden bg-[#F5C600] border-b-2 border-black/20 px-6 py-4 space-y-2.5 text-sm font-bold text-black">
            <a href="{{ route('schedules.index') }}" class="block py-1.5 hover:underline">{{ __('messages.nav_schedules') }}</a>
            <a href="{{ route('tracking') }}" class="block py-1.5 hover:underline">{{ __('messages.nav_tracking') }}</a>
            <div class="py-2 border-y border-black/15 space-y-1">
                <span class="text-[11px] uppercase text-black font-black tracking-wider">{{ __('messages.nav_services') }}</span>
                <a href="{{ route('services.forwarding') }}" class="block py-1 text-xs text-neutral-900 hover:underline">{{ __('messages.svc_forwarding') }}</a>
                <a href="{{ route('services.warehousing') }}" class="block py-1 text-xs text-neutral-900 hover:underline">{{ __('messages.svc_warehousing') }}</a>
                <a href="{{ route('services.trucking') }}" class="block py-1 text-xs text-neutral-900 hover:underline">{{ __('messages.svc_trucking') }}</a>
                <a href="{{ route('services.consolidation') }}" class="block py-1 text-xs text-neutral-900 hover:underline">{{ __('messages.svc_consolidation') }}</a>
            </div>
            <a href="{{ route('career.index') }}" class="block py-1.5 hover:underline">{{ __('messages.nav_career') }}</a>
            <div class="py-2 border-y border-black/15 space-y-1">
                <span class="text-[11px] uppercase text-black font-black tracking-wider">{{ __('messages.nav_company') }}</span>
                <a href="{{ route('company.profile') }}" class="block py-1 text-xs text-neutral-900 hover:underline">{{ __('messages.cmp_profile') }}</a>
                <a href="{{ route('company.ceo') }}" class="block py-1 text-xs text-neutral-900 hover:underline">{{ __('messages.cmp_ceo') }}</a>
                <a href="{{ route('company.history') }}" class="block py-1 text-xs text-neutral-900 hover:underline">{{ __('messages.cmp_history') }}</a>
                <a href="{{ route('company.cip') }}" class="block py-1 text-xs text-neutral-900 hover:underline">{{ __('messages.cmp_cip') }}</a>
                <a href="{{ route('company.license') }}" class="block py-1 text-xs text-neutral-900 hover:underline">{{ __('messages.cmp_license') }}</a>
                <a href="{{ route('company.organization') }}" class="block py-1 text-xs text-neutral-900 hover:underline">{{ __('messages.cmp_organization') }}</a>
                <a href="{{ route('company.branches') }}" class="block py-1 text-xs text-neutral-900 hover:underline">{{ __('messages.cmp_branches') }}</a>
                <a href="{{ route('contact') }}" class="block py-1 text-xs text-neutral-900 hover:underline">{{ __('messages.cmp_directory') }}</a>
            </div>
            <a href="{{ route('tickets.create') }}" class="inline-block mt-1 bg-black text-[#FECE00] px-4 py-2 rounded-full text-xs font-black">{{ __('messages.open_inquiry_ticket') }}</a>
        </div>
    </header>

    <!-- 2. FLASH NOTIFICATIONS -->
    @if (session('success') || session('error') || $errors->any())
    <div class="max-w-7xl mx-auto px-4 sm:px-8 mt-4 w-full">
        @if (session('success'))
            <div class="bg-white border-2 border-[#FECE00] border-l-8 p-4 rounded-2xl shadow-sm flex items-start justify-between">
                <div class="flex items-center space-x-3">
                    <span class="w-6 h-6 rounded-full bg-[#FECE00] text-black flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                    </span>
                    <p class="text-sm font-bold text-black">{{ session('success') }}</p>
                </div>
                <button onclick="this.parentElement.remove()" class="text-neutral-500 hover:text-black text-lg font-bold">&times;</button>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-rose-50 border-l-4 border-rose-600 p-4 rounded-r-xl shadow-sm flex items-start justify-between">
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5 text-rose-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    <p class="text-sm font-semibold text-rose-800">{{ session('error') }}</p>
                </div>
                <button onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-700 text-lg">&times;</button>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-rose-50 border-l-4 border-rose-600 p-4 rounded-r-xl shadow-sm">
                <p class="text-sm font-bold text-rose-800">Mohon perbaiki kesalahan berikut:</p>
                <ul class="list-disc list-inside text-xs text-rose-700 mt-1 space-y-0.5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    @endif

    <!-- 3. MAIN CONTENT -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- 4. FLOATING FEEDBACK TAB (HIGH CONTRAST BLACK + YELLOW) -->
    <div class="fixed right-0 top-1/2 -translate-y-1/2 z-40 hidden sm:block">
        <a href="{{ route('tickets.create') }}" class="bg-black hover:bg-neutral-800 text-[#FECE00] font-black text-xs uppercase tracking-widest px-3.5 py-2 rounded-l-md shadow-xl flex items-center space-x-2 -rotate-90 origin-bottom-right transition transform hover:-translate-x-1 border border-[#FECE00]/40">
            <span>Feedback & Inquiry</span>
        </a>
    </div>

    <!-- 4B. FLOATING ZIMMOAH ASSISTANT CHATBOT -->
    @include('components.chatbot-widget')

    <!-- 5. ZIMMOAH CORPORATE FOOTER (SIGNATURE #FECE00 YELLOW FOOTER LIKE ZIMMOAH.COM) -->
    <footer class="bg-[#FECE00] text-black border-t-4 border-black mt-20">
        <!-- Main Footer Links & 3 Official Offices -->
        <div class="max-w-7xl mx-auto px-4 sm:px-8 py-14 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
            <!-- Col 1: Brand & Bio -->
            <div class="space-y-4">
                <a href="{{ route('home') }}" class="inline-block">
                    <img src="{{ asset('images/zimmoah-logo.svg') }}" alt="ZIMMOAH" class="h-16 w-auto">
                </a>
                <p class="text-xs text-neutral-900 font-medium leading-relaxed">
                    Penyedia layanan logistik, trucking, pergudangan, dan freight forwarding global terintegrasi dengan jaringan rute Asia-Pasifik dan domestik Indonesia.
                </p>
                <div class="pt-1">
                    <a href="{{ route('tickets.create') }}" class="inline-flex items-center space-x-2 text-xs font-black bg-black text-[#FECE00] hover:bg-neutral-800 px-4 py-2 rounded-full transition shadow-sm">
                        <span>Pusat Dukungan Tiket Online</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>

            <!-- Col 2: Services & Quick Links -->
            <div>
                <h4 class="text-xs font-black text-black uppercase tracking-widest mb-4 border-b-2 border-black/20 pb-2">Layanan &amp; Perusahaan</h4>
                <ul class="space-y-2 text-xs text-neutral-900 font-semibold">
                    <li><a href="{{ route('services.forwarding') }}" class="hover:underline">Air &amp; Ocean Freight Forwarding</a></li>
                    <li><a href="{{ route('services.warehousing') }}" class="hover:underline">Warehousing &amp; Bonded Storage</a></li>
                    <li><a href="{{ route('services.trucking') }}" class="hover:underline">Inland Trucking &amp; Trailer Fleet</a></li>
                    <li><a href="{{ route('services.consolidation') }}" class="hover:underline">Consolidation Services (LCL/FCL)</a></li>
                    <li><a href="{{ route('schedules.index') }}" class="hover:underline">Jadwal Kapal &amp; Pesawat (+ PDF)</a></li>
                    <li><a href="{{ route('company.ceo') }}" class="hover:underline">{{ __('messages.cmp_ceo') }}</a></li>
                    <li><a href="{{ route('company.history') }}" class="hover:underline">{{ __('messages.cmp_history') }}</a></li>
                    <li><a href="{{ route('company.cip') }}" class="hover:underline">{{ __('messages.cmp_cip') }}</a></li>
                    <li><a href="{{ route('company.branches') }}" class="hover:underline">{{ __('messages.cmp_branches') }}</a></li>
                    <li><a href="{{ route('career.index') }}" class="hover:underline">Karir &amp; Rekrutmen Perusahaan</a></li>
                </ul>
            </div>

            <!-- Col 3: Jakarta Head Office & Airport Office -->
            <div>
                <h4 class="text-xs font-black text-black uppercase tracking-widest mb-4 border-b-2 border-black/20 pb-2">Jakarta &amp; Airport Office</h4>
                <div class="space-y-3 text-xs text-neutral-900">
                    <div>
                        <strong class="text-black font-black block">Jakarta Head Office</strong>
                        <span>Kirana Boutique Office, Jl. Kirana Avenue 2 Blok D2 No. 10-11 Kelapa Gading, Jakarta Utara 14240</span>
                        <p class="mt-1 font-semibold">Tel: +(62-21) 2937 5670 (Hunting) | Fax: +(62-21) 2937 5671</p>
                        <p class="font-black underline">zimmoah@zimmoah.com</p>
                    </div>
                    <div class="pt-2.5 border-t border-black/15">
                        <strong class="text-black font-black block">Airport Office (Soekarno-Hatta)</strong>
                        <span>Wisma Soewarna Suite 2-F, Soewarna Bisnis Park, Bandara Soekarno-Hatta</span>
                        <p class="mt-1 font-semibold">Tel: +(62-21) 5591 1853 | Fax: +(62-21) 5695 6640</p>
                        <p class="font-black underline">aircargo@zimmoah.com</p>
                    </div>
                </div>
            </div>

            <!-- Col 4: Semarang Office & Legal -->
            <div>
                <h4 class="text-xs font-black text-black uppercase tracking-widest mb-4 border-b-2 border-black/20 pb-2">Semarang Office</h4>
                <div class="space-y-3 text-xs text-neutral-900">
                    <div>
                        <strong class="text-black font-black block">Semarang Office</strong>
                        <span>Jl. Puri Anjasmoro Block EE1 No. 17A, Tawangsari, Kec. Semarang Barat, Kota Semarang 50144</span>
                        <p class="mt-1 font-semibold">Tel: +(62-24) 7643 4641 / 7643 4861 | Fax: +(62-24) 7643 4158</p>
                        <p class="font-black underline">semarang@zimmoah.com</p>
                    </div>
                    <div class="pt-3 border-t border-black/15">
                        <span class="text-[11px] text-neutral-900/80 font-medium block leading-relaxed">
                            PT. Zimmoah Marine Trans (Est. 1989) &mdash; Terdaftar pada ALFI/ILFA, IATA, dan Kemenhub RI.
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Black Copyright Bar -->
        <div class="bg-black text-neutral-300 py-5 px-4 sm:px-8 text-xs">
            <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-4">
                <p>&copy; {{ date('Y') }} PT Zimmoah Trans Global. All rights reserved. Powered by Laravel & PHP 8.4.</p>
                <div class="flex items-center space-x-6">
                    <a href="{{ route('company.profile') }}" class="hover:text-[#FECE00] transition">Kebijakan Privasi (UU PDP)</a>
                    <a href="{{ route('contact') }}" class="hover:text-[#FECE00] transition">Syarat & Ketentuan Pengiriman</a>
                    <a href="{{ route('admin.login') }}" class="text-[#FECE00] font-bold hover:underline">Internal Portal</a>
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

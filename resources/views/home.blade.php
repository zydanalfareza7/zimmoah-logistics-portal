@extends('layouts.app')

@section('content')
<!-- 1. HERO SECTION: SIGNATURE ZIMMOAH.COM BOLD YELLOW (#FECE00) + MONOCHROME LOGISTICS IMAGERY -->
<div class="relative bg-[#FECE00] text-black overflow-hidden border-b-2 border-black/10">
    <!-- Monochrome Logistics Background Image (Signature zimmoah.com Yellow + B&W Aesthetic) -->
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=2000&q=80"
             alt="Zimmoah Inland & Ocean Logistics"
             class="w-full h-full object-cover object-center grayscale contrast-125 opacity-25 mix-blend-multiply">
        <!-- Bold Zimmoah Yellow Gradient Fade from Left for Ultra-Crisp Black Typography -->
        <div class="absolute inset-0 bg-gradient-to-r from-[#FECE00] via-[#FECE00]/92 to-[#FECE00]/35"></div>
    </div>

    <!-- Hero Content Container with Generous Breathing Space -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-8 pt-14 sm:pt-20 pb-32 sm:pb-44 w-full">
        <div class="max-w-3xl space-y-6">
            <span class="inline-flex items-center gap-2 bg-black text-[#FECE00] text-xs uppercase tracking-widest font-black px-4 py-1.5 rounded-full shadow-md">
                <span class="w-2 h-2 rounded-full bg-[#FECE00] animate-pulse"></span>
                {{ __('messages.hero_badge') }}
            </span>

            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black tracking-tight text-black leading-tight">
                {{ __('messages.hero_title_prefix') }}
                <span class="bg-black text-[#FECE00] px-3 py-0.5 rounded-2xl inline-block">{{ __('messages.hero_title_highlight') }}</span>
                {{ __('messages.hero_title_suffix') }}
            </h1>

            <p class="text-base sm:text-lg text-neutral-900 font-semibold leading-relaxed max-w-2xl">
                {{ __('messages.hero_subtitle') }}
            </p>

            <!-- CTA Buttons with Clear Bottom Spacing -->
            <div class="flex flex-wrap items-center gap-4 pt-3 mb-4">
                <a href="#services" class="bg-black hover:bg-neutral-800 text-[#FECE00] font-black text-sm px-8 py-4 rounded-full shadow-xl transition transform hover:-translate-y-0.5">
                    {{ __('messages.hero_cta_services') }}
                </a>
                <a href="{{ route('tickets.create') }}" class="bg-white hover:bg-neutral-100 border-2 border-black text-black font-black text-sm px-7 py-3.5 rounded-full transition shadow-lg">
                    {{ __('messages.hero_cta_ticket') }}
                </a>
            </div>
        </div>
    </div>
</div>

<!-- 2. QUICK-ACTION TOOL (MAERSK TABBED WIDGET - CRISP WHITE POPPING OVER ZIMMOAH YELLOW) -->
<div class="relative z-20 max-w-5xl mx-auto px-4 sm:px-8 -mt-20 sm:-mt-24 mb-14">
    <div class="bg-white rounded-3xl shadow-2xl border-2 border-black/15 overflow-hidden">
        <!-- Tab Headers -->
        <div class="flex border-b border-neutral-200 bg-[#FFFBE6] text-xs sm:text-sm font-black text-neutral-700">
            <button onclick="switchTab('tracking-tab')" id="btn-tracking-tab" class="tab-btn flex-1 py-4 px-4 text-center border-b-4 border-black bg-white text-black flex items-center justify-center gap-2 transition">
                <svg class="w-4 h-4 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                {{ __('messages.tab_track') }}
            </button>
            <button onclick="switchTab('schedules-tab')" id="btn-schedules-tab" class="tab-btn flex-1 py-4 px-4 text-center border-b-4 border-transparent hover:text-black flex items-center justify-center gap-2 transition">
                <svg class="w-4 h-4 text-neutral-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                {{ __('messages.tab_schedules') }}
            </button>
            <button onclick="switchTab('quote-tab')" id="btn-quote-tab" class="tab-btn flex-1 py-4 px-4 text-center border-b-4 border-transparent hover:text-black flex items-center justify-center gap-2 transition hidden sm:flex">
                <svg class="w-4 h-4 text-neutral-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                {{ __('messages.tab_quote') }}
            </button>
        </div>

        <!-- Tab 1: Tracking Tool -->
        <div id="tracking-tab" class="tab-content p-6 sm:p-8">
            <form action="{{ route('tracking') }}" method="GET" class="flex flex-col sm:flex-row items-center gap-4">
                <div class="relative flex-1 w-full">
                    <label class="block text-xs font-black text-neutral-700 uppercase tracking-wider mb-1.5">{{ __('messages.track_input_label') }}</label>
                    <input type="text" name="tracking_number" placeholder="{{ __('messages.track_input_placeholder') }}"
                        class="w-full px-4 py-3.5 border-2 border-neutral-300 rounded-2xl text-sm font-bold text-black focus:outline-none focus:border-black focus:ring-2 focus:ring-[#FECE00] transition">
                </div>
                <div class="w-full sm:w-auto pt-0 sm:pt-6">
                    <button type="submit" class="w-full sm:w-auto bg-black hover:bg-neutral-800 text-[#FECE00] font-black text-sm px-8 py-3.5 rounded-2xl shadow-md transition flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        {{ __('messages.track_button') }}
                    </button>
                </div>
            </form>
            <div class="mt-4 flex flex-wrap items-center justify-between gap-2 text-xs text-neutral-600">
                <span>{{ __('messages.track_helper') }}</span>
                <a href="{{ route('tickets.lookup') }}" class="text-black font-black underline decoration-[#FECE00] decoration-2 underline-offset-4 hover:opacity-75">{{ __('messages.track_ticket_link') }} &rarr;</a>
            </div>
        </div>

        <!-- Tab 2: Schedules Finder -->
        <div id="schedules-tab" class="tab-content p-6 sm:p-8 hidden">
            <form action="{{ route('schedules.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-black text-neutral-700 uppercase tracking-wider mb-1.5">{{ __('messages.origin_label') }}</label>
                    <input type="text" name="origin" placeholder="{{ __('messages.origin_placeholder') }}"
                        class="w-full px-4 py-3.5 border-2 border-neutral-300 rounded-2xl text-sm font-bold text-black focus:outline-none focus:border-black">
                </div>
                <div>
                    <label class="block text-xs font-black text-neutral-700 uppercase tracking-wider mb-1.5">{{ __('messages.destination_label') }}</label>
                    <input type="text" name="destination" placeholder="{{ __('messages.destination_placeholder') }}"
                        class="w-full px-4 py-3.5 border-2 border-neutral-300 rounded-2xl text-sm font-bold text-black focus:outline-none focus:border-black">
                </div>
                <div class="pt-0 sm:pt-6">
                    <button type="submit" class="w-full bg-black hover:bg-neutral-800 text-[#FECE00] font-black text-sm px-6 py-3.5 rounded-2xl shadow-md transition">
                        {{ __('messages.search_route_btn') }}
                    </button>
                </div>
            </form>
        </div>

        <!-- Tab 3: Quote Inquiry -->
        <div id="quote-tab" class="tab-content p-6 sm:p-8 hidden">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-6">
                <div>
                    <h4 class="text-base font-black text-black">{{ __('messages.quote_title') }}</h4>
                    <p class="text-xs text-neutral-600 mt-1">{{ __('messages.quote_desc') }}</p>
                </div>
                <a href="{{ route('tickets.create') }}" class="bg-black hover:bg-neutral-800 text-[#FECE00] font-black text-sm px-7 py-3.5 rounded-2xl transition shadow-md whitespace-nowrap">
                    {{ __('messages.quote_btn') }} &rarr;
                </a>
            </div>
        </div>
    </div>
</div>

<!-- 3. OPERATIONAL ADVISORY BANNER (ZIMMOAH YELLOW ACCENT) -->
@if ($advisory)
<div class="max-w-5xl mx-auto px-4 sm:px-8 mb-16">
    <div class="bg-[#FFF9DB] border-2 border-[#FECE00] rounded-3xl p-6 shadow-sm flex flex-col md:flex-row items-start md:items-center justify-between gap-5">
        <div class="flex items-start space-x-4">
            <div class="p-3 bg-[#FECE00] text-black rounded-2xl flex-shrink-0 font-black shadow-sm border border-black/10">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
            </div>
            <div>
                <span class="text-[11px] font-black uppercase tracking-wider text-[#FECE00] bg-black px-3 py-0.5 rounded-md">{{ __('messages.advisory_badge') }}</span>
                <h4 class="text-base font-black text-black mt-1.5">{{ $advisory->title }}</h4>
                <p class="text-xs text-neutral-700 mt-1 leading-relaxed">{{ $advisory->summary }}</p>
            </div>
        </div>
        <div class="flex items-center space-x-3 w-full md:w-auto justify-end flex-shrink-0">
            <a href="{{ $advisory->action_url ?? route('schedules.index') }}" class="bg-black hover:bg-neutral-800 text-[#FECE00] font-black text-xs px-6 py-3 rounded-full transition shadow-md whitespace-nowrap">
                {{ $advisory->action_text }}
            </a>
        </div>
    </div>
</div>
@endif

<!-- 4. SERVICES BENTO GRID (4 PILAR BISNIS ZIMMOAH) -->
<section id="services" class="max-w-7xl mx-auto px-4 sm:px-8 py-14">
    <div class="text-center max-w-3xl mx-auto space-y-3 mb-14">
        <span class="text-xs font-black uppercase tracking-widest text-black bg-[#FECE00] px-4 py-1.5 rounded-full shadow-sm">Pilar Layanan Logistik</span>
        <h2 class="text-3xl sm:text-4xl font-black text-black tracking-tight">Solusi Rantai Pasok Terpadu</h2>
        <p class="text-sm text-neutral-600">Dari pengurusan kepabeanan di pelabuhan hingga pengiriman darat door-to-door, Zimmoah menyediakan infrastruktur lengkap untuk kelancaran arus barang Anda.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Service 1: Forwarding -->
        <div class="group bg-white rounded-3xl border-2 border-neutral-200 hover:border-[#FECE00] shadow-sm hover:shadow-2xl transition-all duration-300 overflow-hidden flex flex-col">
            <div class="h-48 overflow-hidden relative">
                <img src="{{ asset('images/services/forwarding.jpg') }}" alt="Freight Forwarding" class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-105 transition-all duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/20 to-transparent"></div>
                <span class="absolute bottom-3 left-4 text-[#FECE00] font-black text-base">Freight Forwarding</span>
            </div>
            <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                <p class="text-xs text-neutral-600 leading-relaxed">
                    Pengiriman kargo laut (FCL/LCL) dan kargo udara internasional ke berbagai pelabuhan utama di Asia, Eropa, dan Amerika.
                </p>
                <a href="{{ route('services.forwarding') }}" class="text-xs font-black text-black group-hover:underline decoration-[#FECE00] decoration-2 underline-offset-4 flex items-center gap-1">
                    Detail Layanan &rarr;
                </a>
            </div>
        </div>

        <!-- Service 2: Warehousing -->
        <div class="group bg-white rounded-3xl border-2 border-neutral-200 hover:border-[#FECE00] shadow-sm hover:shadow-2xl transition-all duration-300 overflow-hidden flex flex-col">
            <div class="h-48 overflow-hidden relative">
                <img src="{{ asset('images/services/warehousing.jpg') }}" alt="Warehousing" class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-105 transition-all duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/20 to-transparent"></div>
                <span class="absolute bottom-3 left-4 text-[#FECE00] font-black text-base">Warehousing</span>
            </div>
            <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                <p class="text-xs text-neutral-600 leading-relaxed">
                    Gudang berikat &amp; VMI 18.000 m&sup2; (ISO 9001, FIFO, ERP) di dekat Bandara Soekarno-Hatta, Cikarang (RLC), &amp; Tanjung Priok.
                </p>
                <a href="{{ route('services.warehousing') }}" class="text-xs font-black text-black group-hover:underline decoration-[#FECE00] decoration-2 underline-offset-4 flex items-center gap-1">
                    Detail Layanan &rarr;
                </a>
            </div>
        </div>

        <!-- Service 3: Trucking -->
        <div class="group bg-white rounded-3xl border-2 border-neutral-200 hover:border-[#FECE00] shadow-sm hover:shadow-2xl transition-all duration-300 overflow-hidden flex flex-col">
            <div class="h-48 overflow-hidden relative">
                <img src="{{ asset('images/services/trucking.jpg') }}" alt="Trucking" class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-105 transition-all duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/20 to-transparent"></div>
                <span class="absolute bottom-3 left-4 text-[#FECE00] font-black text-base">Inland Trucking</span>
            </div>
            <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                <p class="text-xs text-neutral-600 leading-relaxed">
                    82 unit armada mandiri (trailer 20ft/40ft, truk 25T/8T/5T, forklift) melayani jadwal rutin 30 kota Jawa &amp; Bali.
                </p>
                <a href="{{ route('services.trucking') }}" class="text-xs font-black text-black group-hover:underline decoration-[#FECE00] decoration-2 underline-offset-4 flex items-center gap-1">
                    Detail Layanan &rarr;
                </a>
            </div>
        </div>

        <!-- Service 4: Consolidation -->
        <div class="group bg-white rounded-3xl border-2 border-neutral-200 hover:border-[#FECE00] shadow-sm hover:shadow-2xl transition-all duration-300 overflow-hidden flex flex-col">
            <div class="h-48 overflow-hidden relative">
                <img src="{{ asset('images/services/consolidation.jpg') }}" alt="Consolidation" class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-105 transition-all duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/20 to-transparent"></div>
                <span class="absolute bottom-3 left-4 text-[#FECE00] font-black text-base">Consolidation</span>
            </div>
            <div class="p-6 flex-1 flex flex-col justify-between space-y-4">
                <p class="text-xs text-neutral-600 leading-relaxed">
                    Solusi penggabungan kargo kontainer terjadwal mingguan untuk mengoptimalkan efisiensi biaya kargo volume parsial (LCL).
                </p>
                <a href="{{ route('services.consolidation') }}" class="text-xs font-black text-black group-hover:underline decoration-[#FECE00] decoration-2 underline-offset-4 flex items-center gap-1">
                    Detail Layanan &rarr;
                </a>
            </div>
        </div>
    </div>
</section>

<!-- 5. JADWAL PENGIRIMAN TERDEKAT (WARM YELLOW BAND) -->
<section class="bg-[#FFF7CC] py-16 border-y-2 border-[#FECE00]">
    <div class="max-w-7xl mx-auto px-4 sm:px-8">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-8">
            <div>
                <span class="text-xs font-black uppercase tracking-widest text-[#FECE00] bg-black px-3.5 py-1 rounded-full">Real-Time Schedule</span>
                <h3 class="text-2xl sm:text-3xl font-black text-black mt-2">Jadwal Keberangkatan Terdekat</h3>
            </div>
            <a href="{{ route('schedules.index') }}" class="bg-black hover:bg-neutral-800 text-[#FECE00] font-black text-xs px-5 py-2.5 rounded-full transition shadow-sm">
                Lihat Seluruh Jadwal (Sea & Air) &rarr;
            </a>
        </div>

        <div class="bg-white rounded-3xl shadow-md border-2 border-black/10 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-[#FECE00] border-b-2 border-black/15 text-black uppercase tracking-wider font-black">
                        <tr>
                            <th class="px-6 py-4">Mode / Carrier</th>
                            <th class="px-6 py-4">Rute Pengiriman</th>
                            <th class="px-6 py-4">Keberangkatan (ETD)</th>
                            <th class="px-6 py-4">Kedatangan (ETA)</th>
                            <th class="px-6 py-4">Cut-Off Dokumen</th>
                            <th class="px-6 py-4">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-100 text-neutral-800 font-medium">
                        @foreach ($schedules as $item)
                        <tr class="hover:bg-[#FFFBE6] transition">
                            <td class="px-6 py-4">
                                <div class="font-black text-black">{{ $item->carrier_vessel_name }}</div>
                                <span class="text-[11px] text-neutral-500 font-mono">{{ $item->voyage_number ?? 'Voyage Terjadwal' }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-black">{{ $item->origin_port }}</div>
                                <div class="text-[11px] text-amber-800 font-extrabold">&darr; {{ $item->destination_port }}</div>
                            </td>
                            <td class="px-6 py-4 text-black font-semibold">{{ $item->departure_time->format('d M Y, H:i') }} WIB</td>
                            <td class="px-6 py-4 text-black font-semibold">{{ $item->arrival_time->format('d M Y, H:i') }}</td>
                            <td class="px-6 py-4 text-amber-900 font-black">{{ $item->cut_off_time ? $item->cut_off_time->format('d M, H:i') : '-' }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-black bg-emerald-100 text-emerald-900 border border-emerald-300">
                                    {{ $item->status }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<!-- 5B. CORPORATE HIGHLIGHTS (MERGED OFFICIAL ZIMMOAH.COM SECTIONS) -->
<section class="max-w-7xl mx-auto px-4 sm:px-8 pt-20 pb-4">
    <div class="bg-black text-white rounded-3xl p-8 sm:p-12 shadow-xl border-2 border-black overflow-hidden">
        <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 mb-10">
            <div class="space-y-2 max-w-2xl">
                <span class="inline-block text-[11px] font-black uppercase tracking-widest bg-[#FECE00] text-black px-3.5 py-1 rounded-full">
                    PT. Zimmoah Marine Trans &bull; Est. 1989
                </span>
                <h2 class="text-2xl sm:text-4xl font-black tracking-tight text-white">
                    Profil Korporat, Sejarah &amp; Jaringan Resmi
                </h2>
                <p class="text-xs sm:text-sm text-neutral-300 leading-relaxed">
                    Akses informasi lengkap perusahaan langsung dari portal resmi Zimmoah: sambutan CEO, sejarah sejak 1989, panduan identitas merek (CIP), lisensi, struktur organisasi, brosur PDF, dan peta 8 cabang Indonesia–Vietnam.
                </p>
            </div>
            <a href="{{ route('company.profile') }}" class="flex-shrink-0 bg-[#FECE00] hover:bg-white text-black font-black text-xs px-6 py-3 rounded-full transition">
                Lihat Profil &amp; Brosur PDF &rarr;
            </a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3.5">
            <a href="{{ route('company.ceo') }}" class="group bg-neutral-900 hover:bg-[#FECE00] border border-neutral-800 hover:border-[#FECE00] rounded-2xl p-4 transition space-y-1.5">
                <span class="text-[10px] font-black uppercase text-[#FECE00] group-hover:text-black">01</span>
                <h3 class="text-sm font-black text-white group-hover:text-black">{{ __('messages.cmp_ceo') }}</h3>
                <p class="text-[11px] text-neutral-400 group-hover:text-neutral-900">Jason Lee (이지현)</p>
            </a>
            <a href="{{ route('company.history') }}" class="group bg-neutral-900 hover:bg-[#FECE00] border border-neutral-800 hover:border-[#FECE00] rounded-2xl p-4 transition space-y-1.5">
                <span class="text-[10px] font-black uppercase text-[#FECE00] group-hover:text-black">02</span>
                <h3 class="text-sm font-black text-white group-hover:text-black">{{ __('messages.cmp_history') }}</h3>
                <p class="text-[11px] text-neutral-400 group-hover:text-neutral-900">1989 &ndash; Present</p>
            </a>
            <a href="{{ route('company.cip') }}" class="group bg-neutral-900 hover:bg-[#FECE00] border border-neutral-800 hover:border-[#FECE00] rounded-2xl p-4 transition space-y-1.5">
                <span class="text-[10px] font-black uppercase text-[#FECE00] group-hover:text-black">03</span>
                <h3 class="text-sm font-black text-white group-hover:text-black">{{ __('messages.cmp_cip') }}</h3>
                <p class="text-[11px] text-neutral-400 group-hover:text-neutral-900">AI / JPG / PNG Pack</p>
            </a>
            <a href="{{ route('company.license') }}" class="group bg-neutral-900 hover:bg-[#FECE00] border border-neutral-800 hover:border-[#FECE00] rounded-2xl p-4 transition space-y-1.5">
                <span class="text-[10px] font-black uppercase text-[#FECE00] group-hover:text-black">04</span>
                <h3 class="text-sm font-black text-white group-hover:text-black">{{ __('messages.cmp_license') }}</h3>
                <p class="text-[11px] text-neutral-400 group-hover:text-neutral-900">ALFI &amp; Air Agency</p>
            </a>
            <a href="{{ route('company.organization') }}" class="group bg-neutral-900 hover:bg-[#FECE00] border border-neutral-800 hover:border-[#FECE00] rounded-2xl p-4 transition space-y-1.5">
                <span class="text-[10px] font-black uppercase text-[#FECE00] group-hover:text-black">05</span>
                <h3 class="text-sm font-black text-white group-hover:text-black">{{ __('messages.cmp_organization') }}</h3>
                <p class="text-[11px] text-neutral-400 group-hover:text-neutral-900">EN &amp; KR Org Chart</p>
            </a>
            <a href="{{ route('company.branches') }}" class="group bg-neutral-900 hover:bg-[#FECE00] border border-neutral-800 hover:border-[#FECE00] rounded-2xl p-4 transition space-y-1.5">
                <span class="text-[10px] font-black uppercase text-[#FECE00] group-hover:text-black">06</span>
                <h3 class="text-sm font-black text-white group-hover:text-black">{{ __('messages.cmp_branches') }}</h3>
                <p class="text-[11px] text-neutral-400 group-hover:text-neutral-900">8 Google Maps</p>
            </a>
        </div>
    </div>
</section>

<!-- 6. OFFICE DIRECTORY (3 CABANG ZIMMOAH) -->
<section class="max-w-7xl mx-auto px-4 sm:px-8 py-20">
    <div class="text-center max-w-2xl mx-auto mb-14 space-y-2">
        <span class="text-xs font-black uppercase tracking-widest text-black bg-[#FECE00] px-4 py-1.5 rounded-full shadow-sm">Jaringan Kantor Resmi</span>
        <h2 class="text-3xl font-black text-black">Hubungi Cabang Zimmoah</h2>
        <p class="text-xs text-neutral-600">Kunjungi atau hubungi tim representatif kami di kantor pusat Jakarta, bandara internasional, maupun kantor cabang Jawa Tengah.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach ($offices as $office)
        <div class="bg-white rounded-3xl border-2 border-neutral-200 hover:border-[#FECE00] p-8 shadow-sm hover:shadow-xl transition-all flex flex-col justify-between space-y-6">
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-black px-3 py-1 rounded-full {{ $office->is_headquarters ? 'bg-[#FECE00] text-black' : 'bg-neutral-100 text-neutral-800' }}">
                        {{ $office->code }}
                    </span>
                    @if ($office->is_headquarters)
                        <span class="text-[10px] font-black uppercase text-[#FECE00] bg-black px-2.5 py-0.5 rounded-full">Headquarters</span>
                    @endif
                </div>

                <h3 class="text-lg font-black text-black">{{ $office->name }}</h3>
                <p class="text-xs text-neutral-600 leading-relaxed">{{ $office->address }}</p>

                <div class="text-xs space-y-1.5 pt-3 border-t border-neutral-100 text-neutral-800">
                    <p><strong class="text-black">Telepon:</strong> {{ $office->phone }}</p>
                    @if ($office->fax)
                        <p><strong class="text-black">Fax:</strong> {{ $office->fax }}</p>
                    @endif
                    <p><strong class="text-black">Email:</strong> <span class="text-black font-black underline decoration-[#FECE00] decoration-2">{{ $office->email }}</span></p>
                </div>
            </div>

            <div>
                <a href="{{ route('contact') }}" class="w-full text-center block bg-black hover:bg-[#FECE00] text-[#FECE00] hover:text-black font-black text-xs py-3 rounded-xl transition shadow-md">
                    Lihat Kontak & Lokasi
                </a>
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- 7. SCRIPT FOR TAB SWITCHING -->
<script>
    function switchTab(tabId) {
        document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('border-black', 'bg-white', 'text-black');
            btn.classList.add('border-transparent', 'text-neutral-700');
        });

        const activeContent = document.getElementById(tabId);
        const activeBtn = document.getElementById('btn-' + tabId);
        if (activeContent) activeContent.classList.remove('hidden');
        if (activeBtn) {
            activeBtn.classList.add('border-black', 'bg-white', 'text-black');
            activeBtn.classList.remove('border-transparent', 'text-neutral-700');
        }
    }
</script>
@endsection

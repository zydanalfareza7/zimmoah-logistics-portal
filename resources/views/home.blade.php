@extends('layouts.app')

@section('content')
<!-- 1. MAERSK-STYLE FULL-BLEED HERO SECTION -->
<div class="relative bg-slate-900 text-white min-h-[620px] flex items-center justify-center overflow-hidden">
    <!-- Scenic Logistics Background Image -->
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=2000&q=80" 
             alt="Zimmoah Inland & Ocean Logistics" 
             class="w-full h-full object-cover object-center opacity-40 brightness-75 scale-105 transition-transform duration-1000">
        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-[#0B1522]/95 via-[#0B1522]/75 to-transparent"></div>
    </div>

    <!-- Hero Headline & Copy -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-8 py-20 w-full">
        <div class="max-w-2xl space-y-6">
            <span class="inline-flex items-center gap-2 bg-[#00A3E0]/20 border border-[#00A3E0]/40 text-[#00A3E0] text-xs uppercase tracking-widest font-extrabold px-3 py-1 rounded-full">
                <span class="w-1.5 h-1.5 rounded-full bg-[#00A3E0]"></span>
                End-to-End Supply Chain Solution
            </span>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-white leading-tight">
                Go the distance with <span class="text-[#00A3E0]">seamless</span> freight transport.
            </h1>
            <p class="text-base sm:text-lg text-slate-300 font-normal leading-relaxed">
                Kirim kargo Anda melalui laut, udara, atau armada darat - menghubungkan pelabuhan utama di Indonesia dengan jaringan rute logistik Asia-Pasifik secara efisien dan aman.
            </p>
            <div class="flex flex-wrap items-center gap-4 pt-2">
                <a href="#services" class="bg-white hover:bg-slate-100 text-slate-950 font-bold text-sm px-6 py-3.5 rounded-full shadow-lg transition transform hover:-translate-y-0.5">
                    Explore our services
                </a>
                <a href="{{ route('tickets.create') }}" class="border border-white/60 hover:border-white text-white hover:bg-white/10 font-bold text-sm px-6 py-3.5 rounded-full transition">
                    Buka Tiket Dukungan
                </a>
            </div>
        </div>
    </div>
</div>

<!-- 2. FLOATING QUICK-ACTION TOOL (MAERSK TABBED WIDGET) -->
<div class="relative z-20 max-w-6xl mx-auto px-4 sm:px-8 -mt-16 sm:-mt-20">
    <div class="bg-white rounded-2xl shadow-2xl border border-slate-200/80 overflow-hidden">
        <!-- Tab Headers -->
        <div class="flex border-b border-slate-200 bg-slate-50 text-xs sm:text-sm font-bold text-slate-600">
            <button onclick="switchTab('tracking-tab')" id="btn-tracking-tab" class="tab-btn flex-1 py-4 px-4 text-center border-b-2 border-[#00A3E0] bg-white text-slate-900 flex items-center justify-center gap-2 transition">
                <svg class="w-4 h-4 text-[#00A3E0]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Track Cargo / Tiket
            </button>
            <button onclick="switchTab('schedules-tab')" id="btn-schedules-tab" class="tab-btn flex-1 py-4 px-4 text-center border-b-2 border-transparent hover:text-slate-900 flex items-center justify-center gap-2 transition">
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Cari Jadwal Kapal
            </button>
            <button onclick="switchTab('quote-tab')" id="btn-quote-tab" class="tab-btn flex-1 py-4 px-4 text-center border-b-2 border-transparent hover:text-slate-900 flex items-center justify-center gap-2 transition hidden sm:flex">
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                Inquiry Tarif Kargo
            </button>
        </div>

        <!-- Tab 1: Tracking Tool -->
        <div id="tracking-tab" class="tab-content p-6 sm:p-8">
            <form action="{{ route('tracking') }}" method="GET" class="flex flex-col sm:flex-row items-center gap-4">
                <div class="relative flex-1 w-full">
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Nomor AWB / Resi / Tiket Bantuan</label>
                    <input type="text" name="tracking_number" placeholder="Contoh: ZIM-2026-9042 atau V.2641-N" 
                        class="w-full px-4 py-3 border border-slate-300 rounded-xl text-sm font-semibold text-slate-900 focus:outline-none focus:border-[#00A3E0] focus:ring-2 focus:ring-[#00A3E0]/20 transition">
                </div>
                <div class="w-full sm:w-auto pt-0 sm:pt-5">
                    <button type="submit" class="w-full sm:w-auto bg-[#00A3E0] hover:bg-[#008CC2] text-white font-bold text-sm px-8 py-3.5 rounded-xl shadow-md transition flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        Lacak Sekarang
                    </button>
                </div>
            </form>
            <div class="mt-3 flex items-center justify-between text-xs text-slate-500">
                <span>Mendukung pelacakan kontainer kapal, AWB kargo udara, dan kode helpdesk email.</span>
                <a href="{{ route('tickets.lookup') }}" class="text-[#00A3E0] font-bold hover:underline">Pelacakan Khusus Tiket &rarr;</a>
            </div>
        </div>

        <!-- Tab 2: Schedules Finder -->
        <div id="schedules-tab" class="tab-content p-6 sm:p-8 hidden">
            <form action="{{ route('schedules.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Pelabuhan / Kota Asal</label>
                    <input type="text" name="origin" placeholder="Contoh: Jakarta / Tanjung Priok" 
                        class="w-full px-4 py-3 border border-slate-300 rounded-xl text-sm font-semibold text-slate-900 focus:outline-none focus:border-[#00A3E0]">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Pelabuhan / Kota Tujuan</label>
                    <input type="text" name="destination" placeholder="Contoh: Busan / Incheon / Semarang" 
                        class="w-full px-4 py-3 border border-slate-300 rounded-xl text-sm font-semibold text-slate-900 focus:outline-none focus:border-[#00A3E0]">
                </div>
                <div class="pt-0 sm:pt-5">
                    <button type="submit" class="w-full bg-[#00A3E0] hover:bg-[#008CC2] text-white font-bold text-sm px-6 py-3.5 rounded-xl shadow-md transition">
                        Cari Rute & Jadwal
                    </button>
                </div>
            </form>
        </div>

        <!-- Tab 3: Quote Inquiry -->
        <div id="quote-tab" class="tab-content p-6 sm:p-8 hidden">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-6">
                <div>
                    <h4 class="text-base font-bold text-slate-900">Butuh Penawaran Tarif Pengiriman Kargo Korporat?</h4>
                    <p class="text-xs text-slate-500 mt-1">Tim sales dan operasional Zimmoah siap menghitungkan estimasi biaya terbaik untuk FCL, LCL, atau Air Freight.</p>
                </div>
                <a href="{{ route('tickets.create') }}" class="bg-[#FF6A3D] hover:bg-[#e0562b] text-white font-bold text-sm px-6 py-3 rounded-xl transition shadow-md whitespace-nowrap">
                    Kirim Inquiry Penawaran &rarr;
                </a>
            </div>
        </div>
    </div>
</div>

<!-- 3. OPERATIONAL ADVISORY BANNER (MAERSK STYLE TICKER) -->
@if ($advisory)
<div class="max-w-6xl mx-auto px-4 sm:px-8 mt-10">
    <div class="bg-amber-50/90 border border-amber-200/80 rounded-2xl p-5 shadow-sm flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
        <div class="flex items-start space-x-3.5">
            <div class="p-2.5 bg-amber-100 text-amber-800 rounded-xl flex-shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
            </div>
            <div>
                <span class="text-[11px] font-extrabold uppercase tracking-wider text-amber-900 bg-amber-200/60 px-2 py-0.5 rounded">Operational Advisory</span>
                <h4 class="text-sm font-bold text-slate-900 mt-1">{{ $advisory->title }}</h4>
                <p class="text-xs text-slate-600 mt-0.5">{{ $advisory->summary }}</p>
            </div>
        </div>
        <div class="flex items-center space-x-3 w-full md:w-auto justify-end">
            <a href="{{ $advisory->action_url ?? route('schedules.index') }}" class="bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs px-5 py-2.5 rounded-full transition shadow-sm whitespace-nowrap">
                {{ $advisory->action_text }}
            </a>
        </div>
    </div>
</div>
@endif

<!-- 4. SERVICES BENTO GRID (4 PILAR BISNIS ZIMMOAH) -->
<section id="services" class="max-w-7xl mx-auto px-4 sm:px-8 py-20">
    <div class="text-center max-w-3xl mx-auto space-y-3 mb-14">
        <span class="text-xs font-extrabold uppercase tracking-widest text-[#00A3E0]">Pilar Layanan Logistik</span>
        <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">Solusi Rantai Pasok Terpadu</h2>
        <p class="text-sm text-slate-500">Dari pengurusan kepabeanan di pelabuhan hingga pengiriman darat *door-to-door*, Zimmoah menyediakan infrastruktur lengkap untuk kelancaran arus barang Anda.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Service 1: Forwarding -->
        <div class="group bg-white rounded-2xl border border-slate-200/80 hover:border-[#00A3E0] shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col">
            <div class="h-44 overflow-hidden relative">
                <img src="https://images.unsplash.com/photo-1578575437130-527eed3abbec?auto=format&fit=crop&w=800&q=80" alt="Freight Forwarding" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent"></div>
                <span class="absolute bottom-3 left-4 text-white font-bold text-base">Freight Forwarding</span>
            </div>
            <div class="p-5 flex-1 flex flex-col justify-between space-y-3">
                <p class="text-xs text-slate-600 leading-relaxed">
                    Pengiriman kargo laut (FCL/LCL) dan kargo udara internasional ke berbagai pelabuhan utama di Asia, Eropa, dan Amerika.
                </p>
                <a href="{{ route('services.forwarding') }}" class="text-xs font-bold text-[#00A3E0] group-hover:underline flex items-center gap-1">
                    Detail Layanan &rarr;
                </a>
            </div>
        </div>

        <!-- Service 2: Warehousing -->
        <div class="group bg-white rounded-2xl border border-slate-200/80 hover:border-[#00A3E0] shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col">
            <div class="h-44 overflow-hidden relative">
                <img src="https://images.unsplash.com/photo-1553413077-190dd305871c?auto=format&fit=crop&w=800&q=80" alt="Warehousing" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent"></div>
                <span class="absolute bottom-3 left-4 text-white font-bold text-base">Warehousing</span>
            </div>
            <div class="p-5 flex-1 flex flex-col justify-between space-y-3">
                <p class="text-xs text-slate-600 leading-relaxed">
                    Fasilitas gudang transit di dekat Bandara Soekarno-Hatta & Pelabuhan Priok lengkap dengan sistem penanganan bea cukai.
                </p>
                <a href="{{ route('services.warehousing') }}" class="text-xs font-bold text-[#00A3E0] group-hover:underline flex items-center gap-1">
                    Detail Layanan &rarr;
                </a>
            </div>
        </div>

        <!-- Service 3: Trucking -->
        <div class="group bg-white rounded-2xl border border-slate-200/80 hover:border-[#00A3E0] shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col">
            <div class="h-44 overflow-hidden relative">
                <img src="https://images.unsplash.com/photo-1601584115197-04ecc0da31d7?auto=format&fit=crop&w=800&q=80" alt="Trucking" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent"></div>
                <span class="absolute bottom-3 left-4 text-white font-bold text-base">Inland Trucking</span>
            </div>
            <div class="p-5 flex-1 flex flex-col justify-between space-y-3">
                <p class="text-xs text-slate-600 leading-relaxed">
                    Armada truk trailer 20ft/40ft, wingbox, dan colt diesel untuk distribusi darat lintas Jawa-Sumatera bergaransi tepat waktu.
                </p>
                <a href="{{ route('services.trucking') }}" class="text-xs font-bold text-[#00A3E0] group-hover:underline flex items-center gap-1">
                    Detail Layanan &rarr;
                </a>
            </div>
        </div>

        <!-- Service 4: Consolidation -->
        <div class="group bg-white rounded-2xl border border-slate-200/80 hover:border-[#00A3E0] shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col">
            <div class="h-44 overflow-hidden relative">
                <img src="https://images.unsplash.com/photo-1494412574643-ff11b0a5c1c3?auto=format&fit=crop&w=800&q=80" alt="Consolidation" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent"></div>
                <span class="absolute bottom-3 left-4 text-white font-bold text-base">Consolidation</span>
            </div>
            <div class="p-5 flex-1 flex flex-col justify-between space-y-3">
                <p class="text-xs text-slate-600 leading-relaxed">
                    Solusi penggabungan kargo kontainer terjadwal mingguan untuk mengoptimalkan efisiensi biaya kargo volume parsial (LCL).
                </p>
                <a href="{{ route('services.consolidation') }}" class="text-xs font-bold text-[#00A3E0] group-hover:underline flex items-center gap-1">
                    Detail Layanan &rarr;
                </a>
            </div>
        </div>
    </div>
</section>

<!-- 5. JADWAL PENGIRIMAN TERDEKAT (PREVIEW TABLE) -->
<section class="bg-slate-100 py-16 border-y border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-8">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-8">
            <div>
                <span class="text-xs font-extrabold uppercase tracking-widest text-[#00A3E0]">Real-Time Schedule</span>
                <h3 class="text-2xl font-extrabold text-slate-900">Jadwal Keberangkatan Terdekat</h3>
            </div>
            <a href="{{ route('schedules.index') }}" class="bg-white hover:bg-slate-50 border border-slate-300 text-slate-800 font-bold text-xs px-5 py-2.5 rounded-full transition shadow-sm">
                Lihat Seluruh Jadwal (Sea & Air) &rarr;
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50 border-b border-slate-200 text-slate-500 uppercase tracking-wider font-bold">
                        <tr>
                            <th class="px-6 py-4">Mode / Carrier</th>
                            <th class="px-6 py-4">Rute Pengiriman</th>
                            <th class="px-6 py-4">Keberangkatan (ETD)</th>
                            <th class="px-6 py-4">Kedatangan (ETA)</th>
                            <th class="px-6 py-4">Cut-Off Dokumen</th>
                            <th class="px-6 py-4">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700 font-medium">
                        @foreach ($schedules as $item)
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="px-6 py-4">
                                <div class="font-bold text-slate-900">{{ $item->carrier_vessel_name }}</div>
                                <span class="text-[11px] text-slate-400">{{ $item->voyage_number ?? 'Voyage Terjadwal' }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-semibold text-slate-900">{{ $item->origin_port }}</div>
                                <div class="text-[11px] text-[#00A3E0]">&darr; {{ $item->destination_port }}</div>
                            </td>
                            <td class="px-6 py-4 text-slate-900">{{ $item->departure_time->format('d M Y, H:i') }} WIB</td>
                            <td class="px-6 py-4 text-slate-900">{{ $item->arrival_time->format('d M Y, H:i') }}</td>
                            <td class="px-6 py-4 text-amber-700 font-semibold">{{ $item->cut_off_time ? $item->cut_off_time->format('d M, H:i') : '-' }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-extrabold bg-emerald-100 text-emerald-800">
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

<!-- 6. OFFICE DIRECTORY (3 CABANG ZIMMOAH SESUAI REFERENSI) -->
<section class="max-w-7xl mx-auto px-4 sm:px-8 py-20">
    <div class="text-center max-w-2xl mx-auto mb-14 space-y-2">
        <span class="text-xs font-extrabold uppercase tracking-widest text-[#00A3E0]">Jaringan Kantor Operasional</span>
        <h2 class="text-3xl font-extrabold text-slate-900">Hubungi Cabang Resmi Zimmoah</h2>
        <p class="text-xs text-slate-500">Kunjungi atau hubungi tim representatif kami di kantor pusat Jakarta, bandara internasional, maupun kantor cabang Jawa Tengah.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach ($offices as $office)
        <div class="bg-white rounded-2xl border border-slate-200/80 p-6 shadow-sm hover:shadow-lg transition flex flex-col justify-between">
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold px-2.5 py-1 rounded-full {{ $office->is_headquarters ? 'bg-[#00A3E0]/10 text-[#00A3E0]' : 'bg-slate-100 text-slate-700' }}">
                        {{ $office->code }}
                    </span>
                    @if ($office->is_headquarters)
                        <span class="text-[10px] font-extrabold uppercase text-amber-600 bg-amber-50 px-2 py-0.5 rounded">Headquarters</span>
                    @endif
                </div>

                <h3 class="text-lg font-bold text-slate-900">{{ $office->name }}</h3>
                <p class="text-xs text-slate-600 leading-relaxed">{{ $office->address }}</p>
                
                <div class="text-xs space-y-1.5 pt-3 border-t border-slate-100 text-slate-600">
                    <p><strong class="text-slate-800">Telepon:</strong> {{ $office->phone }}</p>
                    @if ($office->fax)
                        <p><strong class="text-slate-800">Fax:</strong> {{ $office->fax }}</p>
                    @endif
                    <p><strong class="text-slate-800">Email:</strong> <span class="text-[#00A3E0] font-semibold">{{ $office->email }}</span></p>
                </div>
            </div>

            <div class="pt-6">
                <a href="{{ route('contact') }}" class="w-full text-center block bg-slate-50 hover:bg-slate-100 text-slate-800 font-bold text-xs py-2.5 rounded-xl border border-slate-200 transition">
                    Lihat Peta Lokasi
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
            btn.classList.remove('border-[#00A3E0]', 'bg-white', 'text-slate-900');
            btn.classList.add('border-transparent', 'text-slate-600');
        });

        const activeContent = document.getElementById(tabId);
        const activeBtn = document.getElementById('btn-' + tabId);
        if (activeContent) activeContent.classList.remove('hidden');
        if (activeBtn) {
            activeBtn.classList.add('border-[#00A3E0]', 'bg-white', 'text-slate-900');
            activeBtn.classList.remove('border-transparent', 'text-slate-600');
        }
    }
</script>
@endsection

@extends('layouts.app')

@section('content')
@php $locale = app()->getLocale(); @endphp

<div class="relative bg-[#FECE00] text-black py-16 px-4 sm:px-8 border-b-2 border-black/15 overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('images/services/forwarding.jpg') }}" alt="Freight Forwarding"
             class="w-full h-full object-cover object-center grayscale opacity-20 mix-blend-multiply">
        <div class="absolute inset-0 bg-gradient-to-r from-[#FECE00] via-[#FECE00]/90 to-[#FECE00]/55"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto space-y-4">
        <span class="inline-block text-xs uppercase tracking-widest font-black text-[#FECE00] bg-black px-3.5 py-1 rounded-full">
            Global Cargo Movement
        </span>
        <h1 class="text-3xl sm:text-5xl font-black tracking-tight text-black">Air &amp; Ocean Freight Forwarding</h1>
        <p class="text-neutral-900 font-medium max-w-2xl text-sm sm:text-base leading-relaxed">
            @if ($locale === 'ko')
                짐모아는 세계를 당신의 문 앞까지 가져다주는 종합 화물포워딩 서비스를 제공합니다. 효율적인 항공·해상 운송으로 고객 맞춤형 배송 솔루션을 제공합니다.
            @elseif ($locale === 'en')
                Zimmoah offers comprehensive freight forwarding services that bring the world to your doorstep — cost-effective Air &amp; Ocean solutions tailored to exacting customer requirements.
            @else
                Menghubungkan eksportir dan importir Indonesia dengan rute pelayaran laut kontainer (FCL/LCL) dan kargo udara internasional berkecepatan tinggi secara komprehensif.
            @endif
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-8 py-14 grid grid-cols-1 lg:grid-cols-3 gap-10">
    <div class="lg:col-span-2 space-y-8">
        <div class="bg-white rounded-3xl p-8 border-2 border-neutral-200 shadow-sm space-y-6">
            <h2 class="text-2xl font-black text-black">
                @if ($locale === 'ko') 짐모아 종합 화물 포워딩 솔루션 @elseif ($locale === 'en') Comprehensive Freight Forwarding Solutions @else Solusi Forwarding Tanpa Hambatan @endif
            </h2>
            <p class="text-sm text-neutral-600 leading-relaxed">
                Sebagai mitra logistik terpercaya sejak 1989, Zimmoah mengelola seluruh rantai dokumentasi dan fisik kargo: mulai dari penerbitan House Bill of Lading (HBL), Master Bill of Lading (MBL), Airway Bill (AWB), koordinasi penarikan kontainer di depo, hingga pengurusan Pemberitahuan Ekspor/Impor Barang (PEB/PIB) serta kargo proyek.
            </p>

            <!-- HD Freight Forwarding Visual -->
            <div class="rounded-2xl overflow-hidden border border-neutral-200 bg-neutral-50">
                <img src="{{ asset('images/services/forwarding.jpg') }}" alt="Zimmoah Air & Ocean Freight Forwarding Operations"
                     class="w-full h-auto object-cover">
            </div>

            <!-- Official Service Scope from zimmoah.com/forwarding.php -->
            <div class="bg-[#FFFBE6] p-6 rounded-2xl border border-[#FECE00]/60 space-y-3">
                <h3 class="text-base font-black text-black">
                    @if ($locale === 'ko') 짐모아 화물 서비스 범위 @elseif ($locale === 'en') Our Freight Services Include @else Cakupan Resmi Layanan Forwarding Zimmoah @endif
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 text-xs font-semibold text-neutral-800">
                    <div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-black"></span> Air &amp; Ocean Freight Forwarding (FCL / LCL)</div>
                    <div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-black"></span> In-land Trucking Service across Java</div>
                    <div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-black"></span> Special &amp; General Customs Clearance</div>
                    <div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-black"></span> Door-to-Door &amp; Bonded Express Delivery</div>
                    <div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-black"></span> Heavy &amp; Specialized Project Cargo</div>
                    <div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-black"></span> Sea &amp; Air Consolidation Weekly Hub</div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-2">
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 space-y-2">
                    <h3 class="text-base font-black text-black">Ocean Freight (Laut)</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        &bull; FCL (Full Container Load) 20ft, 40ft, 40HC, Reefer<br>
                        &bull; LCL (Less than Container Load) konsolidasi mingguan<br>
                        &bull; Jaringan direct service menuju Busan, Incheon, Shanghai, Singapore
                    </p>
                </div>

                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 space-y-2">
                    <h3 class="text-base font-black text-black">Air Freight (Udara)</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        &bull; Express Air Cargo dari Bandara Soekarno-Hatta (CGK)<br>
                        &bull; Penanganan kargo khusus (DGR, Pharma, Temperature Controlled)<br>
                        &bull; Transit time 24&ndash;48 jam ke destinasi utama Asia
                    </p>
                </div>
            </div>

            <div class="pt-4 border-t border-neutral-100 flex flex-wrap items-center justify-between gap-4">
                <a href="{{ route('schedules.index') }}" class="text-xs font-black text-black underline decoration-[#FECE00] decoration-2 underline-offset-4 hover:opacity-75">
                    Periksa Jadwal Kapal Terbaru &rarr;
                </a>
                <a href="{{ route('tickets.create') }}" class="bg-black hover:bg-[#FECE00] text-[#FECE00] hover:text-black font-black text-xs px-6 py-3 rounded-full transition shadow-md">
                    Minta Penawaran Tarif
                </a>
            </div>
        </div>
    </div>

    <!-- Offices Sidebar -->
    <div class="space-y-6">
        <div class="bg-white rounded-3xl p-6 border-2 border-neutral-200 shadow-sm space-y-4">
            <h3 class="text-sm font-black text-black uppercase tracking-wider border-b-2 border-[#FECE00] pb-2">Kontak Divisi Forwarding</h3>
            <div class="text-xs text-neutral-700 space-y-3">
                <p><strong>Ocean Cargo (Jakarta HQ):</strong><br>+(62-21) 2937 5670 (ext. 231/232)</p>
                <p><strong>Air Cargo (Airport Office):</strong><br>+(62-21) 5591 1853</p>
                <p><strong>Email Operasional:</strong><br><a href="mailto:aircargo@zimmoah.com" class="text-black font-black underline decoration-[#FECE00] decoration-2">aircargo@zimmoah.com</a></p>
            </div>
            <a href="{{ route('tickets.create') }}" class="block w-full text-center bg-black hover:bg-[#FECE00] text-[#FECE00] hover:text-black font-black text-xs py-3 rounded-xl transition">
                Buka Tiket Inquiry
            </a>
            <a href="{{ route('contact') }}" class="block w-full text-center bg-neutral-100 hover:bg-neutral-200 text-black font-black text-xs py-2.5 rounded-xl transition">
                Direktori PIC Sea &amp; Air &rarr;
            </a>
        </div>
    </div>
</div>
@endsection

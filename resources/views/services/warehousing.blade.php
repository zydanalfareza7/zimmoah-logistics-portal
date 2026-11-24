@extends('layouts.app')

@section('content')
@php $locale = app()->getLocale(); @endphp

<div class="relative bg-[#FECE00] text-black py-16 px-4 sm:px-8 border-b-2 border-black/15 overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('images/services/warehousing.jpg') }}" alt="Warehousing"
             class="w-full h-full object-cover object-center grayscale opacity-20 mix-blend-multiply">
        <div class="absolute inset-0 bg-gradient-to-r from-[#FECE00] via-[#FECE00]/90 to-[#FECE00]/55"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto space-y-4">
        <span class="inline-block text-xs uppercase tracking-widest font-black text-[#FECE00] bg-black px-3.5 py-1 rounded-full">
            Bonded Storage &amp; VMI Distribution
        </span>
        <h1 class="text-3xl sm:text-5xl font-black tracking-tight text-black">Warehousing &amp; Bonded Storage</h1>
        <p class="text-neutral-900 font-medium max-w-2xl text-sm sm:text-base leading-relaxed">
            @if ($locale === 'ko')
                30년 노하우의 VMI(Vendor Management Inventory) 보세장치장 및 ISO 9001·ERP 기반 맞춤 보관 서비스를 제공합니다.
            @elseif ($locale === 'en')
                18,000 m&sup2; land &amp; 15,500 m&sup2; building warehousing capacity offering VMI (Vendor Management Inventory), FIFO, ISO 9001 quality control, ERP management, and temperature-controlled rooms.
            @else
                Fasilitas pergudangan &amp; gudang berikat (GB/PLB) seluas 18.000 m&sup2; lahan &amp; 15.500 m&sup2; bangunan dengan layanan VMI, FIFO, sertifikasi ISO 9001, dan manajemen ERP.
            @endif
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-8 py-14 grid grid-cols-1 lg:grid-cols-3 gap-10">
    <div class="lg:col-span-2 space-y-8">
        <!-- Official Capacity Highlight Banner -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            <div class="bg-white rounded-2xl border-2 border-neutral-200 p-4 text-center">
                <span class="text-xl sm:text-2xl font-black text-black">18,000 m&sup2;</span>
                <p class="text-[11px] font-bold text-neutral-500 mt-1">Total Land Area</p>
            </div>
            <div class="bg-white rounded-2xl border-2 border-neutral-200 p-4 text-center">
                <span class="text-xl sm:text-2xl font-black text-black">15,500 m&sup2;</span>
                <p class="text-[11px] font-bold text-neutral-500 mt-1">Building Area</p>
            </div>
            <div class="bg-white rounded-2xl border-2 border-neutral-200 p-4 text-center">
                <span class="text-xl sm:text-2xl font-black text-black">ISO 9001</span>
                <p class="text-[11px] font-bold text-neutral-500 mt-1">Quality Certified</p>
            </div>
            <div class="bg-white rounded-2xl border-2 border-neutral-200 p-4 text-center">
                <span class="text-xl sm:text-2xl font-black text-black">VMI + ERP</span>
                <p class="text-[11px] font-bold text-neutral-500 mt-1">FIFO Inventory</p>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-8 border-2 border-neutral-200 shadow-sm space-y-6">
            <h2 class="text-2xl font-black text-black">
                @if ($locale === 'ko') 창고 현황 및 VMI 보세장치장 강점 @elseif ($locale === 'en') Warehousing Summary &amp; VMI Strengths @else Keunggulan Pergudangan &amp; VMI Zimmoah @endif
            </h2>
            <p class="text-sm text-neutral-600 leading-relaxed">
                Dengan pengalaman lokal lebih dari 30 tahun di Indonesia (termasuk gudang berikat afiliasi PT. RLC Indonesia GB &amp; PLB), Zimmoah menyediakan layanan <strong>VMI (Vendor Management Inventory)</strong> untuk industri elektronik, tekstil, alas kaki, dan manufaktur — mengelola pengadaan material dari supplier hingga pengiriman tepat waktu sesuai jadwal produksi klien.
            </p>

            <!-- HD Warehouse Visual -->
            <div class="rounded-2xl overflow-hidden border border-neutral-200 bg-neutral-50">
                <img src="{{ asset('images/services/warehousing.jpg') }}" alt="Zimmoah Bonded & VMI Warehouse Facility"
                     class="w-full h-auto object-cover">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-2">
                <div class="bg-[#FFFBE6] p-5 rounded-2xl border border-[#FECE00]/60 space-y-2">
                    <h3 class="text-base font-black text-black">VMI &amp; Strong Points</h3>
                    <p class="text-xs text-neutral-700 leading-relaxed">
                        &bull; FIFO (First In First Out) System<br>
                        &bull; ISO 9001 (Quality Certificate) System<br>
                        &bull; Integrated ERP Inventory Management<br>
                        &bull; Special Storage Rooms (A/C, I/C &amp; Refrigerator)<br>
                        &bull; Accurate &amp; Safe Production-Line Delivery
                    </p>
                </div>

                <div class="bg-[#FFFBE6] p-5 rounded-2xl border border-[#FECE00]/60 space-y-2">
                    <h3 class="text-base font-black text-black">Customs Clearance (PPJK) &amp; Transit</h3>
                    <p class="text-xs text-neutral-700 leading-relaxed">
                        &bull; EDI INSW jalur hijau &amp; jalur merah<br>
                        &bull; Klasifikasi pos tarif HS Code &amp; Lartas<br>
                        &bull; Palletizing, shrink wrapping &amp; cross-docking<br>
                        &bull; Penanganan kargo transit Bandara Soewarna (CGK)
                    </p>
                </div>
            </div>

            <div class="pt-4 border-t border-neutral-100 flex flex-wrap items-center justify-between gap-4">
                <a href="{{ route('company.branches') }}" class="text-xs font-black text-black underline decoration-[#FECE00] decoration-2 underline-offset-4 hover:opacity-75">
                    Lihat Lokasi Gudang RLC &amp; Bandara di Peta &rarr;
                </a>
                <a href="{{ route('tickets.create') }}" class="bg-black hover:bg-[#FECE00] text-[#FECE00] hover:text-black font-black text-xs px-6 py-3 rounded-full transition shadow-md">
                    Konsultasi Kebutuhan Gudang &rarr;
                </a>
            </div>
        </div>
    </div>

    <div class="space-y-6">
        <div class="bg-white rounded-3xl p-6 border-2 border-neutral-200 shadow-sm space-y-4">
            <h3 class="text-sm font-black text-black uppercase tracking-wider border-b-2 border-[#FECE00] pb-2">Lokasi Gudang &amp; Afiliasi</h3>
            <div class="text-xs text-neutral-700 space-y-3">
                <p><strong>PT. RLC Indonesia (Bonded GB &amp; PLB):</strong><br>Cikarang &bull; Tel: +62-21-8911-1740</p>
                <p><strong>Gudang Bandara:</strong><br>Wisma Soewarna Suite 2-F, Soewarna Bisnis Park, Bandara Soekarno-Hatta.</p>
                <p><strong>SK Logistics (TPL Specialist):</strong><br>Tel: +62-21-537-1111 (ext. 1623)</p>
            </div>
            <a href="{{ route('tickets.create') }}" class="block w-full text-center bg-black hover:bg-[#FECE00] text-[#FECE00] hover:text-black font-black text-xs py-3 rounded-xl transition">
                Hubungi Tim Warehousing
            </a>
        </div>
    </div>
</div>
@endsection

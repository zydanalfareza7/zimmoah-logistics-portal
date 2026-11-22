@extends('layouts.app')

@section('content')
<div class="bg-[#FECE00] text-black py-16 px-4 sm:px-8 border-b-2 border-black/15">
    <div class="max-w-7xl mx-auto space-y-4">
        <span class="inline-block text-xs uppercase tracking-widest font-black text-[#FECE00] bg-black px-3.5 py-1 rounded-full">
            Storage & Distribution
        </span>
        <h1 class="text-3xl sm:text-5xl font-black tracking-tight text-black">Warehousing & Customs Brokerage</h1>
        <p class="text-neutral-900 font-medium max-w-2xl text-sm sm:text-base leading-relaxed">
            Fasilitas pergudangan strategis di sekitar bandara internasional dan pelabuhan Tanjung Priok dengan sistem inventory modern dan sertifikasi kepabeanan.
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-8 py-14 grid grid-cols-1 lg:grid-cols-3 gap-10">
    <div class="lg:col-span-2 space-y-8">
        <div class="bg-white rounded-3xl p-8 border-2 border-neutral-200 shadow-sm space-y-6">
            <h2 class="text-2xl font-black text-black">Keunggulan Pergudangan Zimmoah</h2>
            <p class="text-sm text-neutral-600 leading-relaxed">
                Kami menyediakan area penyimpanan kargo aman berstandar industri dengan pengawasan CCTV 24/7, dock leveler untuk bongkar muat cepat, penanganan kargo transit udara di Wisma Soewarna Bandara Soekarno-Hatta, serta integrasi sistem WMS (Warehouse Management System).
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-4">
                <div class="bg-[#FFFBE6] p-5 rounded-2xl border border-[#FECE00]/60 space-y-2">
                    <h3 class="text-base font-black text-black">Customs Clearance (PPJK)</h3>
                    <p class="text-xs text-neutral-700 leading-relaxed">
                        &bull; EDI INSW jalur hijau & jalur merah<br>
                        &bull; Klasifikasi pos tarif HS Code akurat<br>
                        &bull; Pengurusan perizinan Lartas kementerian
                    </p>
                </div>

                <div class="bg-[#FFFBE6] p-5 rounded-2xl border border-[#FECE00]/60 space-y-2">
                    <h3 class="text-base font-black text-black">Fasilitas Gudang Transit</h3>
                    <p class="text-xs text-neutral-700 leading-relaxed">
                        &bull; Palletizing & shrink wrapping standar ekspor<br>
                        &bull; Area penimbangan bersertifikasi metrologi<br>
                        &bull; Cross-docking kargo kontainer
                    </p>
                </div>
            </div>

            <div class="pt-4 border-t border-neutral-100 flex items-center justify-between">
                <a href="{{ route('tickets.create') }}" class="bg-black hover:bg-neutral-800 text-[#FECE00] font-black text-xs px-6 py-3 rounded-full transition shadow-md">
                    Konsultasi Kebutuhan Gudang &rarr;
                </a>
            </div>
        </div>
    </div>

    <div class="space-y-6">
        <div class="bg-white rounded-3xl p-6 border-2 border-neutral-200 shadow-sm space-y-4">
            <h3 class="text-sm font-black text-black uppercase tracking-wider border-b-2 border-[#FECE00] pb-2">Lokasi Gudang Terdekat</h3>
            <div class="text-xs text-neutral-700 space-y-2">
                <p><strong>Gudang Bandara:</strong> Wisma Soewarna Suite 2-F, Soewarna Bisnis Park, Bandara Soekarno-Hatta.</p>
                <p><strong>Gudang Jakarta:</strong> Kelapa Gading & Tanjung Priok Access Hub.</p>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="bg-[#0B1522] text-white py-16 px-4 sm:px-8 border-b border-slate-800">
    <div class="max-w-7xl mx-auto space-y-4">
        <span class="text-xs uppercase tracking-widest font-extrabold text-[#00A3E0] bg-[#00A3E0]/20 px-3 py-1 rounded-full">
            Storage & Distribution
        </span>
        <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight">Warehousing & Customs Brokerage</h1>
        <p class="text-slate-300 max-w-2xl text-sm sm:text-base leading-relaxed">
            Fasilitas pergudangan strategis di sekitar bandara internasional dan pelabuhan Tanjung Priok dengan sistem inventory modern dan sertifikasi kepabeanan.
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-8 py-14 grid grid-cols-1 lg:grid-cols-3 gap-10">
    <div class="lg:col-span-2 space-y-8">
        <div class="bg-white rounded-3xl p-8 border border-slate-200/80 shadow-sm space-y-6">
            <h2 class="text-2xl font-bold text-slate-900">Keunggulan Pergudangan Zimmoah</h2>
            <p class="text-sm text-slate-600 leading-relaxed">
                Kami menyediakan area penyimpanan kargo aman berstandar industri dengan pengawasan CCTV 24/7, dock leveler untuk bongkar muat cepat, penanganan kargo transit udara di Wisma Soewarna Bandara Soekarno-Hatta, serta integrasi sistem WMS (Warehouse Management System).
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-4">
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/60 space-y-2">
                    <h3 class="text-base font-bold text-slate-900">Customs Clearance (PPJK)</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        &bull; EDI INSW jalur hijau & jalur merah<br>
                        &bull; Klasifikasi pos tarif HS Code akurat<br>
                        &bull; Pengurusan perizinan Lartas kementerian
                    </p>
                </div>

                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/60 space-y-2">
                    <h3 class="text-base font-bold text-slate-900">Fasilitas Gudang Transit</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        &bull; Palletizing & shrink wrapping standar ekspor<br>
                        &bull; Area penimbangan bersertifikasi metrologi<br>
                        &bull; Cross-docking kargo kontainer
                    </p>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                <a href="{{ route('tickets.create') }}" class="bg-[#00A3E0] hover:bg-[#008CC2] text-white font-bold text-xs px-6 py-3 rounded-full transition shadow-md">
                    Konsultasi Kebutuhan Gudang &rarr;
                </a>
            </div>
        </div>
    </div>

    <div class="space-y-6">
        <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-sm space-y-4">
            <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider border-b border-slate-100 pb-2">Lokasi Gudang Terdekat</h3>
            <div class="text-xs text-slate-600 space-y-2">
                <p><strong>Gudang Bandara:</strong> Wisma Soewarna Suite 2-F, Soewarna Bisnis Park, Bandara Soekarno-Hatta.</p>
                <p><strong>Gudang Jakarta:</strong> Kelapa Gading & Tanjung Priok Access Hub.</p>
            </div>
        </div>
    </div>
</div>
@endsection

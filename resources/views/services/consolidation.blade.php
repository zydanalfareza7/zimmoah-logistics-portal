@extends('layouts.app')

@section('content')
@php $locale = app()->getLocale(); @endphp

<div class="relative bg-[#FECE00] text-black py-16 px-4 sm:px-8 border-b-2 border-black/15 overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('images/services/consolidation.jpg') }}" alt="Cargo Consolidation"
             class="w-full h-full object-cover object-center grayscale opacity-20 mix-blend-multiply">
        <div class="absolute inset-0 bg-gradient-to-r from-[#FECE00] via-[#FECE00]/90 to-[#FECE00]/55"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto space-y-4">
        <span class="inline-block text-xs uppercase tracking-widest font-black text-[#FECE00] bg-black px-3.5 py-1 rounded-full">
            Cost-Effective LCL Cargo
        </span>
        <h1 class="text-3xl sm:text-5xl font-black tracking-tight text-black">Cargo Consolidation (LCL Hub)</h1>
        <p class="text-neutral-900 font-medium max-w-2xl text-sm sm:text-base leading-relaxed">
            @if ($locale === 'ko')
                하나의 LCL(소량화물)부터 전 세계 멀티 컨트리 콘솔리데이션까지, 매주 정기 선적 스케줄과 경쟁력 있는 운임으로 최적의 해상 운송을 제공합니다.
            @elseif ($locale === 'en')
                From single less-than-container load (LCL) shipments to complete multi-country consolidation solutions with fixed weekly stuffing and loading schedules worldwide.
            @else
                Penggabungan kargo volume kecil (LCL) secara terjadwal mingguan untuk menghemat biaya pengiriman tanpa mengorbankan kepastian jadwal kapal dan keselamatan barang.
            @endif
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-8 py-14 grid grid-cols-1 lg:grid-cols-3 gap-10">
    <div class="lg:col-span-2 space-y-8">
        <div class="bg-white rounded-3xl p-8 border-2 border-neutral-200 shadow-sm space-y-6">
            <h2 class="text-2xl font-black text-black">Solusi Konsolidasi Unggulan (LCL)</h2>
            <p class="text-sm text-neutral-600 leading-relaxed">
                Bagi pengirim dengan volume dan berat kargo yang tidak memerlukan satu kontainer penuh (FCL), layanan konsolidasi mingguan Zimmoah mengemas kargo Anda secara terpisah lalu menggabungkannya secara optimal sesuai destinasi tujuan di CFS (Container Freight Station) resmi sebelum dikirimkan ke pelabuhan akhir.
            </p>

            <!-- HD Consolidation CFS Photo -->
            <div class="rounded-2xl overflow-hidden border border-neutral-200 bg-neutral-50">
                <img src="{{ asset('images/services/consolidation.jpg') }}" alt="Zimmoah CFS LCL Consolidation Hub"
                     class="w-full h-auto object-cover">
            </div>

            <!-- Official Weekly LCL Consolidation Route Network (Native Resolution, Never Stretched) -->
            <div class="rounded-2xl border border-neutral-200 bg-[#FFFDF5] p-5 space-y-4">
                <div class="flex flex-wrap items-center justify-between gap-2">
                    <h3 class="text-sm font-black text-black uppercase tracking-wider">Official Weekly LCL Console Network</h3>
                    <span class="text-[11px] font-bold text-neutral-500">Jakarta / Surabaya Hub</span>
                </div>
                <div class="flex flex-wrap gap-2 text-xs font-black">
                    <span class="px-3 py-1.5 rounded-full bg-black text-[#FECE00]">Jakarta / Surabaya Hub</span>
                    <span class="px-3 py-1.5 rounded-full bg-[#FECE00]/40 text-black">Hong Kong (2x / week)</span>
                    <span class="px-3 py-1.5 rounded-full bg-[#FECE00]/40 text-black">Busan (2x / week)</span>
                    <span class="px-3 py-1.5 rounded-full bg-neutral-100 text-neutral-800">Ho Chi Minh (Weekly)</span>
                    <span class="px-3 py-1.5 rounded-full bg-neutral-100 text-neutral-800">Shanghai (Weekly)</span>
                    <span class="px-3 py-1.5 rounded-full bg-neutral-100 text-neutral-800">LA &ndash; New York (Weekly)</span>
                </div>
                <div class="pt-2 flex justify-center">
                    <img src="{{ asset('zimmoah-assets/images/lcl/lcl-1.jpg') }}" alt="Zimmoah Official LCL Route Chart"
                         class="w-auto max-w-full rounded-xl border border-neutral-200">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-2">
                <div class="bg-[#FFFBE6] p-5 rounded-2xl border border-[#FECE00]/60 space-y-2">
                    <h3 class="text-base font-black text-black">Direct LCL Console Boxes</h3>
                    <p class="text-xs text-neutral-700 leading-relaxed">
                        &bull; Rute tetap mingguan ke Busan, Incheon &amp; Singapore<br>
                        &bull; Tidak ada biaya transshipment ganda<br>
                        &bull; Jadwal stuffing &amp; loading mingguan yang pasti
                    </p>
                </div>

                <div class="bg-[#FFFBE6] p-5 rounded-2xl border border-[#FECE00]/60 space-y-2">
                    <h3 class="text-base font-black text-black">Perhitungan CBM Transparan</h3>
                    <p class="text-xs text-neutral-700 leading-relaxed">
                        &bull; Tarif kompetitif per CBM / Metric Ton<br>
                        &bull; Invoice terperinci tanpa biaya siluman di pelabuhan tujuan<br>
                        &bull; Tracking status stuffing kontainer online
                    </p>
                </div>
            </div>

            <div class="pt-4 border-t border-neutral-100 flex flex-wrap items-center justify-between gap-4">
                <a href="{{ route('schedules.index') }}" class="text-xs font-black text-black underline decoration-[#FECE00] decoration-2 underline-offset-4 hover:opacity-75">
                    Lihat Jadwal Closing LCL &amp; Schedule PDF &rarr;
                </a>
                <a href="{{ route('tickets.create') }}" class="bg-black hover:bg-[#FECE00] text-[#FECE00] hover:text-black font-black text-xs px-6 py-3 rounded-full transition shadow-md">
                    Inquiry Booking LCL
                </a>
            </div>
        </div>
    </div>

    <div class="space-y-6">
        <div class="bg-white rounded-3xl p-6 border-2 border-neutral-200 shadow-sm space-y-4">
            <h3 class="text-sm font-black text-black uppercase tracking-wider border-b-2 border-[#FECE00] pb-2">CFS &amp; Konsolidasi</h3>
            <div class="text-xs text-neutral-700 space-y-3">
                <p><strong>Lokasi Penerimaan Kargo:</strong><br>CFS Gudang Tanjung Priok &amp; Bandara Soekarno-Hatta.</p>
                <p><strong>Telepon (Jakarta HQ):</strong><br>+(62-21) 2937 5670</p>
                <p><strong>Email Konsolidasi:</strong><br><a href="mailto:zimmoah@zimmoah.com" class="text-black font-black underline decoration-[#FECE00] decoration-2">zimmoah@zimmoah.com</a></p>
            </div>
        </div>
    </div>
</div>
@endsection

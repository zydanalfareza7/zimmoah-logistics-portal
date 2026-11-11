@extends('layouts.app')

@section('content')
<div class="bg-[#0B1522] text-white py-16 px-4 sm:px-8 border-b border-slate-800">
    <div class="max-w-7xl mx-auto space-y-4">
        <span class="text-xs uppercase tracking-widest font-extrabold text-[#00A3E0] bg-[#00A3E0]/20 px-3 py-1 rounded-full">
            Global Cargo Movement
        </span>
        <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight">Air & Ocean Freight Forwarding</h1>
        <p class="text-slate-300 max-w-2xl text-sm sm:text-base leading-relaxed">
            Menghubungkan eksportir dan importir Indonesia dengan rute pelayaran laut kontainer (FCL/LCL) dan kargo udara internasional berkecepatan tinggi.
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-8 py-14 grid grid-cols-1 lg:grid-cols-3 gap-10">
    <div class="lg:col-span-2 space-y-8">
        <div class="bg-white rounded-3xl p-8 border border-slate-200/80 shadow-sm space-y-6">
            <h2 class="text-2xl font-bold text-slate-900">Solusi Forwarding Tanpa Hambatan</h2>
            <p class="text-sm text-slate-600 leading-relaxed">
                Sebagai mitra logistik terpercaya, Zimmoah mengelola seluruh rantai dokumentasi dan fisik kargo: mulai dari penerbitan House Bill of Lading (HBL), Master Bill of Lading (MBL), Airway Bill (AWB), koordinasi penarikan kontainer di depo, hingga pengurusan Pemberitahuan Ekspor/Impor Barang (PEB/PIB).
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-4">
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/60 space-y-2">
                    <h3 class="text-base font-bold text-slate-900">Ocean Freight (Laut)</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        &bull; FCL (Full Container Load) 20ft, 40ft, 40HC, Reefer<br>
                        &bull; LCL (Less than Container Load) konsolidasi mingguan<br>
                        &bull; Jaringan direct service menuju Busan, Incheon, Shanghai, Singapore
                    </p>
                </div>

                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/60 space-y-2">
                    <h3 class="text-base font-bold text-slate-900">Air Freight (Udara)</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        &bull; Express Air Cargo dari Bandara Soekarno-Hatta (CGK)<br>
                        &bull; Penanganan kargo khusus (DGR, Pharma, Temperature Controlled)<br>
                        &bull; Transit time 24–48 jam ke destinasi utama Asia
                    </p>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                <a href="{{ route('schedules.index') }}" class="text-xs font-bold text-[#00A3E0] hover:underline">
                    Periksa Jadwal Kapal Terbaru &rarr;
                </a>
                <a href="{{ route('tickets.create') }}" class="bg-[#00A3E0] hover:bg-[#008CC2] text-white font-bold text-xs px-6 py-3 rounded-full transition shadow-md">
                    Minta Penawaran Tarif
                </a>
            </div>
        </div>
    </div>

    <!-- Offices Sidebar -->
    <div class="space-y-6">
        <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-sm space-y-4">
            <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider border-b border-slate-100 pb-2">Kontak Divisi Forwarding</h3>
            <div class="text-xs text-slate-600 space-y-3">
                <p><strong>Ocean Cargo:</strong> +62-21 2937 5570 (Jakarta HQ)</p>
                <p><strong>Air Cargo:</strong> +62-21 5591 1663 (Airport Office)</p>
                <p><strong>Email Operasional:</strong> <span class="text-[#00A3E0] font-semibold">aircargo@zimmoah.com</span></p>
            </div>
            <a href="{{ route('tickets.create') }}" class="block w-full text-center bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs py-3 rounded-xl transition">
                Buka Tiket Inquiry
            </a>
        </div>
    </div>
</div>
@endsection

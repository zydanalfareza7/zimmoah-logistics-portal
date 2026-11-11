@extends('layouts.app')

@section('content')
<div class="bg-[#0B1522] text-white py-16 px-4 sm:px-8 border-b border-slate-800">
    <div class="max-w-7xl mx-auto space-y-4">
        <span class="text-xs uppercase tracking-widest font-extrabold text-[#00A3E0] bg-[#00A3E0]/20 px-3 py-1 rounded-full">
            Cost-Effective LCL Cargo
        </span>
        <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight">Cargo Consolidation (LCL Hub)</h1>
        <p class="text-slate-300 max-w-2xl text-sm sm:text-base leading-relaxed">
            Penggabungan kargo volume kecil (LCL) secara terjadwal untuk menghemat biaya pengiriman tanpa mengorbankan kepastian jadwal kapal dan keselamatan barang.
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-8 py-14 grid grid-cols-1 lg:grid-cols-3 gap-10">
    <div class="lg:col-span-2 space-y-8">
        <div class="bg-white rounded-3xl p-8 border border-slate-200/80 shadow-sm space-y-6">
            <h2 class="text-2xl font-bold text-slate-900">Solusi Konsolidasi Unggulan</h2>
            <p class="text-sm text-slate-600 leading-relaxed">
                Bagi pengirim yang tidak memerlukan satu kontainer penuh, layanan konsolidasi mingguan Zimmoah menjadi pilihan paling ekonomis. Kargo Anda ditampung di CFS (Container Freight Station) resmi, diukur dengan akurat, dan disusun menggunakan tata letak kargo optimal (*stowage plan*) untuk menghindari risiko kerusakan.
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-4">
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/60 space-y-2">
                    <h3 class="text-base font-bold text-slate-900">Direct LCL Console Boxes</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        &bull; Rute tetap mingguan ke Busan, Incheon & Singapore<br>
                        &bull; Tidak ada biaya transshipment ganda<br>
                        &bull; Waktu stuffing kontainer tepat waktu
                    </p>
                </div>

                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/60 space-y-2">
                    <h3 class="text-base font-bold text-slate-900">Perhitungan CBM Transparan</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        &bull; Tarif kompetitif per CBM / Metric Ton<br>
                        &bull; Invoice terperinci tanpa biaya siluman di pelabuhan tujuan<br>
                        &bull; Tracking status stuffing kontainer online
                    </p>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                <a href="{{ route('schedules.index') }}" class="text-xs font-bold text-[#00A3E0] hover:underline">
                    Lihat Jadwal Closing LCL &rarr;
                </a>
                <a href="{{ route('tickets.create') }}" class="bg-[#00A3E0] hover:bg-[#008CC2] text-white font-bold text-xs px-6 py-3 rounded-full transition shadow-md">
                    Inquiry Booking LCL
                </a>
            </div>
        </div>
    </div>

    <div class="space-y-6">
        <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-sm space-y-4">
            <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider border-b border-slate-100 pb-2">CFS & Konsolidasi</h3>
            <div class="text-xs text-slate-600 space-y-2">
                <p><strong>Lokasi Penerimaan Kargo:</strong> CFS Gudang Tanjung Priok & Bandara Soekarno-Hatta.</p>
                <p><strong>Email Konsolidasi:</strong> <span class="text-[#00A3E0] font-semibold">zimmoah@zimmoah.com</span></p>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="bg-[#FECE00] text-black py-16 px-4 sm:px-8 border-b-2 border-black/15">
    <div class="max-w-7xl mx-auto space-y-4">
        <span class="inline-block text-xs uppercase tracking-widest font-black text-[#FECE00] bg-black px-3.5 py-1 rounded-full">
            Cost-Effective LCL Cargo
        </span>
        <h1 class="text-3xl sm:text-5xl font-black tracking-tight text-black">Cargo Consolidation (LCL Hub)</h1>
        <p class="text-neutral-900 font-medium max-w-2xl text-sm sm:text-base leading-relaxed">
            Penggabungan kargo volume kecil (LCL) secara terjadwal untuk menghemat biaya pengiriman tanpa mengorbankan kepastian jadwal kapal dan keselamatan barang.
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-8 py-14 grid grid-cols-1 lg:grid-cols-3 gap-10">
    <div class="lg:col-span-2 space-y-8">
        <div class="bg-white rounded-3xl p-8 border-2 border-neutral-200 shadow-sm space-y-6">
            <h2 class="text-2xl font-black text-black">Solusi Konsolidasi Unggulan</h2>
            <p class="text-sm text-neutral-600 leading-relaxed">
                Bagi pengirim yang tidak memerlukan satu kontainer penuh, layanan konsolidasi mingguan Zimmoah menjadi pilihan paling ekonomis. Kargo Anda ditampung di CFS (Container Freight Station) resmi, diukur dengan akurat, dan disusun menggunakan tata letak kargo optimal (stowage plan) untuk menghindari risiko kerusakan.
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-4">
                <div class="bg-[#FFFBE6] p-5 rounded-2xl border border-[#FECE00]/60 space-y-2">
                    <h3 class="text-base font-black text-black">Direct LCL Console Boxes</h3>
                    <p class="text-xs text-neutral-700 leading-relaxed">
                        &bull; Rute tetap mingguan ke Busan, Incheon & Singapore<br>
                        &bull; Tidak ada biaya transshipment ganda<br>
                        &bull; Waktu stuffing kontainer tepat waktu
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

            <div class="pt-4 border-t border-neutral-100 flex items-center justify-between">
                <a href="{{ route('schedules.index') }}" class="text-xs font-black text-black underline decoration-[#FECE00] decoration-2 underline-offset-4 hover:opacity-75">
                    Lihat Jadwal Closing LCL &rarr;
                </a>
                <a href="{{ route('tickets.create') }}" class="bg-black hover:bg-neutral-800 text-[#FECE00] font-black text-xs px-6 py-3 rounded-full transition shadow-md">
                    Inquiry Booking LCL
                </a>
            </div>
        </div>
    </div>

    <div class="space-y-6">
        <div class="bg-white rounded-3xl p-6 border-2 border-neutral-200 shadow-sm space-y-4">
            <h3 class="text-sm font-black text-black uppercase tracking-wider border-b-2 border-[#FECE00] pb-2">CFS & Konsolidasi</h3>
            <div class="text-xs text-neutral-700 space-y-2">
                <p><strong>Lokasi Penerimaan Kargo:</strong> CFS Gudang Tanjung Priok & Bandara Soekarno-Hatta.</p>
                <p><strong>Email Konsolidasi:</strong> <span class="text-black font-black underline decoration-[#FECE00] decoration-2">zimmoah@zimmoah.com</span></p>
            </div>
        </div>
    </div>
</div>
@endsection

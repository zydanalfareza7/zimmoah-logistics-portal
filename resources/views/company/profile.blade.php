@extends('layouts.app')

@section('content')
<div class="bg-[#0B1522] text-white py-16 px-4 sm:px-8 border-b border-slate-800">
    <div class="max-w-7xl mx-auto space-y-4">
        <span class="text-xs uppercase tracking-widest font-extrabold text-[#00A3E0] bg-[#00A3E0]/20 px-3 py-1 rounded-full">
            Tentang Zimmoah
        </span>
        <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight">Profil Perusahaan & Komitmen Layanan</h1>
        <p class="text-slate-300 max-w-2xl text-sm sm:text-base leading-relaxed">
            Menghubungkan Indonesia dengan arus perdagangan global melalui infrastruktur terpadu, armada handal, dan teknologi logistik modern.
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-8 py-14 space-y-12">
    <div class="bg-white rounded-3xl p-8 sm:p-10 border border-slate-200/80 shadow-sm space-y-6">
        <h2 class="text-2xl font-bold text-slate-900">Visi & Misi Perusahaan</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-sm text-slate-600 leading-relaxed">
            <div class="bg-slate-50 p-6 rounded-2xl border border-slate-200/60 space-y-2">
                <span class="text-xs uppercase font-extrabold text-[#00A3E0] tracking-wider">Visi</span>
                <h3 class="text-lg font-bold text-slate-900">Menjadi Mitra Rantai Pasok Terdepan di Asia</h3>
                <p>Menyediakan layanan logistik kelas dunia dengan transparansi jadwal, efisiensi biaya, dan integritas tinggi bagi seluruh pelaku industri manufaktur dan perdagangan.</p>
            </div>
            <div class="bg-slate-50 p-6 rounded-2xl border border-slate-200/60 space-y-2">
                <span class="text-xs uppercase font-extrabold text-[#00A3E0] tracking-wider">Misi</span>
                <h3 class="text-lg font-bold text-slate-900">Operasional Unggul & Berkelanjutan</h3>
                <p>Memberikan solusi kargo terintegrasi (laut, darat, udara) didukung sistem helpdesk transparan, pemenuhan SLA yang ketat, dan kepatuhan penuh terhadap regulasi kepabeanan internasional.</p>
            </div>
        </div>
    </div>

    <!-- Offices Directory Grid -->
    <div class="space-y-6">
        <h2 class="text-2xl font-bold text-slate-900">Direktori Kantor & Jaringan Operasional</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($offices as $office)
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-3">
                <span class="text-xs font-bold px-2 py-0.5 rounded bg-[#00A3E0]/10 text-[#00A3E0]">{{ $office->code }}</span>
                <h3 class="text-base font-bold text-slate-900">{{ $office->name }}</h3>
                <p class="text-xs text-slate-600 leading-relaxed">{{ $office->address }}</p>
                <div class="pt-3 border-t border-slate-100 text-xs text-slate-500 space-y-1">
                    <p><strong>Tel:</strong> {{ $office->phone }}</p>
                    <p><strong>Email:</strong> <span class="text-[#00A3E0]">{{ $office->email }}</span></p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

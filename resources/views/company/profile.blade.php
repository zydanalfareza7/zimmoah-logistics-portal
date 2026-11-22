@extends('layouts.app')

@section('content')
<div class="bg-[#FECE00] text-black py-16 px-4 sm:px-8 border-b-2 border-black/15">
    <div class="max-w-7xl mx-auto space-y-4">
        <span class="inline-block text-xs uppercase tracking-widest font-black text-[#FECE00] bg-black px-3.5 py-1 rounded-full">
            Tentang Zimmoah
        </span>
        <h1 class="text-3xl sm:text-5xl font-black tracking-tight text-black">Profil Perusahaan & Komitmen Layanan</h1>
        <p class="text-neutral-900 font-medium max-w-2xl text-sm sm:text-base leading-relaxed">
            Menghubungkan Indonesia dengan arus perdagangan global melalui infrastruktur terpadu, armada handal, dan teknologi logistik modern.
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-8 py-14 space-y-12">
    <div class="bg-white rounded-3xl p-8 sm:p-10 border-2 border-neutral-200 shadow-sm space-y-6">
        <h2 class="text-2xl font-black text-black">Visi & Misi Perusahaan</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-sm text-neutral-700 leading-relaxed">
            <div class="bg-[#FFFBE6] p-6 rounded-2xl border-2 border-[#FECE00]/60 space-y-2">
                <span class="inline-block text-xs uppercase font-black bg-black text-[#FECE00] px-2.5 py-0.5 rounded tracking-wider">Visi</span>
                <h3 class="text-lg font-black text-black">Menjadi Mitra Rantai Pasok Terdepan di Asia</h3>
                <p>Menyediakan layanan logistik kelas dunia dengan transparansi jadwal, efisiensi biaya, dan integritas tinggi bagi seluruh pelaku industri manufaktur dan perdagangan.</p>
            </div>
            <div class="bg-[#FFFBE6] p-6 rounded-2xl border-2 border-[#FECE00]/60 space-y-2">
                <span class="inline-block text-xs uppercase font-black bg-black text-[#FECE00] px-2.5 py-0.5 rounded tracking-wider">Misi</span>
                <h3 class="text-lg font-black text-black">Operasional Unggul & Berkelanjutan</h3>
                <p>Memberikan solusi kargo terintegrasi (laut, darat, udara) didukung sistem helpdesk transparan, pemenuhan SLA yang ketat, dan kepatuhan penuh terhadap regulasi kepabeanan internasional.</p>
            </div>
        </div>
    </div>

    <!-- Offices Directory Grid -->
    <div class="space-y-6">
        <h2 class="text-2xl font-black text-black">Direktori Kantor & Jaringan Operasional</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($offices as $office)
            <div class="bg-white rounded-2xl border-2 border-neutral-200 hover:border-[#FECE00] p-6 shadow-sm space-y-3 transition">
                <span class="inline-block text-xs font-black px-2.5 py-0.5 rounded-full bg-[#FECE00] text-black">{{ $office->code }}</span>
                <h3 class="text-base font-black text-black">{{ $office->name }}</h3>
                <p class="text-xs text-neutral-600 leading-relaxed">{{ $office->address }}</p>
                <div class="pt-3 border-t border-neutral-100 text-xs text-neutral-700 space-y-1">
                    <p><strong>Tel:</strong> {{ $office->phone }}</p>
                    <p><strong>Email:</strong> <span class="text-black font-black underline decoration-[#FECE00] decoration-2">{{ $office->email }}</span></p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

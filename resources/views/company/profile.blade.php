@extends('layouts.app')

@section('content')
@php $locale = app()->getLocale(); @endphp

<div class="relative bg-[#FECE00] text-black py-16 px-4 sm:px-8 border-b-2 border-black/15 overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('zimmoah-assets/images/banner/banner-schedule.jpg') }}" alt="Zimmoah Profile"
             class="w-full h-full object-cover object-center grayscale opacity-20 mix-blend-multiply">
        <div class="absolute inset-0 bg-gradient-to-r from-[#FECE00] via-[#FECE00]/90 to-[#FECE00]/55"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto space-y-4">
        <span class="inline-block text-xs uppercase tracking-widest font-black text-[#FECE00] bg-black px-3.5 py-1 rounded-full">
            PT. Zimmoah Marine Trans &bull; Since 1989
        </span>
        <h1 class="text-3xl sm:text-5xl font-black tracking-tight text-black">
            @if ($locale === 'ko') 회사 소개 및 공식 프로필 @elseif ($locale === 'en') Company Profile &amp; Official Brochure @else Profil Perusahaan &amp; Komitmen Layanan @endif
        </h1>
        <p class="text-neutral-900 font-medium max-w-2xl text-sm sm:text-base leading-relaxed">
            Menghubungkan Indonesia dengan arus perdagangan global melalui infrastruktur terpadu, armada handal, dan teknologi logistik modern sejak 1989.
        </p>
    </div>
</div>

@include('company._subnav')

<div class="max-w-7xl mx-auto px-4 sm:px-8 py-14 space-y-12">
    <!-- Quick Navigation to All Official Zimmoah Company Sections -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        <a href="{{ route('company.ceo') }}" class="group bg-white rounded-2xl border-2 border-neutral-200 hover:border-[#FECE00] p-6 shadow-sm hover:shadow-lg transition space-y-2">
            <span class="inline-block text-[10px] font-black uppercase bg-black text-[#FECE00] px-2.5 py-0.5 rounded-full">Leadership</span>
            <h3 class="text-base font-black text-black group-hover:underline decoration-[#FECE00] decoration-2">{{ __('messages.cmp_ceo') }}</h3>
            <p class="text-xs text-neutral-600">Sambutan resmi CEO Jason Lee (이지현) &amp; semboyan korporat Zimmoah Marine Trans.</p>
        </a>
        <a href="{{ route('company.history') }}" class="group bg-white rounded-2xl border-2 border-neutral-200 hover:border-[#FECE00] p-6 shadow-sm hover:shadow-lg transition space-y-2">
            <span class="inline-block text-[10px] font-black uppercase bg-[#FECE00] text-black px-2.5 py-0.5 rounded-full">1989 &ndash; Present</span>
            <h3 class="text-base font-black text-black group-hover:underline decoration-[#FECE00] decoration-2">{{ __('messages.cmp_history') }}</h3>
            <p class="text-xs text-neutral-600">Jejak sejarah pendirian di Jakarta (1989), ekspansi Indonesia &amp; Vietnam, hingga RLC &amp; Cargobus.</p>
        </a>
        <a href="{{ route('company.cip') }}" class="group bg-white rounded-2xl border-2 border-neutral-200 hover:border-[#FECE00] p-6 shadow-sm hover:shadow-lg transition space-y-2">
            <span class="inline-block text-[10px] font-black uppercase bg-black text-[#FECE00] px-2.5 py-0.5 rounded-full">Brand Kit</span>
            <h3 class="text-base font-black text-black group-hover:underline decoration-[#FECE00] decoration-2">{{ __('messages.cmp_cip') }}</h3>
            <p class="text-xs text-neutral-600">Panduan Wordmark, Signature, dan unduh file logo resmi (.AI, .JPG, .PNG).</p>
        </a>
        <a href="{{ route('company.license') }}" class="group bg-white rounded-2xl border-2 border-neutral-200 hover:border-[#FECE00] p-6 shadow-sm hover:shadow-lg transition space-y-2">
            <span class="inline-block text-[10px] font-black uppercase bg-[#FECE00] text-black px-2.5 py-0.5 rounded-full">Accreditation</span>
            <h3 class="text-base font-black text-black group-hover:underline decoration-[#FECE00] decoration-2">{{ __('messages.cmp_license') }}</h3>
            <p class="text-xs text-neutral-600">Asosiasi logistik resmi &amp; keagenan kargo udara (Official Aircargo Agency).</p>
        </a>
        <a href="{{ route('company.organization') }}" class="group bg-white rounded-2xl border-2 border-neutral-200 hover:border-[#FECE00] p-6 shadow-sm hover:shadow-lg transition space-y-2">
            <span class="inline-block text-[10px] font-black uppercase bg-black text-[#FECE00] px-2.5 py-0.5 rounded-full">Structure</span>
            <h3 class="text-base font-black text-black group-hover:underline decoration-[#FECE00] decoration-2">{{ __('messages.cmp_organization') }}</h3>
            <p class="text-xs text-neutral-600">Bagan struktur organisasi Kantor Pusat (versi Inggris &amp; Korea).</p>
        </a>
        <a href="{{ route('company.branches') }}" class="group bg-white rounded-2xl border-2 border-neutral-200 hover:border-[#FECE00] p-6 shadow-sm hover:shadow-lg transition space-y-2">
            <span class="inline-block text-[10px] font-black uppercase bg-[#FECE00] text-black px-2.5 py-0.5 rounded-full">8 Locations</span>
            <h3 class="text-base font-black text-black group-hover:underline decoration-[#FECE00] decoration-2">{{ __('messages.cmp_branches') }}</h3>
            <p class="text-xs text-neutral-600">Peta jaringan Asia Tenggara &amp; 8 lokasi Google Maps kantor cabang + afiliasi.</p>
        </a>
    </div>

    <!-- Vision & Mission -->
    <div class="bg-white rounded-3xl p-8 sm:p-10 border-2 border-neutral-200 shadow-sm space-y-6">
        <h2 class="text-2xl font-black text-black">Visi &amp; Misi Perusahaan</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-sm text-neutral-700 leading-relaxed">
            <div class="bg-[#FFFBE6] p-6 rounded-2xl border-2 border-[#FECE00]/60 space-y-2">
                <span class="inline-block text-xs uppercase font-black bg-black text-[#FECE00] px-2.5 py-0.5 rounded tracking-wider">Visi</span>
                <h3 class="text-lg font-black text-black">Menjadi Mitra Rantai Pasok Terdepan di Asia</h3>
                <p>Menyediakan layanan logistik kelas dunia dengan transparansi jadwal, efisiensi biaya, dan integritas tinggi bagi seluruh pelaku industri manufaktur dan perdagangan.</p>
            </div>
            <div class="bg-[#FFFBE6] p-6 rounded-2xl border-2 border-[#FECE00]/60 space-y-2">
                <span class="inline-block text-xs uppercase font-black bg-black text-[#FECE00] px-2.5 py-0.5 rounded tracking-wider">Misi</span>
                <h3 class="text-lg font-black text-black">Operasional Unggul &amp; Berkelanjutan</h3>
                <p>Memberikan solusi kargo terintegrasi (laut, darat, udara) didukung sistem helpdesk transparan, pemenuhan SLA yang ketat, dan kepatuhan penuh terhadap regulasi kepabeanan internasional.</p>
            </div>
        </div>
    </div>

    <!-- Official Zimmoah Company Profile PDF (from zimmoah.com/company-profile.php) -->
    @if (!empty($profilePdf))
    <div class="bg-white rounded-3xl p-6 sm:p-10 border-2 border-neutral-200 shadow-sm space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-neutral-100 pb-4">
            <div>
                <span class="inline-block text-[10px] font-black uppercase bg-black text-[#FECE00] px-3 py-1 rounded-full mb-1.5">
                    Official Document &bull; PDF
                </span>
                <h2 class="text-2xl font-black text-black">Zimmoah Official Company Profile Brochure</h2>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ asset($profilePdf) }}" target="_blank"
                   class="px-4 py-2.5 rounded-full text-xs font-black bg-neutral-100 hover:bg-neutral-200 text-black transition">
                    Buka Tab Baru &nearr;
                </a>
                <a href="{{ asset($profilePdf) }}" download
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-xs font-black bg-black hover:bg-[#FECE00] text-[#FECE00] hover:text-black transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    <span>Download Profile PDF</span>
                </a>
            </div>
        </div>
        <div class="rounded-2xl overflow-hidden border-2 border-neutral-200 bg-neutral-100">
            <iframe src="{{ asset($profilePdf) }}" class="w-full h-[640px] border-0" title="Zimmoah Company Profile PDF"></iframe>
        </div>
    </div>
    @endif

    <!-- Offices Directory Grid -->
    <div class="space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <h2 class="text-2xl font-black text-black">Direktori Kantor &amp; Jaringan Operasional</h2>
            <a href="{{ route('company.branches') }}" class="text-xs font-black text-black underline decoration-[#FECE00] decoration-2 underline-offset-4 hover:opacity-75">
                Lihat Peta 8 Cabang &amp; Afiliasi &rarr;
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($offices as $office)
            <div class="bg-white rounded-2xl border-2 border-neutral-200 hover:border-[#FECE00] p-6 shadow-sm space-y-3 transition">
                <span class="inline-block text-xs font-black px-2.5 py-0.5 rounded-full bg-[#FECE00] text-black">{{ $office->code }}</span>
                <h3 class="text-base font-black text-black">{{ $office->name }}</h3>
                <p class="text-xs text-neutral-600 leading-relaxed">{{ $office->address }}</p>
                <div class="pt-3 border-t border-neutral-100 text-xs text-neutral-700 space-y-1">
                    <p><strong>Tel:</strong> {{ $office->phone }}</p>
                    @if ($office->fax)
                        <p><strong>Fax:</strong> {{ $office->fax }}</p>
                    @endif
                    <p><strong>Email:</strong> <span class="text-black font-black underline decoration-[#FECE00] decoration-2">{{ $office->email }}</span></p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
@php $locale = app()->getLocale(); @endphp

<!-- Hero -->
<div class="relative bg-[#FECE00] text-black py-16 px-4 sm:px-8 border-b-2 border-black/15 overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('zimmoah-assets/images/banner/banner-history.jpg') }}" alt="Company History"
             class="w-full h-full object-cover object-center grayscale opacity-20 mix-blend-multiply">
        <div class="absolute inset-0 bg-gradient-to-r from-[#FECE00] via-[#FECE00]/90 to-[#FECE00]/55"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto space-y-4">
        <span class="inline-block text-xs uppercase tracking-widest font-black text-[#FECE00] bg-black px-3.5 py-1 rounded-full">
            1989 &ndash; Present &bull; 35+ Years of Trust
        </span>
        <h1 class="text-3xl sm:text-5xl font-black tracking-tight text-black">
            @if ($locale === 'ko') 회사 연혁 @elseif ($locale === 'en') Company History @else Sejarah &amp; Tonggak Perusahaan @endif
        </h1>
        <p class="text-neutral-900 font-medium max-w-2xl text-sm sm:text-base leading-relaxed">
            @if ($locale === 'ko')
                1989년 자카르타 본사 설립부터 인도네시아 전역 및 베트남 지점, 보세창고 및 프로젝트 전문 법인까지 짐모아의 성장 여정입니다.
            @elseif ($locale === 'en')
                Tracing PT. Zimmoah Marine Trans from our founding in Jakarta in 1989 to a multi-country logistics, bonded warehousing, and project cargo group across Indonesia and Vietnam.
            @else
                Perjalanan pertumbuhan PT. Zimmoah Marine Trans sejak didirikan di Jakarta pada 1989 hingga memiliki jaringan cabang Indonesia–Vietnam, gudang berikat, dan armada darat mandiri.
            @endif
        </p>
    </div>
</div>

@include('company._subnav')

<div class="max-w-5xl mx-auto px-4 sm:px-8 py-14 space-y-10">
    <!-- Highlight KPIs -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-2xl border-2 border-neutral-200 p-5 text-center">
            <span class="text-3xl font-black text-black">1989</span>
            <p class="text-xs font-bold text-neutral-500 mt-1">Founded in Jakarta</p>
        </div>
        <div class="bg-white rounded-2xl border-2 border-neutral-200 p-5 text-center">
            <span class="text-3xl font-black text-black">8</span>
            <p class="text-xs font-bold text-neutral-500 mt-1">Branches &amp; Affiliates</p>
        </div>
        <div class="bg-white rounded-2xl border-2 border-neutral-200 p-5 text-center">
            <span class="text-3xl font-black text-black">82+</span>
            <p class="text-xs font-bold text-neutral-500 mt-1">Owned Fleet Units</p>
        </div>
        <div class="bg-white rounded-2xl border-2 border-neutral-200 p-5 text-center">
            <span class="text-3xl font-black text-black">18,000 m&sup2;</span>
            <p class="text-xs font-bold text-neutral-500 mt-1">Warehouse Land Area</p>
        </div>
    </div>

    <!-- Vertical Timeline -->
    <div class="bg-white rounded-3xl border-2 border-neutral-200 shadow-sm p-8 sm:p-10">
        <div class="relative border-l-4 border-[#FECE00] ml-4 space-y-7">
            @foreach ($timeline as $item)
                <div class="relative pl-8">
                    <span class="absolute -left-[14px] top-1.5 w-6 h-6 rounded-full bg-black border-4 border-[#FECE00] shadow-xs"></span>
                    <div class="bg-[#FFFDF5] hover:bg-[#FFFBE6] border border-neutral-200 hover:border-[#FECE00] rounded-2xl p-5 transition flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <div class="space-y-1">
                            <div class="flex items-center gap-2.5">
                                <span class="text-lg font-black text-black">{{ $item['year'] }}</span>
                                <span class="text-[10px] font-black uppercase tracking-wider px-2.5 py-0.5 rounded-full bg-[#FECE00] text-black">
                                    {{ $item['tag'] }}
                                </span>
                            </div>
                            <p class="text-sm font-semibold text-neutral-800">
                                {{ $item[$locale] ?? $item['en'] }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

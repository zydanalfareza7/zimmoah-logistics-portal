@extends('layouts.app')

@section('content')
@php
    $locale = app()->getLocale();
    $orgChartImg = $locale === 'ko'
        ? 'zimmoah-assets/images/organization/org-chart-kor.jpg'
        : 'zimmoah-assets/images/organization/org-chart-eng.jpg';
@endphp

<!-- Hero -->
<div class="relative bg-[#FECE00] text-black py-16 px-4 sm:px-8 border-b-2 border-black/15 overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('zimmoah-assets/images/banner/banner-organization.jpg') }}" alt="Organization Chart"
             class="w-full h-full object-cover object-center grayscale opacity-20 mix-blend-multiply">
        <div class="absolute inset-0 bg-gradient-to-r from-[#FECE00] via-[#FECE00]/90 to-[#FECE00]/55"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto space-y-4">
        <span class="inline-block text-xs uppercase tracking-widest font-black text-[#FECE00] bg-black px-3.5 py-1 rounded-full">
            Corporate Structure
        </span>
        <h1 class="text-3xl sm:text-5xl font-black tracking-tight text-black">
            @if ($locale === 'ko') 조직도 @elseif ($locale === 'en') Organization Chart @else Struktur Organisasi @endif
        </h1>
        <p class="text-neutral-900 font-medium max-w-2xl text-sm sm:text-base leading-relaxed">
            @if ($locale === 'ko')
                자카르타 본사 및 각 사업부(해상·항공·영업·고객지원·회계)의 체계적인 조직 구성도입니다.
            @elseif ($locale === 'en')
                Head Office organizational structure spanning Management, Sales &amp; Development, Sea &amp; Air Freight, Customer Service, and Accounting.
            @else
                Struktur organisasi Kantor Pusat PT. Zimmoah Marine Trans yang mencakup Manajemen, Sales, Sea/Air Freight, Customer Service, dan Accounting.
            @endif
        </p>
    </div>
</div>

@include('company._subnav')

<div class="max-w-6xl mx-auto px-4 sm:px-8 py-14 space-y-8">
    <div class="bg-white rounded-3xl border-2 border-neutral-200 p-6 sm:p-10 shadow-sm space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-neutral-100 pb-4">
            <div>
                <h2 class="text-2xl font-black text-black">
                    @if ($locale === 'ko') 본사 조직도 (Head Office) @elseif ($locale === 'en') Head Office Organization Chart @else Bagan Organisasi Kantor Pusat @endif
                </h2>
                <p class="text-xs text-neutral-500 mt-1">
                    @if ($locale === 'ko') 아래 버튼으로 영문/한글 조직도를 전환하거나 원본 크기로 열 수 있습니다. @elseif ($locale === 'en') Toggle between English and Korean charts or open full resolution. @else Anda dapat mengganti tampilan bagan versi Inggris/Korea atau membuka resolusi penuh. @endif
                </p>
            </div>
            <div class="flex items-center gap-2">
                <button type="button" onclick="setOrgChart('eng')" id="btn-org-eng"
                        class="px-4 py-2 rounded-full text-xs font-black transition {{ $locale !== 'ko' ? 'bg-black text-[#FECE00]' : 'bg-neutral-100 text-neutral-700 hover:bg-[#FECE00] hover:text-black' }}">
                    English Chart
                </button>
                <button type="button" onclick="setOrgChart('kor')" id="btn-org-kor"
                        class="px-4 py-2 rounded-full text-xs font-black transition {{ $locale === 'ko' ? 'bg-black text-[#FECE00]' : 'bg-neutral-100 text-neutral-700 hover:bg-[#FECE00] hover:text-black' }}">
                    한국어 조직도
                </button>
                <a id="orgChartFullLink" href="{{ asset($orgChartImg) }}" target="_blank"
                   class="px-4 py-2 rounded-full text-xs font-black bg-[#FECE00] hover:bg-black text-black hover:text-[#FECE00] transition">
                    Full Size &nearr;
                </a>
            </div>
        </div>

        <div class="rounded-2xl border border-neutral-200 bg-neutral-50 p-4 sm:p-6 flex justify-center">
            <img id="orgChartImg" src="{{ asset($orgChartImg) }}" alt="Zimmoah Head Office Organization Chart"
                 class="max-w-full h-auto rounded-xl shadow-xs">
        </div>

        <div class="pt-4 border-t border-neutral-100 flex flex-wrap items-center justify-between gap-4">
            <p class="text-xs text-neutral-600">
                @if ($locale === 'ko') 각 부서 담당자 연락처가 필요하신가요? @elseif ($locale === 'en') Need direct email or extension numbers for each department? @else Butuh email atau nomor ekstensi langsung tiap departemen? @endif
            </p>
            <a href="{{ route('contact') }}" class="bg-black hover:bg-[#FECE00] text-[#FECE00] hover:text-black font-black text-xs px-6 py-3 rounded-full transition shadow-sm">
                @if ($locale === 'ko') 담당부서 연락처 보기 &rarr; @elseif ($locale === 'en') View Staff Contact Directory &rarr; @else Lihat Direktori Kontak PIC &rarr; @endif
            </a>
        </div>
    </div>
</div>

<script>
    const orgChartUrls = {
        eng: "{{ asset('zimmoah-assets/images/organization/org-chart-eng.jpg') }}",
        kor: "{{ asset('zimmoah-assets/images/organization/org-chart-kor.jpg') }}"
    };

    function setOrgChart(code) {
        const img = document.getElementById('orgChartImg');
        const link = document.getElementById('orgChartFullLink');
        if (img) img.src = orgChartUrls[code];
        if (link) link.href = orgChartUrls[code];

        ['eng', 'kor'].forEach(k => {
            const btn = document.getElementById('btn-org-' + k);
            if (!btn) return;
            if (k === code) {
                btn.className = 'px-4 py-2 rounded-full text-xs font-black transition bg-black text-[#FECE00]';
            } else {
                btn.className = 'px-4 py-2 rounded-full text-xs font-black transition bg-neutral-100 text-neutral-700 hover:bg-[#FECE00] hover:text-black';
            }
        });
    }
</script>
@endsection

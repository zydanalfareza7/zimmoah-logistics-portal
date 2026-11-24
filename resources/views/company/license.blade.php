@extends('layouts.app')

@section('content')
@php $locale = app()->getLocale(); @endphp

<!-- Hero -->
<div class="relative bg-[#FECE00] text-black py-16 px-4 sm:px-8 border-b-2 border-black/15 overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('zimmoah-assets/images/banner/banner-license.jpg') }}" alt="License and Association"
             class="w-full h-full object-cover object-center grayscale opacity-20 mix-blend-multiply">
        <div class="absolute inset-0 bg-gradient-to-r from-[#FECE00] via-[#FECE00]/90 to-[#FECE00]/55"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto space-y-4">
        <span class="inline-block text-xs uppercase tracking-widest font-black text-[#FECE00] bg-black px-3.5 py-1 rounded-full">
            Certifications &amp; Memberships
        </span>
        <h1 class="text-3xl sm:text-5xl font-black tracking-tight text-black">
            @if ($locale === 'ko') 라이센스 및 협회 @elseif ($locale === 'en') License &amp; Association @else Lisensi &amp; Keanggotaan Asosiasi @endif
        </h1>
        <p class="text-neutral-900 font-medium max-w-2xl text-sm sm:text-base leading-relaxed">
            @if ($locale === 'ko')
                짐모아가 보유한 국제/국내 물류 협회 가입 현황 및 공식 항공화물 에이전시 인증 정보입니다.
            @elseif ($locale === 'en')
                Official logistics industry associations, regulatory memberships, and accredited airline cargo agencies held by PT. Zimmoah Marine Trans.
            @else
                Daftar keanggotaan resmi asosiasi logistik nasional &amp; internasional serta lisensi keagenan kargo udara resmi PT. Zimmoah Marine Trans.
            @endif
        </p>
    </div>
</div>

@include('company._subnav')

<div class="max-w-6xl mx-auto px-4 sm:px-8 py-14 space-y-10">
    <!-- Association -->
    <div class="bg-white rounded-3xl border-2 border-neutral-200 p-8 sm:p-10 shadow-sm space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 border-b border-neutral-100 pb-4">
            <div>
                <span class="inline-block text-[10px] font-black uppercase tracking-wider bg-[#FECE00] text-black px-3 py-1 rounded-full mb-2">
                    01 &bull; Membership
                </span>
                <h2 class="text-2xl font-black text-black">
                    @if ($locale === 'ko') 가입 협회 (Association) @elseif ($locale === 'en') Association Memberships @else Keanggotaan Asosiasi @endif
                </h2>
            </div>
            <span class="text-xs font-semibold text-neutral-500">ALFI / ILFA &bull; FIATA &bull; IATA &bull; Global Networks</span>
        </div>
        <div class="rounded-2xl border border-neutral-200 bg-neutral-50 p-6 flex justify-center">
            <img src="{{ asset('zimmoah-assets/images/license/license-2.jpg') }}" alt="Zimmoah Associations"
                 class="max-w-full h-auto rounded-xl">
        </div>
    </div>

    <!-- Official Aircargo Agency -->
    <div class="bg-white rounded-3xl border-2 border-neutral-200 p-8 sm:p-10 shadow-sm space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 border-b border-neutral-100 pb-4">
            <div>
                <span class="inline-block text-[10px] font-black uppercase tracking-wider bg-black text-[#FECE00] px-3 py-1 rounded-full mb-2">
                    02 &bull; Airline Partners
                </span>
                <h2 class="text-2xl font-black text-black">
                    @if ($locale === 'ko') 공식 항공화물 에이전시 @elseif ($locale === 'en') Official Aircargo Agency @else Agen Resmi Kargo Udara @endif
                </h2>
            </div>
            <span class="text-xs font-semibold text-neutral-500">Accredited Airline GSA &amp; Cargo Partners</span>
        </div>
        <div class="rounded-2xl border border-neutral-200 bg-neutral-50 p-6 flex justify-center">
            <img src="{{ asset('zimmoah-assets/images/license/license-1.jpg') }}" alt="Zimmoah Official Aircargo Agency"
                 class="max-w-full h-auto rounded-xl">
        </div>
    </div>
</div>
@endsection

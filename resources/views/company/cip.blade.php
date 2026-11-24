@extends('layouts.app')

@section('content')
@php $locale = app()->getLocale(); @endphp

<!-- Hero -->
<div class="relative bg-[#FECE00] text-black py-16 px-4 sm:px-8 border-b-2 border-black/15 overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('zimmoah-assets/images/banner/banner-cip.jpg') }}" alt="Zimmoah CIP"
             class="w-full h-full object-cover object-center grayscale opacity-20 mix-blend-multiply">
        <div class="absolute inset-0 bg-gradient-to-r from-[#FECE00] via-[#FECE00]/90 to-[#FECE00]/55"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto space-y-4">
        <span class="inline-block text-xs uppercase tracking-widest font-black text-[#FECE00] bg-black px-3.5 py-1 rounded-full">
            Corporate Identity Program (CIP)
        </span>
        <h1 class="text-3xl sm:text-5xl font-black tracking-tight text-black">
            @if ($locale === 'ko') CIP 및 공식 로고 다운로드 @elseif ($locale === 'en') Brand Identity (CIP) &amp; Logo Assets @else Identitas Perusahaan (CIP) &amp; Unduh Logo @endif
        </h1>
        <p class="text-neutral-900 font-medium max-w-2xl text-sm sm:text-base leading-relaxed">
            @if ($locale === 'ko')
                짐모아 워드마크, 시그니처 매뉴얼 및 공식 로고 원본 파일(AI, JPG, PNG)을 다운로드하실 수 있습니다.
            @elseif ($locale === 'en')
                Official Zimmoah Wordmark, Signature guidelines, and original logo files (.AI, .JPG, .PNG) for partners and media.
            @else
                Panduan resmi Wordmark, Signature, dan paket unduhan logo asli Zimmoah (.AI, .JPG, .PNG) untuk mitra dan keperluan media.
            @endif
        </p>
    </div>
</div>

@include('company._subnav')

<div class="max-w-7xl mx-auto px-4 sm:px-8 py-14 space-y-10">
    <!-- Wordmark & Signature Descriptions -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="bg-white rounded-3xl border-2 border-neutral-200 p-8 shadow-sm space-y-4">
            <span class="inline-block text-xs uppercase font-black bg-black text-[#FECE00] px-3 py-1 rounded-full">
                @if ($locale === 'ko') 워드마크 @else Wordmark @endif
            </span>
            <h2 class="text-xl font-black text-black">
                @if ($locale === 'ko') 짐모아 워드마크의 의미 @elseif ($locale === 'en') Meaning of the Zimmoah Wordmark @else Makna Wordmark Zimmoah @endif
            </h2>
            @if ($locale === 'ko')
                <p class="text-sm text-neutral-700 leading-relaxed">
                    짐모아를 상징하는 Z를 감싸고 있는 라운드형의 사각형은 유연성과 효율적인 운송서비스를 의미하며, 영문로고의 AH부분에 있는 사선형 이미지는 전 세계를 향한 비상하는 짐모아의 기상과 운송서비스를 상징화하고 있습니다.
                </p>
                <p class="text-sm text-neutral-700 leading-relaxed">
                    전체적으로 볼드체의 묵직한 로고타입은 성실하고 책임감있는 자세로 묵묵히 임무 수행에 최선을 다하겠다는 짐모아 전 임직원의 의지를 나타내며, 로고의 라운딩 타입은 적극적이고도 유연한 대고객서비스 자세를 표현하고 있습니다.
                </p>
            @elseif ($locale === 'en')
                <p class="text-sm text-neutral-700 leading-relaxed">
                    The rounded rectangle surrounding the letter <strong>Z</strong> symbolizes Zimmoah's flexibility and efficient transportation services, while the linear wave in the <strong>AH</strong> portion of the English logo symbolizes the soaring spirit and global reach of Zimmoah.
                </p>
                <p class="text-sm text-neutral-700 leading-relaxed">
                    Overall, the bold heavyweight logotype represents the commitment of all Zimmoah employees to fulfill their duties reliably and responsibly. The rounded form expresses a proactive and flexible approach to customer service.
                </p>
            @else
                <p class="text-sm text-neutral-700 leading-relaxed">
                    Persegi panjang membulat yang melingkupi huruf <strong>Z</strong> melambangkan fleksibilitas dan efisiensi layanan transportasi Zimmoah, sementara garis dinamis pada bagian <strong>AH</strong> melambangkan semangat Zimmoah yang terus melesat menjangkau dunia.
                </p>
                <p class="text-sm text-neutral-700 leading-relaxed">
                    Tipografi tebal (bold) mencerminkan tekad seluruh jajaran Zimmoah dalam menjalankan tugas secara tekun dan penuh tanggung jawab, sedangkan sudut membulatnya melambangkan pelayanan pelanggan yang proaktif dan fleksibel.
                </p>
            @endif
        </div>

        <div class="bg-white rounded-3xl border-2 border-neutral-200 p-8 shadow-sm space-y-4">
            <span class="inline-block text-xs uppercase font-black bg-[#FECE00] text-black px-3 py-1 rounded-full">
                @if ($locale === 'ko') 시그니춰 @else Signature System @endif
            </span>
            <h2 class="text-xl font-black text-black">
                @if ($locale === 'ko') 시그니처 사용 규정 @elseif ($locale === 'en') Signature Usage Guidelines @else Pedoman Penggunaan Signature @endif
            </h2>
            @if ($locale === 'ko')
                <p class="text-sm text-neutral-700 leading-relaxed">
                    시그니춰 시스템의 활용은 상황에 맞는 조합으로 선택 활용할 수 있으며, 본 매뉴얼의 해당 항목별로 예시된 내용을 따르도록 해야 합니다. 해당 데이터는 원본 데이터를 그대로 사용하여 이미지의 오용과 훼손을 막아야 합니다.
                </p>
            @elseif ($locale === 'en')
                <p class="text-sm text-neutral-700 leading-relaxed">
                    The signature system may be applied in combinations suited to each context while strictly following the examples shown in this manual. Always use the original digital source files below to prevent distortion or misuse.
                </p>
            @else
                <p class="text-sm text-neutral-700 leading-relaxed">
                    Sistem signature dapat digunakan dalam kombinasi sesuai kebutuhan media dengan tetap mengikuti contoh pada panduan ini. Selalu gunakan file digital asli di bawah ini agar bentuk dan proporsi logo tetap terjaga.
                </p>
            @endif

            <!-- Official Brand Colors -->
            <div class="pt-3 border-t border-neutral-100 grid grid-cols-2 gap-3">
                <div class="flex items-center gap-3 p-3 rounded-xl bg-neutral-50 border border-neutral-200">
                    <span class="w-9 h-9 rounded-lg bg-[#FECE00] border border-black/15 flex-shrink-0"></span>
                    <div class="text-xs">
                        <strong class="block text-black">Zimmoah Yellow</strong>
                        <span class="font-mono text-neutral-500">#FECE00</span>
                    </div>
                </div>
                <div class="flex items-center gap-3 p-3 rounded-xl bg-neutral-50 border border-neutral-200">
                    <span class="w-9 h-9 rounded-lg bg-black flex-shrink-0"></span>
                    <div class="text-xs">
                        <strong class="block text-black">Corporate Black</strong>
                        <span class="font-mono text-neutral-500">#000000</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Official CIP Visual Guide -->
    <div class="bg-white rounded-3xl border-2 border-neutral-200 p-6 sm:p-10 shadow-sm space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 border-b border-neutral-100 pb-4">
            <h2 class="text-xl font-black text-black">Official CIP Signature Sheet</h2>
            <span class="text-xs font-semibold text-neutral-500">Original Zimmoah Brand Manual</span>
        </div>
        <div class="rounded-2xl overflow-hidden border border-neutral-200 bg-neutral-50 p-4 flex justify-center">
            <img src="{{ asset('zimmoah-assets/images/cip/cip-1-eng.jpg') }}" alt="Zimmoah CIP Signature Manual"
                 class="max-w-full h-auto rounded-xl">
        </div>
    </div>

    <!-- Download Cards -->
    <div class="space-y-4">
        <h2 class="text-2xl font-black text-black">
            @if ($locale === 'ko') 공식 로고 파일 다운로드 @elseif ($locale === 'en') Download Official Logo Assets @else Unduh Paket Logo Resmi @endif
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($downloads as $dl)
                <div class="bg-white rounded-3xl border-2 border-neutral-200 hover:border-[#FECE00] p-6 shadow-sm flex flex-col justify-between space-y-5 transition">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-[11px] font-black bg-[#FECE00] text-black px-3 py-1 rounded-full">{{ $dl['badge'] }}</span>
                            <span class="text-xs font-mono text-neutral-500">{{ $dl['size'] }}</span>
                        </div>
                        <h3 class="text-lg font-black text-black">{{ $dl['format'] }}</h3>
                        <p class="text-xs text-neutral-600 leading-relaxed">
                            {{ $dl['desc_' . $locale] ?? $dl['desc_en'] }}
                        </p>
                    </div>
                    <a href="{{ asset($dl['file']) }}" download
                       class="w-full inline-flex items-center justify-center gap-2 bg-black hover:bg-[#FECE00] text-[#FECE00] hover:text-black font-black text-xs py-3 rounded-xl transition shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        <span>Download {{ $dl['badge'] }}</span>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
@php $locale = app()->getLocale(); @endphp

<!-- Hero -->
<div class="relative bg-[#FECE00] text-black py-16 px-4 sm:px-8 border-b-2 border-black/15 overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('zimmoah-assets/images/banner/banner-branch.jpg') }}" alt="Branch Network"
             class="w-full h-full object-cover object-center grayscale opacity-20 mix-blend-multiply">
        <div class="absolute inset-0 bg-gradient-to-r from-[#FECE00] via-[#FECE00]/90 to-[#FECE00]/55"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto space-y-4">
        <span class="inline-block text-xs uppercase tracking-widest font-black text-[#FECE00] bg-black px-3.5 py-1 rounded-full">
            Indonesia &bull; Vietnam &bull; Affiliates
        </span>
        <h1 class="text-3xl sm:text-5xl font-black tracking-tight text-black">
            @if ($locale === 'ko') 지점 및 관계사 안내 @elseif ($locale === 'en') Branch Network &amp; Affiliates @else Jaringan Cabang &amp; Afiliasi @endif
        </h1>
        <p class="text-neutral-900 font-medium max-w-2xl text-sm sm:text-base leading-relaxed">
            @if ($locale === 'ko')
                인도네시아(자카르타 본사, 공항, 스마랑) 및 베트남(호치민, 하노이) 지점과 관계사(SKL, Line Network, RLC) 위치를 지도에서 바로 확인하세요.
            @elseif ($locale === 'en')
                Explore all 8 official Zimmoah offices and group affiliates across Indonesia and Vietnam with interactive Google Maps.
            @else
                Jelajahi 8 lokasi resmi kantor cabang dan perusahaan afiliasi Zimmoah di Indonesia &amp; Vietnam lengkap dengan peta Google Maps interaktif.
            @endif
        </p>
    </div>
</div>

@include('company._subnav')

<div class="max-w-7xl mx-auto px-4 sm:px-8 py-14 space-y-12">
    <!-- Interactive Google Map Explorer (All 8 Official Locations from zimmoah.com) -->
    <div class="bg-white rounded-3xl border-2 border-neutral-200 shadow-sm overflow-hidden">
        <div class="p-6 sm:p-8 border-b border-neutral-200 bg-[#FFFBE6] flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <span class="text-[10px] font-black uppercase tracking-widest bg-black text-[#FECE00] px-3 py-1 rounded-full">
                    Interactive Map Explorer
                </span>
                <h2 class="text-2xl font-black text-black mt-2">
                    @if ($locale === 'ko') 지점별 위치 지도 (8개 거점) @elseif ($locale === 'en') Select a Branch or Affiliate Location @else Pilih Lokasi Cabang atau Afiliasi @endif
                </h2>
            </div>
            <p class="text-xs font-semibold text-neutral-600">
                Click any branch below to load its exact Google Map &amp; contact details
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12">
            <!-- Left Selector List -->
            <div class="lg:col-span-4 border-b lg:border-b-0 lg:border-r border-neutral-200 divide-y divide-neutral-100 max-h-[560px] overflow-y-auto">
                @foreach ($branches as $idx => $b)
                    <button type="button"
                            onclick="selectBranch('{{ $b['slug'] }}')"
                            id="branch-btn-{{ $b['slug'] }}"
                            class="branch-selector w-full text-left p-5 transition flex items-start justify-between gap-3 {{ $idx === 0 ? 'bg-[#FECE00]/25 border-l-4 border-black' : 'hover:bg-neutral-50 border-l-4 border-transparent' }}">
                        <div class="space-y-1">
                            <div class="flex items-center gap-2">
                                <span class="text-[10px] font-black uppercase px-2 py-0.5 rounded-full {{ $b['type'] === 'Headquarters' ? 'bg-black text-[#FECE00]' : ($b['type'] === 'Affiliate' ? 'bg-amber-100 text-amber-900' : 'bg-neutral-200 text-neutral-800') }}">
                                    {{ $b['type'] }}
                                </span>
                                <span class="text-[10px] font-bold text-neutral-500">{{ $b['country'] }}</span>
                            </div>
                            <h3 class="text-sm font-black text-black">{{ $b['name'] }}</h3>
                            <p class="text-xs text-neutral-600 line-clamp-2">{{ $b['address'] }}</p>
                        </div>
                        <span class="text-neutral-400 font-bold mt-1">&rarr;</span>
                    </button>
                @endforeach
            </div>

            <!-- Right Map & Details Viewer -->
            <div class="lg:col-span-8 flex flex-col">
                @php $first = $branches[0] ?? null; @endphp
                @if ($first)
                    <div class="p-6 bg-white border-b border-neutral-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div class="space-y-1">
                            <span id="activeBranchType" class="inline-block text-[10px] font-black uppercase bg-black text-[#FECE00] px-2.5 py-0.5 rounded-full">
                                {{ $first['type'] }} &bull; {{ $first['country'] }}
                            </span>
                            <h3 id="activeBranchName" class="text-xl font-black text-black">{{ $first['name'] }}</h3>
                            <p id="activeBranchAddress" class="text-xs text-neutral-600">{{ $first['address'] }}</p>
                            <div class="flex flex-wrap gap-x-5 gap-y-1 pt-1 text-xs text-neutral-800">
                                <span><strong>Tel:</strong> <span id="activeBranchPhone">{{ $first['phone'] }}</span></span>
                                <span id="activeBranchFaxWrap" class="{{ $first['fax'] ? '' : 'hidden' }}"><strong>Fax:</strong> <span id="activeBranchFax">{{ $first['fax'] }}</span></span>
                                <span><strong>Email:</strong> <a id="activeBranchEmail" href="mailto:{{ $first['email'] }}" class="font-black underline decoration-[#FECE00] decoration-2">{{ $first['email'] }}</a></span>
                            </div>
                        </div>
                        <a href="{{ route('tickets.create') }}" class="flex-shrink-0 bg-black hover:bg-[#FECE00] text-[#FECE00] hover:text-black font-black text-xs px-5 py-2.5 rounded-full transition">
                            Inquiry &rarr;
                        </a>
                    </div>
                    <div class="flex-1 bg-neutral-100 min-h-[420px]">
                        <iframe id="activeBranchMap"
                                src="{{ $first['map_embed'] }}"
                                class="w-full h-[440px] border-0"
                                allowfullscreen
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Official Regional Coverage Visual Map from zimmoah.com -->
    <div class="bg-white rounded-3xl border-2 border-neutral-200 p-6 sm:p-10 shadow-sm space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 border-b border-neutral-100 pb-4">
            <div>
                <h2 class="text-2xl font-black text-black">
                    @if ($locale === 'ko') 동남아시아 거점 네트워크 맵 @elseif ($locale === 'en') Southeast Asia Network Overview @else Peta Jaringan Asia Tenggara @endif
                </h2>
                <p class="text-xs text-neutral-500 mt-1">Connecting Hanoi &bull; Ho Chi Minh City &bull; Jakarta &bull; Soewarna Airport &bull; Semarang &bull; Surabaya</p>
            </div>
            <div class="flex items-center gap-2">
                <button type="button" onclick="selectBranch('hanoi'); document.getElementById('activeBranchMap').scrollIntoView({behavior:'smooth'});" class="px-3 py-1.5 rounded-full text-xs font-black bg-neutral-100 hover:bg-[#FECE00] text-black transition">Hanoi Map</button>
                <button type="button" onclick="selectBranch('hochiminh'); document.getElementById('activeBranchMap').scrollIntoView({behavior:'smooth'});" class="px-3 py-1.5 rounded-full text-xs font-black bg-neutral-100 hover:bg-[#FECE00] text-black transition">Ho Chi Minh Map</button>
                <button type="button" onclick="selectBranch('jakarta'); document.getElementById('activeBranchMap').scrollIntoView({behavior:'smooth'});" class="px-3 py-1.5 rounded-full text-xs font-black bg-[#FECE00] text-black transition">Jakarta HQ Map</button>
            </div>
        </div>
        <div class="rounded-2xl overflow-hidden border border-neutral-200 bg-neutral-50 p-4 flex justify-center">
            <img src="{{ asset('zimmoah-assets/images/branch/zimmoah-asia.jpg') }}" alt="Zimmoah Asia Branch Network Map"
                 class="max-w-full max-h-[640px] w-auto rounded-xl">
        </div>
    </div>
</div>

<script>
    const branchData = @json(collect($branches)->keyBy('slug'));

    function selectBranch(slug) {
        const b = branchData[slug];
        if (!b) return;

        document.getElementById('activeBranchType').textContent = b.type + ' • ' + b.country;
        document.getElementById('activeBranchName').textContent = b.name;
        document.getElementById('activeBranchAddress').textContent = b.address;
        document.getElementById('activeBranchPhone').textContent = b.phone || '-';

        const faxWrap = document.getElementById('activeBranchFaxWrap');
        const faxEl = document.getElementById('activeBranchFax');
        if (b.fax) {
            faxWrap.classList.remove('hidden');
            faxEl.textContent = b.fax;
        } else {
            faxWrap.classList.add('hidden');
        }

        const emailEl = document.getElementById('activeBranchEmail');
        emailEl.textContent = b.email;
        emailEl.href = 'mailto:' + b.email;

        document.getElementById('activeBranchMap').src = b.map_embed;

        document.querySelectorAll('.branch-selector').forEach(btn => {
            btn.classList.remove('bg-[#FECE00]/25', 'border-black');
            btn.classList.add('border-transparent');
        });
        const activeBtn = document.getElementById('branch-btn-' + slug);
        if (activeBtn) {
            activeBtn.classList.add('bg-[#FECE00]/25', 'border-black');
            activeBtn.classList.remove('border-transparent');
        }
    }
</script>
@endsection

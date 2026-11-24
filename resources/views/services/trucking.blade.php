@extends('layouts.app')

@section('content')
@php
    $locale = app()->getLocale();
    $totalFleet = collect($fleet)->sum('count');
@endphp

<div class="relative bg-[#FECE00] text-black py-16 px-4 sm:px-8 border-b-2 border-black/15 overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('images/services/trucking.jpg') }}" alt="Inland Trucking"
             class="w-full h-full object-cover object-center grayscale opacity-20 mix-blend-multiply">
        <div class="absolute inset-0 bg-gradient-to-r from-[#FECE00] via-[#FECE00]/90 to-[#FECE00]/55"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto space-y-4">
        <span class="inline-block text-xs uppercase tracking-widest font-black text-[#FECE00] bg-black px-3.5 py-1 rounded-full">
            Inland Ground Transport &bull; {{ $totalFleet }} Owned Units
        </span>
        <h1 class="text-3xl sm:text-5xl font-black tracking-tight text-black">Inland Fleet &amp; Container Trucking</h1>
        <p class="text-neutral-900 font-medium max-w-2xl text-sm sm:text-base leading-relaxed">
            @if ($locale === 'ko')
                자체 보유 트레일러 및 톤수별 트럭({{ $totalFleet }}대)으로 자카르타·스마랑·수라바야 허브에서 자바 전역 및 발리까지 정시 내륙운송을 제공합니다.
            @elseif ($locale === 'en')
                Regular timetable from Hub Jakarta, Hub Semarang, and Hub Surabaya to 30+ cities across Java and Bali using our dedicated fleet of {{ $totalFleet }} owned trailers, trucks, lifts, and vans.
            @else
                Jadwal rutin dari Hub Jakarta, Hub Semarang, dan Hub Surabaya menuju 30 kota lintas Jawa &amp; Bali menggunakan {{ $totalFleet }} unit armada milik sendiri.
            @endif
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-8 py-14 space-y-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <!-- Main Equipment & Fleet Specs -->
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white rounded-3xl p-8 border-2 border-neutral-200 shadow-sm space-y-6">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                    <h2 class="text-2xl font-black text-black">Daftar Armada Resmi (Equipment Fleet)</h2>
                    <span class="inline-block text-xs font-black bg-[#FECE00] text-black px-3 py-1 rounded-full">
                        Total: {{ $totalFleet }} Units
                    </span>
                </div>
                <p class="text-sm text-neutral-600 leading-relaxed">
                    Zimmoah memiliki armada trailer head, chassis 20ft/40ft, truk 25T/8T/5T, forklift, dan van operasional sendiri untuk menjamin ketersediaan unit tepat waktu (<em>on-time dispatch</em>) di seluruh koridor industri Jawa &amp; Bali.
                </p>

                <!-- HD Inland Trucking Fleet Visual -->
                <div class="rounded-2xl overflow-hidden border border-neutral-200 bg-neutral-50">
                    <img src="{{ asset('images/services/trucking.jpg') }}" alt="Zimmoah Inland Container Trucking Fleet"
                         class="w-full h-auto object-cover">
                </div>

                <!-- Official Equipment Table from zimmoah.com/trucking.php -->
                <div class="overflow-x-auto rounded-2xl border border-neutral-200">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-black text-[#FECE00] uppercase tracking-wider font-black">
                            <tr>
                                <th class="px-5 py-3.5">Equipment</th>
                                <th class="px-5 py-3.5">Quantity</th>
                                <th class="px-5 py-3.5">Remarks</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-neutral-100 text-neutral-800">
                            @foreach ($fleet as $item)
                                <tr class="hover:bg-[#FFFBE6] transition">
                                    <td class="px-5 py-3.5 font-black text-black">{{ $item['equipment'] }}</td>
                                    <td class="px-5 py-3.5">
                                        <span class="inline-block bg-[#FECE00]/40 text-black font-black px-2.5 py-0.5 rounded-md">{{ $item['quantity'] }}</span>
                                    </td>
                                    <td class="px-5 py-3.5 text-neutral-600 font-medium">{{ $item['remarks'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="pt-4 border-t border-neutral-100 flex items-center justify-between">
                    <a href="{{ route('tickets.create') }}" class="bg-black hover:bg-[#FECE00] text-[#FECE00] hover:text-black font-black text-xs px-6 py-3 rounded-full transition shadow-md">
                        Pesan Armada Trucking &rarr;
                    </a>
                </div>
            </div>
        </div>

        <!-- Sidebar Dispatch Info -->
        <div class="space-y-6">
            <div class="bg-white rounded-3xl p-6 border-2 border-neutral-200 shadow-sm space-y-4">
                <h3 class="text-sm font-black text-black uppercase tracking-wider border-b-2 border-[#FECE00] pb-2">Kontak Dispatch Armada</h3>
                <div class="text-xs text-neutral-700 space-y-3">
                    <p><strong>Pusat Koordinasi (Jakarta HQ):</strong><br>+(62-21) 2937 5670 (Hunting)</p>
                    <p><strong>Operasional Jawa Tengah (Semarang):</strong><br>+(62-24) 7643 4641 / 7643 4861</p>
                    <p><strong>Line Network Logistics (Affiliate):</strong><br>+62-21-2105-6359</p>
                </div>
            </div>

            <div class="bg-[#FFFBE6] rounded-3xl p-6 border-2 border-[#FECE00]/70 space-y-3">
                <h3 class="text-sm font-black text-black uppercase tracking-wider">3 Hub Utama Jawa</h3>
                <ul class="space-y-2 text-xs font-semibold text-neutral-800">
                    <li>&bull; <strong>Hub Jakarta</strong> &mdash; 500 km / 14h ke Semarang</li>
                    <li>&bull; <strong>Hub Semarang</strong> &mdash; Koridor Jawa Tengah &amp; DIY</li>
                    <li>&bull; <strong>Hub Surabaya</strong> &mdash; 800 km / 22h ke Jakarta &amp; akses Bali</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Official Java-Bali Service Route Map from zimmoah.com/trucking.php -->
    <div class="bg-white rounded-3xl p-6 sm:p-10 border-2 border-neutral-200 shadow-sm space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-neutral-100 pb-4">
            <div>
                <span class="inline-block text-[10px] font-black uppercase bg-black text-[#FECE00] px-3 py-1 rounded-full mb-1.5">
                    Service Route Map
                </span>
                <h2 class="text-2xl font-black text-black">Peta Rute Trucking Jawa &amp; Bali (30 Kota)</h2>
                <p class="text-xs text-neutral-500 mt-0.5">Point-to-point dedicated trucking services throughout continental Java to Denpasar, Bali.</p>
            </div>
            <a href="{{ asset('zimmoah-assets/images/trucking/map-1.jpg') }}" target="_blank"
               class="px-4 py-2 rounded-full text-xs font-black bg-[#FECE00] hover:bg-black text-black hover:text-[#FECE00] transition">
                Lihat Peta Ukuran Penuh &nearr;
            </a>
        </div>
        <div class="rounded-2xl overflow-hidden border border-neutral-200 bg-neutral-50 p-3 flex justify-center">
            <img src="{{ asset('zimmoah-assets/images/trucking/map-1.jpg') }}" alt="Zimmoah Java Bali Trucking Route Map"
                 class="max-w-full h-auto rounded-xl">
        </div>
    </div>

    <!-- Official 30-City Distance & Transit Time Table (Searchable) -->
    <div class="bg-white rounded-3xl border-2 border-neutral-200 shadow-sm overflow-hidden">
        <div class="p-6 sm:p-8 bg-[#FFFBE6] border-b border-neutral-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-black text-black">Estimasi Jarak &amp; Waktu Tempuh (30 Kota)</h2>
                <p class="text-xs text-neutral-600 mt-1">Data rute resmi pengiriman darat Zimmoah dari Cilegon hingga Denpasar.</p>
            </div>
            <input type="text" id="routeSearch" oninput="filterTruckingRoutes()"
                   placeholder="Cari kota (misal: Bandung, Semarang, Denpasar)..."
                   class="px-4 py-2.5 bg-white border-2 border-neutral-300 rounded-xl text-xs font-semibold text-black focus:outline-none focus:border-black w-full sm:w-72">
        </div>

        <div class="p-6 sm:p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3" id="routeGrid">
                @foreach ($truckingRoutes as $route)
                    <div class="route-card flex items-center justify-between p-4 rounded-2xl border transition {{ $route['hub'] ? 'bg-[#FECE00]/25 border-black shadow-xs' : 'bg-neutral-50 border-neutral-200 hover:border-[#FECE00]' }}"
                         data-city="{{ strtolower($route['city'] . ' ' . $route['distance']) }}">
                        <div class="flex items-center gap-3">
                            <span class="w-7 h-7 rounded-full flex items-center justify-center text-[11px] font-black {{ $route['hub'] ? 'bg-black text-[#FECE00]' : 'bg-white border border-neutral-300 text-neutral-700' }}">
                                {{ $route['no'] }}
                            </span>
                            <div>
                                <div class="text-sm font-black text-black flex items-center gap-1.5">
                                    {{ $route['city'] }}
                                    @if ($route['hub'])
                                        <span class="text-[9px] uppercase bg-black text-[#FECE00] px-1.5 py-0.5 rounded">HUB</span>
                                    @endif
                                </div>
                                <div class="text-[11px] text-neutral-600 font-medium">{{ $route['distance'] }}</div>
                            </div>
                        </div>
                        <span class="text-xs font-black px-2.5 py-1 rounded-lg bg-white border border-neutral-200 text-black font-mono">
                            {{ $route['time'] }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
    function filterTruckingRoutes() {
        const q = (document.getElementById('routeSearch')?.value || '').trim().toLowerCase();
        document.querySelectorAll('.route-card').forEach(card => {
            card.classList.toggle('hidden', q !== '' && !card.dataset.city.includes(q));
        });
    }
</script>
@endsection

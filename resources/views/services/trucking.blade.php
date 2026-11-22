@extends('layouts.app')

@section('content')
<div class="bg-[#FECE00] text-black py-16 px-4 sm:px-8 border-b-2 border-black/15">
    <div class="max-w-7xl mx-auto space-y-4">
        <span class="inline-block text-xs uppercase tracking-widest font-black text-[#FECE00] bg-black px-3.5 py-1 rounded-full">
            Inland Ground Transport
        </span>
        <h1 class="text-3xl sm:text-5xl font-black tracking-tight text-black">Inland Fleet & Container Trucking</h1>
        <p class="text-neutral-900 font-medium max-w-2xl text-sm sm:text-base leading-relaxed">
            Armada truk trailer dan mobil boks terjadwal dengan pemantauan GPS real-time untuk distribusi logistik lintas pulau Jawa, Sumatera, dan Bali.
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-8 py-14 grid grid-cols-1 lg:grid-cols-3 gap-10">
    <div class="lg:col-span-2 space-y-8">
        <div class="bg-white rounded-3xl p-8 border-2 border-neutral-200 shadow-sm space-y-6">
            <h2 class="text-2xl font-black text-black">Armada Darat Handal & Bergaransi</h2>
            <p class="text-sm text-neutral-600 leading-relaxed">
                Zimmoah mengoperasikan armada mandiri untuk menjamin ketersediaan unit tepat waktu (on-time dispatch). Pengemudi profesional kami terlatih dalam standar K3 keselamatan berkendara dan penanganan kargo pabrik bernilai tinggi.
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-4">
                <div class="bg-[#FFFBE6] p-5 rounded-2xl border border-[#FECE00]/60 space-y-2">
                    <h3 class="text-base font-black text-black">Trailer Kontainer</h3>
                    <p class="text-xs text-neutral-700 leading-relaxed">
                        &bull; Head Truck 6x4 & 6x2 heavy duty<br>
                        &bull; Chassis 20ft & 40ft (Skeleton & Flatbed)<br>
                        &bull; Rute depo Priok, Tanjung Emas Semarang, & Perak Surabaya
                    </p>
                </div>

                <div class="bg-[#FFFBE6] p-5 rounded-2xl border border-[#FECE00]/60 space-y-2">
                    <h3 class="text-base font-black text-black">Wingbox & Boks Tertutup</h3>
                    <p class="text-xs text-neutral-700 leading-relaxed">
                        &bull; Tronton Wingbox kapasitas 45 CBM / 25 Ton<br>
                        &bull; CDD (Colt Diesel Double) Long Chassis<br>
                        &bull; Segel keamanan e-lock & pemantauan suhu
                    </p>
                </div>
            </div>

            <div class="pt-4 border-t border-neutral-100 flex items-center justify-between">
                <a href="{{ route('tickets.create') }}" class="bg-black hover:bg-neutral-800 text-[#FECE00] font-black text-xs px-6 py-3 rounded-full transition shadow-md">
                    Pesan Armada Trucking &rarr;
                </a>
            </div>
        </div>
    </div>

    <div class="space-y-6">
        <div class="bg-white rounded-3xl p-6 border-2 border-neutral-200 shadow-sm space-y-4">
            <h3 class="text-sm font-black text-black uppercase tracking-wider border-b-2 border-[#FECE00] pb-2">Kontak Dispatch Armada</h3>
            <div class="text-xs text-neutral-700 space-y-2">
                <p><strong>Operasional Trucking:</strong> +62-24 7643 4641 (Semarang Office)</p>
                <p><strong>Pusat Koordinasi:</strong> +62-21 2937 5570 (Jakarta Head Office)</p>
            </div>
        </div>
    </div>
</div>
@endsection

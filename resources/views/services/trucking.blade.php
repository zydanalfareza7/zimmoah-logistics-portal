@extends('layouts.app')

@section('content')
<div class="bg-[#0B1522] text-white py-16 px-4 sm:px-8 border-b border-slate-800">
    <div class="max-w-7xl mx-auto space-y-4">
        <span class="text-xs uppercase tracking-widest font-extrabold text-[#00A3E0] bg-[#00A3E0]/20 px-3 py-1 rounded-full">
            Inland Ground Transport
        </span>
        <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight">Inland Fleet & Container Trucking</h1>
        <p class="text-slate-300 max-w-2xl text-sm sm:text-base leading-relaxed">
            Armada truk trailer dan mobil boks terjadwal dengan pemantauan GPS real-time untuk distribusi logistik lintas pulau Jawa, Sumatera, dan Bali.
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-8 py-14 grid grid-cols-1 lg:grid-cols-3 gap-10">
    <div class="lg:col-span-2 space-y-8">
        <div class="bg-white rounded-3xl p-8 border border-slate-200/80 shadow-sm space-y-6">
            <h2 class="text-2xl font-bold text-slate-900">Armada Darat Handal & Bergaransi</h2>
            <p class="text-sm text-slate-600 leading-relaxed">
                Zimmoah mengoperasikan armada mandiri untuk menjamin ketersediaan unit tepat waktu (*on-time dispatch*). Pengemudi profesional kami terlatih dalam standar K3 keselamatan berkendara dan penanganan kargo pabrik bernilai tinggi.
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-4">
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/60 space-y-2">
                    <h3 class="text-base font-bold text-slate-900">Trailer Kontainer</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        &bull; Head Truck 6x4 & 6x2 heavy duty<br>
                        &bull; Chassis 20ft & 40ft (Skeleton & Flatbed)<br>
                        &bull; Rute depo Priok, Tanjung Emas Semarang, & Perak Surabaya
                    </p>
                </div>

                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200/60 space-y-2">
                    <h3 class="text-base font-bold text-slate-900">Wingbox & Boks Tertutup</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        &bull; Tronton Wingbox kapasitas 45 CBM / 25 Ton<br>
                        &bull; CDD (Colt Diesel Double) Long Chassis<br>
                        &bull; Segel keamanan e-lock & pemantauan suhu
                    </p>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                <a href="{{ route('tickets.create') }}" class="bg-[#00A3E0] hover:bg-[#008CC2] text-white font-bold text-xs px-6 py-3 rounded-full transition shadow-md">
                    Pesan Armada Trucking &rarr;
                </a>
            </div>
        </div>
    </div>

    <div class="space-y-6">
        <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-sm space-y-4">
            <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider border-b border-slate-100 pb-2">Kontak Dispatch Armada</h3>
            <div class="text-xs text-slate-600 space-y-2">
                <p><strong>Operasional Trucking:</strong> +62-24 7643 4641 (Semarang Office)</p>
                <p><strong>Pusat Koordinasi:</strong> +62-21 2937 5570 (Jakarta Head Office)</p>
            </div>
        </div>
    </div>
</div>
@endsection

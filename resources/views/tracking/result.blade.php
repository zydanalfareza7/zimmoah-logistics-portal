@extends('layouts.app')

@section('content')
<div class="bg-[#0B131F] text-white py-14 px-4 sm:px-8 border-b border-slate-800">
    <div class="max-w-4xl mx-auto space-y-2">
        <span class="text-xs uppercase tracking-widest font-black text-slate-950 bg-[#FECE00] px-3.5 py-1 rounded-full">
            Hasil Pelacakan Kargo
        </span>
        <h1 class="text-2xl sm:text-3xl font-black tracking-tight">Status Pelacakan: <span class="text-[#FECE00] font-mono">{{ $query }}</span></h1>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 sm:px-8 py-12">
    @if ($schedule)
    <!-- Schedule / Vessel match -->
    <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-lg space-y-6">
        <div class="flex items-center justify-between border-b border-slate-100 pb-4">
            <div>
                <span class="text-xs uppercase tracking-wider font-black text-amber-700">Voyage Terjadwal</span>
                <h2 class="text-xl font-bold text-slate-900 mt-0.5">{{ $schedule->carrier_vessel_name }} ({{ $schedule->voyage_number }})</h2>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-black bg-emerald-100 text-emerald-800 border border-emerald-300">
                {{ $schedule->status }}
            </span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 text-xs">
            <div>
                <span class="text-slate-400 font-bold block mb-1">Rute:</span>
                <strong class="text-slate-900 text-sm block">{{ $schedule->origin_port }}</strong>
                <span class="text-amber-600 font-bold">&darr; {{ $schedule->destination_port }}</span>
            </div>
            <div>
                <span class="text-slate-400 font-bold block mb-1">Waktu Keberangkatan (ETD):</span>
                <strong class="text-slate-900 text-sm block">{{ $schedule->departure_time->format('d M Y, H:i') }} WIB</strong>
            </div>
            <div>
                <span class="text-slate-400 font-bold block mb-1">Waktu Kedatangan (ETA):</span>
                <strong class="text-slate-900 text-sm block">{{ $schedule->arrival_time->format('d M Y, H:i') }}</strong>
                <span class="text-slate-500 block text-[11px] mt-0.5">{{ $schedule->duration }}</span>
            </div>
        </div>

        <!-- Tracking Visual Milestone -->
        <div class="pt-6 border-t border-slate-100">
            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider block mb-4">Milestone Pergerakan Kargo</span>
            <div class="grid grid-cols-4 gap-2 text-center text-[11px]">
                <div class="p-3 bg-emerald-50 text-emerald-800 rounded-xl border border-emerald-200 font-bold">
                    1. Booking Confirmed
                </div>
                <div class="p-3 bg-emerald-50 text-emerald-800 rounded-xl border border-emerald-200 font-bold">
                    2. Gate In Pelabuhan
                </div>
                <div class="p-3 bg-amber-50 text-amber-900 rounded-xl border border-amber-300 font-bold">
                    3. In-Transit (Berlayar)
                </div>
                <div class="p-3 bg-slate-50 text-slate-400 rounded-xl border border-slate-200 font-medium">
                    4. Arrived Destination
                </div>
            </div>
        </div>
    </div>
    @else
    <!-- Not Found -->
    <div class="bg-white rounded-3xl p-10 text-center border border-slate-200 shadow-md space-y-4">
        <div class="w-16 h-16 bg-slate-100 text-slate-400 rounded-full flex items-center justify-center mx-auto">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <h2 class="text-xl font-bold text-slate-900">Nomor Pelacakan Tidak Ditemukan</h2>
        <p class="text-xs text-slate-500 max-w-md mx-auto">
            Nomor referensi <strong class="text-slate-800">{{ $query }}</strong> belum terdaftar pada sistem kargo aktif. Pastikan format nomor AWB, kontainer, atau kode tiket sudah sesuai.
        </p>
        <div class="pt-2 flex justify-center gap-3">
            <a href="{{ route('home') }}" class="bg-[#FECE00] hover:bg-[#E5B800] text-slate-950 font-black text-xs px-6 py-2.5 rounded-full transition shadow-sm">
                Cari Kembali
            </a>
            <a href="{{ route('tickets.create') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-800 font-bold text-xs px-6 py-2.5 rounded-full transition">
                Tanyakan ke Tim Support &rarr;
            </a>
        </div>
    </div>
    @endif
</div>
@endsection

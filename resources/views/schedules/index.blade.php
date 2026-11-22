@extends('layouts.app')

@section('content')
<div class="bg-[#FECE00] text-black py-14 px-4 sm:px-8 border-b-2 border-black/15">
    <div class="max-w-7xl mx-auto space-y-3">
        <span class="inline-block text-xs uppercase tracking-widest font-black text-[#FECE00] bg-black px-3.5 py-1 rounded-full">
            Shipping Schedules
        </span>
        <h1 class="text-3xl sm:text-4xl font-black tracking-tight text-black">Jadwal Keberangkatan Kapal & Kargo Udara</h1>
        <p class="text-neutral-900 text-sm font-medium max-w-2xl leading-relaxed">
            Periksa jadwal pelayaran mingguan dari pelabuhan utama di Indonesia (Tanjung Priok, Tanjung Emas, Bandara Soekarno-Hatta) menuju hub global Asia-Pasifik.
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-8 py-10 space-y-8">
    <!-- Filter Search -->
    <div class="bg-white rounded-3xl p-6 border border-slate-200/90 shadow-sm">
        <form action="{{ route('schedules.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-4 gap-4 text-xs">
            <div>
                <label class="block font-bold text-slate-500 uppercase tracking-wider mb-1">Pelabuhan Asal</label>
                <input type="text" name="origin" value="{{ $origin }}" placeholder="Contoh: Jakarta / Priok" 
                    class="w-full px-3 py-2.5 border border-slate-300 rounded-xl focus:outline-none focus:border-[#FECE00]">
            </div>

            <div>
                <label class="block font-bold text-slate-500 uppercase tracking-wider mb-1">Pelabuhan Tujuan</label>
                <input type="text" name="destination" value="{{ $destination }}" placeholder="Contoh: Busan / Incheon" 
                    class="w-full px-3 py-2.5 border border-slate-300 rounded-xl focus:outline-none focus:border-[#FECE00]">
            </div>

            <div>
                <label class="block font-bold text-slate-500 uppercase tracking-wider mb-1">Moda Transportasi</label>
                <select name="mode" class="w-full px-3 py-2.5 border border-slate-300 rounded-xl font-semibold text-slate-800 focus:outline-none focus:border-[#FECE00]">
                    <option value="">Semua Moda</option>
                    <option value="SEA" {{ $mode === 'SEA' ? 'selected' : '' }}>Laut (Ocean Freight - FCL/LCL)</option>
                    <option value="AIR" {{ $mode === 'AIR' ? 'selected' : '' }}>Udara (Air Freight)</option>
                </select>
            </div>

            <div class="pt-0 sm:pt-5 flex items-center gap-2">
                <button type="submit" class="w-full bg-[#FECE00] hover:bg-[#E5B800] text-slate-950 font-black text-xs py-3 rounded-xl transition shadow-sm">
                    Cari Jadwal
                </button>
                @if ($origin || $destination || $mode)
                    <a href="{{ route('schedules.index') }}" class="p-2.5 text-slate-400 hover:text-slate-600 border border-slate-200 rounded-xl" title="Reset">
                        &times;
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Schedules Table -->
    <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 border-b border-slate-200 text-slate-600 uppercase tracking-wider font-black">
                    <tr>
                        <th class="px-6 py-4">Moda & Carrier / Vessel</th>
                        <th class="px-6 py-4">Rute Pelayaran</th>
                        <th class="px-6 py-4">Keberangkatan (ETD)</th>
                        <th class="px-6 py-4">Kedatangan (ETA)</th>
                        <th class="px-6 py-4">Transit Time</th>
                        <th class="px-6 py-4">Cut-Off Dokumen</th>
                        <th class="px-6 py-4 text-right">Booking Space</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700 font-medium">
                    @forelse ($schedules as $item)
                    <tr class="hover:bg-amber-50/40 transition">
                        <td class="px-6 py-4">
                            <span class="inline-block px-2 py-0.5 rounded text-[10px] font-black {{ $item->transport_mode === 'SEA' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }} mb-1">
                                {{ $item->transport_mode === 'SEA' ? 'Ocean Freight' : 'Air Cargo' }}
                            </span>
                            <div class="font-bold text-slate-900 text-sm">{{ $item->carrier_vessel_name }}</div>
                            <span class="text-[11px] text-slate-400">{{ $item->voyage_number ?? 'Voyage Reguler' }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-bold text-slate-900">{{ $item->origin_port }}</div>
                            <div class="text-[11px] text-amber-600 font-black">&darr; {{ $item->destination_port }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <strong class="text-slate-900 block">{{ $item->departure_time->format('d M Y, H:i') }}</strong>
                            <span class="text-[10px] text-slate-400">WIB</span>
                        </td>
                        <td class="px-6 py-4">
                            <strong class="text-slate-900 block">{{ $item->arrival_time->format('d M Y, H:i') }}</strong>
                            <span class="text-[10px] text-slate-400">Waktu Lokal</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="bg-slate-100 text-slate-700 font-bold px-2 py-1 rounded-md text-[11px]">
                                {{ $item->duration }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-amber-700 font-bold">
                            {{ $item->cut_off_time ? $item->cut_off_time->format('d M Y, H:i') : '-' }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('tickets.create') }}" class="inline-block bg-[#FECE00] hover:bg-[#E5B800] text-slate-950 font-black text-xs px-4 py-2 rounded-xl transition shadow-sm">
                                Booking Inquiry &rarr;
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-slate-400">
                            Tidak ada jadwal yang cocok dengan rute pencarian Anda.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-slate-100">
            {{ $schedules->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection

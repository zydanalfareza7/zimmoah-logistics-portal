@extends('layouts.app')

@section('content')
<div class="bg-[#0B1522] text-white py-16 px-4 sm:px-8 border-b border-slate-800">
    <div class="max-w-7xl mx-auto space-y-4">
        <span class="text-xs uppercase tracking-widest font-extrabold text-[#00A3E0] bg-[#00A3E0]/20 px-3 py-1 rounded-full">
            Hubungi Kami
        </span>
        <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight">Kontak Kantor & Layanan Bantuan</h1>
        <p class="text-slate-300 max-w-2xl text-sm sm:text-base leading-relaxed">
            Tim representatif kami siap melayani kebutuhan pengiriman kargo, jadwal kapal, dan konsultasi kepabeanan di 3 kantor cabang utama.
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-8 py-14 grid grid-cols-1 md:grid-cols-3 gap-8">
    @foreach ($offices as $office)
    <div class="bg-white rounded-3xl border border-slate-200/80 p-8 shadow-sm flex flex-col justify-between space-y-6">
        <div class="space-y-4">
            <span class="text-xs font-bold px-3 py-1 rounded-full {{ $office->is_headquarters ? 'bg-[#00A3E0]/20 text-[#00A3E0]' : 'bg-slate-100 text-slate-700' }}">
                {{ $office->code }} {{ $office->is_headquarters ? '(Pusat)' : '' }}
            </span>
            <h2 class="text-xl font-bold text-slate-900">{{ $office->name }}</h2>
            <p class="text-xs text-slate-600 leading-relaxed">{{ $office->address }}</p>

            <div class="pt-4 border-t border-slate-100 text-xs space-y-2 text-slate-700">
                <p><strong>Telepon Hunting:</strong> {{ $office->phone }}</p>
                @if ($office->fax)
                    <p><strong>Fax:</strong> {{ $office->fax }}</p>
                @endif
                <p><strong>Email:</strong> <span class="text-[#00A3E0] font-semibold">{{ $office->email }}</span></p>
            </div>
        </div>

        <div>
            <a href="{{ route('tickets.create') }}" class="w-full text-center block bg-slate-900 hover:bg-[#00A3E0] text-white font-bold text-xs py-3 rounded-xl transition shadow-md">
                Kirim Pesan ke Cabang Ini &rarr;
            </a>
        </div>
    </div>
    @endforeach
</div>
@endsection

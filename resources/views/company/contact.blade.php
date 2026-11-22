@extends('layouts.app')

@section('content')
<div class="bg-[#FECE00] text-black py-16 px-4 sm:px-8 border-b-2 border-black/15">
    <div class="max-w-7xl mx-auto space-y-4">
        <span class="inline-block text-xs uppercase tracking-widest font-black text-[#FECE00] bg-black px-3.5 py-1 rounded-full">
            Hubungi Kami
        </span>
        <h1 class="text-3xl sm:text-5xl font-black tracking-tight text-black">Kontak Kantor & Layanan Bantuan</h1>
        <p class="text-neutral-900 font-medium max-w-2xl text-sm sm:text-base leading-relaxed">
            Tim representatif kami siap melayani kebutuhan pengiriman kargo, jadwal kapal, dan konsultasi kepabeanan di 3 kantor cabang utama.
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-8 py-14 grid grid-cols-1 md:grid-cols-3 gap-8">
    @foreach ($offices as $office)
    <div class="bg-white rounded-3xl border-2 border-neutral-200 hover:border-[#FECE00] p-8 shadow-sm hover:shadow-xl transition flex flex-col justify-between space-y-6">
        <div class="space-y-4">
            <span class="inline-block text-xs font-black px-3 py-1 rounded-full {{ $office->is_headquarters ? 'bg-[#FECE00] text-black' : 'bg-neutral-100 text-neutral-800' }}">
                {{ $office->code }} {{ $office->is_headquarters ? '(Pusat)' : '' }}
            </span>
            <h2 class="text-xl font-black text-black">{{ $office->name }}</h2>
            <p class="text-xs text-neutral-600 leading-relaxed">{{ $office->address }}</p>

            <div class="pt-4 border-t border-neutral-100 text-xs space-y-2 text-neutral-800">
                <p><strong>Telepon Hunting:</strong> {{ $office->phone }}</p>
                @if ($office->fax)
                    <p><strong>Fax:</strong> {{ $office->fax }}</p>
                @endif
                <p><strong>Email:</strong> <span class="text-black font-black underline decoration-[#FECE00] decoration-2">{{ $office->email }}</span></p>
            </div>
        </div>

        <div>
            <a href="{{ route('tickets.create') }}" class="w-full text-center block bg-black hover:bg-[#FECE00] text-[#FECE00] hover:text-black font-black text-xs py-3 rounded-xl transition shadow-md">
                Kirim Pesan ke Cabang Ini &rarr;
            </a>
        </div>
    </div>
    @endforeach
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto px-4 py-20">
    <div class="bg-white rounded-3xl p-8 shadow-xl border border-slate-200 space-y-6">
        <div class="text-center space-y-2">
            <h1 class="text-xl font-bold text-slate-900">Verifikasi Kepemilikan Tiket</h1>
            <p class="text-xs text-slate-500">Demi keamanan privasi data kargo, masukkan email yang didaftarkan pada tiket <strong class="text-slate-900">{{ $code }}</strong>.</p>
        </div>

        <form action="{{ route('tickets.track') }}" method="GET" class="space-y-4">
            <input type="hidden" name="code" value="{{ $code }}">

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Email Pembuat Tiket *</label>
                <input type="email" name="email" placeholder="email@perusahaan.com" required autofocus
                    class="w-full px-4 py-3 border-2 border-neutral-300 rounded-xl text-sm focus:outline-none focus:border-black">
            </div>

            <button type="submit" class="w-full bg-black hover:bg-neutral-800 text-[#FECE00] font-black text-sm py-3.5 rounded-xl transition shadow-md">
                Konfirmasi & Buka Tiket
            </button>
        </form>
    </div>
</div>
@endsection

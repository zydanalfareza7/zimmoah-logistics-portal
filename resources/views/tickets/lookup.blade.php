@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto px-4 py-20">
    <div class="bg-white rounded-3xl p-8 sm:p-10 shadow-xl border border-slate-200 space-y-6">
        <div class="text-center space-y-2">
            <div class="w-12 h-12 bg-[#00A3E0]/10 text-[#00A3E0] rounded-2xl flex items-center justify-center mx-auto">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
            <h1 class="text-2xl font-extrabold text-slate-900">Lacak Status Tiket Anda</h1>
            <p class="text-xs text-slate-500">Masukkan kode referensi tiket dan alamat email yang Anda gunakan saat mengajukan tiket.</p>
        </div>

        <form action="{{ route('tickets.track') }}" method="GET" class="space-y-4">
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Nomor Tiket *</label>
                <input type="text" name="code" placeholder="Contoh: ZIM-2026-9042" required
                    class="w-full px-4 py-3 border border-slate-300 rounded-xl text-sm font-semibold uppercase focus:outline-none focus:border-[#00A3E0]">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Alamat Email Terdaftar *</label>
                <input type="email" name="email" placeholder="email@perusahaan.co.id" required
                    class="w-full px-4 py-3 border border-slate-300 rounded-xl text-sm focus:outline-none focus:border-[#00A3E0]">
            </div>

            <button type="submit" class="w-full bg-[#00A3E0] hover:bg-[#008CC2] text-white font-bold text-sm py-3.5 rounded-xl shadow-md transition">
                Buka Riwayat Percakapan Tiket
            </button>
        </form>

        <div class="text-center pt-2">
            <a href="{{ route('tickets.create') }}" class="text-xs text-slate-500 hover:text-[#00A3E0] font-semibold">Belum punya tiket? Ajukan tiket baru &rarr;</a>
        </div>
    </div>
</div>
@endsection

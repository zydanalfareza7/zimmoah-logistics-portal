@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-20 text-center">
    <div class="bg-white rounded-3xl p-10 shadow-xl border border-slate-200 space-y-6">
        <div class="w-16 h-16 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        </div>

        <h1 class="text-3xl font-extrabold text-slate-900">Lamaran Berhasil Terkirim!</h1>
        <p class="text-sm text-slate-600 leading-relaxed">
            Terima kasih telah melamar posisi <strong class="text-slate-900">{{ $job->title }}</strong> di Zimmoah Global Logistics. Berkas resume dan profil Anda telah diterima oleh tim HRD.
        </p>

        <div class="bg-slate-50 p-4 rounded-2xl text-xs text-slate-500 text-left border border-slate-200/80 space-y-1">
            <p><strong>Langkah Selanjutnya:</strong></p>
            <p>&bull; Tim rekrutmen kami akan melakukan screening berkas dalam 3–7 hari kerja.</p>
            <p>&bull; Kandidat yang memenuhi kualifikasi akan dihubungi melalui email atau nomor WhatsApp untuk tahapan interview.</p>
        </div>

        <div class="pt-4 flex justify-center gap-4">
            <a href="{{ route('career.index') }}" class="bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs px-6 py-3 rounded-full transition">
                Kembali ke Daftar Karir
            </a>
            <a href="{{ route('home') }}" class="border border-slate-300 hover:bg-slate-100 text-slate-800 font-bold text-xs px-6 py-3 rounded-full transition">
                Ke Halaman Utama
            </a>
        </div>
    </div>
</div>
@endsection

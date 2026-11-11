@extends('layouts.app')

@section('content')
<!-- Career Hero Header -->
<div class="bg-[#0B1522] text-white py-16 px-4 sm:px-8 border-b border-slate-800">
    <div class="max-w-7xl mx-auto space-y-4">
        <span class="text-xs uppercase tracking-widest font-extrabold text-[#00A3E0] bg-[#00A3E0]/20 px-3 py-1 rounded-full">
            Karir & Budaya Kerja
        </span>
        <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight">Tumbuh Bersama Zimmoah Global Logistics</h1>
        <p class="text-slate-300 max-w-2xl text-sm sm:text-base leading-relaxed">
            Bergabunglah dengan tim profesional rantai pasok global kami. Kembangkan keahlian Anda di lingkungan kerja multinasional yang kolaboratif dan inovatif.
        </p>
    </div>
</div>

<!-- Filters & Job Board -->
<div class="max-w-7xl mx-auto px-4 sm:px-8 py-12">
    <!-- Filter Box -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200/80 mb-10">
        <form action="{{ route('career.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-4 gap-4">
            <!-- Filter Departemen -->
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Departemen</label>
                <select name="department" class="w-full px-3 py-2.5 border border-slate-300 rounded-xl text-xs font-semibold text-slate-800 focus:outline-none focus:border-[#00A3E0]">
                    <option value="">Semua Departemen</option>
                    @foreach ($departments as $dept)
                        <option value="{{ $dept }}" {{ $department === $dept ? 'selected' : '' }}>{{ $dept }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Filter Lokasi Kantor -->
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Kantor Cabang</label>
                <select name="office_id" class="w-full px-3 py-2.5 border border-slate-300 rounded-xl text-xs font-semibold text-slate-800 focus:outline-none focus:border-[#00A3E0]">
                    <option value="">Semua Kantor</option>
                    @foreach ($offices as $off)
                        <option value="{{ $off->id }}" {{ $officeId == $off->id ? 'selected' : '' }}>{{ $off->name }} ({{ $off->city }})</option>
                    @endforeach
                </select>
            </div>

            <!-- Filter Tipe Kontrak -->
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Tipe Kerja</label>
                <select name="type" class="w-full px-3 py-2.5 border border-slate-300 rounded-xl text-xs font-semibold text-slate-800 focus:outline-none focus:border-[#00A3E0]">
                    <option value="">Semua Tipe</option>
                    <option value="FULL_TIME" {{ $type === 'FULL_TIME' ? 'selected' : '' }}>Purna Waktu (Full-Time)</option>
                    <option value="CONTRACT" {{ $type === 'CONTRACT' ? 'selected' : '' }}>Kontrak</option>
                    <option value="INTERNSHIP" {{ $type === 'INTERNSHIP' ? 'selected' : '' }}>Magang (Internship)</option>
                </select>
            </div>

            <!-- Submit Button -->
            <div class="pt-0 sm:pt-5">
                <button type="submit" class="w-full bg-[#00A3E0] hover:bg-[#008CC2] text-white font-bold text-xs py-3 rounded-xl transition shadow-sm">
                    Terapkan Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Jobs Grid -->
    <div class="space-y-4">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-extrabold text-slate-900">Lowongan Kerja Terbuka ({{ $jobs->total() }})</h2>
            <span class="text-xs text-slate-500">Menampilkan posisi aktif</span>
        </div>

        @if ($jobs->isEmpty())
            <div class="bg-white rounded-2xl p-12 text-center border border-slate-200">
                <p class="text-slate-500 text-sm">Tidak ada posisi yang cocok dengan kriteria filter saat ini.</p>
                <a href="{{ route('career.index') }}" class="mt-3 inline-block text-xs font-bold text-[#00A3E0] hover:underline">Reset Filter &rarr;</a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($jobs as $job)
                <div class="bg-white rounded-2xl border border-slate-200/80 p-6 shadow-sm hover:shadow-xl hover:border-[#00A3E0] transition-all flex flex-col justify-between">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-[10px] font-extrabold uppercase px-2.5 py-1 rounded-full bg-slate-100 text-slate-700">
                                {{ $job->department }}
                            </span>
                            <span class="text-[10px] font-bold text-slate-500">
                                {{ $job->office->city }}
                            </span>
                        </div>

                        <h3 class="text-base font-bold text-slate-900 hover:text-[#00A3E0] transition leading-snug">
                            <a href="{{ route('career.show', $job->slug) }}">{{ $job->title }}</a>
                        </h3>

                        <p class="text-xs text-slate-500 line-clamp-3 leading-relaxed">
                            {{ $job->description }}
                        </p>

                        <div class="pt-2 text-[11px] text-slate-600 space-y-1">
                            <p><strong>Tipe:</strong> {{ $job->employment_type_label }}</p>
                            @if ($job->salary_range)
                                <p><strong>Estimasi Gaji:</strong> {{ $job->salary_range }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="pt-6">
                        <a href="{{ route('career.show', $job->slug) }}" class="w-full text-center block bg-slate-900 hover:bg-[#00A3E0] text-white font-bold text-xs py-2.5 rounded-xl transition shadow-sm">
                            Lihat Detail & Lamar &rarr;
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="pt-8">
                {{ $jobs->withQueryString()->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

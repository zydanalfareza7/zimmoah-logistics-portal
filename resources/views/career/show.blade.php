@extends('layouts.app')

@section('content')
<div class="bg-slate-100 py-10 px-4 sm:px-8 border-b border-slate-200">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
        <div>
            <div class="flex items-center space-x-2 text-xs text-slate-500 mb-2">
                <a href="{{ route('career.index') }}" class="hover:underline">Karir</a>
                <span>&rsaquo;</span>
                <span>{{ $job->department }}</span>
            </div>
            <h1 class="text-2xl sm:text-4xl font-extrabold text-slate-900">{{ $job->title }}</h1>
            <div class="flex flex-wrap items-center gap-3 mt-3 text-xs text-slate-600">
                <span class="bg-white border border-slate-300 px-3 py-1 rounded-full font-semibold">{{ $job->office->name }} ({{ $job->office->city }})</span>
                <span class="bg-white border border-slate-300 px-3 py-1 rounded-full font-semibold">{{ $job->employment_type_label }}</span>
                @if ($job->salary_range)
                    <span class="bg-emerald-50 border border-emerald-300 text-emerald-800 px-3 py-1 rounded-full font-semibold">{{ $job->salary_range }}</span>
                @endif
            </div>
        </div>
        <a href="#apply-section" class="bg-[#00A3E0] hover:bg-[#008CC2] text-white font-bold text-sm px-8 py-3.5 rounded-full shadow-lg transition">
            Lamar Posisi Ini &darr;
        </a>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-8 py-12 grid grid-cols-1 lg:grid-cols-3 gap-10">
    <!-- Main Description -->
    <div class="lg:col-span-2 space-y-10">
        <!-- Overview -->
        <div class="bg-white rounded-2xl p-8 border border-slate-200/80 shadow-sm space-y-6">
            <h2 class="text-xl font-bold text-slate-900 border-b border-slate-100 pb-3">Ringkasan Pekerjaan</h2>
            <p class="text-sm text-slate-600 leading-relaxed">{{ $job->description }}</p>

            <div>
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-2">Tanggung Jawab Utama</h3>
                <div class="text-sm text-slate-600 leading-relaxed whitespace-pre-line bg-slate-50 p-4 rounded-xl border border-slate-200/60">
                    {{ $job->responsibilities }}
                </div>
            </div>

            <div>
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-2">Kualifikasi & Persyaratan</h3>
                <div class="text-sm text-slate-600 leading-relaxed whitespace-pre-line bg-slate-50 p-4 rounded-xl border border-slate-200/60">
                    {{ $job->requirements }}
                </div>
            </div>

            @if ($job->benefits)
            <div>
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-2">Benefit & Fasilitas</h3>
                <div class="text-sm text-slate-600 leading-relaxed whitespace-pre-line bg-emerald-50/50 p-4 rounded-xl border border-emerald-200/60">
                    {{ $job->benefits }}
                </div>
            </div>
            @endif
        </div>

        <!-- Application Form Section -->
        <div id="apply-section" class="bg-white rounded-2xl p-8 border-2 border-[#00A3E0]/40 shadow-xl space-y-6">
            <div class="border-b border-slate-200 pb-4">
                <span class="text-xs uppercase tracking-widest font-extrabold text-[#00A3E0]">Formulir Pendaftaran</span>
                <h2 class="text-2xl font-bold text-slate-900 mt-1">Kirimkan Lamaran Anda</h2>
                <p class="text-xs text-slate-500 mt-1">Seluruh data pelamar dienkripsi dan diproses secara rahasia sesuai kepatuhan UU PDP.</p>
            </div>

            <form action="{{ route('career.apply', $job->slug) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Nama Lengkap *</label>
                        <input type="text" name="full_name" value="{{ old('full_name') }}" required 
                            class="w-full px-4 py-2.5 border border-slate-300 rounded-xl text-sm focus:outline-none focus:border-[#00A3E0]">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Alamat Email *</label>
                        <input type="email" name="email" value="{{ old('email') }}" required 
                            class="w-full px-4 py-2.5 border border-slate-300 rounded-xl text-sm focus:outline-none focus:border-[#00A3E0]">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Nomor WhatsApp / HP *</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" placeholder="+62 8..." required 
                            class="w-full px-4 py-2.5 border border-slate-300 rounded-xl text-sm focus:outline-none focus:border-[#00A3E0]">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Profil LinkedIn (Opsional)</label>
                        <input type="url" name="linkedin_url" value="{{ old('linkedin_url') }}" placeholder="https://linkedin.com/in/..." 
                            class="w-full px-4 py-2.5 border border-slate-300 rounded-xl text-sm focus:outline-none focus:border-[#00A3E0]">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Ekspektasi Gaji Bulanan (IDR)</label>
                        <input type="number" name="expected_salary" value="{{ old('expected_salary') }}" placeholder="Contoh: 8500000" 
                            class="w-full px-4 py-2.5 border border-slate-300 rounded-xl text-sm focus:outline-none focus:border-[#00A3E0]">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Notice Period (Mulai Bekerja)</label>
                        <input type="text" name="notice_period" value="{{ old('notice_period') }}" placeholder="Contoh: Segera / 1 Bulan" 
                            class="w-full px-4 py-2.5 border border-slate-300 rounded-xl text-sm focus:outline-none focus:border-[#00A3E0]">
                    </div>
                </div>

                <!-- Secure Resume Upload -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">
                        Upload CV / Resume (PDF / DOCX, Maksimal 5MB) *
                    </label>
                    <div class="border-2 border-dashed border-slate-300 rounded-xl p-6 text-center hover:border-[#00A3E0] transition bg-slate-50">
                        <input type="file" name="resume" accept=".pdf,.doc,.docx" required class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-[#00A3E0] file:text-white hover:file:bg-[#008CC2] cursor-pointer">
                        <p class="text-[11px] text-slate-400 mt-2">Format yang didukung: PDF, DOCX. Disimpan di private encrypted storage.</p>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Surat Pengantar / Catatan untuk HR (Opsional)</label>
                    <textarea name="cover_letter" rows="3" placeholder="Ceritakan singkat motivasi dan pengalaman relevan Anda..." 
                        class="w-full px-4 py-2.5 border border-slate-300 rounded-xl text-sm focus:outline-none focus:border-[#00A3E0]">{{ old('cover_letter') }}</textarea>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-[#00A3E0] hover:bg-[#008CC2] text-white font-bold text-sm py-4 rounded-xl shadow-lg transition flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Kirim Lamaran Kerja Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Sidebar Info -->
    <div class="space-y-6">
        <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm space-y-4">
            <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider border-b border-slate-100 pb-2">Informasi Penempatan</h3>
            <div class="text-xs text-slate-600 space-y-2">
                <p><strong>Kantor:</strong> {{ $job->office->name }}</p>
                <p><strong>Alamat:</strong> {{ $job->office->address }}</p>
                <p><strong>Telepon Kantor:</strong> {{ $job->office->phone }}</p>
                <p><strong>Departemen:</strong> {{ $job->department }}</p>
                <p><strong>Batas Lamaran:</strong> {{ $job->deadline ? $job->deadline->format('d M Y') : 'Hingga posisi terisi' }}</p>
            </div>
        </div>

        @if ($relatedJobs->isNotEmpty())
        <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm space-y-4">
            <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider border-b border-slate-100 pb-2">Posisi Terkait Lainnya</h3>
            <div class="space-y-3">
                @foreach ($relatedJobs as $rel)
                <div class="border-b border-slate-100 pb-2 last:border-0">
                    <a href="{{ route('career.show', $rel->slug) }}" class="text-xs font-bold text-slate-800 hover:text-[#00A3E0] block leading-snug">
                        {{ $rel->title }}
                    </a>
                    <span class="text-[10px] text-slate-500">{{ $rel->office->city }} &bull; {{ $rel->employment_type_label }}</span>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@extends('admin.layout')

@section('admin_content')
<div class="space-y-6">
    <!-- Back & Header -->
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.applications.index') }}" class="text-xs font-bold text-slate-500 hover:text-slate-800 flex items-center gap-1">
            &larr; Kembali ke Daftar Pelamar
        </a>
        <div class="flex items-center space-x-3">
            <span class="px-3 py-1 rounded-lg text-xs font-extrabold border {{ $application->stage->colorClasses() }}">
                Status: {{ $application->stage->label() }}
            </span>
        </div>
    </div>

    <!-- Candidate Card & CV Action -->
    <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200/80 shadow-sm space-y-6">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 border-b border-slate-100 pb-5">
            <div>
                <span class="text-xs uppercase font-extrabold text-[#00A3E0] tracking-wider">Kandidat Pelamar</span>
                <h1 class="text-2xl font-extrabold text-slate-900 mt-1">{{ $application->full_name }}</h1>
                <p class="text-xs text-slate-500 mt-0.5">
                    Melamar untuk posisi: <strong class="text-slate-800">{{ $application->jobPosting->title }}</strong> ({{ $application->jobPosting->office->name }})
                </p>
            </div>

            <!-- Secure Resume Download -->
            <a href="{{ route('admin.resumes.download', $application->id) }}" class="bg-slate-900 hover:bg-[#00A3E0] text-white font-bold text-xs px-5 py-3 rounded-xl transition shadow-md flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Unduh Berkas CV ({{ $application->resume_original_name }})
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-4 gap-6 text-xs text-slate-700">
            <div>
                <span class="text-slate-400 font-bold block mb-1">Email:</span>
                <strong class="text-slate-900">{{ $application->email }}</strong>
            </div>
            <div>
                <span class="text-slate-400 font-bold block mb-1">WhatsApp / Telepon:</span>
                <strong class="text-slate-900">{{ $application->phone }}</strong>
            </div>
            <div>
                <span class="text-slate-400 font-bold block mb-1">Ekspektasi Gaji:</span>
                <strong class="text-emerald-700 font-bold text-sm">{{ $application->formatted_salary }}</strong>
            </div>
            <div>
                <span class="text-slate-400 font-bold block mb-1">Notice Period:</span>
                <strong class="text-slate-900">{{ $application->notice_period ?? 'Langsung Tersedia' }}</strong>
            </div>
        </div>

        @if ($application->linkedin_url)
        <div class="text-xs pt-2">
            <span class="text-slate-400 font-bold">LinkedIn:</span>
            <a href="{{ $application->linkedin_url }}" target="_blank" class="text-[#00A3E0] font-semibold hover:underline ml-1">
                {{ $application->linkedin_url }} &rarr;
            </a>
        </div>
        @endif

        @if ($application->cover_letter)
        <div class="bg-slate-50 p-4 rounded-xl border border-slate-200/80 text-xs">
            <span class="font-bold text-slate-700 block mb-1">Surat Pengantar / Catatan Pelamar:</span>
            <p class="text-slate-600 leading-relaxed">{{ $application->cover_letter }}</p>
        </div>
        @endif
    </div>

    <!-- Update Stage & Rating Form -->
    <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm space-y-4">
        <h3 class="text-sm font-bold text-slate-900">Perbarui Tahapan Seleksi & Rating Evaluasi</h3>

        <form action="{{ route('admin.applications.stage', $application->id) }}" method="POST" class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
            @csrf

            <div>
                <label class="block font-bold text-slate-600 mb-1">Tahap Seleksi</label>
                <select name="stage" class="w-full px-3 py-2 border border-slate-300 rounded-xl font-semibold text-slate-800 focus:outline-none focus:border-[#00A3E0]">
                    <option value="NEW" {{ $application->stage->value === 'NEW' ? 'selected' : '' }}>Lamaran Masuk (New)</option>
                    <option value="SCREENING" {{ $application->stage->value === 'SCREENING' ? 'selected' : '' }}>Screening Berkas</option>
                    <option value="INTERVIEW" {{ $application->stage->value === 'INTERVIEW' ? 'selected' : '' }}>Tahap Wawancara (Interview)</option>
                    <option value="OFFER" {{ $application->stage->value === 'OFFER' ? 'selected' : '' }}>Penawaran Kerja (Offering)</option>
                    <option value="HIRED" {{ $application->stage->value === 'HIRED' ? 'selected' : '' }}>Diterima (Hired)</option>
                    <option value="REJECTED" {{ $application->stage->value === 'REJECTED' ? 'selected' : '' }}>Tidak Lolos (Rejected)</option>
                </select>
            </div>

            <div>
                <label class="block font-bold text-slate-600 mb-1">Rating Evaluasi HR (Bintang)</label>
                <select name="rating" class="w-full px-3 py-2 border border-slate-300 rounded-xl font-semibold text-amber-500 focus:outline-none focus:border-[#00A3E0]">
                    <option value="0" {{ $application->rating == 0 ? 'selected' : '' }}>Belum Dinilai (0)</option>
                    <option value="1" {{ $application->rating == 1 ? 'selected' : '' }}>★☆☆☆☆ (1 Bintang)</option>
                    <option value="2" {{ $application->rating == 2 ? 'selected' : '' }}>★★☆☆☆ (2 Bintang)</option>
                    <option value="3" {{ $application->rating == 3 ? 'selected' : '' }}>★★★☆☆ (3 Bintang)</option>
                    <option value="4" {{ $application->rating == 4 ? 'selected' : '' }}>★★★★☆ (4 Bintang)</option>
                    <option value="5" {{ $application->rating == 5 ? 'selected' : '' }}>★★★★★ (5 Bintang - Rekomendasi Tinggi)</option>
                </select>
            </div>

            <div class="pt-0 sm:pt-5">
                <button type="submit" class="w-full bg-[#00A3E0] hover:bg-[#008CC2] text-white font-bold text-xs py-2.5 rounded-xl transition shadow-sm">
                    Simpan Perubahan Tahapan
                </button>
            </div>
        </form>
    </div>

    <!-- Notes & Interview Log -->
    <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm space-y-5">
        <h3 class="text-sm font-bold text-slate-900">Catatan Wawancara & Evaluasi Internal</h3>

        <!-- Add note -->
        <form action="{{ route('admin.applications.notes', $application->id) }}" method="POST" class="space-y-3">
            @csrf
            <textarea name="note" rows="3" placeholder="Tuliskan hasil screening, catatan interview user, atau hasil negosiasi gaji..." required
                class="w-full px-4 py-3 border border-slate-300 rounded-xl text-xs focus:outline-none focus:border-[#00A3E0]"></textarea>
            <button type="submit" class="bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs px-5 py-2.5 rounded-xl transition">
                + Tambah Catatan Evaluasi
            </button>
        </form>

        <!-- List of notes -->
        <div class="space-y-3 pt-3 border-t border-slate-100">
            @forelse ($application->notes as $note)
            <div class="bg-slate-50 p-4 rounded-xl border border-slate-200/60 space-y-1 text-xs">
                <div class="flex items-center justify-between text-slate-400">
                    <strong class="text-slate-800">{{ $note->author->name }}</strong>
                    <span>{{ $note->created_at->format('d M Y, H:i') }} WIB</span>
                </div>
                <p class="text-slate-700 leading-relaxed">{{ $note->note }}</p>
            </div>
            @empty
            <p class="text-slate-400 text-xs">Belum ada catatan evaluasi untuk kandidat ini.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection

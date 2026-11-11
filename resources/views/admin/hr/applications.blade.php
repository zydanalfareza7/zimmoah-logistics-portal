@extends('admin.layout')

@section('admin_content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Applicant Tracking System (ATS HR)</h1>
            <p class="text-xs text-slate-500 mt-1">Kelola pipa seleksi calon karyawan untuk seluruh cabang Zimmoah.</p>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm">
        <form action="{{ route('admin.applications.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-4 gap-4">
            <div>
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama, email, no HP..." 
                    class="w-full px-4 py-2 border border-slate-300 rounded-xl text-xs focus:outline-none focus:border-[#00A3E0]">
            </div>

            <div>
                <select name="job_id" class="w-full px-3 py-2 border border-slate-300 rounded-xl text-xs font-semibold text-slate-700 focus:outline-none focus:border-[#00A3E0]">
                    <option value="">Semua Posisi Lowongan</option>
                    @foreach ($jobs as $job)
                        <option value="{{ $job->id }}" {{ $jobId == $job->id ? 'selected' : '' }}>
                            {{ $job->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <select name="stage" class="w-full px-3 py-2 border border-slate-300 rounded-xl text-xs font-semibold text-slate-700 focus:outline-none focus:border-[#00A3E0]">
                    <option value="">Semua Tahapan Seleksi</option>
                    <option value="NEW" {{ $stage === 'NEW' ? 'selected' : '' }}>Lamaran Masuk (New)</option>
                    <option value="SCREENING" {{ $stage === 'SCREENING' ? 'selected' : '' }}>Screening Berkas</option>
                    <option value="INTERVIEW" {{ $stage === 'INTERVIEW' ? 'selected' : '' }}>Tahap Wawancara</option>
                    <option value="OFFER" {{ $stage === 'OFFER' ? 'selected' : '' }}>Penawaran Kerja (Offering)</option>
                    <option value="HIRED" {{ $stage === 'HIRED' ? 'selected' : '' }}>Diterima (Hired)</option>
                    <option value="REJECTED" {{ $stage === 'REJECTED' ? 'selected' : '' }}>Tidak Lolos (Rejected)</option>
                </select>
            </div>

            <div class="flex items-center space-x-2">
                <button type="submit" class="w-full bg-[#00A3E0] hover:bg-[#008CC2] text-white font-bold text-xs py-2.5 rounded-xl transition shadow-sm">
                    Filter Kandidat
                </button>
                @if ($search || $jobId || $stage)
                    <a href="{{ route('admin.applications.index') }}" class="p-2.5 text-slate-400 hover:text-slate-600 border border-slate-200 rounded-xl" title="Reset">
                        &times;
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Applicants Table -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 border-b border-slate-200 text-slate-500 uppercase tracking-wider font-bold">
                    <tr>
                        <th class="px-6 py-4">Kandidat Pelamar</th>
                        <th class="px-6 py-4">Posisi & Cabang</th>
                        <th class="px-6 py-4">Ekspektasi Gaji & Notice</th>
                        <th class="px-6 py-4">Tahapan Seleksi</th>
                        <th class="px-6 py-4">Rating</th>
                        <th class="px-6 py-4">Tanggal Masuk</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700 font-medium">
                    @forelse ($applications as $app)
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="px-6 py-4">
                            <strong class="text-slate-900 block">{{ $app->full_name }}</strong>
                            <span class="text-[11px] text-slate-400">{{ $app->email }} &bull; {{ $app->phone }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="font-bold text-slate-900 block">{{ $app->jobPosting->title }}</span>
                            <span class="text-[10px] text-slate-400">{{ $app->jobPosting->office->name }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <strong class="text-slate-800 block">{{ $app->formatted_salary }}</strong>
                            <span class="text-[10px] text-slate-500">{{ $app->notice_period ?? 'Notice: -' }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-block px-2.5 py-1 rounded-full text-[10px] font-extrabold border {{ $app->stage->colorClasses() }}">
                                {{ $app->stage->label() }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-amber-500 font-bold">
                                {{ str_repeat('★', $app->rating) }}{{ str_repeat('☆', 5 - $app->rating) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-slate-500">
                            {{ $app->created_at->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.applications.show', $app->id) }}" class="inline-block bg-slate-900 hover:bg-[#00A3E0] text-white font-bold text-xs px-3.5 py-1.5 rounded-lg transition shadow-sm">
                                Review &rarr;
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-slate-400 text-xs">
                            Tidak ada pelamar yang cocok dengan kriteria pencarian.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-slate-100">
            {{ $applications->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection

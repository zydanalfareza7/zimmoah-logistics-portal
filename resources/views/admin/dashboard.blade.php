@extends('admin.layout')

@section('admin_content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Overview Operasional & Helpdesk</h1>
            <p class="text-xs text-slate-500 mt-1">Pantau volume tiket kargo, kepatuhan respon SLA, dan pipeline rekrutmen talenta Zimmoah.</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.tickets.index') }}" class="bg-black hover:bg-neutral-800 text-[#FECE00] font-black text-xs px-4 py-2.5 rounded-xl transition shadow-sm">
                Lihat Semua Tiket &rarr;
            </a>
        </div>
    </div>

    <!-- 5 KPI Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-5">
        <!-- KPI 1 -->
        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm space-y-2">
            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Total Tiket</span>
            <div class="text-2xl font-black text-slate-900">{{ $totalTickets }}</div>
            <span class="text-[10px] text-slate-500 block">Akumulasi seluruh saluran</span>
        </div>

        <!-- KPI 2 -->
        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm space-y-2">
            <span class="text-[11px] font-bold uppercase tracking-wider text-blue-600">Tiket Aktif (Open)</span>
            <div class="text-2xl font-black text-blue-700">{{ $openTickets }}</div>
            <span class="text-[10px] text-blue-500 block">Membutuhkan penanganan</span>
        </div>

        <!-- KPI 3 -->
        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm space-y-2">
            <span class="text-[11px] font-bold uppercase tracking-wider text-rose-600">SLA Overdue</span>
            <div class="text-2xl font-black text-rose-700">{{ $slaBreached }}</div>
            <span class="text-[10px] text-rose-500 block">Melewati batas waktu respon</span>
        </div>

        <!-- KPI 4 -->
        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm space-y-2">
            <span class="text-[11px] font-bold uppercase tracking-wider text-emerald-600">Total Pelamar</span>
            <div class="text-2xl font-black text-emerald-700">{{ $totalApplicants }}</div>
            <span class="text-[10px] text-emerald-500 block">Kandidat dalam ATS</span>
        </div>

        <!-- KPI 5 -->
        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm space-y-2">
            <span class="text-[11px] font-bold uppercase tracking-wider text-purple-600">Lowongan Aktif</span>
            <div class="text-2xl font-black text-purple-700">{{ $activeJobs }}</div>
            <span class="text-[10px] text-purple-500 block">Terbuka di 3 cabang</span>
        </div>
    </div>

    <!-- 2 Tables: Recent Tickets & Recent Applicants -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Tickets Table -->
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
            <div class="p-5 border-b border-slate-100 flex items-center justify-between">
                <h3 class="text-sm font-bold text-slate-900">Tiket Layanan Masuk Terbaru</h3>
                <a href="{{ route('admin.tickets.index') }}" class="text-xs font-black text-black underline decoration-[#FECE00] decoration-2">Semua &rarr;</a>
            </div>
            <div class="divide-y divide-slate-100 text-xs">
                @forelse ($recentTickets as $ticket)
                <div class="p-4 hover:bg-slate-50 transition flex items-center justify-between gap-3">
                    <div class="space-y-1">
                        <div class="flex items-center space-x-2">
                            <span class="font-mono font-bold text-slate-900">{{ $ticket->ticket_code }}</span>
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold border {{ $ticket->status->colorClasses() }}">
                                {{ $ticket->status->label() }}
                            </span>
                        </div>
                        <h4 class="font-semibold text-slate-800 line-clamp-1">{{ $ticket->subject }}</h4>
                        <span class="text-[10px] text-slate-400">{{ $ticket->customer_name }} &bull; {{ $ticket->created_at->diffForHumans() }}</span>
                    </div>
                    <a href="{{ route('admin.tickets.show', $ticket->id) }}" class="text-xs font-bold text-black hover:bg-[#FECE00] px-3 py-1.5 rounded-lg border border-neutral-300 hover:border-black transition">
                        Buka
                    </a>
                </div>
                @empty
                <div class="p-6 text-center text-slate-400">Belum ada tiket masuk.</div>
                @endforelse
            </div>
        </div>

        <!-- Recent Applicants Table -->
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
            <div class="p-5 border-b border-slate-100 flex items-center justify-between">
                <h3 class="text-sm font-bold text-slate-900">Pelamar Karir Terbaru</h3>
                <a href="{{ route('admin.applications.index') }}" class="text-xs font-black text-black underline decoration-[#FECE00] decoration-2">Semua &rarr;</a>
            </div>
            <div class="divide-y divide-slate-100 text-xs">
                @forelse ($recentApplicants as $applicant)
                <div class="p-4 hover:bg-slate-50 transition flex items-center justify-between gap-3">
                    <div class="space-y-1">
                        <div class="flex items-center space-x-2">
                            <span class="font-bold text-slate-900">{{ $applicant->full_name }}</span>
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold border {{ $applicant->stage->colorClasses() }}">
                                {{ $applicant->stage->label() }}
                            </span>
                        </div>
                        <h4 class="text-slate-600 line-clamp-1">Posisi: <strong>{{ $applicant->jobPosting->title }}</strong></h4>
                        <span class="text-[10px] text-slate-400">{{ $applicant->email }} &bull; {{ $applicant->created_at->diffForHumans() }}</span>
                    </div>
                    <a href="{{ route('admin.applications.show', $applicant->id) }}" class="text-xs font-bold text-black hover:bg-[#FECE00] px-3 py-1.5 rounded-lg border border-neutral-300 hover:border-black transition">
                        Detail
                    </a>
                </div>
                @empty
                <div class="p-6 text-center text-slate-400">Belum ada pelamar.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

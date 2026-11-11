@extends('admin.layout')

@section('admin_content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Antrean Helpdesk & Tiket Layanan</h1>
            <p class="text-xs text-slate-500 mt-1">Kelola komunikasi kargo pelanggan dua arah via email & web portal.</p>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm">
        <form action="{{ route('admin.tickets.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-4 gap-4">
            <div>
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari kode tiket, subjek, nama..." 
                    class="w-full px-4 py-2 border border-slate-300 rounded-xl text-xs focus:outline-none focus:border-[#00A3E0]">
            </div>

            <div>
                <select name="status" class="w-full px-3 py-2 border border-slate-300 rounded-xl text-xs font-semibold text-slate-700 focus:outline-none focus:border-[#00A3E0]">
                    <option value="">Semua Status</option>
                    <option value="NEW" {{ $status === 'NEW' ? 'selected' : '' }}>Baru (New)</option>
                    <option value="OPEN" {{ $status === 'OPEN' ? 'selected' : '' }}>Sedang Ditangani (Open)</option>
                    <option value="PENDING" {{ $status === 'PENDING' ? 'selected' : '' }}>Menunggu Klien (Pending)</option>
                    <option value="RESOLVED" {{ $status === 'RESOLVED' ? 'selected' : '' }}>Selesai (Resolved)</option>
                    <option value="CLOSED" {{ $status === 'CLOSED' ? 'selected' : '' }}>Ditutup (Closed)</option>
                </select>
            </div>

            <div>
                <select name="priority" class="w-full px-3 py-2 border border-slate-300 rounded-xl text-xs font-semibold text-slate-700 focus:outline-none focus:border-[#00A3E0]">
                    <option value="">Semua Urgensi</option>
                    <option value="LOW" {{ $priority === 'LOW' ? 'selected' : '' }}>Rendah</option>
                    <option value="MEDIUM" {{ $priority === 'MEDIUM' ? 'selected' : '' }}>Sedang</option>
                    <option value="HIGH" {{ $priority === 'HIGH' ? 'selected' : '' }}>Tinggi</option>
                    <option value="URGENT" {{ $priority === 'URGENT' ? 'selected' : '' }}>Mendesak (Urgent)</option>
                </select>
            </div>

            <div class="flex items-center space-x-2">
                <button type="submit" class="w-full bg-[#00A3E0] hover:bg-[#008CC2] text-white font-bold text-xs py-2.5 rounded-xl transition shadow-sm">
                    Filter Tiket
                </button>
                @if ($search || $status || $priority)
                    <a href="{{ route('admin.tickets.index') }}" class="p-2.5 text-slate-400 hover:text-slate-600 border border-slate-200 rounded-xl" title="Reset">
                        &times;
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Tickets Table -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 border-b border-slate-200 text-slate-500 uppercase tracking-wider font-bold">
                    <tr>
                        <th class="px-6 py-4">Kode Tiket</th>
                        <th class="px-6 py-4">Klien & Pengirim</th>
                        <th class="px-6 py-4">Subjek Masalah</th>
                        <th class="px-6 py-4">Status & Prioritas</th>
                        <th class="px-6 py-4">SLA Respon</th>
                        <th class="px-6 py-4">Agen Penanggung Jawab</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700 font-medium">
                    @forelse ($tickets as $ticket)
                    <tr class="hover:bg-slate-50/80 transition">
                        <td class="px-6 py-4">
                            <span class="font-mono font-bold text-slate-900 block">{{ $ticket->ticket_code }}</span>
                            <span class="text-[10px] text-slate-400">{{ $ticket->category }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <strong class="text-slate-900 block">{{ $ticket->customer_name }}</strong>
                            <span class="text-[11px] text-slate-400">{{ $ticket->customer_email }}</span>
                        </td>
                        <td class="px-6 py-4 max-w-xs">
                            <span class="font-semibold text-slate-900 line-clamp-1">{{ $ticket->subject }}</span>
                            <span class="text-[10px] text-slate-400">Diperbarui {{ $ticket->updated_at->diffForHumans() }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="space-y-1">
                                <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-extrabold border {{ $ticket->status->colorClasses() }}">
                                    {{ $ticket->status->label() }}
                                </span>
                                <span class="inline-block px-2 py-0.5 rounded-full text-[10px] font-bold border {{ $ticket->priority->colorClasses() }}">
                                    {{ $ticket->priority->label() }}
                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-slate-800 font-semibold block">{{ $ticket->sla_due_at ? $ticket->sla_due_at->format('d M, H:i') : '-' }}</span>
                            @if ($ticket->isSlaBreached())
                                <span class="text-[10px] font-black text-rose-600 block">SLA Terlewat</span>
                            @else
                                <span class="text-[10px] text-emerald-600 block">On Track</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if ($ticket->assignedAgent)
                                <span class="text-slate-900 font-bold text-xs">{{ $ticket->assignedAgent->name }}</span>
                            @else
                                <span class="text-amber-600 font-semibold text-[11px]">Belum Ditugaskan</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.tickets.show', $ticket->id) }}" class="inline-block bg-slate-900 hover:bg-[#00A3E0] text-white font-bold text-xs px-3.5 py-1.5 rounded-lg transition shadow-sm">
                                Respon &rarr;
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-slate-400 text-xs">
                            Tidak ada tiket yang cocok dengan kriteria pencarian.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-slate-100">
            {{ $tickets->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection

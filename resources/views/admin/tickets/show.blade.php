@extends('admin.layout')

@section('admin_content')
<div class="space-y-6">
    <!-- Back & Header -->
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.tickets.index') }}" class="text-xs font-bold text-slate-500 hover:text-slate-800 flex items-center gap-1">
            &larr; Kembali ke Daftar Tiket
        </a>
        <div class="flex items-center space-x-2">
            <span class="font-mono font-bold text-slate-900 bg-white px-3 py-1 rounded-lg border border-slate-200 text-xs shadow-sm">
                {{ $ticket->ticket_code }}
            </span>
            <span class="px-3 py-1 rounded-lg text-xs font-extrabold border {{ $ticket->status->colorClasses() }}">
                {{ $ticket->status->label() }}
            </span>
        </div>
    </div>

    <!-- Ticket Summary Card -->
    <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm grid grid-cols-1 md:grid-cols-4 gap-6 text-xs">
        <div>
            <span class="text-slate-400 font-bold block mb-1">Klien Pengirim:</span>
            <strong class="text-slate-900 text-sm block">{{ $ticket->customer_name }}</strong>
            <span class="text-slate-500 block">{{ $ticket->customer_email }}</span>
            <span class="text-slate-500 block">{{ $ticket->customer_phone ?? 'Tanpa telepon' }}</span>
        </div>

        <div>
            <span class="text-slate-400 font-bold block mb-1">Subjek & Kategori:</span>
            <strong class="text-slate-900 text-sm block line-clamp-2">{{ $ticket->subject }}</strong>
            <span class="text-[#00A3E0] font-bold block mt-1">Kategori: {{ $ticket->category }}</span>
        </div>

        <div>
            <span class="text-slate-400 font-bold block mb-1">Target SLA & Prioritas:</span>
            <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold border mb-1 {{ $ticket->priority->colorClasses() }}">
                Prioritas: {{ $ticket->priority->label() }}
            </span>
            <p class="text-slate-700">Batas Respon: <strong>{{ $ticket->sla_due_at ? $ticket->sla_due_at->format('d M, H:i') : '-' }} WIB</strong></p>
            @if ($ticket->isSlaBreached())
                <span class="text-rose-600 font-black block mt-0.5">TERLEWAT SLA!</span>
            @endif
        </div>

        <div>
            <span class="text-slate-400 font-bold block mb-1">Agen yang Menangani:</span>
            <strong class="text-slate-900 text-sm block">{{ $ticket->assignedAgent ? $ticket->assignedAgent->name : 'Belum Ditugaskan' }}</strong>
            <span class="text-slate-400 block text-[11px] mt-1">Dibuat: {{ $ticket->created_at->format('d M Y, H:i') }}</span>
        </div>
    </div>

    <!-- Timeline of Replies -->
    <div class="space-y-4">
        <h3 class="text-sm font-bold text-slate-900">Kronologi Percakapan & Catatan</h3>

        @foreach ($ticket->replies as $reply)
            @if ($reply->is_internal_note)
                <!-- Internal Note Bubble (Yellow/Amber) -->
                <div class="bg-amber-50/80 border-2 border-amber-300/80 rounded-2xl p-5 shadow-sm space-y-2">
                    <div class="flex items-center justify-between text-xs text-amber-900 font-bold border-b border-amber-200/60 pb-2">
                        <div class="flex items-center space-x-2">
                            <span class="bg-amber-200 text-amber-900 px-2 py-0.5 rounded text-[10px] uppercase font-extrabold">Catatan Internal</span>
                            <span>{{ $reply->sender_name }}</span>
                        </div>
                        <span class="text-amber-700 text-[11px] font-normal">{{ $reply->created_at->format('d M Y, H:i') }} WIB</span>
                    </div>
                    <div class="text-xs text-amber-950 leading-relaxed whitespace-pre-line">
                        {{ $reply->body_text }}
                    </div>
                </div>
            @else
                <!-- Normal Message Bubble -->
                <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm space-y-3 {{ $reply->sender_type === 'AGENT' ? 'border-l-4 border-l-[#00A3E0]' : '' }}">
                    <div class="flex items-center justify-between text-xs border-b border-slate-100 pb-2">
                        <div>
                            <strong class="text-slate-900">{{ $reply->sender_name }}</strong>
                            <span class="text-slate-400 text-[11px] ml-1">({{ $reply->sender_type === 'AGENT' ? 'Staf Zimmoah' : 'Klien' }})</span>
                        </div>
                        <span class="text-slate-400 text-[11px]">{{ $reply->created_at->format('d M Y, H:i') }} WIB</span>
                    </div>

                    <div class="text-xs text-slate-800 leading-relaxed whitespace-pre-line">
                        {{ $reply->body_text }}
                    </div>

                    @if ($reply->attachments->isNotEmpty())
                    <div class="pt-3 border-t border-slate-100 space-y-1.5">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Berkas Lampiran:</span>
                        @foreach ($reply->attachments as $att)
                        <div class="flex items-center justify-between bg-slate-50 p-2.5 rounded-xl border border-slate-200 text-xs">
                            <span class="font-medium text-slate-800">{{ $att->file_name }} ({{ $att->formatted_size }})</span>
                            <a href="{{ route('admin.attachments.download', $att->id) }}" class="text-[#00A3E0] font-bold hover:underline flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                Unduh Lampiran
                            </a>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            @endif
        @endforeach
    </div>

    <!-- Agent Reply Box & Control Center -->
    <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-md space-y-5">
        <h3 class="text-base font-bold text-slate-900">Respon Agen & Pembaruan Status</h3>

        <form action="{{ route('admin.tickets.reply', $ticket->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <!-- Toggle Internal Note -->
            <div class="bg-slate-50 p-3.5 rounded-xl border border-slate-200 flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <input type="checkbox" name="is_internal_note" id="internalNoteCheck" value="1" class="w-4 h-4 text-[#00A3E0] rounded border-slate-300 focus:ring-[#00A3E0]">
                    <label for="internalNoteCheck" class="text-xs font-bold text-slate-800 cursor-pointer">
                        Simpan sebagai Catatan Internal (Hanya dilihat oleh staf internal Zimmoah)
                    </label>
                </div>
                <span class="text-[10px] text-slate-400 hidden sm:inline">Tidak akan dikirimkan ke email pelanggan</span>
            </div>

            <!-- Message Area -->
            <div>
                <textarea name="body_text" rows="5" placeholder="Tuliskan balasan untuk klien atau catatan koordinasi tim operasional..." required
                    class="w-full px-4 py-3 border border-slate-300 rounded-xl text-xs focus:outline-none focus:border-[#00A3E0] leading-relaxed"></textarea>
            </div>

            <!-- Controls (Status & Assign) -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
                <div>
                    <label class="block font-bold text-slate-600 mb-1">Perbarui Status Tiket</label>
                    <select name="status" class="w-full px-3 py-2 border border-slate-300 rounded-xl font-semibold text-slate-800 focus:outline-none focus:border-[#00A3E0]">
                        <option value="OPEN" {{ $ticket->status->value === 'OPEN' ? 'selected' : '' }}>Sedang Ditangani (Open)</option>
                        <option value="PENDING" {{ $ticket->status->value === 'PENDING' ? 'selected' : '' }}>Menunggu Tanggapan Klien (Pending)</option>
                        <option value="RESOLVED" {{ $ticket->status->value === 'RESOLVED' ? 'selected' : '' }}>Selesai Ditangani (Resolved)</option>
                        <option value="CLOSED" {{ $ticket->status->value === 'CLOSED' ? 'selected' : '' }}>Tutup Tiket (Closed)</option>
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-slate-600 mb-1">Tugaskan ke Agen</label>
                    <select name="assigned_agent_id" class="w-full px-3 py-2 border border-slate-300 rounded-xl font-semibold text-slate-800 focus:outline-none focus:border-[#00A3E0]">
                        <option value="">Pilih Agen...</option>
                        @foreach ($agents as $agent)
                            <option value="{{ $agent->id }}" {{ $ticket->assigned_agent_id == $agent->id ? 'selected' : '' }}>
                                {{ $agent->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-slate-600 mb-1">Lampirkan File (Opsional)</label>
                    <input type="file" name="attachment" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"
                        class="w-full text-xs text-slate-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200 cursor-pointer">
                </div>
            </div>

            <div class="pt-3 border-t border-slate-100 flex justify-end">
                <button type="submit" class="bg-[#00A3E0] hover:bg-[#008CC2] text-white font-bold text-xs px-8 py-3 rounded-xl transition shadow-md flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                    Kirimkan Pembaruan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

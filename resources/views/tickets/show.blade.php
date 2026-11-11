@extends('layouts.app')

@section('content')
<div class="bg-slate-100 py-8 px-4 sm:px-8 border-b border-slate-200">
    <div class="max-w-5xl mx-auto flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
        <div>
            <div class="flex items-center space-x-3 mb-2">
                <span class="text-xs font-mono font-bold bg-slate-900 text-white px-2.5 py-1 rounded-md">{{ $ticket->ticket_code }}</span>
                <span class="text-xs font-extrabold px-3 py-1 rounded-full border {{ $ticket->status->colorClasses() }}">
                    Status: {{ $ticket->status->label() }}
                </span>
                <span class="text-xs font-extrabold px-3 py-1 rounded-full border {{ $ticket->priority->colorClasses() }}">
                    Urgensi: {{ $ticket->priority->label() }}
                </span>
            </div>
            <h1 class="text-xl sm:text-2xl font-extrabold text-slate-900">{{ $ticket->subject }}</h1>
            <p class="text-xs text-slate-500 mt-1">
                Kategori: <strong class="text-slate-700">{{ $ticket->category }}</strong> &bull; Dibuat oleh: <strong class="text-slate-700">{{ $ticket->customer_name }}</strong> ({{ $ticket->customer_email }})
            </p>
        </div>

        <div class="text-right text-xs text-slate-500 bg-white p-3 rounded-xl border border-slate-200 shadow-sm">
            <span class="block">Target SLA Respon:</span>
            <span class="font-bold text-slate-800">{{ $ticket->sla_due_at ? $ticket->sla_due_at->format('d M Y, H:i') : '-' }} WIB</span>
            @if ($ticket->isSlaBreached())
                <span class="text-rose-600 font-extrabold block text-[10px]">Overdue SLA</span>
            @endif
        </div>
    </div>
</div>

<div class="max-w-5xl mx-auto px-4 sm:px-8 py-10 space-y-8">
    <!-- Conversation Timeline -->
    <div class="space-y-6">
        @foreach ($ticket->replies as $reply)
        <div class="flex gap-4 {{ $reply->sender_type === 'AGENT' ? 'flex-row-reverse' : '' }}">
            <!-- Avatar -->
            <div class="w-10 h-10 rounded-full flex items-center justify-center font-black text-xs flex-shrink-0 {{ $reply->sender_type === 'AGENT' ? 'bg-[#FECE00] text-slate-950 shadow-md' : 'bg-slate-300 text-slate-800' }}">
                {{ $reply->sender_type === 'AGENT' ? 'ZIM' : substr($reply->sender_name, 0, 2) }}
            </div>

            <!-- Bubble Content -->
            <div class="max-w-2xl w-full bg-white rounded-2xl p-6 shadow-sm border border-slate-200/80 space-y-3 {{ $reply->sender_type === 'AGENT' ? 'border-l-4 border-l-[#FECE00]' : '' }}">
                <div class="flex items-center justify-between border-b border-slate-100 pb-2 text-xs">
                    <div>
                        <strong class="text-slate-900">{{ $reply->sender_name }}</strong>
                        <span class="text-slate-400 text-[11px] ml-1">({{ $reply->sender_type === 'AGENT' ? 'Staf Customer Care Zimmoah' : 'Klien' }})</span>
                    </div>
                    <span class="text-slate-400 text-[11px]">{{ $reply->created_at->format('d M Y, H:i') }} WIB</span>
                </div>

                <div class="text-sm text-slate-700 leading-relaxed whitespace-pre-line">
                    {{ $reply->body_text }}
                </div>

                @if ($reply->attachments->isNotEmpty())
                <div class="pt-3 border-t border-slate-100 space-y-1.5">
                    <span class="text-[11px] font-bold text-slate-500 uppercase tracking-wider block">Lampiran Dokumen:</span>
                    @foreach ($reply->attachments as $att)
                    <div class="flex items-center justify-between bg-slate-50 p-2.5 rounded-lg border border-slate-200 text-xs">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg>
                            <span class="font-medium text-slate-800">{{ $att->file_name }}</span>
                            <span class="text-slate-400 text-[10px]">({{ $att->formatted_size }})</span>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>

    <!-- Client Reply Box -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-md">
        <h3 class="text-base font-black text-slate-900 mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/></svg>
            Kirimkan Balasan Tambahan
        </h3>

        <form action="{{ route('tickets.reply', $ticket->ticket_code) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <input type="hidden" name="token" value="{{ $ticket->access_token }}">

            <div>
                <textarea name="message" rows="4" placeholder="Tuliskan pesan balasan Anda..." required
                    class="w-full px-4 py-3 border border-slate-300 rounded-xl text-sm focus:outline-none focus:border-[#FECE00] leading-relaxed"></textarea>
            </div>

            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div class="w-full sm:w-auto">
                    <input type="file" name="attachment" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" 
                        class="text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-amber-100 file:text-amber-900 hover:file:bg-amber-200 cursor-pointer">
                </div>

                <button type="submit" class="bg-[#FECE00] hover:bg-[#E5B800] text-slate-950 font-black text-xs px-7 py-3 rounded-xl transition shadow-md whitespace-nowrap">
                    Kirim Balasan &rarr;
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

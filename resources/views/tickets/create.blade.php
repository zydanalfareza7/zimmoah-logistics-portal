@extends('layouts.app')

@section('content')
<div class="bg-[#FECE00] text-black py-14 px-4 sm:px-8 border-b-2 border-black/15">
    <div class="max-w-4xl mx-auto space-y-3">
        <span class="inline-block text-xs uppercase tracking-widest font-black text-[#FECE00] bg-black px-3.5 py-1 rounded-full">
            Customer Support & Helpdesk
        </span>
        <h1 class="text-3xl sm:text-4xl font-black tracking-tight text-black">Pusat Layanan Bantuan & Tiket Kargo</h1>
        <p class="text-neutral-900 font-medium text-sm leading-relaxed max-w-2xl">
            Sampaikan inquiry jadwal, konfirmasi booking kargo, kendala operasional, atau penagihan invoice. Sistem kami terhubung dua arah dengan email resmi Zimmoah.
        </p>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 sm:px-8 py-12">
    <div class="bg-white rounded-3xl p-8 sm:p-10 shadow-xl border border-slate-200">
        <div class="flex items-center justify-between border-b border-slate-200 pb-5 mb-8">
            <div>
                <h2 class="text-xl font-bold text-slate-900">Formulir Tiket Baru</h2>
                <p class="text-xs text-slate-500 mt-1">Nomor referensi tiket akan dikirimkan otomatis ke email Anda.</p>
            </div>
            <a href="{{ route('tickets.lookup') }}" class="text-xs font-bold text-amber-700 hover:underline flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                Lacak Tiket Eksisting &rarr;
            </a>
        </div>

        <form action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Sender Info -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama Lengkap / Perusahaan *</label>
                    <input type="text" name="customer_name" value="{{ old('customer_name') }}" placeholder="Contoh: PT Sumber Makmur / Bpk. Andi" required
                        class="w-full px-4 py-3 border border-slate-300 rounded-xl text-sm focus:outline-none focus:border-[#FECE00]">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Alamat Email Resmi *</label>
                    <input type="email" name="customer_email" value="{{ old('customer_email') }}" placeholder="andi@perusahaan.co.id" required
                        class="w-full px-4 py-3 border border-slate-300 rounded-xl text-sm focus:outline-none focus:border-[#FECE00]">
                    <span class="text-[11px] text-slate-400">Balasan agen akan otomatis masuk ke inbox email ini.</span>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nomor Telepon / WhatsApp</label>
                    <input type="text" name="customer_phone" value="{{ old('customer_phone') }}" placeholder="+62 812..." 
                        class="w-full px-4 py-3 border border-slate-300 rounded-xl text-sm focus:outline-none focus:border-[#FECE00]">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Kategori Masalah *</label>
                    <select name="category" required class="w-full px-4 py-3 border border-slate-300 rounded-xl text-sm font-semibold text-slate-800 focus:outline-none focus:border-[#FECE00]">
                        <option value="FORWARDING">Freight Forwarding (Sea / Air)</option>
                        <option value="TRUCKING">Trucking & Armada Darat</option>
                        <option value="WAREHOUSING">Gudang & Bea Cukai</option>
                        <option value="BILLING">Keuangan & Invoice</option>
                        <option value="GENERAL" selected>Inquiry Umum / Lainnya</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Tingkat Urgensi (SLA) *</label>
                    <select name="priority" required class="w-full px-4 py-3 border border-slate-300 rounded-xl text-sm font-semibold text-slate-800 focus:outline-none focus:border-[#FECE00]">
                        <option value="LOW">Rendah (SLA 24 Jam)</option>
                        <option value="MEDIUM" selected>Sedang (SLA 12 Jam)</option>
                        <option value="HIGH">Tinggi (SLA 4 Jam)</option>
                        <option value="URGENT">Mendesak / Emergency (SLA 1 Jam)</option>
                    </select>
                </div>
            </div>

            <!-- Subject & Message -->
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Subjek Tiket / Judul Masalah *</label>
                <input type="text" name="subject" value="{{ old('subject') }}" placeholder="Contoh: Permintaan Space Kontainer 20ft Rute Jakarta - Busan" required
                    class="w-full px-4 py-3 border border-slate-300 rounded-xl text-sm focus:outline-none focus:border-[#FECE00]">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Rincian Pertanyaan / Kendala Kargo *</label>
                <textarea name="message" rows="5" placeholder="Tuliskan nomor kontainer/AWB, pelabuhan asal, tujuan, jenis komoditas kargo, atau detail permasalahan..." required
                    class="w-full px-4 py-3 border border-slate-300 rounded-xl text-sm focus:outline-none focus:border-[#FECE00] leading-relaxed">{{ old('message') }}</textarea>
            </div>

            <!-- Attachment -->
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    Lampiran Dokumen (PDF, Gambar BL, Packing List, Maks 5MB)
                </label>
                <div class="border-2 border-dashed border-slate-300 rounded-xl p-5 text-center bg-slate-50 hover:border-[#FECE00] transition">
                    <input type="file" name="attachment" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-slate-900 file:text-white hover:file:bg-[#FECE00] hover:file:text-slate-950 cursor-pointer">
                    <p class="text-[11px] text-slate-400 mt-2">Mendukung file PDF, Word, JPEG, PNG. Disimpan secara aman di server privat.</p>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-200">
                <button type="submit" class="w-full bg-[#FECE00] hover:bg-[#E5B800] text-slate-950 font-black text-sm py-4 rounded-xl shadow-lg transition flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                    Kirimkan Tiket ke Tim Operasional
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@php
    $chatLocale = app()->getLocale();
    $chatTitle = match ($chatLocale) {
        'en' => 'Zimmoah Assistant',
        'ko' => '짐모아 어시스턴트',
        default => 'Zimmoah Assistant',
    };
    $chatSubtitle = match ($chatLocale) {
        'en' => 'Online • Live Tracking, Schedules & Info',
        'ko' => '온라인 • 실시간 추적 · 스케줄 · 안내',
        default => 'Online • Lacak Kargo, Jadwal & Info',
    };
    $chatPrivacy = match ($chatLocale) {
        'en' => 'For your privacy, please do not enter passwords or sensitive personal data.',
        'ko' => '개인정보 보호를 위해 비밀번호 등 민감한 정보는 입력하지 마세요.',
        default => 'Demi privasi, mohon tidak menuliskan password atau data pribadi sensitif di chat.',
    };
    $chatWelcome = match ($chatLocale) {
        'en' => "Hello! I'm **Zimmoah Assistant**. Ask me to track a shipment (`ZIM-CARGO-9042`), check ocean/air schedules, look up 30 Java–Bali trucking routes, find department PICs, or explore careers.",
        'ko' => "안녕하세요! **짐모아 어시스턴트**입니다. 실시간 화물 추적(`ZIM-CARGO-9042`), 해상/항공 스케줄, 내륙운송 30개 도시, 담당부서 연락처, 채용 정보를 바로 물어보세요.",
        default => "Halo! Saya **Zimmoah Assistant**. Anda bisa langsung lacak kargo (`ZIM-CARGO-9042`), cek jadwal kapal/pesawat, jarak trucking 30 kota, kontak PIC departemen, atau info lowongan kerja.",
    };
    $chatPlaceholder = match ($chatLocale) {
        'en' => 'Ask about tracking, schedules, services...',
        'ko' => '화물 추적, 스케줄, 서비스에 대해 질문하세요...',
        default => 'Ketik nomor resi atau pertanyaan Anda...',
    };
    $quickPrompts = match ($chatLocale) {
        'en' => [
            ['label' => '📦 Track ZIM-CARGO-9042', 'q' => 'Track ZIM-CARGO-9042'],
            ['label' => '🚢 Schedule to Busan', 'q' => 'Ocean schedule to Busan'],
            ['label' => '🚛 Trucking to Bandung', 'q' => 'Trucking distance to Bandung'],
            ['label' => '📞 Sea Export PIC', 'q' => 'Contact Sea Export PIC'],
            ['label' => '💼 Open Careers', 'q' => 'Are there active job openings?'],
        ],
        'ko' => [
            ['label' => '📦 ZIM-CARGO-9042 추적', 'q' => 'ZIM-CARGO-9042 추적해줘'],
            ['label' => '🚢 부산 운항 스케줄', 'q' => '부산 스케줄 알려줘'],
            ['label' => '🚛 반둥 내륙운송 거리', 'q' => 'Bandung 내륙운송 거리'],
            ['label' => '📞 지점 및 담당자', 'q' => '지점 연락처 알려줘'],
            ['label' => '💼 채용 공고', 'q' => '현재 채용 공고 있어?'],
        ],
        default => [
            ['label' => '📦 Lacak ZIM-CARGO-9042', 'q' => 'Lacak ZIM-CARGO-9042'],
            ['label' => '🚢 Jadwal ke Busan', 'q' => 'Jadwal kapal ke Busan'],
            ['label' => '🚛 Jarak ke Bandung', 'q' => 'Jarak trucking ke Bandung'],
            ['label' => '📞 PIC Sea Export', 'q' => 'Kontak PIC Sea Export'],
            ['label' => '💼 Lowongan Kerja', 'q' => 'Ada lowongan kerja aktif?'],
        ],
    };
@endphp

<!-- ZIMMOAH FLOATING ASSISTANT CHATBOT WIDGET -->
<div id="zimmoahChatbotRoot" class="fixed bottom-5 right-5 z-50 flex flex-col items-end">
    <!-- Chat Window -->
    <div id="zimChatPanel"
         class="hidden mb-3 w-[calc(100vw-2rem)] sm:w-[395px] bg-white rounded-3xl shadow-2xl border-2 border-black/15 overflow-hidden flex flex-col"
         style="max-height: min(600px, calc(100vh - 7rem));"
         role="dialog"
         aria-label="Zimmoah Assistant Chat">

        <!-- Header -->
        <div class="bg-black text-white px-5 py-4 border-b-4 border-[#FECE00] flex items-center justify-between gap-3">
            <div class="flex items-center gap-3 min-w-0">
                <div class="w-10 h-10 rounded-2xl bg-[#FECE00] text-black font-black flex items-center justify-center flex-shrink-0 shadow-sm text-lg">
                    Z
                </div>
                <div class="min-w-0">
                    <div class="flex items-center gap-2">
                        <h3 class="text-sm font-black text-white truncate">{{ $chatTitle }}</h3>
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse flex-shrink-0"></span>
                    </div>
                    <p class="text-[11px] text-neutral-300 truncate">{{ $chatSubtitle }}</p>
                </div>
            </div>
            <div class="flex items-center gap-1.5 flex-shrink-0">
                <button type="button" id="zimChatReset" title="Reset Chat"
                        class="p-1.5 rounded-lg text-neutral-400 hover:text-[#FECE00] hover:bg-neutral-800 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                </button>
                <button type="button" id="zimChatClose" title="Tutup"
                        class="p-1.5 rounded-lg text-neutral-400 hover:text-white hover:bg-neutral-800 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </div>

        <!-- Privacy Strip -->
        <div class="bg-[#FFFBE6] border-b border-[#FECE00]/60 px-4 py-2 text-[11px] text-neutral-700 font-medium flex items-center gap-2">
            <svg class="w-3.5 h-3.5 text-amber-700 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
            <span>{{ $chatPrivacy }}</span>
        </div>

        <!-- Messages Stream -->
        <div id="zimChatMessages" class="flex-1 overflow-y-auto p-4 space-y-3 bg-[#FFFDF5] min-h-[280px]">
            <!-- Initial Bot Bubble rendered via JS on load/reset -->
        </div>

        <!-- Quick Suggestion Chips -->
        <div id="zimChatQuickBar" class="px-3 py-2 bg-white border-t border-neutral-100 flex items-center gap-1.5 overflow-x-auto">
            @foreach ($quickPrompts as $qp)
                <button type="button"
                        data-prompt="{{ $qp['q'] }}"
                        class="zim-quick-chip whitespace-nowrap text-[11px] font-bold px-3 py-1.5 rounded-full bg-neutral-100 hover:bg-[#FECE00] text-neutral-800 hover:text-black border border-neutral-200 transition">
                    {{ $qp['label'] }}
                </button>
            @endforeach
        </div>

        <!-- Input Area -->
        <form id="zimChatForm" class="p-3 bg-white border-t border-neutral-200 flex items-center gap-2">
            <input type="text"
                   id="zimChatInput"
                   maxlength="500"
                   autocomplete="off"
                   placeholder="{{ $chatPlaceholder }}"
                   class="flex-1 px-3.5 py-2.5 text-xs font-medium text-black bg-neutral-50 border-2 border-neutral-200 rounded-2xl focus:outline-none focus:border-black focus:bg-white transition">
            <button type="submit"
                    id="zimChatSend"
                    class="bg-black hover:bg-[#FECE00] text-[#FECE00] hover:text-black font-black text-xs px-4 py-2.5 rounded-2xl transition shadow-sm flex items-center gap-1 flex-shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
            </button>
        </form>
    </div>

    <!-- Floating Launcher Button -->
    <button type="button"
            id="zimChatToggle"
            aria-expanded="false"
            aria-controls="zimChatPanel"
            class="group bg-black hover:bg-neutral-900 text-[#FECE00] border-2 border-[#FECE00] rounded-full shadow-2xl px-4 py-3 flex items-center gap-2.5 transition transform hover:scale-105 cursor-pointer">
        <span class="relative flex h-3 w-3">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#FECE00] opacity-75"></span>
            <span class="relative inline-flex rounded-full h-3 w-3 bg-[#FECE00]"></span>
        </span>
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
        <span class="hidden sm:inline text-xs font-black tracking-wide">{{ $chatTitle }}</span>
    </button>
</div>

<script>
(function () {
    const endpoint = @json(route('chatbot.message'));
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
    const welcomeText = @json($chatWelcome);

    const panel = document.getElementById('zimChatPanel');
    const toggleBtn = document.getElementById('zimChatToggle');
    const closeBtn = document.getElementById('zimChatClose');
    const resetBtn = document.getElementById('zimChatReset');
    const messagesEl = document.getElementById('zimChatMessages');
    const form = document.getElementById('zimChatForm');
    const input = document.getElementById('zimChatInput');
    const sendBtn = document.getElementById('zimChatSend');

    let lastSentAt = 0;
    let isBusy = false;

    function escapeHtml(str) {
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#39;');
    }

    function formatRichText(text) {
        let safe = escapeHtml(text);
        safe = safe.replace(/\*\*(.+?)\*\*/g, '<strong class="font-black text-black">$1</strong>');
        safe = safe.replace(/`([^`]+)`/g, '<code class="px-1.5 py-0.5 rounded bg-neutral-200/80 text-black font-mono text-[11px]">$1</code>');
        safe = safe.replace(/\n/g, '<br>');
        return safe;
    }

    function scrollBottom() {
        messagesEl.scrollTop = messagesEl.scrollHeight;
    }

    function appendMessage(role, text, links = []) {
        const wrap = document.createElement('div');
        wrap.className = role === 'user' ? 'flex justify-end' : 'flex justify-start';

        const bubble = document.createElement('div');
        if (role === 'user') {
            bubble.className = 'max-w-[82%] bg-black text-[#FECE00] text-xs font-semibold px-4 py-2.5 rounded-2xl rounded-br-sm shadow-xs leading-relaxed';
            bubble.textContent = text;
        } else {
            bubble.className = 'max-w-[88%] bg-white border border-neutral-200 text-neutral-800 text-xs px-4 py-3 rounded-2xl rounded-bl-sm shadow-xs leading-relaxed space-y-2.5';
            const body = document.createElement('div');
            body.innerHTML = formatRichText(text);
            bubble.appendChild(body);

            if (Array.isArray(links) && links.length > 0) {
                const linkRow = document.createElement('div');
                linkRow.className = 'flex flex-wrap gap-1.5 pt-1 border-t border-neutral-100';
                links.forEach(item => {
                    if (!item || !item.url || !item.label) return;
                    const a = document.createElement('a');
                    a.href = item.url;
                    a.className = 'inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-[11px] font-black bg-[#FECE00] hover:bg-black text-black hover:text-[#FECE00] transition';
                    a.textContent = item.label + ' →';
                    linkRow.appendChild(a);
                });
                bubble.appendChild(linkRow);
            }
        }

        wrap.appendChild(bubble);
        messagesEl.appendChild(wrap);
        scrollBottom();
    }

    function appendTyping() {
        const wrap = document.createElement('div');
        wrap.id = 'zimChatTyping';
        wrap.className = 'flex justify-start';
        wrap.innerHTML = '<div class="bg-white border border-neutral-200 px-4 py-2.5 rounded-2xl rounded-bl-sm text-xs text-neutral-500 font-bold flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-black animate-bounce"></span><span class="w-1.5 h-1.5 rounded-full bg-black animate-bounce" style="animation-delay:0.15s"></span><span class="w-1.5 h-1.5 rounded-full bg-black animate-bounce" style="animation-delay:0.3s"></span></div>';
        messagesEl.appendChild(wrap);
        scrollBottom();
    }

    function removeTyping() {
        document.getElementById('zimChatTyping')?.remove();
    }

    function initWelcome() {
        messagesEl.innerHTML = '';
        appendMessage('bot', welcomeText);
    }

    async function sendPrompt(text) {
        const cleaned = (text || '').trim();
        if (!cleaned || isBusy) return;

        const now = Date.now();
        if (now - lastSentAt < 1500) {
            return;
        }
        lastSentAt = now;
        isBusy = true;
        sendBtn.disabled = true;

        appendMessage('user', cleaned);
        input.value = '';
        appendTyping();

        try {
            const resp = await fetch(endpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify({ message: cleaned }),
            });

            removeTyping();

            if (resp.status === 429) {
                appendMessage('bot', 'Terlalu banyak pesan dalam waktu singkat. Mohon tunggu sebentar sebelum mengirim pesan kembali.');
            } else if (!resp.ok) {
                appendMessage('bot', 'Maaf, terjadi gangguan sementara saat memproses pesan. Silakan coba lagi atau buka Tiket Bantuan.');
            } else {
                const data = await resp.json();
                appendMessage('bot', data.reply || 'Maaf, tidak ada respons.', data.links || []);
            }
        } catch (err) {
            removeTyping();
            appendMessage('bot', 'Koneksi terputus sementara. Silakan periksa jaringan Anda dan coba kembali.');
        } finally {
            isBusy = false;
            sendBtn.disabled = false;
            input.focus();
        }
    }

    function togglePanel(forceOpen = null) {
        const shouldOpen = forceOpen !== null ? forceOpen : panel.classList.contains('hidden');
        panel.classList.toggle('hidden', !shouldOpen);
        toggleBtn.setAttribute('aria-expanded', shouldOpen ? 'true' : 'false');
        if (shouldOpen) {
            setTimeout(() => input.focus(), 50);
            scrollBottom();
        }
    }

    toggleBtn?.addEventListener('click', () => togglePanel());
    closeBtn?.addEventListener('click', () => togglePanel(false));
    resetBtn?.addEventListener('click', initWelcome);

    form?.addEventListener('submit', (e) => {
        e.preventDefault();
        sendPrompt(input.value);
    });

    document.querySelectorAll('.zim-quick-chip').forEach(btn => {
        btn.addEventListener('click', () => {
            const q = btn.getAttribute('data-prompt');
            if (q) sendPrompt(q);
        });
    });

    initWelcome();
})();
</script>

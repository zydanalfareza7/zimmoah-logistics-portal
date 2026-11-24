<?php

namespace App\Http\Controllers;

use App\Models\JobPosting;
use App\Models\Office;
use App\Models\Schedule;
use App\Models\Shipment;
use App\Models\Ticket;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    public function message(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'message' => ['required', 'string', 'max:500'],
        ]);

        $rawMessage = trim(strip_tags($validated['message']));
        if ($rawMessage === '') {
            return response()->json([
                'reply' => $this->txt(
                    'Silakan ketik pertanyaan seputar layanan, jadwal, pelacakan kargo, atau kontak PT. Zimmoah Marine Trans.',
                    'Please type a question about Zimmoah services, schedules, cargo tracking, or contacts.',
                    '짐모아 서비스, 운항 스케줄, 화물 추적 또는 연락처에 대해 질문해 주세요.'
                ),
                'links' => [],
                'mode' => 'local',
            ]);
        }

        $lower = mb_strtolower($rawMessage, 'UTF-8');

        // 1. Prompt injection / abuse guard
        if ($this->isPromptInjection($lower)) {
            return response()->json([
                'reply' => $this->txt(
                    'Maaf, saya adalah asisten resmi PT. Zimmoah Marine Trans yang hanya membantu informasi publik seputar layanan logistik, jadwal, pelacakan kargo, karir, dan kontak perusahaan.',
                    'Sorry, I am the official PT. Zimmoah Marine Trans assistant and can only help with public logistics services, schedules, cargo tracking, careers, and company contacts.',
                    '죄송합니다. 저는 PT. Zimmoah Marine Trans 공식 어시스턴트로서 물류 서비스, 스케줄, 화물 추적, 채용 및 지점 안내만 도와드릴 수 있습니다.'
                ),
                'links' => [
                    ['label' => $this->txt('Buka Tiket Bantuan', 'Open Support Ticket', '고객 지원 티켓 열기'), 'url' => route('tickets.create')],
                ],
                'mode' => 'guard',
            ]);
        }

        // 2. Direct live tracking detection (ZIM-CARGO-..., ZIM-AIR-..., ZIMU-..., ZIM-YYYY-...)
        if ($trackingReply = $this->handleTracking($rawMessage, $lower)) {
            return response()->json($trackingReply);
        }

        // 3. Direct Trucking 30-city route lookup
        if ($cityReply = $this->handleTruckingCity($lower)) {
            return response()->json($cityReply);
        }

        // 4. Live Shipping Schedules
        if ($this->matchesAny($lower, ['jadwal', 'schedule', 'kapal', 'vessel', 'pesawat', 'etd', 'eta', 'busan', 'incheon', 'seoul', 'singapore', 'pelayaran', '스케줄', '선박', '운항'])) {
            return response()->json($this->handleSchedules($lower));
        }

        // 5. Careers / Active Job Vacancies
        if ($this->matchesAny($lower, ['lowongan', 'karir', 'career', 'loker', 'lamar', 'kerja', 'rekrutmen', 'cv', '채용', '구인', '입사'])) {
            return response()->json($this->handleCareers());
        }

        // 6. Staff PIC / Department Directory lookup
        if ($picReply = $this->handleDirectoryPic($lower)) {
            return response()->json($picReply);
        }

        // 7. Specific Services (Trucking / Warehousing / Forwarding / Consolidation)
        if ($this->matchesAny($lower, ['trucking', 'truk', 'armada', 'trailer', 'fleet', 'darat', '내륙운송', '트럭'])) {
            return response()->json($this->handleTruckingOverview());
        }

        if ($this->matchesAny($lower, ['warehousing', 'warehouse', 'gudang', 'vmi', 'fifo', 'iso 9001', 'bonded', 'berikat', 'rlc', '창고', '보세'])) {
            return response()->json($this->handleWarehousing());
        }

        if ($this->matchesAny($lower, ['lcl', 'konsolidasi', 'consolidation', 'cfs', 'cbm', '혼적', '소량화물'])) {
            return response()->json($this->handleConsolidation());
        }

        if ($this->matchesAny($lower, ['forwarding', 'fcl', 'ekspor', 'impor', 'export', 'import', 'ocean', 'air freight', 'kargo laut', 'kargo udara', '포워딩', '해상', '항공'])) {
            return response()->json($this->handleForwarding());
        }

        // 8. Company Info (CEO, History, CIP Logo, License, Org Chart, Branches, Contact)
        if ($companyReply = $this->handleCompanyInfo($lower)) {
            return response()->json($companyReply);
        }

        // 9. Quote / Pricing / Support Ticket
        if ($this->matchesAny($lower, ['harga', 'tarif', 'ongkir', 'biaya', 'quote', 'penawaran', 'tiket', 'ticket', 'bantuan', 'komplain', 'keluhan', 'inquiry', '견적', '운임', '티켓', '문의'])) {
            return response()->json([
                'reply' => $this->txt(
                    "Untuk permintaan penawaran tarif (FCL, LCL, Air Freight, Trucking, atau Warehousing) maupun kendala pengiriman, Anda dapat langsung membuat **Tiket Inquiry** tanpa perlu login.\n\nTim operasional kami akan menindaklanjuti dan Anda akan mendapatkan nomor referensi unik (format `ZIM-YYYY-XXXXX`) untuk melacak progresnya.",
                    "For cargo rate quotations (FCL, LCL, Air Freight, Trucking, or Warehousing) or shipment support, please open an **Inquiry Ticket** — no account required.\n\nYou will receive a unique tracking code (`ZIM-YYYY-XXXXX`) to follow up directly with our operations team.",
                    "운임 견적(FCL, LCL, 항공, 내륙운송, 창고) 또는 배송 문의는 회원가입 없이 바로 **문의 티켓**을 등록하실 수 있습니다. 접수 즉시 고유 코드(`ZIM-YYYY-XXXXX`)가 발급됩니다."
                ),
                'links' => [
                    ['label' => $this->txt('Buat Tiket Inquiry', 'Open Inquiry Ticket', '문의 티켓 등록'), 'url' => route('tickets.create')],
                    ['label' => $this->txt('Lacak Status Tiket', 'Track Existing Ticket', '티켓 조회'), 'url' => route('tickets.lookup')],
                ],
                'mode' => 'local',
            ]);
        }

        // 10. Greeting / Thanks
        if ($this->matchesAny($lower, ['halo', 'hai', 'hello', 'hi ', 'pagi', 'siang', 'sore', 'malam', 'permisi', 'assalam', 'terima kasih', 'makasih', 'thanks', 'thank you', '안녕', '감사'])) {
            return response()->json([
                'reply' => $this->txt(
                    "Halo! Saya **Zimmoah Assistant** dari PT. Zimmoah Marine Trans (berdiri sejak 1989). Saya bisa membantu Anda:\n• Melacak kargo real-time (coba ketik `ZIM-CARGO-9042`)\n• Cek jadwal kapal & pesawat\n• Cek jarak & waktu trucking 30 kota Jawa–Bali (misal: `jarak ke Bandung`)\n• Info layanan, cabang, kontak PIC, lowongan kerja, & tiket inquiry.",
                    "Hello! I am **Zimmoah Assistant** from PT. Zimmoah Marine Trans (Est. 1989). I can help you:\n• Track live cargo milestones (try typing `ZIM-CARGO-9042`)\n• Check upcoming ocean & air schedules\n• Look up 30 Java–Bali trucking routes & 82 owned fleet units\n• Find branch offices, department PICs, careers, and inquiry tickets.",
                    "안녕하세요! **PT. Zimmoah Marine Trans (1989년 설립)** 공식 어시스턴트입니다.\n• 실시간 화물 추적 (`ZIM-CARGO-9042` 입력)\n• 해상/항공 운항 스케줄 조회\n• 내륙운송 30개 도시 거리/시간 및 보유 차량 안내\n• 지점 위치, 담당부서 연락처, 채용 및 문의 티켓 안내를 도와드립니다."
                ),
                'links' => [
                    ['label' => $this->txt('Lacak Kargo', 'Track Cargo', '화물 추적'), 'url' => route('tracking')],
                    ['label' => $this->txt('Jadwal Kapal', 'Schedules', '운항 스케줄'), 'url' => route('schedules.index')],
                    ['label' => $this->txt('Buka Tiket', 'Open Ticket', '문의 티켓'), 'url' => route('tickets.create')],
                ],
                'mode' => 'local',
            ]);
        }

        // 11. Optional Google Gemini AI fallback (if GEMINI_API_KEY is configured in .env)
        if ($geminiReply = $this->askGemini($rawMessage)) {
            return response()->json([
                'reply' => $geminiReply,
                'links' => [
                    ['label' => $this->txt('Buka Tiket Bantuan', 'Open Support Ticket', '문의 티켓 등록'), 'url' => route('tickets.create')],
                    ['label' => $this->txt('Direktori Kontak PIC', 'Contact Directory', '담당부서 연락처'), 'url' => route('contact')],
                ],
                'mode' => 'gemini',
            ]);
        }

        // 12. Polite fallback guiding to relevant Zimmoah features
        return response()->json([
            'reply' => $this->txt(
                "Maaf, saya belum menemukan informasi spesifik untuk pertanyaan tersebut. Saya dapat membantu seputar **pelacakan kargo**, **jadwal kapal/pesawat**, **layanan Forwarding/Warehousing/Trucking/LCL**, **kontak cabang & PIC**, **profil & logo CIP**, serta **lowongan kerja**.\n\nUntuk pertanyaan khusus atau permintaan penawaran, silakan buka Tiket Inquiry agar tim operasional Zimmoah dapat langsung membantu Anda.",
                "I couldn't find an exact match for that question. I specialize in **cargo tracking**, **shipping schedules**, **Forwarding / Warehousing / Trucking / LCL**, **branch offices & PIC contacts**, **company profile & CIP**, and **careers**.\n\nFor tailored inquiries, please submit a Support Ticket so our team can assist you directly.",
                "죄송합니다. 해당 질문에 대한 정확한 정보를 찾지 못했습니다. **화물 추적**, **운항 스케줄**, **포워딩/창고/내륙운송/LCL**, **지점 및 담당부서 연락처**, **채용 정보**에 대해 질문해 주시거나 문의 티켓을 등록해 주세요."
            ),
            'links' => [
                ['label' => $this->txt('Buka Tiket Inquiry', 'Open Inquiry Ticket', '문의 티켓 등록'), 'url' => route('tickets.create')],
                ['label' => $this->txt('Kontak Cabang & PIC', 'Branches & PIC', '지점 및 담당자'), 'url' => route('contact')],
            ],
            'mode' => 'local',
        ]);
    }

    private function handleTracking(string $raw, string $lower): ?array
    {
        // Match explicit tracking / container / AWB / ticket patterns
        $code = null;
        if (preg_match('/\b(ZIM-(?:CARGO|AIR|LAND|\d{4})-[A-Z0-9]+|ZIMU-\d+|\d{3}-\d{8})\b/i', $raw, $m)) {
            $code = strtoupper($m[1]);
        }

        if ($code !== null) {
            $shipment = Shipment::whereRaw('UPPER(tracking_number) = ?', [$code])
                ->orWhereRaw('UPPER(container_or_awb) = ?', [$code])
                ->first();

            if ($shipment) {
                $stageLabel = $shipment->current_stage->label();
                $step = $shipment->current_stage->stepNumber();
                $pct = $shipment->progressPercent();
                $eta = $shipment->estimated_arrival ? $shipment->estimated_arrival->format('d M Y, H:i') : '-';

                return [
                    'reply' => $this->txt(
                        "📦 **Status Kargo `{$shipment->tracking_number}`**\n• Kontainer/AWB: `{$shipment->container_or_awb}`\n• Rute: {$shipment->origin_port} → {$shipment->destination_port}\n• Kapal/Penerbangan: {$shipment->vessel_or_flight}\n• Tahap Saat Ini: **{$stageLabel}** (Step {$step}/5 — {$pct}%)\n• Estimasi Tiba (ETA): {$eta}",
                        "📦 **Cargo Status `{$shipment->tracking_number}`**\n• Container/AWB: `{$shipment->container_or_awb}`\n• Route: {$shipment->origin_port} → {$shipment->destination_port}\n• Vessel/Flight: {$shipment->vessel_or_flight}\n• Current Stage: **{$stageLabel}** (Step {$step}/5 — {$pct}%)\n• Estimated Arrival (ETA): {$eta}",
                        "📦 **화물 추적 결과 `{$shipment->tracking_number}`**\n• 컨테이너/AWB: `{$shipment->container_or_awb}`\n• 노선: {$shipment->origin_port} → {$shipment->destination_port}\n• 선박/항공편: {$shipment->vessel_or_flight}\n• 현재 단계: **{$stageLabel}** (Step {$step}/5 — {$pct}%)\n• 도착 예정(ETA): {$eta}"
                    ),
                    'links' => [
                        ['label' => $this->txt('Lihat Milestone Lengkap', 'View Full Milestone', '상세 이력 보기'), 'url' => route('tracking', ['tracking_number' => $shipment->tracking_number])],
                    ],
                    'mode' => 'live-db',
                ];
            }

            if (preg_match('/^ZIM-\d{4}-/', $code) || Ticket::whereRaw('UPPER(ticket_code) = ?', [$code])->exists()) {
                return [
                    'reply' => $this->txt(
                        "🎫 Nomor `{$code}` terdeteksi sebagai **Tiket Bantuan Pelanggan**. Demi privasi data, silakan verifikasi melalui halaman Pelacakan Tiket menggunakan email atau token akses Anda.",
                        "🎫 `{$code}` is a **Customer Support Ticket**. For privacy protection, please verify using your email or access token on the Ticket Lookup page.",
                        "🎫 `{$code}` 번호는 **고객 지원 티켓**입니다. 개인정보 보호를 위해 티켓 조회 페이지에서 이메일 또는 토큰으로 확인해 주세요."
                    ),
                    'links' => [
                        ['label' => $this->txt('Buka Pelacakan Tiket', 'Open Ticket Lookup', '티켓 조회 페이지'), 'url' => route('tickets.track', ['code' => $code])],
                    ],
                    'mode' => 'live-db',
                ];
            }

            return [
                'reply' => $this->txt(
                    "Nomor referensi `{$code}` belum ditemukan pada sistem kargo aktif kami. Pastikan format nomor resi/kontainer/AWB sudah benar, atau coba nomor sampel seperti `ZIM-CARGO-9042` / `ZIM-AIR-8821`.",
                    "Reference `{$code}` was not found in our active shipments. Please verify the number or try sample tracking `ZIM-CARGO-9042` / `ZIM-AIR-8821`.",
                    "`{$code}` 번호가 활성 화물 시스템에서 조회되지 않았습니다. 번호를 확인하시거나 샘플 번호(`ZIM-CARGO-9042`)로 테스트해 보세요."
                ),
                'links' => [
                    ['label' => $this->txt('Halaman Tracking', 'Tracking Page', '화물 추적 페이지'), 'url' => route('tracking')],
                    ['label' => $this->txt('Tanya Tim Support', 'Ask Support Team', '지원팀 문의'), 'url' => route('tickets.create')],
                ],
                'mode' => 'live-db',
            ];
        }

        if ($this->matchesAny($lower, ['lacak', 'tracking', 'resi', 'awb', 'kontainer', 'container', 'cek kiriman', 'posisi kargo', '화물 추적', '배송 조회'])) {
            $samples = Shipment::latest()->take(2)->pluck('tracking_number')->all();
            $sampleText = $samples ? implode('` atau `', $samples) : 'ZIM-CARGO-9042';

            return [
                'reply' => $this->txt(
                    "Untuk melacak kargo secara langsung di chat ini, cukup ketik nomor resi atau nomor kontainer/AWB Anda.\n\nContoh yang bisa langsung dicoba sekarang: `{$sampleText}`.",
                    "To track your shipment right here, simply type your tracking number, container number, or AWB.\n\nSample numbers you can try: `{$sampleText}`.",
                    "이 채팅창에 송장 번호, 컨테이너 번호 또는 AWB 번호를 바로 입력하시면 실시간 상태를 조회해 드립니다.\n\n예시: `{$sampleText}`"
                ),
                'links' => [
                    ['label' => $this->txt('Buka Halaman Tracking', 'Open Tracking Page', '화물 추적 페이지'), 'url' => route('tracking')],
                ],
                'mode' => 'live-db',
            ];
        }

        return null;
    }

    private function handleSchedules(string $lower): array
    {
        $query = Schedule::query()->orderBy('departure_time', 'asc');
        if (str_contains($lower, 'air') || str_contains($lower, 'udara') || str_contains($lower, 'pesawat') || str_contains($lower, '항공')) {
            $query->where('transport_mode', 'AIR');
        } elseif (str_contains($lower, 'sea') || str_contains($lower, 'laut') || str_contains($lower, 'kapal') || str_contains($lower, '해상')) {
            $query->where('transport_mode', 'SEA');
        }

        foreach (['busan', 'incheon', 'seoul', 'singapore', 'semarang', 'jakarta'] as $port) {
            if (str_contains($lower, $port)) {
                $query->where(function ($q) use ($port) {
                    $q->where('origin_port', 'LIKE', "%{$port}%")
                      ->orWhere('destination_port', 'LIKE', "%{$port}%");
                });
                break;
            }
        }

        $items = $query->take(4)->get();
        if ($items->isEmpty()) {
            $items = Schedule::orderBy('departure_time', 'asc')->take(3)->get();
        }

        $lines = [];
        foreach ($items as $item) {
            $etd = $item->departure_time ? $item->departure_time->format('d M Y H:i') : '-';
            $lines[] = "• **{$item->carrier_vessel_name}** ({$item->transport_mode}) — {$item->origin_port} → {$item->destination_port} | ETD: {$etd}";
        }

        $list = implode("\n", $lines);

        return [
            'reply' => $this->txt(
                "🚢 **Jadwal Pelayaran & Kargo Udara Terdekat:**\n{$list}\n\nAnda juga dapat memfilter rute lengkap atau mengunduh brosur **Zimmoah Weekly Schedule PDF** di halaman Schedules.",
                "🚢 **Upcoming Ocean & Air Schedules:**\n{$list}\n\nFilter all routes or download the official **Zimmoah Weekly Schedule PDF** on the Schedules page.",
                "🚢 **예정된 해상/항공 운항 스케줄:**\n{$list}\n\n스케줄 페이지에서 전체 노선 검색 및 공식 **주간 스케줄 PDF** 다운로드가 가능합니다."
            ),
            'links' => [
                ['label' => $this->txt('Lihat Semua Jadwal', 'View All Schedules', '전체 스케줄 보기'), 'url' => route('schedules.index')],
                ['label' => 'Download Schedule PDF', 'url' => asset(config('zimmoah.documents.schedule_pdf'))],
            ],
            'mode' => 'live-db',
        ];
    }

    private function handleTruckingCity(string $lower): ?array
    {
        $routes = config('zimmoah.trucking_routes', []);
        foreach ($routes as $r) {
            $cityLower = mb_strtolower($r['city'], 'UTF-8');
            $cleanCity = trim(str_replace('hub ', '', $cityLower));
            if (mb_strlen($cleanCity) >= 4 && str_contains($lower, $cleanCity)) {
                // Avoid colliding with generic "jakarta" office address questions unless trucking/distance context exists
                if (in_array($cleanCity, ['jakarta', 'semarang'], true) && ! $this->matchesAny($lower, ['jarak', 'waktu', 'lama', 'jam', 'km', 'rute', 'trucking', 'truk', 'kirim', 'darat', 'distance', 'route', '거리', '운송'])) {
                    continue;
                }

                return [
                    'reply' => $this->txt(
                        "🚛 **Rute Trucking — {$r['city']}**\n• Jarak tempuh: **{$r['distance']}**\n• Estimasi waktu perjalanan: **{$r['time']}**\n• Layanan: Jadwal rutin point-to-point dari Hub Jakarta, Hub Semarang, dan Hub Surabaya dengan 82 unit armada milik sendiri.",
                        "🚛 **Inland Trucking Route — {$r['city']}**\n• Distance: **{$r['distance']}**\n• Estimated transit time: **{$r['time']}**\n• Regular point-to-point fleet from Hub Jakarta, Semarang, and Surabaya (82 owned units).",
                        "🚛 **내륙운송 노선 — {$r['city']}**\n• 거리: **{$r['distance']}**\n• 예상 소요 시간: **{$r['time']}**\n• 자카르타·스마랑·수라바야 허브에서 자체 보유 차량 82대로 정시 운송합니다."
                    ),
                    'links' => [
                        ['label' => $this->txt('Peta & 30 Kota Trucking', 'Trucking Map & 30 Cities', '내륙운송 노선도'), 'url' => route('services.trucking')],
                        ['label' => $this->txt('Pesan Armada', 'Book Trucking Fleet', '차량 예약 문의'), 'url' => route('tickets.create')],
                    ],
                    'mode' => 'live-db',
                ];
            }
        }

        return null;
    }

    private function handleTruckingOverview(): array
    {
        $fleet = config('zimmoah.fleet', []);
        $total = collect($fleet)->sum('count');
        $summary = collect($fleet)->map(fn ($f) => "• {$f['equipment']}: **{$f['quantity']}** ({$f['remarks']})")->implode("\n");

        return [
            'reply' => $this->txt(
                "🚛 **Armada Inland Trucking Zimmoah (Total {$total} Unit):**\n{$summary}\n\nMelayani 30 kota lintas Jawa & Bali dari Hub Jakarta, Semarang, dan Surabaya (hingga Denpasar 420 km / 12 jam).",
                "🚛 **Zimmoah Owned Trucking Fleet ({$total} Units Total):**\n{$summary}\n\nCovering 30 cities across Java & Bali from Hub Jakarta, Semarang, and Surabaya.",
                "🚛 **짐모아 자체 보유 내륙운송 장비 (총 {$total}대):**\n{$summary}\n\n자카르타·스마랑·수라바야 허브에서 자바 전역 및 발리 30개 도시를 연결합니다."
            ),
            'links' => [
                ['label' => $this->txt('Detail Trucking & Peta', 'Trucking & Route Map', '내륙운송 자세히 보기'), 'url' => route('services.trucking')],
            ],
            'mode' => 'live-db',
        ];
    }

    private function handleWarehousing(): array
    {
        return [
            'reply' => $this->txt(
                "🏭 **Fasilitas Warehousing & Bonded Storage Zimmoah:**\n• Luas area: **Lahan 18.000 m²** / **Bangunan 15.500 m²**\n• Layanan inti: **VMI (Vendor Management Inventory)**, Gudang Berikat (GB & PLB melalui afiliasi PT. RLC Indonesia), dan Customs Clearance (PPJK)\n• Standar operasional: Sistem **FIFO**, sertifikasi **ISO 9001**, manajemen **ERP**, serta ruang khusus **A/C, I/C, dan Refrigerator**.",
                "🏭 **Zimmoah Warehousing & Bonded Storage:**\n• Capacity: **18,000 m² Land** / **15,500 m² Building**\n• Core Services: **VMI (Vendor Management Inventory)**, Bonded Warehouse (GB & PLB via PT. RLC Indonesia), & Customs Brokerage\n• Standards: **FIFO**, **ISO 9001** Quality Certificate, **ERP** management, plus **A/C, I/C & Refrigerator** rooms.",
                "🏭 **짐모아 보세창고 및 VMI 물류센터:**\n• 규모: **토지 18,000 m² / 건물 15,500 m²**\n• 서비스: **VMI(Vendor Management Inventory)**, 보세창고(PT. RLC Indonesia GB & PLB), 통관 대행\n• 강점: **FIFO** 선입선출, **ISO 9001** 인증, **ERP** 전산 관리, 항온/항습(A/C·I/C) 및 냉장 보관."
            ),
            'links' => [
                ['label' => $this->txt('Detail Warehousing', 'Warehousing Details', '보세창고 자세히 보기'), 'url' => route('services.warehousing')],
            ],
            'mode' => 'local',
        ];
    }

    private function handleForwarding(): array
    {
        return [
            'reply' => $this->txt(
                "🚢✈️ **Layanan Air & Ocean Freight Forwarding Zimmoah:**\n• **Ocean Freight**: FCL (20ft, 40ft, 40HC, Reefer) & LCL konsolidasi mingguan ke Busan, Incheon, Shanghai, Singapore, hingga AS/Eropa.\n• **Air Freight**: Express Air Cargo dari Bandara Soekarno-Hatta (CGK), DGR, & kargo sensitif suhu.\n• Termasuk **Customs Clearance (PEB/PIB)**, **Door-to-Door**, dan **Project Cargo**.",
                "🚢✈️ **Zimmoah Air & Ocean Freight Forwarding:**\n• **Ocean Freight**: FCL (20ft/40ft/40HC/Reefer) & weekly LCL consolidation to Busan, Incheon, Shanghai, Singapore, and worldwide.\n• **Air Freight**: Express cargo via Soekarno-Hatta (CGK), DGR & temperature-controlled handling.\n• Full **Customs Clearance**, **Door-to-Door**, and **Project Cargo**.",
                "🚢✈️ **짐모아 해상·항공 포워딩 서비스:**\n• **해상 운송**: FCL(20'/40'/40HC/Reefer) 및 부산·인천·상하이·싱가포르 정기 LCL 콘솔\n• **항공 운송**: 수카르노하타 공항(CGK) 특화 항공 화물 및 특수화물 처리\n• 통관 대행, Door-to-Door 및 프로젝트 화물 일괄 지원."
            ),
            'links' => [
                ['label' => $this->txt('Detail Forwarding', 'Forwarding Details', '포워딩 자세히 보기'), 'url' => route('services.forwarding')],
                ['label' => $this->txt('Cek Jadwal Kapal', 'Check Schedules', '스케줄 조회'), 'url' => route('schedules.index')],
            ],
            'mode' => 'local',
        ];
    }

    private function handleConsolidation(): array
    {
        return [
            'reply' => $this->txt(
                "📦 **Layanan Consolidation (LCL Hub) Mingguan:**\nDari hub **Jakarta & Surabaya** dengan jadwal *stuffing* tetap setiap minggu menuju:\n• **Hong Kong** (2x seminggu) & **Busan** (2x seminggu)\n• **Ho Chi Minh**, **Shanghai**, & **LA – New York** (mingguan)\nPerhitungan CBM transparan tanpa biaya *transshipment* ganda.",
                "📦 **Weekly LCL Cargo Consolidation:**\nFixed weekly stuffing schedules from **Jakarta & Surabaya Hub** to:\n• **Hong Kong** (2x/week) & **Busan** (2x/week)\n• **Ho Chi Minh**, **Shanghai**, & **LA – New York** (weekly)\nTransparent CBM pricing with direct console boxes.",
                "📦 **정기 LCL 소량화물 혼적 서비스:**\n**자카르타 / 수라바야 허브**에서 매주 정기 선적:\n• **홍콩** (주 2회), **부산** (주 2회)\n• **호치민**, **상하이**, **LA–뉴욕** (주 1회)\n합리적인 CBM 운임과 신속한 직항 콘솔 서비스를 제공합니다."
            ),
            'links' => [
                ['label' => $this->txt('Detail Consolidation & Diagram', 'Consolidation & Diagram', 'LCL 혼적 자세히 보기'), 'url' => route('services.consolidation')],
            ],
            'mode' => 'local',
        ];
    }

    private function handleCareers(): array
    {
        $jobs = JobPosting::where('is_active', true)->with('office')->latest()->take(5)->get();
        if ($jobs->isEmpty()) {
            return [
                'reply' => $this->txt(
                    'Saat ini belum ada posisi lowongan aktif. Silakan pantau halaman Karir kami secara berkala.',
                    'There are currently no active job openings. Please check our Careers page again soon.',
                    '현재 진행 중인 채용 공고가 없습니다. 채용 페이지를 수시로 확인해 주세요.'
                ),
                'links' => [['label' => $this->txt('Halaman Karir', 'Careers Page', '채용 페이지'), 'url' => route('career.index')]],
                'mode' => 'live-db',
            ];
        }

        $lines = $jobs->map(function ($job) {
            $loc = $job->office ? $job->office->city : 'Indonesia';
            return "• **{$job->title}** ({$job->department} — {$loc})";
        })->implode("\n");

        return [
            'reply' => $this->txt(
                "💼 **Lowongan Kerja Aktif di PT. Zimmoah Marine Trans ({$jobs->count()} posisi):**\n{$lines}\n\nAnda dapat langsung melihat kualifikasi dan mengunggah CV (PDF/DOC/DOCX maks. 5 MB) secara aman di halaman Karir.",
                "💼 **Active Job Openings at PT. Zimmoah Marine Trans ({$jobs->count()} positions):**\n{$lines}\n\nView full requirements and upload your CV securely on our Careers portal.",
                "💼 **현재 채용 중인 포지션 ({$jobs->count()}건):**\n{$lines}\n\n채용 페이지에서 상세 자격 요건 확인 및 이력서(CV) 온라인 지원이 가능합니다."
            ),
            'links' => [
                ['label' => $this->txt('Lihat Semua Lowongan', 'Browse All Jobs', '채용 공고 보기'), 'url' => route('career.index')],
            ],
            'mode' => 'live-db',
        ];
    }

    private function handleDirectoryPic(string $lower): ?array
    {
        $directory = config('zimmoah.directory', []);
        $matched = [];

        foreach ($directory as $group) {
            foreach ($group['departments'] as $dept => $members) {
                $deptLower = mb_strtolower($dept, 'UTF-8');
                $deptHit = str_contains($lower, $deptLower)
                    || (str_contains($deptLower, 'sea export') && $this->matchesAny($lower, ['sea export', 'ekspor laut']))
                    || (str_contains($deptLower, 'sea import') && $this->matchesAny($lower, ['sea import', 'impor laut']))
                    || (str_contains($deptLower, 'air export') && $this->matchesAny($lower, ['air export', 'ekspor udara']))
                    || (str_contains($deptLower, 'air import') && $this->matchesAny($lower, ['air import', 'impor udara']))
                    || (str_contains($deptLower, 'accounting') && $this->matchesAny($lower, ['accounting', 'keuangan', 'invoice', 'tagihan', '회계']))
                    || (str_contains($deptLower, 'customer service') && $this->matchesAny($lower, ['customer service', 'cs ', 'layanan pelanggan']))
                    || (str_contains($deptLower, 'surabaya') && str_contains($lower, 'surabaya'))
                    || (str_contains($deptLower, 'ho chi minh') && $this->matchesAny($lower, ['ho chi minh', 'hcmc', 'vietnam']))
                    || (str_contains($deptLower, 'rlc') && str_contains($lower, 'rlc'));

                if ($deptHit) {
                    foreach ($members as $m) {
                        $matched[] = "• **{$dept}** — {$m['name']} ({$m['position']}) | {$m['email']} | {$m['tel']}";
                    }
                }
            }
        }

        if (! empty($matched)) {
            $list = implode("\n", array_slice($matched, 0, 6));
            return [
                'reply' => $this->txt(
                    "📞 **Kontak PIC Departemen Terkait:**\n{$list}",
                    "📞 **Department PIC Contacts:**\n{$list}",
                    "📞 **해당 부서 담당자 연락처:**\n{$list}"
                ),
                'links' => [
                    ['label' => $this->txt('Buka Direktori Lengkap', 'Full Contact Directory', '전체 담당부서 연락처'), 'url' => route('contact')],
                ],
                'mode' => 'live-db',
            ];
        }

        return null;
    }

    private function handleCompanyInfo(string $lower): ?array
    {
        if ($this->matchesAny($lower, ['ceo', 'jason', 'sambutan', 'greeting', 'direktur', '인사말'])) {
            return [
                'reply' => $this->txt(
                    "👔 **Sambutan CEO — Jason Lee (이지현)**\nPT. Zimmoah Marine Trans berdiri sejak **1989** di Indonesia dengan 3 semboyan utama: *tujuan yang kokoh*, *semangat & dinamis*, serta *gigih & bertanggung jawab*.",
                    "👔 **CEO Message — Jason Lee (이지현)**\nPT. Zimmoah Marine Trans has served Indonesia and global trade partners since **1989** with strong ocean, air, TPL, consolidation, trucking, and bonded warehouse networks.",
                    "👔 **CEO 인사말 — 이지현 대표이사 (Jason Lee)**\n1989년 설립 이래 30여 년간 글로벌 네트워크와 자체 물류 인프라로 고객 가치를 창출하는 물류 선도기업 짐모아입니다."
                ),
                'links' => [
                    ['label' => $this->txt('Baca Sambutan CEO', 'Read CEO Message', 'CEO 인사말 보기'), 'url' => route('company.ceo')],
                ],
                'mode' => 'local',
            ];
        }

        if ($this->matchesAny($lower, ['sejarah', 'history', 'berdiri', 'tahun', '1989', '연혁'])) {
            return [
                'reply' => $this->txt(
                    "🏛️ **Sejarah Singkat PT. Zimmoah Marine Trans:**\n• **1989**: Didirikan di Jakarta\n• **2005–2007**: Pendirian afiliasi SK Logistics (TPL) & Line Network Logistics (Trucking)\n• **2009–2013**: Ekspansi Airport Office (CGK), Surabaya, Gedung Pusat Kelapa Gading, & Semarang\n• **2014–2018**: Cabang Vietnam (Ho Chi Minh & Hanoi), pembaruan CI, akuisisi gudang berikat PT. RLC Indonesia, & PT. Cargobus Samudera Indonesia.",
                    "🏛️ **Company History Highlights:**\n• **1989**: Founded PT. Zimmoah Marine Trans in Jakarta\n• **2005–2007**: Established SK Logistics (TPL) & Line Network Logistics (Trucking)\n• **2009–2013**: Expanded to Soekarno-Hatta Airport, Surabaya, New HQ, & Semarang\n• **2014–2018**: Launched Vietnam branches (HCMC & Hanoi), CI renewal, acquired PT. RLC bonded warehouse, & PT. Cargobus Samudera Indonesia.",
                    "🏛️ **짐모아 주요 연혁:**\n• **1989**: 자카르타 본사 설립\n• **2005–2007**: SK 로지스틱스(TPL) & Line네트워크(내륙운송) 설립\n• **2009–2013**: 공항사무실·수라바야·본사 사옥·스마랑 지점 확장\n• **2014–2018**: 베트남(호치민/하노이) 진출, CI 리뉴얼, RLC 보세창고 인수."
                ),
                'links' => [['label' => $this->txt('Lihat Timeline Lengkap', 'Full History Timeline', '회사 연혁 보기'), 'url' => route('company.history')]],
                'mode' => 'local',
            ];
        }

        if ($this->matchesAny($lower, ['cip', 'logo', 'brand', 'wordmark', 'signature', '로고'])) {
            return [
                'reply' => $this->txt(
                    "🎨 **Identitas Perusahaan (CIP) & Unduh Logo Resmi**\nAnda dapat melihat panduan Wordmark/Signature serta mengunduh paket logo resmi Zimmoah dalam format **.AI (Vector)**, **.ZIP JPG**, dan **.ZIP PNG** di halaman CIP.",
                    "🎨 **Corporate Identity (CIP) & Official Logo Pack**\nView Zimmoah's Wordmark & Signature manual and download official **.AI**, **.ZIP JPG**, and **.ZIP PNG** logo packs on the CIP page.",
                    "🎨 **CIP 및 공식 로고 다운로드**\n워드마크/시그니처 가이드와 원본 로고 파일(.AI, JPG, PNG)을 CIP 페이지에서 바로 다운로드하실 수 있습니다."
                ),
                'links' => [['label' => $this->txt('Buka Halaman CIP & Logo', 'Open CIP & Logo Downloads', 'CIP 페이지 열기'), 'url' => route('company.cip')]],
                'mode' => 'local',
            ];
        }

        if ($this->matchesAny($lower, ['lisensi', 'license', 'asosiasi', 'alfi', 'iata', 'sertifikat', '라이센스', '협회'])) {
            return [
                'reply' => $this->txt(
                    "📜 PT. Zimmoah Marine Trans terdaftar pada asosiasi logistik resmi (**ALFI/ILFA, FIATA, IATA**) serta berstatus **Official Aircargo Agency** dari maskapai mitra internasional.",
                    "📜 PT. Zimmoah Marine Trans holds official logistics association memberships (**ALFI/ILFA, FIATA, IATA**) and **Official Aircargo Agency** accreditations.",
                    "📜 짐모아는 공식 물류 협회 가입 및 주요 항공사 공식 항공화물 에이전시 자격을 보유하고 있습니다."
                ),
                'links' => [['label' => $this->txt('Lihat Lisensi & Asosiasi', 'License & Association', '라이센스 및 협회'), 'url' => route('company.license')]],
                'mode' => 'local',
            ];
        }

        if ($this->matchesAny($lower, ['organisasi', 'organization', 'struktur', 'org chart', '조직도'])) {
            return [
                'reply' => $this->txt(
                    "🏢 Anda dapat melihat **Struktur Organisasi Kantor Pusat** PT. Zimmoah Marine Trans dalam versi Bahasa Inggris maupun Bahasa Korea pada halaman Organization Chart.",
                    "🏢 View the official **Head Office Organization Chart** in both English and Korean versions on our Organization Chart page.",
                    "🏢 자카르타 본사 공식 조직도(한글/영문 전환 지원)를 조직도 페이지에서 확인하실 수 있습니다."
                ),
                'links' => [['label' => $this->txt('Lihat Struktur Organisasi', 'View Organization Chart', '조직도 보기'), 'url' => route('company.organization')]],
                'mode' => 'local',
            ];
        }

        if ($this->matchesAny($lower, ['cabang', 'branch', 'alamat', 'kantor', 'lokasi', 'peta', 'map', 'telepon', 'telp', 'kontak', 'contact', 'email', 'jakarta', 'airport', 'semarang', 'hanoi', '지점', '주소', '연락처', '위치'])) {
            $offices = Office::orderBy('is_headquarters', 'desc')->get();
            $lines = $offices->map(fn ($o) => "• **{$o->name}**: {$o->phone} | {$o->email}")->implode("\n");

            return [
                'reply' => $this->txt(
                    "📍 **Kantor Utama PT. Zimmoah Marine Trans:**\n{$lines}\n\nKami juga memiliki jaringan di Surabaya, Ho Chi Minh, Hanoi, serta afiliasi SKL, Line Network Logistics, dan PT. RLC Indonesia lengkap dengan 8 peta Google Maps interaktif.",
                    "📍 **Primary Zimmoah Offices:**\n{$lines}\n\nWe also operate in Surabaya, Ho Chi Minh City, Hanoi, plus affiliates (SKL, Line Network, PT. RLC) with 8 interactive Google Maps.",
                    "📍 **짐모아 주요 지점 안내:**\n{$lines}\n\n수라바야, 베트남(호치민/하노이) 및 관계사(SKL, LNL, RLC) 포함 8개 거점 지도를 지점 안내 페이지에서 확인하세요."
                ),
                'links' => [
                    ['label' => $this->txt('Peta 8 Cabang & Afiliasi', '8 Branch Maps', '8개 지점 지도'), 'url' => route('company.branches')],
                    ['label' => $this->txt('Direktori Kontak PIC', 'Staff PIC Directory', '담당부서 연락처'), 'url' => route('contact')],
                ],
                'mode' => 'live-db',
            ];
        }

        if ($this->matchesAny($lower, ['profil', 'profile', 'brosur', 'pdf', 'tentang', 'about', 'zimmoah', '회사 소개'])) {
            return [
                'reply' => $this->txt(
                    "📘 **PT. Zimmoah Marine Trans** adalah perusahaan logistik terpadu sejak 1989 di Indonesia (Forwarding Laut & Udara, Warehousing VMI 18.000 m², Inland Trucking 82 armada, & Consolidation LCL). Anda juga bisa membaca/mengunduh **Company Profile PDF resmi** di halaman Profil.",
                    "📘 **PT. Zimmoah Marine Trans** is an integrated logistics provider in Indonesia since 1989 (Ocean & Air Forwarding, 18,000 m² VMI Warehousing, 82-unit Inland Trucking, & Weekly LCL Consolidation). Download our official **Company Profile PDF** on the Profile page.",
                    "📘 **PT. Zimmoah Marine Trans**는 1989년 설립된 인도네시아 종합 물류 기업(해상/항공 포워딩, 보세창고, 내륙운송, LCL 콘솔)입니다. 회사 소개서 페이지에서 공식 PDF를 확인하실 수 있습니다."
                ),
                'links' => [
                    ['label' => $this->txt('Profil & Brosur PDF', 'Company Profile & PDF', '회사 소개서 (PDF)'), 'url' => route('company.profile')],
                ],
                'mode' => 'local',
            ];
        }

        return null;
    }

    private function askGemini(string $userMessage): ?string
    {
        $apiKey = config('services.gemini.api_key');
        if (empty($apiKey)) {
            return null;
        }

        $model = config('services.gemini.model', 'gemini-2.5-flash');
        $locale = app()->getLocale();
        $langName = match ($locale) {
            'en' => 'English',
            'ko' => 'Korean',
            default => 'Indonesian',
        };

        // Public-only context (never passes private tickets, resumes, or user PII)
        $officesText = Office::all()->map(fn ($o) => "{$o->name}: {$o->address} | Tel: {$o->phone} | Email: {$o->email}")->implode("\n");
        $systemPrompt = "You are Zimmoah Assistant, the official customer support chatbot for PT. Zimmoah Marine Trans (Est. 1989, Indonesia).\n"
            . "Answer concisely in {$langName} based ONLY on these public facts:\n"
            . "- Services: Air & Ocean Freight Forwarding, Warehousing & Bonded Storage (18,000 m2 land, 15,500 m2 building, VMI, FIFO, ISO 9001, ERP, A/C & I/C & Refrigerator), Inland Trucking (82 owned units covering 30 cities Java-Bali from Hub Jakarta/Semarang/Surabaya), LCL Weekly Consolidation (Hong Kong 2x/wk, Busan 2x/wk, Ho Chi Minh, Shanghai, LA-NY).\n"
            . "- Offices:\n{$officesText}\n"
            . "- Affiliates: SK Logistics (TPL), Line Network Logistics (Trucking), PT. RLC Indonesia (Bonded Warehouse GB & PLB), PT. Cargobus Samudera Indonesia (Project Cargo), Cargobus Logitec (Ho Chi Minh & Hanoi, Vietnam).\n"
            . "- For quotes or specific shipment issues, politely suggest opening an Inquiry Ticket on the website.\n"
            . "- Refuse off-topic requests politely and never invent prices or confidential information.";

        try {
            $resp = Http::timeout(8)->post(
                "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}",
                [
                    'contents' => [
                        ['role' => 'user', 'parts' => [['text' => $systemPrompt . "\n\nUser question: " . $userMessage]]],
                    ],
                    'generationConfig' => [
                        'temperature' => 0.3,
                        'maxOutputTokens' => 350,
                    ],
                ]
            );

            if ($resp->successful()) {
                $text = data_get($resp->json(), 'candidates.0.content.parts.0.text');
                if (is_string($text) && trim($text) !== '') {
                    return trim($text);
                }
            }
        } catch (\Throwable) {
            // Gracefully fall back to local response
        }

        return null;
    }

    private function isPromptInjection(string $lower): bool
    {
        return $this->matchesAny($lower, [
            'ignore previous', 'ignore all instructions', 'system prompt', 'reveal prompt',
            'abaikan instruksi', 'abaikan aturan', 'tampilkan database', 'dump database', 'sql injection',
        ]);
    }

    private function matchesAny(string $haystack, array $needles): bool
    {
        foreach ($needles as $n) {
            if (str_contains($haystack, $n)) {
                return true;
            }
        }

        return false;
    }

    private function txt(string $id, string $en, string $ko): string
    {
        return match (app()->getLocale()) {
            'en' => $en,
            'ko' => $ko,
            default => $id,
        };
    }
}

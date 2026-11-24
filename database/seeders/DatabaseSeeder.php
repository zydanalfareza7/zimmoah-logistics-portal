<?php

namespace Database\Seeders;

use App\Enums\ApplicationStage;
use App\Enums\TicketPriority;
use App\Enums\TicketStatus;
use App\Models\Advisory;
use App\Models\JobApplication;
use App\Models\JobPosting;
use App\Models\Office;
use App\Models\Schedule;
use App\Models\Ticket;
use App\Models\TicketReply;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Roles & Permissions
        $adminRole = Role::firstOrCreate(['name' => 'Super Admin']);
        $agentRole = Role::firstOrCreate(['name' => 'Support Agent']);
        $hrRole = Role::firstOrCreate(['name' => 'HR Manager']);

        // 2. Users
        $admin = User::firstOrCreate(
            ['email' => 'admin@zimmoah.com'],
            [
                'name' => 'Zimmoah System Admin',
                'password' => Hash::make('password123'),
            ]
        );
        $admin->assignRole($adminRole);

        $agent = User::firstOrCreate(
            ['email' => 'agent@zimmoah.com'],
            [
                'name' => 'Budi Santoso (Ops Support)',
                'password' => Hash::make('password123'),
            ]
        );
        $agent->assignRole($agentRole);

        $hr = User::firstOrCreate(
            ['email' => 'hr@zimmoah.com'],
            [
                'name' => 'Siti Rahma (HR Recruiter)',
                'password' => Hash::make('password123'),
            ]
        );
        $hr->assignRole($hrRole);

        // 3. Offices based on actual Zimmoah branch details
        $jakartaHq = Office::create([
            'name' => 'Jakarta Head Office',
            'code' => 'JKT-HQ',
            'address' => 'Kirana Boutique Office, Jl. Kirana Avenue 2 Blok D2 No. 10-11 Kelapa Gading, Jakarta Utara 14240, Indonesia',
            'city' => 'Jakarta Utara',
            'phone' => '+(62-21) 2937 5670 (Hunting)',
            'fax' => '+(62-21) 2937 5671',
            'email' => 'zimmoah@zimmoah.com',
            'latitude' => -6.155823,
            'longitude' => 106.908234,
            'is_headquarters' => true,
        ]);

        $airportOffice = Office::create([
            'name' => 'Airport Office',
            'code' => 'CGK-AIR',
            'address' => 'Wisma Soewarna Suite 2-F, Soewarna Bisnis Park, Bandara Soekarno-Hatta, Tangerang, Banten, Indonesia',
            'city' => 'Tangerang',
            'phone' => '+(62-21) 5591 1853',
            'fax' => '+(62-21) 5695 6640',
            'email' => 'aircargo@zimmoah.com',
            'latitude' => -6.126438,
            'longitude' => 106.653421,
            'is_headquarters' => false,
        ]);

        $semarangOffice = Office::create([
            'name' => 'Semarang Office',
            'code' => 'SRG-BR',
            'address' => 'Jl. Puri Anjasmoro Block EE1 No. 17A, Tawangsari, Kec. Semarang Barat, Kota Semarang, Jawa Tengah 50144, Indonesia',
            'city' => 'Semarang',
            'phone' => '+(62-24) 7643 4641 / 7643 4861',
            'fax' => '+(62-24) 7643 4158',
            'email' => 'semarang@zimmoah.com',
            'latitude' => -6.963623,
            'longitude' => 110.389723,
            'is_headquarters' => false,
        ]);

        // 4. Operational Advisory (Maersk-style ticker)
        Advisory::create([
            'title' => 'Panduan Operasional: Update Rute Pengiriman Akhir Tahun & Koordinasi Pelabuhan',
            'slug' => 'update-rute-akhir-tahun-2026',
            'category' => 'OPERATIONAL',
            'summary' => 'Jadwal cut-off kargo konsolidasi laut & udara periode akhir tahun dan update kelancaran gate-in pelabuhan Tanjung Priok serta Bandara Soekarno-Hatta.',
            'content' => 'Bagi para mitra kargo, seluruh proses penerimaan dokumen Bill of Lading (B/L) dan packing list diharapkan diserahkan maksimal 24 jam sebelum jadwal closing date masing-masing rute pelayaran.',
            'action_text' => 'Lihat Jadwal & Panduan',
            'action_url' => '/schedules',
            'is_active' => true,
            'published_at' => now(),
        ]);

        // 5. Schedules
        Schedule::create([
            'transport_mode' => 'SEA',
            'origin_port' => 'Jakarta (Tanjung Priok / IDJKT)',
            'destination_port' => 'Busan Port (KRPUS)',
            'carrier_vessel_name' => 'ZIMMOAH PIONEER',
            'voyage_number' => 'V.2641-N',
            'departure_time' => now()->addDays(3)->setHour(14)->setMinute(0),
            'arrival_time' => now()->addDays(11)->setHour(9)->setMinute(0),
            'cut_off_time' => now()->addDays(2)->setHour(17)->setMinute(0),
            'status' => 'SCHEDULED',
            'notes' => 'Direct Ocean Freight - FCL & LCL Consolidation Available',
        ]);

        Schedule::create([
            'transport_mode' => 'SEA',
            'origin_port' => 'Jakarta (Tanjung Priok / IDJKT)',
            'destination_port' => 'Incheon Port (KRINC)',
            'carrier_vessel_name' => 'PACIFIC GLORY',
            'voyage_number' => 'V.1102-E',
            'departure_time' => now()->addDays(5)->setHour(20)->setMinute(0),
            'arrival_time' => now()->addDays(14)->setHour(16)->setMinute(0),
            'cut_off_time' => now()->addDays(4)->setHour(12)->setMinute(0),
            'status' => 'SCHEDULED',
            'notes' => 'Direct Weekly Schedule',
        ]);

        Schedule::create([
            'transport_mode' => 'AIR',
            'origin_port' => 'Jakarta Soekarno-Hatta (CGK)',
            'destination_port' => 'Seoul Incheon (ICN)',
            'carrier_vessel_name' => 'ZIM AIR EXPRESS',
            'voyage_number' => 'ZF-882',
            'departure_time' => now()->addDays(1)->setHour(23)->setMinute(30),
            'arrival_time' => now()->addDays(2)->setHour(8)->setMinute(15),
            'cut_off_time' => now()->addDays(1)->setHour(17)->setMinute(0),
            'status' => 'SCHEDULED',
            'notes' => 'Priority Air Cargo - Temperature Controlled Available',
        ]);

        Schedule::create([
            'transport_mode' => 'SEA',
            'origin_port' => 'Semarang (Tanjung Emas / IDSRG)',
            'destination_port' => 'Singapore (SGSIN)',
            'carrier_vessel_name' => 'NUSANTARA CARRIER',
            'voyage_number' => 'V.045',
            'departure_time' => now()->addDays(4)->setHour(10)->setMinute(0),
            'arrival_time' => now()->addDays(7)->setHour(18)->setMinute(0),
            'cut_off_time' => now()->addDays(3)->setHour(16)->setMinute(0),
            'status' => 'SCHEDULED',
            'notes' => 'Feeder Vessel to Global Hub',
        ]);

        // 6. Job Postings
        $job1 = JobPosting::create([
            'office_id' => $jakartaHq->id,
            'title' => 'Freight Forwarding Operations Specialist (Air & Ocean)',
            'slug' => 'freight-forwarding-operations-specialist',
            'department' => 'Freight Forwarding',
            'employment_type' => 'FULL_TIME',
            'experience_level' => 'MID',
            'salary_range' => 'Rp 7.500.000 - Rp 11.000.000',
            'description' => 'Bertanggung jawab dalam koordinasi pengiriman kargo ekspor-impor udara dan laut, penerbitan instruksi B/L, komunikasi dengan shipping line, serta kepatuhan kepabeanan.',
            'responsibilities' => "- Mengelola booking kargo FCL/LCL dan air cargo dari penjemputan hingga penyerahan di pelabuhan tujuan.\n- Berkoordinasi aktif dengan pihak bea cukai, agen pelayaran, dan depo kontainer.\n- Memantau pergerakan armada dan menangani kendala teknis operasional lapangan.",
            'requirements' => "- Minimal D3/S1 Manajemen Logistik, Transportasi, atau jurusan terkait.\n- Pengalaman minimal 2 tahun di bidang Freight Forwarding atau International Logistics.\n- Memahami prosedur ekspor-impor, Bill of Lading, Airway Bill, dan sistem INSW.\n- Mampu berbahasa Inggris lisan dan tulisan (bahasa Korea merupakan nilai plus).",
            'benefits' => "- Asuransi Kesehatan BPJS & Swasta\n- Tunjangan Transportasi & Komunikasi\n- Bonus Kinerja Tahunan",
            'is_active' => true,
            'deadline' => now()->addMonths(1),
        ]);

        $job2 = JobPosting::create([
            'office_id' => $airportOffice->id,
            'title' => 'Air Cargo Warehouse & Dispatch Coordinator',
            'slug' => 'air-cargo-warehouse-coordinator',
            'department' => 'Warehousing',
            'employment_type' => 'FULL_TIME',
            'experience_level' => 'MID',
            'salary_range' => 'Rp 6.500.000 - Rp 9.000.000',
            'description' => 'Mengawasi alur keluar-masuk kargo udara di gudang bandara Soekarno-Hatta, memastikan penimbangan akurat, packing standar ekspor, serta dokumentasi keselamatan penerbangan (DGR).',
            'responsibilities' => "- Mengatur proses loading & unloading kargo pesawat kargo terjadwal.\n- Memeriksa dokumen kesesuaian AWB dan label DGR jika membawa hazardous goods.\n- Memelihara akurasi inventory gudang transit Bandara Soewarna.",
            'requirements' => "- Pendidikan minimal SMA/SMK/D3.\n- Memiliki sertifikat DGR (Dangerous Goods Regulations) menjadi nilai tambah utama.\n- Siap bekerja dengan sistem shift di area Bandara Soekarno-Hatta.",
            'benefits' => "- BPJS Ketenagakerjaan & Kesehatan\n- Uang Makan & Shift Allowance\n- Pelatihan Sertifikasi Aviasi",
            'is_active' => true,
            'deadline' => now()->addWeeks(3),
        ]);

        $job3 = JobPosting::create([
            'office_id' => $semarangOffice->id,
            'title' => 'Logistics Sales & Key Account Executive',
            'slug' => 'logistics-sales-executive-semarang',
            'department' => 'Sales',
            'employment_type' => 'FULL_TIME',
            'experience_level' => 'SENIOR',
            'salary_range' => 'Rp 8.000.000 - Rp 15.000.000 + Komisi',
            'description' => 'Mengembangkan basis klien manufaktur dan eksportir di Jawa Tengah untuk jasa trucking kontainer, pergudangan, dan ocean consolidation Zimmoah.',
            'responsibilities' => "- Mengidentifikasi prospek klien korporat ekspor-impor di wilayah Jawa Tengah.\n- Menyusun proposal penawaran tarif freight dan solusi rantai pasok terintegrasi.\n- Membangun relasi jangka panjang dengan pemilik kargo dan pabrik.",
            'requirements' => "- Pendidikan S1 segala jurusan.\n- Pengalaman minimal 3 tahun di bidang B2B Logistics Sales / Freight Forwarding di Semarang/Jateng.\n- Memiliki relasi dan jaringan industri manufaktur yang luas.",
            'benefits' => "- Skema Komisi Sales Sangat Menarik tanpa batas\n- Tunjangan Kendaraan & Operasional\n- Jenjang Karir Cepat",
            'is_active' => true,
            'deadline' => now()->addMonths(2),
        ]);

        // Sample applicant
        JobApplication::create([
            'job_posting_id' => $job1->id,
            'full_name' => 'Dimas Arya Pratama',
            'email' => 'dimas.arya@example.com',
            'phone' => '+6281234567890',
            'linkedin_url' => 'https://linkedin.com/in/dimas-arya-logistics',
            'resume_path' => 'resumes/sample_cv_dimas.pdf',
            'resume_original_name' => 'CV_Dimas_Arya_Operations.pdf',
            'expected_salary' => 9500000,
            'notice_period' => '1 Bulan',
            'cover_letter' => 'Saya memiliki pengalaman 3 tahun menangani ekspor-impor kargo udara di Soekarno-Hatta dan siap berkontribusi di Zimmoah.',
            'stage' => ApplicationStage::SCREENING,
            'rating' => 4,
        ]);

        // 7. Sample Tickets
        $ticket1 = Ticket::create([
            'ticket_code' => 'ZIM-2026-9042',
            'customer_name' => 'PT Maju Makmur Sentosa (Bpk. Hendra)',
            'customer_email' => 'hendra@majumakmur.co.id',
            'customer_phone' => '+628119876543',
            'subject' => 'Inquiry Jadwal Kapal Tanjung Priok ke Busan Kontainer 40ft',
            'category' => 'FORWARDING',
            'priority' => TicketPriority::HIGH,
            'status' => TicketStatus::OPEN,
            'assigned_agent_id' => $agent->id,
            'sla_due_at' => now()->addHours(4),
            'first_responded_at' => now()->subHours(1),
        ]);

        TicketReply::create([
            'ticket_id' => $ticket1->id,
            'user_id' => null,
            'sender_name' => 'Bpk. Hendra',
            'sender_email' => 'hendra@majumakmur.co.id',
            'sender_type' => 'CUSTOMER',
            'message_id' => '<inquiry-9042@majumakmur.co.id>',
            'body_text' => 'Halo tim Zimmoah, mohon info space kapal minggu depan untuk 2 unit kontainer 40HC tujuan Busan dari Priok. Apakah closing date masih hari Selasa jam 17:00? Terima kasih.',
            'is_internal_note' => false,
        ]);

        TicketReply::create([
            'ticket_id' => $ticket1->id,
            'user_id' => $agent->id,
            'sender_name' => 'Budi Santoso (Ops Support)',
            'sender_email' => 'budi.santoso@zimmoah.com',
            'sender_type' => 'AGENT',
            'message_id' => '<reply-zim-9042-1@zimmoah.com>',
            'body_text' => "Selamat siang Pak Hendra,\n\nTerima kasih atas pesanannya. Untuk jadwal kapal ZIMMOAH PIONEER V.2641-N tujuan Busan masih tersedia slot kontainer 40HC. Closing date dan cut-off dokumen tetap sesuai jadwal yaitu hari Selasa pukul 17:00 WIB di Gate Tanjung Priok.\n\nFormulir shipping order dan booking draft telah kami siapkan di attachment.\n\nSalam,\nBudi Santoso - Zimmoah Operations",
            'is_internal_note' => false,
        ]);

        TicketReply::create([
            'ticket_id' => $ticket1->id,
            'user_id' => $agent->id,
            'sender_name' => 'Budi Santoso (Ops Support)',
            'sender_email' => 'budi.santoso@zimmoah.com',
            'sender_type' => 'AGENT',
            'body_text' => 'Catatan Internal: Slot sudah diparaf oleh tim liner, tinggal menunggu penyerahan final booking order dari Pak Hendra sore ini.',
            'is_internal_note' => true,
        ]);

        // 8. Sample Cargo Shipments (Maersk-style Milestone Tracking)
        $this->call(ShipmentSeeder::class);
    }
}

<?php

namespace Database\Seeders;

use App\Enums\ShipmentStage;
use App\Models\Shipment;
use Illuminate\Database\Seeder;

class ShipmentSeeder extends Seeder
{
    public function run(): void
    {
        $shipments = [
            [
                'tracking_number' => 'ZIM-CARGO-9042',
                'transport_mode' => 'SEA',
                'container_or_awb' => 'ZIMU-4092817',
                'vessel_or_flight' => 'ZIMMOAH PIONEER / V.2641-N',
                'origin_port' => 'Jakarta (Tanjung Priok / IDJKT)',
                'destination_port' => 'Busan Port (KRPUS)',
                'shipper_name' => 'PT Maju Makmur Sentosa',
                'consignee_name' => 'Hanbit Industrial Co., Ltd.',
                'cargo_description' => 'Precision Automotive Components (2x40ft HC)',
                'weight_kg' => 24850.00,
                'container_size' => '40ft High Cube (FCL)',
                'current_stage' => ShipmentStage::ON_VESSEL,
                'departed_at' => now()->subDays(3),
                'estimated_arrival' => now()->addDays(4),
                'milestones' => [
                    [
                        'stage' => 'booked',
                        'title' => 'Booking Confirmed & Shipping Order Issued',
                        'location' => 'Jakarta Head Office (Kelapa Gading)',
                        'timestamp' => now()->subDays(6)->format('Y-m-d H:i'),
                        'notes' => 'Booking slot 40HC dikonfirmasi pada kapal ZIMMOAH PIONEER V.2641-N.',
                    ],
                    [
                        'stage' => 'gate_in',
                        'title' => 'Container Gate In at Export Terminal',
                        'location' => 'JICT Terminal 1, Tanjung Priok, Jakarta',
                        'timestamp' => now()->subDays(4)->format('Y-m-d H:i'),
                        'notes' => 'Kontainer ZIMU-4092817 masuk gate pelabuhan dengan segel bea cukai terverifikasi.',
                    ],
                    [
                        'stage' => 'on_vessel',
                        'title' => 'Loaded on Vessel & Departed Port',
                        'location' => 'Laut Jawa menuju Selat Korea',
                        'timestamp' => now()->subDays(3)->format('Y-m-d H:i'),
                        'notes' => 'Kapal telah lepas sandar sesuai jadwal. Estimasi sandar di Busan New Port dalam 4 hari.',
                    ],
                ],
            ],
            [
                'tracking_number' => 'ZIM-AIR-8821',
                'transport_mode' => 'AIR',
                'container_or_awb' => 'AWB-180-99428821',
                'vessel_or_flight' => 'KE-628 (Korean Air Cargo)',
                'origin_port' => 'Jakarta (Soekarno-Hatta / CGK)',
                'destination_port' => 'Seoul (Incheon Int. / ICN)',
                'shipper_name' => 'PT Nusantara Electronics',
                'consignee_name' => 'Seoul MicroTech Corp.',
                'cargo_description' => 'Semiconductor Testing Modules (Priority Air)',
                'weight_kg' => 640.50,
                'container_size' => 'Air Priority ULD Pallet',
                'current_stage' => ShipmentStage::CUSTOMS_CLEARANCE,
                'departed_at' => now()->subDays(1),
                'estimated_arrival' => now()->addHours(8),
                'milestones' => [
                    [
                        'stage' => 'booked',
                        'title' => 'Air Waybill Issued & Space Locked',
                        'location' => 'Zimmoah Airport Office (Soewarna CGK)',
                        'timestamp' => now()->subDays(2)->format('Y-m-d H:i'),
                        'notes' => 'Master AWB 180-99428821 diterbitkan untuk penerbangan kargo prioritas.',
                    ],
                    [
                        'stage' => 'gate_in',
                        'title' => 'Accepted at Cargo Terminal & X-Ray Cleared',
                        'location' => 'Terminal Kargo 530, Bandara Soekarno-Hatta',
                        'timestamp' => now()->subHours(32)->format('Y-m-d H:i'),
                        'notes' => 'Lolos inspeksi keamanan RA/X-Ray dan siap muat ke pesawat.',
                    ],
                    [
                        'stage' => 'on_vessel',
                        'title' => 'Departed CGK via Flight KE-628',
                        'location' => 'In-Flight CGK -> ICN',
                        'timestamp' => now()->subHours(20)->format('Y-m-d H:i'),
                        'notes' => 'Pesawat kargo berangkat tepat waktu dan mendarat di Incheon Cargo Terminal.',
                    ],
                    [
                        'stage' => 'customs_clearance',
                        'title' => 'Import Customs Clearance in Progress',
                        'location' => 'Incheon International Airport Customs (ICN)',
                        'timestamp' => now()->subHours(3)->format('Y-m-d H:i'),
                        'notes' => 'Dokumen PIB/Invoice sedang diverifikasi oleh petugas bea cukai Korea.',
                    ],
                ],
            ],
            [
                'tracking_number' => 'ZIM-LCL-5510',
                'transport_mode' => 'SEA',
                'container_or_awb' => 'ZIMU-2055109',
                'vessel_or_flight' => 'ZIMMOAH HARMONY / V.2644-S',
                'origin_port' => 'Semarang (Tanjung Emas / IDSRG)',
                'destination_port' => 'Singapore (PSA Terminal / SGSIN)',
                'shipper_name' => 'CV Karya Furnitur Jepara',
                'consignee_name' => 'Pacific Living Pte. Ltd.',
                'cargo_description' => 'Export Teak Furniture Consolidation (LCL 12 CBM)',
                'weight_kg' => 3850.00,
                'container_size' => 'LCL Consolidation (12 CBM)',
                'current_stage' => ShipmentStage::GATE_IN,
                'departed_at' => now()->addDays(1),
                'estimated_arrival' => now()->addDays(5),
                'milestones' => [
                    [
                        'stage' => 'booked',
                        'title' => 'LCL Consolidation Booking Confirmed',
                        'location' => 'Zimmoah Semarang Office (Puri Anjasmoro)',
                        'timestamp' => now()->subDays(2)->format('Y-m-d H:i'),
                        'notes' => 'Kargo dijadwalkan masuk ke kontainer konsolidasi mingguan tujuan Singapura.',
                    ],
                    [
                        'stage' => 'gate_in',
                        'title' => 'Stuffing Complete & Gate In TPKS',
                        'location' => 'TPKS Tanjung Emas, Semarang',
                        'timestamp' => now()->subHours(6)->format('Y-m-d H:i'),
                        'notes' => 'Proses stuffing selesai, kontainer menunggu jadwal sandar kapal besok pagi.',
                    ],
                ],
            ],
            [
                'tracking_number' => 'ZIM-DLV-1001',
                'transport_mode' => 'SEA',
                'container_or_awb' => 'ZIMU-4010012',
                'vessel_or_flight' => 'ZIMMOAH VOYAGER / V.2638-S',
                'origin_port' => 'Busan Port (KRPUS)',
                'destination_port' => 'Jakarta (Tanjung Priok / IDJKT)',
                'shipper_name' => 'Daehan Machinery Ltd.',
                'consignee_name' => 'PT Karya Teknik Industri Cikarang',
                'cargo_description' => 'CNC Industrial Milling Machinery',
                'weight_kg' => 18200.00,
                'container_size' => '40ft Open Top (FCL)',
                'current_stage' => ShipmentStage::DELIVERED,
                'departed_at' => now()->subDays(12),
                'estimated_arrival' => now()->subDays(2),
                'milestones' => [
                    [
                        'stage' => 'booked',
                        'title' => 'Export Booking Confirmed',
                        'location' => 'Busan Partner Desk, South Korea',
                        'timestamp' => now()->subDays(14)->format('Y-m-d H:i'),
                        'notes' => 'Booking kontainer Open Top 40ft dikonfirmasi.',
                    ],
                    [
                        'stage' => 'gate_in',
                        'title' => 'Gate In Busan New Port',
                        'location' => 'Busan New Port Terminal 3',
                        'timestamp' => now()->subDays(13)->format('Y-m-d H:i'),
                        'notes' => 'Kontainer tiba di pelabuhan muat.',
                    ],
                    [
                        'stage' => 'on_vessel',
                        'title' => 'Vessel Departed Busan -> Jakarta',
                        'location' => 'Busan Port (KRPUS)',
                        'timestamp' => now()->subDays(12)->format('Y-m-d H:i'),
                        'notes' => 'Berlayar dengan kapal ZIMMOAH VOYAGER V.2638-S.',
                    ],
                    [
                        'stage' => 'customs_clearance',
                        'title' => 'SPPB Issued (Customs Cleared)',
                        'location' => 'Bea Cukai Tanjung Priok, Jakarta',
                        'timestamp' => now()->subDays(2)->format('Y-m-d H:i'),
                        'notes' => 'Jalur Hijau - SPPB terbit dan siap diantar armada trailer Zimmoah.',
                    ],
                    [
                        'stage' => 'delivered',
                        'title' => 'Delivered to Consignee Warehouse',
                        'location' => 'Kawasan Industri Jababeka, Cikarang',
                        'timestamp' => now()->subDay()->format('Y-m-d H:i'),
                        'notes' => 'Diterima dengan baik oleh Kepala Gudang PT Karya Teknik Industri (POD ditandatangani).',
                    ],
                ],
            ],
        ];

        foreach ($shipments as $data) {
            Shipment::updateOrCreate(
                ['tracking_number' => $data['tracking_number']],
                $data
            );
        }
    }
}

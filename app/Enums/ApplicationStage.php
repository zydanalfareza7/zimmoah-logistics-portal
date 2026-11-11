<?php

namespace App\Enums;

enum ApplicationStage: string
{
    case NEW = 'NEW';
    case SCREENING = 'SCREENING';
    case INTERVIEW = 'INTERVIEW';
    case OFFER = 'OFFER';
    case HIRED = 'HIRED';
    case REJECTED = 'REJECTED';

    public function label(): string
    {
        return match ($this) {
            self::NEW => 'Lamaran Masuk',
            self::SCREENING => 'Screening Berkas',
            self::INTERVIEW => 'Tahap Wawancara',
            self::OFFER => 'Penawaran Kerja (Offering)',
            self::HIRED => 'Diterima (Hired)',
            self::REJECTED => 'Tidak Lolos',
        };
    }

    public function colorClasses(): string
    {
        return match ($this) {
            self::NEW => 'bg-indigo-50 text-indigo-700 border-indigo-200',
            self::SCREENING => 'bg-amber-50 text-amber-700 border-amber-200',
            self::INTERVIEW => 'bg-blue-50 text-blue-700 border-blue-200',
            self::OFFER => 'bg-purple-50 text-purple-700 border-purple-200',
            self::HIRED => 'bg-emerald-50 text-emerald-700 border-emerald-200',
            self::REJECTED => 'bg-rose-50 text-rose-700 border-rose-200',
        };
    }
}

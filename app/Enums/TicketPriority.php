<?php

namespace App\Enums;

enum TicketPriority: string
{
    case LOW = 'LOW';
    case MEDIUM = 'MEDIUM';
    case HIGH = 'HIGH';
    case URGENT = 'URGENT';

    public function label(): string
    {
        return match ($this) {
            self::LOW => 'Rendah',
            self::MEDIUM => 'Sedang',
            self::HIGH => 'Tinggi',
            self::URGENT => 'Mendesak (Urgent)',
        };
    }

    public function slaHours(): int
    {
        return match ($this) {
            self::LOW => 24,
            self::MEDIUM => 12,
            self::HIGH => 4,
            self::URGENT => 1,
        };
    }

    public function colorClasses(): string
    {
        return match ($this) {
            self::LOW => 'bg-slate-100 text-slate-700 border-slate-300',
            self::MEDIUM => 'bg-sky-100 text-sky-800 border-sky-300',
            self::HIGH => 'bg-orange-100 text-orange-800 border-orange-300',
            self::URGENT => 'bg-rose-100 text-rose-800 border-rose-300 animate-pulse',
        };
    }
}

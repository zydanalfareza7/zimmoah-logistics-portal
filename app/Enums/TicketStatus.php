<?php

namespace App\Enums;

enum TicketStatus: string
{
    case NEW = 'NEW';
    case OPEN = 'OPEN';
    case PENDING = 'PENDING';
    case RESOLVED = 'RESOLVED';
    case CLOSED = 'CLOSED';

    public function label(): string
    {
        return match ($this) {
            self::NEW => 'Baru',
            self::OPEN => 'Sedang Ditangani',
            self::PENDING => 'Menunggu Klien',
            self::RESOLVED => 'Selesai',
            self::CLOSED => 'Ditutup',
        };
    }

    public function colorClasses(): string
    {
        return match ($this) {
            self::NEW => 'bg-amber-100 text-amber-800 border-amber-300',
            self::OPEN => 'bg-blue-100 text-blue-800 border-blue-300',
            self::PENDING => 'bg-purple-100 text-purple-800 border-purple-300',
            self::RESOLVED => 'bg-emerald-100 text-emerald-800 border-emerald-300',
            self::CLOSED => 'bg-gray-100 text-gray-800 border-gray-300',
        };
    }
}

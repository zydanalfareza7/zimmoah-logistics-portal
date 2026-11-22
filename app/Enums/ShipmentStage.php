<?php

namespace App\Enums;

enum ShipmentStage: string
{
    case BOOKED = 'booked';
    case GATE_IN = 'gate_in';
    case ON_VESSEL = 'on_vessel';
    case CUSTOMS_CLEARANCE = 'customs_clearance';
    case DELIVERED = 'delivered';

    public function stepNumber(): int
    {
        return match ($this) {
            self::BOOKED => 1,
            self::GATE_IN => 2,
            self::ON_VESSEL => 3,
            self::CUSTOMS_CLEARANCE => 4,
            self::DELIVERED => 5,
        };
    }

    public function label(): string
    {
        return __('messages.stage_' . $this->value);
    }

    public function badgeClass(): string
    {
        return match ($this) {
            self::BOOKED => 'bg-slate-100 text-slate-800 border-slate-300',
            self::GATE_IN => 'bg-blue-100 text-blue-800 border-blue-300',
            self::ON_VESSEL => 'bg-amber-100 text-amber-900 border-amber-300',
            self::CUSTOMS_CLEARANCE => 'bg-purple-100 text-purple-800 border-purple-300',
            self::DELIVERED => 'bg-emerald-100 text-emerald-800 border-emerald-300',
        };
    }

    /**
     * @return array<int, self>
     */
    public static function ordered(): array
    {
        return [
            self::BOOKED,
            self::GATE_IN,
            self::ON_VESSEL,
            self::CUSTOMS_CLEARANCE,
            self::DELIVERED,
        ];
    }
}

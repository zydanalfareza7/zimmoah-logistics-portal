<?php

namespace App\Models;

use App\Enums\ShipmentStage;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $fillable = [
        'tracking_number',
        'transport_mode',
        'container_or_awb',
        'vessel_or_flight',
        'origin_port',
        'destination_port',
        'shipper_name',
        'consignee_name',
        'cargo_description',
        'weight_kg',
        'container_size',
        'current_stage',
        'departed_at',
        'estimated_arrival',
        'milestones',
    ];

    protected function casts(): array
    {
        return [
            'current_stage' => ShipmentStage::class,
            'weight_kg' => 'decimal:2',
            'departed_at' => 'datetime',
            'estimated_arrival' => 'datetime',
            'milestones' => 'array',
        ];
    }

    public function progressPercent(): int
    {
        return match ($this->current_stage->stepNumber()) {
            1 => 10,
            2 => 32,
            3 => 55,
            4 => 78,
            5 => 100,
            default => 0,
        };
    }
}

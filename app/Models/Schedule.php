<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'transport_mode',
        'origin_port',
        'destination_port',
        'carrier_vessel_name',
        'voyage_number',
        'departure_time',
        'arrival_time',
        'cut_off_time',
        'status',
        'notes',
    ];

    protected $casts = [
        'departure_time' => 'datetime',
        'arrival_time' => 'datetime',
        'cut_off_time' => 'datetime',
    ];

    public function getDurationAttribute(): string
    {
        if ($this->departure_time && $this->arrival_time) {
            $hours = (int) round(abs($this->departure_time->diffInMinutes($this->arrival_time)) / 60);
            if ($hours < 24) {
                return max(1, $hours) . ' Jam Transit';
            }
            $days = (int) round($hours / 24);
            return "{$days} Hari Transit";
        }
        return '-';
    }
}

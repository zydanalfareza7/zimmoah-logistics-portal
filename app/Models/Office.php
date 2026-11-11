<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Office extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'address',
        'city',
        'phone',
        'fax',
        'email',
        'latitude',
        'longitude',
        'is_headquarters',
    ];

    protected $casts = [
        'is_headquarters' => 'boolean',
        'latitude' => 'float',
        'longitude' => 'float',
    ];

    public function jobPostings(): HasMany
    {
        return $this->hasMany(JobPosting::class);
    }
}

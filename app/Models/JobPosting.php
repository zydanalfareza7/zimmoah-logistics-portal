<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class JobPosting extends Model
{
    use HasFactory;

    protected $fillable = [
        'office_id',
        'title',
        'slug',
        'department',
        'employment_type',
        'experience_level',
        'salary_range',
        'description',
        'responsibilities',
        'requirements',
        'benefits',
        'is_active',
        'deadline',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'deadline' => 'date',
    ];

    protected static function booted(): void
    {
        static::creating(function (JobPosting $job) {
            if (empty($job->slug)) {
                $job->slug = Str::slug($job->title) . '-' . Str::random(5);
            }
        });
    }

    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class);
    }

    public function applications(): HasMany
    {
        return $this->hasMany(JobApplication::class);
    }

    public function getEmploymentTypeLabelAttribute(): string
    {
        return match ($this->employment_type) {
            'FULL_TIME' => 'Purna Waktu (Full-Time)',
            'CONTRACT' => 'Kontrak',
            'INTERNSHIP' => 'Magang (Internship)',
            default => $this->employment_type,
        };
    }
}

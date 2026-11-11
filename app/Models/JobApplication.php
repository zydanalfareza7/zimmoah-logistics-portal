<?php

namespace App\Models;

use App\Enums\ApplicationStage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_posting_id',
        'full_name',
        'email',
        'phone',
        'linkedin_url',
        'resume_path',
        'resume_original_name',
        'expected_salary',
        'notice_period',
        'cover_letter',
        'stage',
        'rating',
    ];

    protected $casts = [
        'stage' => ApplicationStage::class,
        'expected_salary' => 'decimal:2',
        'rating' => 'integer',
    ];

    public function jobPosting(): BelongsTo
    {
        return $this->belongsTo(JobPosting::class);
    }

    public function notes(): HasMany
    {
        return $this->hasMany(ApplicationNote::class)->latest();
    }

    public function getFormattedSalaryAttribute(): string
    {
        if ($this->expected_salary) {
            return 'Rp ' . number_format($this->expected_salary, 0, ',', '.');
        }
        return 'Nego';
    }
}

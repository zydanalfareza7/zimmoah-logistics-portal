<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApplicationNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_application_id',
        'user_id',
        'note',
    ];

    public function application(): BelongsTo
    {
        return $this->belongsTo(JobApplication::class, 'job_application_id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

<?php

namespace App\Models;

use App\Enums\TicketPriority;
use App\Enums\TicketStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_code',
        'access_token',
        'customer_name',
        'customer_email',
        'customer_phone',
        'subject',
        'category',
        'priority',
        'status',
        'assigned_agent_id',
        'sla_due_at',
        'first_responded_at',
        'resolved_at',
    ];

    protected $casts = [
        'status' => TicketStatus::class,
        'priority' => TicketPriority::class,
        'sla_due_at' => 'datetime',
        'first_responded_at' => 'datetime',
        'resolved_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (Ticket $ticket) {
            if (empty($ticket->ticket_code)) {
                $ticket->ticket_code = 'ZIM-' . date('Y') . '-' . strtoupper(Str::random(5));
            }
            if (empty($ticket->access_token)) {
                $ticket->access_token = hash('sha256', Str::random(40) . microtime(true));
            }
            if (empty($ticket->sla_due_at) && $ticket->priority) {
                $hours = $ticket->priority->slaHours();
                $ticket->sla_due_at = now()->addHours($hours);
            }
        });
    }

    public function assignedAgent(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_agent_id');
    }

    public function replies(): HasMany
    {
        return $this->hasMany(TicketReply::class)->orderBy('created_at', 'asc');
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(TicketAttachment::class);
    }

    public function isSlaBreached(): bool
    {
        if ($this->status === TicketStatus::RESOLVED || $this->status === TicketStatus::CLOSED) {
            return false;
        }
        return $this->sla_due_at && now()->greaterThan($this->sla_due_at);
    }
}

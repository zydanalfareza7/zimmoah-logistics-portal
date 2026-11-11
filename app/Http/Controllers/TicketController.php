<?php

namespace App\Http\Controllers;

use App\Enums\TicketPriority;
use App\Enums\TicketStatus;
use App\Models\Ticket;
use App\Models\TicketAttachment;
use App\Models\TicketReply;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class TicketController extends Controller
{
    public function create(): View
    {
        return view('tickets.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'customer_name' => ['required', 'string', 'max:150'],
            'customer_email' => ['required', 'email:rfc', 'max:150'],
            'customer_phone' => ['nullable', 'string', 'max:25'],
            'category' => ['required', 'string', 'in:FORWARDING,TRUCKING,WAREHOUSING,BILLING,GENERAL'],
            'priority' => ['required', 'string', 'in:LOW,MEDIUM,HIGH,URGENT'],
            'subject' => ['required', 'string', 'max:200'],
            'message' => ['required', 'string', 'max:5000'],
            'attachment' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png,doc,docx', 'max:5120'],
        ]);

        $ticket = Ticket::create([
            'customer_name' => strip_tags($validated['customer_name']),
            'customer_email' => strtolower(trim($validated['customer_email'])),
            'customer_phone' => $validated['customer_phone'] ? strip_tags($validated['customer_phone']) : null,
            'category' => $validated['category'],
            'priority' => TicketPriority::from($validated['priority']),
            'status' => TicketStatus::NEW,
            'subject' => strip_tags($validated['subject']),
        ]);

        // First message as customer reply
        $reply = TicketReply::create([
            'ticket_id' => $ticket->id,
            'sender_name' => $ticket->customer_name,
            'sender_email' => $ticket->customer_email,
            'sender_type' => 'CUSTOMER',
            'message_id' => '<web-' . Str::uuid() . '@zimmoah.com>',
            'body_text' => strip_tags($validated['message']),
            'is_internal_note' => false,
        ]);

        // Handle attachment
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $hashedName = Str::random(40) . '.' . $extension;
            $path = $file->storeAs('ticket_attachments', $hashedName, 'local');

            TicketAttachment::create([
                'ticket_id' => $ticket->id,
                'ticket_reply_id' => $reply->id,
                'file_name' => $originalName,
                'file_path' => $path,
                'file_size' => $file->getSize(),
                'mime_type' => $file->getMimeType(),
            ]);
        }

        return redirect()->route('tickets.track', [
            'code' => $ticket->ticket_code,
            'token' => $ticket->access_token,
        ])->with('success', "Tiket Anda berhasil dibuat dengan nomor referensi {$ticket->ticket_code}.");
    }

    public function track(Request $request): View|RedirectResponse
    {
        $code = strtoupper(trim($request->input('code', '')));
        $token = $request->input('token');
        $email = strtolower(trim($request->input('email', '')));

        if (empty($code)) {
            return view('tickets.lookup');
        }

        $ticketQuery = Ticket::where('ticket_code', $code);

        // Security check: Either valid access token or matching customer email
        if (!empty($token)) {
            $ticketQuery->where('access_token', $token);
        } elseif (!empty($email)) {
            $ticketQuery->where('customer_email', $email);
        } else {
            // Need verification
            $ticket = Ticket::where('ticket_code', $code)->first();
            if ($ticket) {
                return view('tickets.verify_email', compact('code'));
            }
            return redirect()->route('tickets.lookup')->with('error', 'Nomor tiket tidak ditemukan.');
        }

        $ticket = $ticketQuery->with(['replies' => function ($q) {
            $q->where('is_internal_note', false)->with('attachments');
        }])->first();

        if (!$ticket) {
            return redirect()->route('tickets.lookup')->with('error', 'Tiket tidak ditemukan atau kredensial pelacakan tidak cocok.');
        }

        return view('tickets.show', compact('ticket'));
    }

    public function reply(Request $request, string $code): RedirectResponse
    {
        $ticket = Ticket::where('ticket_code', $code)->firstOrFail();

        // Verify token or email
        $token = $request->input('token');
        if ($token !== $ticket->access_token) {
            abort(403, 'Akses tidak sah untuk membalas tiket ini.');
        }

        $validated = $request->validate([
            'message' => ['required', 'string', 'max:3000'],
            'attachment' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png,doc,docx', 'max:5120'],
        ]);

        $reply = TicketReply::create([
            'ticket_id' => $ticket->id,
            'sender_name' => $ticket->customer_name,
            'sender_email' => $ticket->customer_email,
            'sender_type' => 'CUSTOMER',
            'message_id' => '<web-reply-' . Str::uuid() . '@zimmoah.com>',
            'body_text' => strip_tags($validated['message']),
            'is_internal_note' => false,
        ]);

        // If ticket was resolved/closed, reopen it
        if ($ticket->status === TicketStatus::RESOLVED || $ticket->status === TicketStatus::CLOSED) {
            $ticket->status = TicketStatus::OPEN;
            $ticket->save();
        }

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $hashedName = Str::random(40) . '.' . $extension;
            $path = $file->storeAs('ticket_attachments', $hashedName, 'local');

            TicketAttachment::create([
                'ticket_id' => $ticket->id,
                'ticket_reply_id' => $reply->id,
                'file_name' => $originalName,
                'file_path' => $path,
                'file_size' => $file->getSize(),
                'mime_type' => $file->getMimeType(),
            ]);
        }

        return redirect()->route('tickets.track', [
            'code' => $ticket->ticket_code,
            'token' => $ticket->access_token,
        ])->with('success', 'Balasan Anda telah berhasil dikirim ke tim customer support.');
    }

    /**
     * Inbound Email Webhook Simulator / Receiver
     * Accepts POST payload from email gateway (Mailgun, Postmark, AWS SES, or IMAP cron)
     */
    public function inboundEmail(Request $request): JsonResponse
    {
        // Secret token check for email webhook endpoint
        $webhookSecret = config('services.inbound_email.secret', 'zimmoah-webhook-secret-key-2026');
        if ($request->header('X-Webhook-Secret') !== $webhookSecret && $request->input('secret') !== $webhookSecret) {
            return response()->json(['error' => 'Unauthorized email webhook'], 403);
        }

        $fromEmail = strtolower(trim($request->input('from_email')));
        $fromName = strip_tags($request->input('from_name', $fromEmail));
        $subject = strip_tags($request->input('subject', 'No Subject'));
        $body = strip_tags($request->input('body', ''));
        $messageId = $request->input('message_id', '<inbound-' . Str::uuid() . '@external>');

        // Check if subject has [ZIM-YYYY-XXXXX]
        if (preg_match('/\[?(ZIM-\d{4}-[A-Z0-9]+)\]?/i', $subject, $matches)) {
            $ticketCode = strtoupper($matches[1]);
            $ticket = Ticket::where('ticket_code', $ticketCode)->first();
            if ($ticket) {
                $reply = TicketReply::create([
                    'ticket_id' => $ticket->id,
                    'sender_name' => $fromName,
                    'sender_email' => $fromEmail,
                    'sender_type' => 'CUSTOMER',
                    'message_id' => $messageId,
                    'body_text' => $body,
                    'is_internal_note' => false,
                ]);

                $ticket->status = TicketStatus::OPEN;
                $ticket->save();

                return response()->json([
                    'status' => 'success',
                    'action' => 'appended_to_ticket',
                    'ticket_code' => $ticket->ticket_code,
                ]);
            }
        }

        // New Ticket from inbound email
        $ticket = Ticket::create([
            'customer_name' => $fromName,
            'customer_email' => $fromEmail,
            'subject' => $subject,
            'category' => 'GENERAL',
            'priority' => TicketPriority::MEDIUM,
            'status' => TicketStatus::NEW,
        ]);

        TicketReply::create([
            'ticket_id' => $ticket->id,
            'sender_name' => $fromName,
            'sender_email' => $fromEmail,
            'sender_type' => 'CUSTOMER',
            'message_id' => $messageId,
            'body_text' => $body,
            'is_internal_note' => false,
        ]);

        return response()->json([
            'status' => 'success',
            'action' => 'created_new_ticket',
            'ticket_code' => $ticket->ticket_code,
        ]);
    }
}

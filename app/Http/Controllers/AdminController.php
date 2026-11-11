<?php

namespace App\Http\Controllers;

use App\Enums\ApplicationStage;
use App\Enums\TicketPriority;
use App\Enums\TicketStatus;
use App\Models\ApplicationNote;
use App\Models\JobApplication;
use App\Models\JobPosting;
use App\Models\Schedule;
use App\Models\Ticket;
use App\Models\TicketAttachment;
use App\Models\TicketReply;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    // Auth Views
    public function showLogin(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Kombinasi email dan kata sandi tidak cocok.',
        ])->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Anda telah berhasil keluar.');
    }

    // Dashboard Overview
    public function dashboard(): View
    {
        $totalTickets = Ticket::count();
        $openTickets = Ticket::whereIn('status', [TicketStatus::NEW, TicketStatus::OPEN, TicketStatus::PENDING])->count();
        $slaBreached = Ticket::whereIn('status', [TicketStatus::NEW, TicketStatus::OPEN])
            ->where('sla_due_at', '<', now())
            ->count();
        $totalApplicants = JobApplication::count();
        $activeJobs = JobPosting::where('is_active', true)->count();

        $recentTickets = Ticket::with(['assignedAgent', 'replies'])->latest()->take(5)->get();
        $recentApplicants = JobApplication::with('jobPosting')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalTickets',
            'openTickets',
            'slaBreached',
            'totalApplicants',
            'activeJobs',
            'recentTickets',
            'recentApplicants'
        ));
    }

    // Helpdesk / Ticket Management
    public function tickets(Request $request): View
    {
        $status = $request->input('status');
        $priority = $request->input('priority');
        $search = $request->input('search');

        $query = Ticket::with('assignedAgent');

        if ($status) {
            $query->where('status', $status);
        }
        if ($priority) {
            $query->where('priority', $priority);
        }
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('ticket_code', 'LIKE', "%{$search}%")
                  ->orWhere('subject', 'LIKE', "%{$search}%")
                  ->orWhere('customer_name', 'LIKE', "%{$search}%")
                  ->orWhere('customer_email', 'LIKE', "%{$search}%");
            });
        }

        $tickets = $query->latest('updated_at')->paginate(15);
        $agents = User::all();

        return view('admin.tickets.index', compact('tickets', 'agents', 'status', 'priority', 'search'));
    }

    public function showTicket(int $id): View
    {
        $ticket = Ticket::with(['replies.attachments', 'assignedAgent', 'replies.user'])->findOrFail($id);
        $agents = User::all();

        return view('admin.tickets.show', compact('ticket', 'agents'));
    }

    public function replyTicket(Request $request, int $id): RedirectResponse
    {
        $ticket = Ticket::findOrFail($id);

        $validated = $request->validate([
            'body_text' => ['required', 'string', 'max:5000'],
            'is_internal_note' => ['nullable', 'boolean'],
            'status' => ['nullable', 'string', 'in:NEW,OPEN,PENDING,RESOLVED,CLOSED'],
            'assigned_agent_id' => ['nullable', 'exists:users,id'],
            'attachment' => ['nullable', 'file', 'mimes:pdf,jpg,png,doc,docx', 'max:5120'],
        ]);

        $isInternal = $request->boolean('is_internal_note');

        $reply = TicketReply::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'sender_name' => Auth::user()->name,
            'sender_email' => Auth::user()->email,
            'sender_type' => 'AGENT',
            'message_id' => '<agent-reply-' . Str::uuid() . '@zimmoah.com>',
            'body_text' => strip_tags($validated['body_text']),
            'is_internal_note' => $isInternal,
        ]);

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $originalName = $file->getClientOriginalName();
            $path = $file->storeAs('ticket_attachments', Str::random(40) . '.' . $file->getClientOriginalExtension(), 'local');

            TicketAttachment::create([
                'ticket_id' => $ticket->id,
                'ticket_reply_id' => $reply->id,
                'file_name' => $originalName,
                'file_path' => $path,
                'file_size' => $file->getSize(),
                'mime_type' => $file->getMimeType(),
            ]);
        }

        // Update ticket meta
        if (!$isInternal && !$ticket->first_responded_at) {
            $ticket->first_responded_at = now();
        }

        if (!empty($validated['status'])) {
            $ticket->status = TicketStatus::from($validated['status']);
            if ($ticket->status === TicketStatus::RESOLVED && !$ticket->resolved_at) {
                $ticket->resolved_at = now();
            }
        } elseif (!$isInternal) {
            $ticket->status = TicketStatus::PENDING; // Waiting customer response
        }

        if (isset($validated['assigned_agent_id'])) {
            $ticket->assigned_agent_id = $validated['assigned_agent_id'];
        }

        $ticket->save();

        $msg = $isInternal ? 'Catatan internal berhasil disimpan.' : 'Balasan berhasil dikirimkan ke pelanggan.';
        return back()->with('success', $msg);
    }

    // HR ATS Management
    public function applications(Request $request): View
    {
        $stage = $request->input('stage');
        $jobId = $request->input('job_id');
        $search = $request->input('search');

        $query = JobApplication::with('jobPosting.office');

        if ($stage) {
            $query->where('stage', $stage);
        }
        if ($jobId) {
            $query->where('job_posting_id', $jobId);
        }
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('phone', 'LIKE', "%{$search}%");
            });
        }

        $applications = $query->latest()->paginate(15);
        $jobs = JobPosting::all();

        return view('admin.hr.applications', compact('applications', 'jobs', 'stage', 'jobId', 'search'));
    }

    public function showApplication(int $id): View
    {
        $application = JobApplication::with(['jobPosting.office', 'notes.author'])->findOrFail($id);
        return view('admin.hr.show', compact('application'));
    }

    public function updateApplicationStage(Request $request, int $id): RedirectResponse
    {
        $application = JobApplication::findOrFail($id);

        $validated = $request->validate([
            'stage' => ['required', 'string', 'in:NEW,SCREENING,INTERVIEW,OFFER,HIRED,REJECTED'],
            'rating' => ['nullable', 'integer', 'between:0,5'],
        ]);

        $application->stage = ApplicationStage::from($validated['stage']);
        if (isset($validated['rating'])) {
            $application->rating = (int)$validated['rating'];
        }
        $application->save();

        return back()->with('success', "Tahapan kandidat diperbarui menjadi: {$application->stage->label()}.");
    }

    public function addApplicationNote(Request $request, int $id): RedirectResponse
    {
        $application = JobApplication::findOrFail($id);

        $validated = $request->validate([
            'note' => ['required', 'string', 'max:2000'],
        ]);

        ApplicationNote::create([
            'job_application_id' => $application->id,
            'user_id' => Auth::id(),
            'note' => strip_tags($validated['note']),
        ]);

        return back()->with('success', 'Catatan evaluasi pelamar berhasil ditambahkan.');
    }

    /**
     * Secure Resume Streamer (Prevents direct URL access & verifies staff session)
     */
    public function downloadResume(int $id): StreamedResponse
    {
        $application = JobApplication::findOrFail($id);

        // Security check: must exist in private storage
        if (!Storage::disk('local')->exists($application->resume_path)) {
            abort(404, 'Berkas resume tidak ditemukan di penyimpanan server.');
        }

        return Storage::disk('local')->download(
            $application->resume_path,
            $application->resume_original_name
        );
    }

    /**
     * Secure Ticket Attachment Streamer
     */
    public function downloadAttachment(int $id): StreamedResponse
    {
        $attachment = TicketAttachment::findOrFail($id);

        if (!Storage::disk('local')->exists($attachment->file_path)) {
            abort(404, 'Lampiran tidak ditemukan di penyimpanan.');
        }

        return Storage::disk('local')->download(
            $attachment->file_path,
            $attachment->file_name
        );
    }
}

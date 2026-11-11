<?php

namespace App\Http\Controllers;

use App\Enums\ApplicationStage;
use App\Models\JobApplication;
use App\Models\JobPosting;
use App\Models\Office;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CareerController extends Controller
{
    public function index(Request $request): View
    {
        $department = $request->input('department');
        $officeId = $request->input('office_id');
        $type = $request->input('type');

        $query = JobPosting::where('is_active', true)->with('office');

        if ($department) {
            $query->where('department', $department);
        }
        if ($officeId) {
            $query->where('office_id', $officeId);
        }
        if ($type) {
            $query->where('employment_type', $type);
        }

        $jobs = $query->latest()->paginate(9);
        $offices = Office::all();
        $departments = JobPosting::where('is_active', true)->distinct()->pluck('department');

        return view('career.index', compact('jobs', 'offices', 'departments', 'department', 'officeId', 'type'));
    }

    public function show(string $slug): View
    {
        $job = JobPosting::where('slug', $slug)
            ->where('is_active', true)
            ->with('office')
            ->firstOrFail();

        $relatedJobs = JobPosting::where('is_active', true)
            ->where('id', '!=', $job->id)
            ->where(function ($q) use ($job) {
                $q->where('department', $job->department)
                  ->orWhere('office_id', $job->office_id);
            })
            ->take(3)
            ->get();

        return view('career.show', compact('job', 'relatedJobs'));
    }

    public function apply(Request $request, string $slug): RedirectResponse
    {
        $job = JobPosting::where('slug', $slug)->where('is_active', true)->firstOrFail();

        // 1. Strict input validation with file checks
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email:rfc', 'max:150'],
            'phone' => ['required', 'string', 'max:25'],
            'linkedin_url' => ['nullable', 'url', 'max:255'],
            'expected_salary' => ['nullable', 'numeric', 'min:0', 'max:999999999'],
            'notice_period' => ['nullable', 'string', 'max:50'],
            'cover_letter' => ['nullable', 'string', 'max:2000'],
            'resume' => [
                'required',
                'file',
                'mimes:pdf,doc,docx',
                'max:5120', // Max 5MB
            ],
        ]);

        // 2. Secure file upload storage (Private storage with randomized hash)
        $file = $request->file('resume');
        $extension = $file->getClientOriginalExtension();
        $originalName = $file->getClientOriginalName();
        $hashedName = Str::random(40) . '.' . $extension;

        // Store into private storage: storage/app/private/resumes
        $path = $file->storeAs('resumes', $hashedName, 'local');

        // 3. Save application
        JobApplication::create([
            'job_posting_id' => $job->id,
            'full_name' => strip_tags($validated['full_name']),
            'email' => strtolower(trim($validated['email'])),
            'phone' => strip_tags($validated['phone']),
            'linkedin_url' => $validated['linkedin_url'] ?? null,
            'resume_path' => $path,
            'resume_original_name' => $originalName,
            'expected_salary' => $validated['expected_salary'] ?? null,
            'notice_period' => !empty($validated['notice_period']) ? strip_tags($validated['notice_period']) : null,
            'cover_letter' => !empty($validated['cover_letter']) ? strip_tags($validated['cover_letter']) : null,
            'stage' => ApplicationStage::NEW,
            'rating' => 0,
        ]);

        return redirect()->route('career.success', ['slug' => $job->slug])
            ->with('success', 'Lamaran Anda berhasil dikirim ke tim HR Zimmoah.');
    }

    public function success(string $slug): View
    {
        $job = JobPosting::where('slug', $slug)->firstOrFail();
        return view('career.success', compact('job'));
    }
}

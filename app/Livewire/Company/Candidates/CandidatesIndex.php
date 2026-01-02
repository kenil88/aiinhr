<?php

namespace App\Livewire\Company\Candidates;

use App\Models\Application;
use App\Models\Candidate;
use App\Models\CandidateActivity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

#[Layout('layouts.app-sidebar')]
class CandidatesIndex extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $showAssignModal = false;
    public $selectedCandidateId = null;
    public $selectedJobId = null;
    public $jobs = [];
    public $appliedJobIds = [];
    public $showResumeModal = false;
    public $resume;
    public $resumeCandidateId;
    public $showResumePreview = false;
    public $resumePreviewPath = null;
    protected $paginationTheme = 'tailwind';
    public $search = '';
    public $perPage = 10;
    public $resumeFilter = 'all';

    public function render()
    {
        $query = Candidate::where('company_id', Auth::user()->company_id)
            ->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->withCount([
                'applications as applications_count' => function ($q) {
                    $q->whereNotNull('job_id');
                }
            ])
            ->with(['applications:id,candidate_id,resume_path,job_id'])
            ->latest();

        // Resume filter
        if ($this->resumeFilter === 'uploaded') {
            $query->whereHas('applications', function ($q) {
                $q->whereNotNull('resume_path');
            });
        }

        if ($this->resumeFilter === 'missing') {
            $query->whereDoesntHave('applications', function ($q) {
                $q->whereNotNull('resume_path');
            });
        }

        return view('livewire.company.candidates.candidates-index', [
            'candidates' => $query->paginate($this->perPage),
        ]);
    }

    public function openAssignModal($candidateId)
    {
        $this->selectedCandidateId = $candidateId;

        // All open jobs of company
        $this->jobs = Auth::user()
            ->company
            ->jobs()
            ->where('status', 'open')
            ->get();

        // Jobs candidate already applied to
        $this->appliedJobIds = Application::where('candidate_id', $candidateId)
            ->pluck('job_id')
            ->toArray();

        $this->showAssignModal = true;
    }

    public function assignToJob()
    {
        $this->validate([
            'selectedJobId' => [
                'required',
                'integer',
                Rule::exists('ats_jobs', 'id')
                    ->where('company_id', Auth::user()->company_id),
            ],
        ]);

        $this->selectedJobId = (int) $this->selectedJobId;

        // 1️⃣ Check if candidate already applied to this job
        $exists = Application::where('candidate_id', $this->selectedCandidateId)
            ->where('job_id', $this->selectedJobId)
            ->exists();

        if ($exists) {
            $this->addError('selectedJobId', 'Candidate already applied to this job.');
            return;
        }

        // 2️⃣ Find placeholder application (job_id = null)
        $placeholder = Application::where('candidate_id', $this->selectedCandidateId)
            ->whereNull('job_id')
            ->first();

        if ($placeholder) {
            // 3️⃣ Convert placeholder → real application
            $placeholder->update([
                'job_id' => $this->selectedJobId,
                'status' => 'new',
            ]);
        } else {
            // 4️⃣ Create new application if no placeholder exists
            Application::create([
                'company_id' => Auth::user()->company_id,
                'candidate_id' => $this->selectedCandidateId,
                'job_id' => $this->selectedJobId,
                'status' => 'new',
            ]);
        }

        // 5️⃣ Reset modal state
        $this->reset([
            'showAssignModal',
            'selectedJobId',
            'selectedCandidateId',
            'appliedJobIds',
        ]);
        // 6️⃣ Log activity
        CandidateActivity::create([
            'company_id' => Auth::user()->company_id,
            'candidate_id' => $this->selectedCandidateId,
            'job_id' => $this->selectedJobId,
            'type' => 'job_assigned',
            'message' => 'Assigned to job',
        ]);

        session()->flash('success', 'Candidate assigned to job successfully.');
    }

    public function hasResume($candidate): bool
    {
        return $candidate->applications->whereNotNull('resume_path')->isNotEmpty();
    }

    public function openResumeModal($candidateId)
    {
        $this->resumeCandidateId = $candidateId;
        $this->resume = null;
        $this->showResumeModal = true;
    }

    public function openResumePreview($candidateId)
    {
        $application = Application::where('candidate_id', $candidateId)
            ->whereNotNull('resume_path')
            ->latest()
            ->first();

        if (! $application) {
            return;
        }

        $this->resumePreviewPath = $application->resume_path;
        $this->showResumePreview = true;
    }

    public function uploadResume()
    {
        $this->validate([
            'resume' => 'required|file|mimes:pdf,doc,docx|max:5120',
        ]);

        // 1️⃣ Find latest application (job OR no job)
        $application = Application::where('candidate_id', $this->resumeCandidateId)
            ->latest()
            ->first();

        // 2️⃣ If no application exists → create placeholder
        if (! $application) {
            $application = Application::create([
                'company_id' => Auth::user()->company_id,
                'candidate_id' => $this->resumeCandidateId,
                'job_id' => null, // sourced / talent pool
                'status' => 'new',
            ]);
        }

        // 3️⃣ Store resume
        $path = $this->resume->store('resumes', 'public');

        // 4️⃣ Attach resume
        $application->update([
            'resume_path' => $path,
        ]);

        // 5️⃣ UX: close upload modal, open preview
        $this->showResumeModal = false;
        $this->resumePreviewPath = $path;
        $this->showResumePreview = true;

        // 6️⃣ Reset state
        $this->resume = null;
        $this->resumeCandidateId = null;

        session()->flash('success', 'Resume uploaded successfully.');

        CandidateActivity::create([
            'company_id' => Auth::user()->company_id,
            'candidate_id' => $application->candidate_id,
            'job_id' => $application->job_id,
            'type' => 'resume_uploaded',
            'message' => 'Resume uploaded',
        ]);
    }

    public function updated($property)
    {
        if (in_array($property, ['search', 'resumeFilter', 'perPage'])) {
            $this->resetPage();
        }
    }
}

<?php

namespace App\Livewire\Company\Applications;

use Livewire\Component;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('layouts.app-sidebar')]
class ApplicationShow extends Component
{
    public Application $application;
    public $status;

    public function mount(Application $application)
    {
        // 🔐 Security: ensure application belongs to company
        abort_if(
            $application->job->company_id !== Auth::user()->company_id,
            403
        );

        $this->application = $application;
        $this->status = $application->status;
    }

    public function render()
    {
        return view('livewire.company.applications.application-show');
    }

    public function updateStatus()
    {
        $allowed = ['new', 'shortlisted', 'interview', 'hired', 'rejected'];

        abort_unless(in_array($this->status, $allowed), 403);

        $this->application->update([
            'status' => $this->status,
        ]);

        session()->flash('success', 'Candidate status updated.');
    }
}

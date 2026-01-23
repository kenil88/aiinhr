<?php

namespace App\Livewire\Company\Jobs;

use Livewire\Component;
use App\Models\Requisition;
use App\Models\Job;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Layout('admin.layouts.app-sidebar')]
class JobCreateFromRequisition extends Component
{
    public Requisition $requisition;

    public $title;
    public $description;
    public $employment_type;
    public $salary_min;
    public $salary_max;

    public function mount(Requisition $requisition)
    {
        abort_unless(
            $requisition->company_id === Auth::user()->company_id,
            403
        );

        abort_unless(
            $requisition->status === 'approved',
            403
        );

        // pre-fill from requisition
        $this->requisition = $requisition;

        // ✅ Prefill job fields from requisition
        $this->title = $requisition->job_title;
        $this->employment_type = $requisition->employment_type;
        $this->salary_min = $requisition->salary_min;
        $this->salary_max = $requisition->salary_max;
    }

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:50',
        ];
    }

    public function createJob()
    {
        $this->validate();

        // prevent duplicate job creation
        if ($this->requisition->job) {
            session()->flash('error', 'Job already created for this requisition.');
            return;
        }

        Job::create([
            'title' => $this->title,
            'description' => $this->description,
            'salary_min' => $this->salary_min,
            'salary_max' => $this->salary_max,
            'company_id' => Auth::user()->company_id,
            'requisition_id' => $this->requisition->id,
            'status' => 'draft',
        ]);

        session()->flash('success', 'Job created from requisition.');

        return redirect()->route('company.jobs');
    }

    public function render()
    {
        return view('admin.livewire.company.jobs.job-create-from-requisition');
    }
}

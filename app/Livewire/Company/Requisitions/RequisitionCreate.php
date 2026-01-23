<?php

namespace App\Livewire\Company\Requisitions;

use App\Models\Job;
use Livewire\Component;
use App\Models\Requisition;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Layout('admin.layouts.app-sidebar')]
class RequisitionCreate extends Component
{
    public $job_title;
    public $openings = 1;
    public $employment_type;
    public $salary_min;
    public $salary_max;
    public $priority = 'medium';
    public $reason;

    public function rules()
    {
        return [
            'job_title' => 'required|string|max:255',
            'openings' => 'required|integer|min:1',
            'employment_type' => 'required|in:full_time,part_time,contract,intern',
            'salary_min' => 'nullable|integer',
            'salary_max' => 'nullable|integer|gte:salary_min',
            'priority' => 'required|in:low,medium,high',
            'reason' => 'nullable|string|max:1000',
        ];
    }

    public function saveDraft()
    {
        $this->validate();

        $this->createRequisition('draft');

        session()->flash('success', 'Requisition saved as draft.');
        return redirect()->route('company.requisitions.index');
    }

    public function submit()
    {
        $this->validate();

        $this->createRequisition('submitted');

        session()->flash('success', 'Requisition submitted for approval.');
        return redirect()->route('company.requisitions.index');
    }

    protected function createRequisition(string $status)
    {
        Requisition::create([
            'requisition_code' => 'REQ-' . now()->year . '-' . Str::upper(Str::random(5)),
            'job_title' => $this->job_title,
            'openings' => $this->openings,
            'employment_type' => $this->employment_type,
            'salary_min' => $this->salary_min,
            'salary_max' => $this->salary_max,
            'priority' => $this->priority,
            'reason' => $this->reason,
            'status' => $status,

            // multi-tenant safe
            'company_id' => Auth::user()->company_id,
            'requested_by' => Auth::id(),
        ]);
    }

    public function render()
    {
        return view('admin.livewire.company.requisitions.requisition-create');
    }
}

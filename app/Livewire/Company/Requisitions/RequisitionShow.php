<?php

namespace App\Livewire\Company\Requisitions;

use Livewire\Component;
use App\Models\Requisition;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('admin.layouts.app-sidebar')]
class RequisitionShow extends Component
{
    public Requisition $requisition;

    public function mount(Requisition $requisition)
    {
        // multi-tenant safety
        abort_unless(
            $requisition->company_id === Auth::user()->company_id,
            403
        );

        $this->requisition = $requisition;
    }

    public function approve()
    {
        abort_unless(Auth::user()->isOwner(), 403);

        if ($this->requisition->status !== 'submitted') {
            return;
        }

        $this->requisition->approve(Auth::user());
        session()->flash('success', 'Requisition approved.');
    }

    public function reject()
    {
        abort_unless(Auth::user()->isOwner(), 403);

        if ($this->requisition->status !== 'submitted') {
            return;
        }

        $this->requisition->reject(Auth::user());
        session()->flash('success', 'Requisition rejected.');
    }

    public function render()
    {
        return view('admin.livewire.company.requisitions.requisition-show');
    }
}

<?php

namespace App\Livewire\Company\Requisitions;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Requisition;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('layouts.app-sidebar')]
class RequisitionsIndex extends Component
{
    use WithPagination;

    public $statusFilter = 'all';

    public function approve($id)
    {
        $this->authorizeOwner();

        $requisition = Requisition::where('company_id', Auth::user()->company_id)
            ->where('status', 'submitted')
            ->findOrFail($id);

        $requisition->approve(Auth::user());

        session()->flash('success', 'Requisition approved successfully.');
    }

    public function reject($id)
    {
        $this->authorizeOwner();

        $requisition = Requisition::where('company_id', Auth::user()->company_id)
            ->where('status', 'submitted')
            ->findOrFail($id);

        $requisition->reject(Auth::user());

        session()->flash('success', 'Requisition rejected.');
    }

    protected function authorizeOwner()
    {
        abort_unless(Auth::user()->isOwner(), 403);
    }

    public function render()
    {
        $query = Requisition::query()
            ->with('requester')
            ->where('company_id', Auth::user()->company_id)
            ->latest();

        if ($this->statusFilter !== 'all') {
            $query->where('status', $this->statusFilter);
        }

        return view('livewire.company.requisitions.requisitions-index', [
            'requisitions' => $query->paginate(10),
        ]);
    }
}

<?php

namespace App\Livewire\Company;

use App\Models\User;
use App\Support\CompanyLimits;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('admin.layouts.app-sidebar')]
class TeamMembers extends Component
{
    public $name;
    public $email;
    public $role = 'recruiter';
    public $roles = [];
    public $generatedPassword;

    public function mount()
    {
        abort_unless(Auth::user()->isOwner(), 403);

        $this->roles = User::where('company_id', Auth::user()->company_id)
            ->pluck('role', 'id')
            ->toArray();
    }

    public function invite()
    {

        $company = Auth::user()->company;

        if (! CompanyLimits::canAddTeamMember($company)) {
            $this->addError('limit', 'You have reached the maximum number of team members allowed for your plan.');
            return;
        }

        // Validate input
        $this->validate([
            'name' => 'required|string|min:2',
            'email' => [
                'required',
                'email',
                function ($attribute, $value, $fail) {
                    $exists = User::where('email', $value)
                        ->where('company_id', Auth::user()->company_id)
                        ->exists();

                    if ($exists) {
                        $fail('This user is already part of your team.');
                    }
                },
            ],
            'role' => 'required|in:recruiter,viewer',
        ]);

        // Generate a random password
        $password = Str::random(10);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($password),
            'role' => $this->role,
            'company_id' => Auth::user()->company_id,
        ]);

        $user->sendPasswordResetNotification(app('auth.password.broker')->createToken($user));

        $this->generatedPassword = $password;

        $this->reset(['name', 'email', 'role']);
    }

    public function render()
    {
        return view('admin.livewire.company.team-members', [
            'members' => User::where('company_id', auth()->user()->company_id)->get(),
        ]);
    }

    public function deactivate($userId)
    {
        abort_unless(Auth::user()->isOwner(), 403);

        $user = User::where('company_id', Auth::user()->company_id)
            ->where('id', $userId)
            ->firstOrFail();

        if ($user->id === Auth::id()) {
            session()->flash('error', 'You cannot remove yourself.');
            return;
        }

        if ($user->role === 'owner') {
            $ownersCount = User::where('company_id', Auth::user()->company_id)
                ->where('role', 'owner')
                ->where('is_active', true)
                ->count();

            if ($ownersCount <= 1) {
                session()->flash('error', 'At least one owner is required.');
                return;
            }
        }

        $user->update(['is_active' => false]);

        session()->flash('success', 'Team member deactivated.');
    }

    public function activate($userId)
    {
        abort_unless(Auth::user()->isOwner(), 403);

        $user = User::where('company_id', Auth::user()->company_id)
            ->where('id', $userId)
            ->firstOrFail();

        $user->update(['is_active' => true]);

        session()->flash('success', 'Team member activated.');
    }

    public function updateRole($userId)
    {
        abort_unless(Auth::user()->isOwner(), 403);

        $role = $this->roles[$userId] ?? null;

        if (! in_array($role, ['recruiter', 'viewer'])) {
            return;
        }

        $user = User::where('company_id', Auth::user()->company_id)
            ->where('id', $userId)
            ->firstOrFail();

        if ($user->id === Auth::id()) {
            session()->flash('error', 'You cannot change your own role.');
            return;
        }

        if (! $user->is_active) {
            session()->flash('error', 'Activate user before changing role.');
            return;
        }

        if ($user->role === 'owner') {
            session()->flash('error', 'Owner role cannot be changed.');
            return;
        }

        $user->update(['role' => $role]);

        session()->flash('success', 'Role updated successfully.');
    }

    public function getCanAddTeamMemberProperty(): bool
    {
        return CompanyLimits::canAddTeamMember(Auth::user()->company);
    }
}

<?php

namespace App\Livewire\Company\Profile;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

#[Layout('admin.layouts.app-sidebar')]
class CompanyProfileView extends Component
{
    use WithFileUploads;

    public $company;
    public $logo;

    public $name;
    public $description;
    public $country;
    public $city;
    public $address;
    public $phone;
    public $email;
    public $website;
    public $facebook;
    public $twitter;
    public $linkedin;

    public function mount()
    {
        $this->company = Auth::user()->company;
        abort_if(! $this->company, 403);

        // ✅ hydrate ONCE
        $this->name = $this->company->name;
        $this->description = $this->company->description;
        $this->country = $this->company->country;
        $this->city = $this->company->city;
        $this->address = $this->company->address;
        $this->phone = $this->company->phone;
        $this->email = $this->company->email;
        $this->website = $this->company->website;
        $this->facebook = $this->company->facebook;
        $this->twitter = $this->company->twitter;
        $this->linkedin = $this->company->linkedin;
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
        ]);

        $this->company->update([
            'name' => $this->name,
            'description' => $this->description,
            'country' => $this->country,
            'city' => $this->city,
            'address' => $this->address,
            'phone' => $this->phone,
            'email' => $this->email,
            'website' => $this->website,
            'facebook' => $this->facebook,
            'twitter' => $this->twitter,
            'linkedin' => $this->linkedin,
        ]);

        session()->flash('success', 'Company profile updated.');
    }

    public function render()
    {
        return view('admin.livewire.company.profile.company-profile-view');
    }
}

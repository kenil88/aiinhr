<?php

namespace App\Livewire\Company\Settings;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;

#[Layout('layouts.app-sidebar')]
class CompanyProfile extends Component
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

        // 🔑 HYDRATE FIELDS MANUALLY
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
        $data = $this->validate([
            'company.name' => 'required|string|max:255',
            'company.description' => 'nullable|string|max:1000',
            'company.country' => 'nullable|string|max:100',
            'company.city' => 'nullable|string|max:100',
            'company.address' => 'nullable|string|max:255',
            'company.phone' => 'nullable|string|max:20',
            'company.email' => 'nullable|email',
            'company.website' => 'nullable|url',
            'company.facebook' => 'nullable|url',
            'company.twitter' => 'nullable|url',
            'company.linkedin' => 'nullable|url',
            'logo' => 'nullable|image|max:1024',
        ]);

        if ($this->logo) {
            $path = $this->logo->store('company-logos', 'public');
            $this->company->logo = $path;
        }

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
        return view('livewire.company.settings.company-profile');
    }
}

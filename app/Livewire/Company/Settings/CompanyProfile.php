<?php

namespace App\Livewire\Company\Settings;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;

#[Layout('admin.layouts.app-sidebar')]
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
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'country' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'website' => 'nullable|url',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'logo' => 'nullable|image|max:1024',
        ]);

        if ($this->logo) {
            $path = $this->logo->store('company-logos', 'public');
            $this->company->logo = $path;
        }

        $this->company->name = $this->name;
        $this->company->description = $this->description;
        $this->company->country = $this->country;
        $this->company->city = $this->city;
        $this->company->address = $this->address;
        $this->company->phone = $this->phone;
        $this->company->email = $this->email;
        $this->company->website = $this->website;
        $this->company->facebook = $this->facebook;
        $this->company->twitter = $this->twitter;
        $this->company->linkedin = $this->linkedin;

        $this->company->save();

        session()->flash('success', 'Company profile updated.');
    }

    public function render()
    {
        return view('admin.livewire.company.settings.company-profile');
    }
}

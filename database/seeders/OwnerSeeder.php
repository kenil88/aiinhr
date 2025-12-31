<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;

class OwnerSeeder extends Seeder
{
    public function run(): void
    {
        $company = Company::where('name', 'Demo Company')->first();

        User::updateOrCreate(
            ['email' => 'hr@demo.com'],
            [
                'name' => 'HR Manager',
                'password' => Hash::make('password'),
                'role' => 'owner',
                'company_id' => $company->id,
            ]
        );
    }
}

<?php

namespace Database\Seeders;

use App\Models\Requisition;
use App\Models\User;
use Illuminate\Database\Seeder;

class RequisitionSeeder extends Seeder
{
    public function run(): void
    {
        $owner = User::where('role', 'owner')->first();

        // Create draft requisitions
        Requisition::factory()
            ->count(5)
            ->create([
                'status' => 'draft',
            ]);

        // Create submitted requisitions
        Requisition::factory()
            ->count(5)
            ->submitted()
            ->create();

        // Create approved requisitions
        if ($owner) {
            Requisition::factory()
                ->count(5)
                ->approved($owner)
                ->create();
        }
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('ats_jobs', function (Blueprint $table) {
            $table->string('department')->nullable();
            $table->string('location')->nullable();
            $table->enum('employment_type', [
                'full-time',
                'part-time',
                'contract',
                'internship'
            ])->default('full-time');
            $table->enum('experience_level', [
                'junior',
                'mid',
                'senior',
                'lead'
            ])->nullable();
            $table->integer('salary_min')->nullable();
            $table->integer('salary_max')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ats_jobs', function (Blueprint $table) {
            $table->dropColumn([
                'department',
                'location',
                'employment_type',
                'experience_level',
                'salary_min',
                'salary_max'
            ]);
        });
    }
};

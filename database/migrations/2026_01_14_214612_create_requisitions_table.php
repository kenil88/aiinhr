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
        Schema::create('requisitions', function (Blueprint $table) {
            $table->id();

            $table->string('requisition_code')->unique(); // REQ-2026-001

            $table->string('job_title');
            $table->unsignedBigInteger('department_id')->nullable();

            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('requested_by'); // hiring manager (user_id)
            $table->unsignedBigInteger('approved_by')->nullable(); // approver (user_id)

            $table->integer('openings')->default(1);

            $table->enum('employment_type', [
                'full_time',
                'part_time',
                'contract',
                'intern'
            ]);

            $table->integer('salary_min')->nullable();
            $table->integer('salary_max')->nullable();

            $table->enum('priority', ['low', 'medium', 'high'])->default('medium');

            $table->enum('status', [
                'draft',
                'submitted',
                'approved',
                'rejected',
                'closed'
            ])->default('draft');

            $table->text('reason')->nullable(); // why hire?

            $table->timestamp('approved_at')->nullable();
            $table->timestamp('closed_at')->nullable();

            $table->timestamps();

            // indexes
            $table->index(['company_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requisitions');
    }
};

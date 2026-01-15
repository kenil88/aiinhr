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
        Schema::table('requisitions', function (Blueprint $table) {

            if (!Schema::hasColumn('requisitions', 'requisition_code')) {
                $table->string('requisition_code')->unique();
            }

            if (!Schema::hasColumn('requisitions', 'job_title')) {
                $table->string('job_title');
            }

            if (!Schema::hasColumn('requisitions', 'department_id')) {
                $table->unsignedBigInteger('department_id')->nullable();
            }

            if (!Schema::hasColumn('requisitions', 'company_id')) {
                $table->unsignedBigInteger('company_id');
            }

            if (!Schema::hasColumn('requisitions', 'requested_by')) {
                $table->unsignedBigInteger('requested_by');
            }

            if (!Schema::hasColumn('requisitions', 'approved_by')) {
                $table->unsignedBigInteger('approved_by')->nullable();
            }

            if (!Schema::hasColumn('requisitions', 'openings')) {
                $table->integer('openings')->default(1);
            }

            if (!Schema::hasColumn('requisitions', 'employment_type')) {
                $table->enum('employment_type', [
                    'full_time',
                    'part_time',
                    'contract',
                    'intern'
                ]);
            }

            if (!Schema::hasColumn('requisitions', 'salary_min')) {
                $table->integer('salary_min')->nullable();
            }

            if (!Schema::hasColumn('requisitions', 'salary_max')) {
                $table->integer('salary_max')->nullable();
            }

            if (!Schema::hasColumn('requisitions', 'priority')) {
                $table->enum('priority', ['low', 'medium', 'high'])->default('medium');
            }

            if (!Schema::hasColumn('requisitions', 'status')) {
                $table->enum('status', [
                    'draft',
                    'submitted',
                    'approved',
                    'rejected',
                    'closed'
                ])->default('draft');
            }

            if (!Schema::hasColumn('requisitions', 'reason')) {
                $table->text('reason')->nullable();
            }

            if (!Schema::hasColumn('requisitions', 'approved_at')) {
                $table->timestamp('approved_at')->nullable();
            }

            if (!Schema::hasColumn('requisitions', 'closed_at')) {
                $table->timestamp('closed_at')->nullable();
            }

            if (
                !Schema::hasColumn('requisitions', 'company_id')
                || !Schema::hasColumn('requisitions', 'status')
            ) {
                $table->index(['company_id', 'status']);
            }
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('requisitions', function (Blueprint $table) {
            $table->dropColumn([
                'requisition_code',
                'job_title',
                'department_id',
                'company_id',
                'requested_by',
                'approved_by',
                'openings',
                'employment_type',
                'salary_min',
                'salary_max',
                'priority',
                'status',
                'reason',
                'approved_at',
                'closed_at'
            ]);
        });
    }
};

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
            if (!Schema::hasColumn('ats_jobs', 'requisition_id')) {
                $table->unsignedBigInteger('requisition_id')->nullable()->after('company_id');

                $table->index('requisition_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ats_jobs', function (Blueprint $table) {
            if (Schema::hasColumn('ats_jobs', 'requisition_id')) {
                $table->dropColumn('requisition_id');
            }
        });
    }
};

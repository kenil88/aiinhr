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
        Schema::table('companies', function (Blueprint $table) {
            $table->string('logo')->nullable()->after('name');
            $table->text('description')->nullable();

            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();

            $table->string('website')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn([
                'logo',
                'description',
                'country',
                'city',
                'address',
                'website',
                'facebook',
                'twitter',
                'linkedin',
            ]);
        });
    }
};

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
        Schema::table('company', function (Blueprint $table) {
            Schema::table('company', function (Blueprint $table) {
                $table->foreignId('hr_id')->nullable()->constrained('users');
                $table->foreignId('manager_id')->nullable()->constrained('users');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('company', function (Blueprint $table) {
            $table->dropColumn('hr_id');
            $table->dropColumn('manager_id');
        });
    }
};

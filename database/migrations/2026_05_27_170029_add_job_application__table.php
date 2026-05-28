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
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->string('name', 20);
            $table->decimal('salary', 10, 2);
            $table->enum('status', ['active', 'inActive'])->default('active');
            $table->enum('type', ['part-time', 'full-time', 'hybrid', 'internship'])->default('internship');
            $table->foreignId('company_id')->constrained('company')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};

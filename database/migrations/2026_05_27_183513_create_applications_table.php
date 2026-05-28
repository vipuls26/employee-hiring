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

        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('employee_name', 50);
            $table->string('employee_email', 50);
            $table->enum('overall_status', ['pending', 'hr_approved', 'hr_rejected', 'manager_approved', 'manager_rejected', 'owner_approved', 'owner_rejected'])->default('pending');
            $table->foreignId('job_id')->constrained('job_applications');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });


        Schema::create('application_approvals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained('applications')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users');
            $table->enum('role', ['hr', 'manager', 'owner']);
            $table->enum('action', ['accept', 'reject']);
            $table->string('reason', 255)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
        Schema::dropIfExists('application_approvals');
    }
};

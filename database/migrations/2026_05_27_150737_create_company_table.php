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
        Schema::create('company', function (Blueprint $table) {
            $table->id();
            $table->string('name', 20);
            $table->string('email', 50);
            $table->string('phone', 12);
            $table->string('website', 50);
            $table->string('description', 50);
            $table->string('location', 20);
            $table->foreignId('owner_id')->constrained('users');
            
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company');
    }
};

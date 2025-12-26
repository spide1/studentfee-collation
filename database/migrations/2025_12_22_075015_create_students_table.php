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
      Schema::create('students', function (Blueprint $table) {
    $table->id();

    $table->unsignedBigInteger('institute_id')->index();

    $table->string('name');
    $table->string('parent_name')->nullable();
    $table->string('academic_year'); // 2025-2026

    $table->decimal('monthly_fee', 10, 2)->nullable();
    $table->decimal('quarterly_fee', 10, 2)->nullable();
    $table->decimal('annual_fee', 10, 2)->nullable();

    $table->enum('is_active', ['Y', 'N'])->default('Y');
    $table->timestamps();
});


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};



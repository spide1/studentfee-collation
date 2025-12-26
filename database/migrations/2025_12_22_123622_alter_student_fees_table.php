<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_fees', function (Blueprint $table) {
            $table->id();

            // Logical reference (no FK constraint as per your design)
            $table->unsignedBigInteger('student_id')->index();

            $table->decimal('monthly_fee', 10, 2)->nullable();
            $table->decimal('quarterly_fee', 10, 2)->nullable();
            $table->decimal('annual_fee', 10, 2)->nullable();

            $table->enum('is_active', ['Y', 'N'])->default('Y');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_fees');
    }
};

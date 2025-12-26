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
            $table->unsignedBigInteger('institute_id');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('name');
            $table->string('parent_name');
            $table->string('mobile');
            $table->string('roll_no')->nullable();
            $table->string('class');
            $table->string('section')->nullable();

            $table->string('academic_year');
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

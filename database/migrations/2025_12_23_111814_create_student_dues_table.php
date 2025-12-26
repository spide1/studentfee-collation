<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_duues', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('student_id');

            $table->string('month');        // April, May etc
            $table->integer('year');        // 2025
            $table->decimal('amount', 10, 2);

            $table->enum('status', ['PAID', 'UNPAID'])->default('UNPAID');;
            $table->enum('is_active', ['Y', 'N'])->default('Y');
            $table->unsignedBigInteger('payment_id');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_dues');
    }
};

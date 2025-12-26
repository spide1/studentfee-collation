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
        Schema::create('payments', function (Blueprint $table) {
    $table->id();

    $table->unsignedBigInteger('student_id')->index();

    $table->decimal('amount', 10, 2);
    $table->enum('type', ['DUE', 'ADVANCE']);
    $table->enum('mode', ['ONLINE', 'CASH', 'UPI']);

    $table->enum('is_active', ['Y', 'N'])->default('Y');
    $table->timestamps();
});


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

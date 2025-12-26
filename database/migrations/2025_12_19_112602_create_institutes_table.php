<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
     Schema::create('institutes', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email')->unique();
    $table->string('password');
    $table->enum('is_active', ['Y', 'N'])->default('N'); // admin approval
    $table->timestamps();
});




    }

    public function down(): void
    {
        Schema::dropIfExists('institutes');
    }
};

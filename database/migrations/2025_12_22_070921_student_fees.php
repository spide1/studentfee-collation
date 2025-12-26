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
    Schema::table('student_fees', function (Blueprint $table) {

        // Fee structure
        $table->enum('fee_type', ['MONTHLY','QUARTERLY','ANNUAL','ADVANCE'])
              ->after('student_id');

        // Base fee (important)
        $table->decimal('base_fee', 10,2)->after('fee_type');

        // Calculated fields
        $table->decimal('total_fee', 10,2)->after('base_fee');
        $table->decimal('paid_amount', 10,2)->default(0)->after('total_fee');
        $table->decimal('due_amount', 10,2)->default(0)->after('paid_amount');
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

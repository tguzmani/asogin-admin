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
        Schema::table('memberships', function (Blueprint $table) {
            // Remove the specified columns
            $table->dropColumn(['start_date', 'end_date', 'membership_type', 'status', 'member_id']);

            // Add new columns
            $table->string('name');
            $table->text('description')->nullable(); // Nullable if description isn't mandatory
            $table->decimal('base_price', 10, 2); // Adjust precision/scale as needed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('membership', function (Blueprint $table) {
            // Re-add the removed columns
            $table->date('start_date');
            $table->date('end_date');
            $table->string('membership_type');
            $table->string('status');
            $table->unsignedBigInteger('member_id');

            // Remove the added columns
            $table->dropColumn(['name', 'description', 'base_price']);
        });
    }
};

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
        Schema::create('member_membership', function (Blueprint $table) {
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
            $table->decimal('price', 10, 2);
            $table->timestamps();

            $table->unsignedBigInteger('membership_id');
            $table->unsignedBigInteger('member_id');

            $table->foreign('member_id')->references('id')->on('members')->cascadeOnDelete();
            $table->foreign('membership_id')->references('id')->on('memberships')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_membership');
    }
};

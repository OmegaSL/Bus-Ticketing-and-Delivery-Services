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
        Schema::create('seat_allocations', function (Blueprint $table) {
            $table->id();
			$table->foreignId('booking_id')->constrained('bookings')->onDelete('cascade');
			$table->foreignId('seat_id')->constrained('seats')->onDelete('cascade');
			$table->foreignId('driver_id')->constrained('users')->onDelete('cascade');
			$table->string('seat_type')->comment('1=lower, 2=upper');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seat_allocations');
    }
};

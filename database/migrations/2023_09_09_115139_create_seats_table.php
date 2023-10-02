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
        Schema::create('seats', function (Blueprint $table) {
            $table->id();
			$table->foreignId('bus_id')->constrained()->cascadeOnDelete();
			$table->string('seat_number');
			$table->string('seat_type')->nullable()->comment('Economy, Business, First Class');
			$table->string('seat_status')->nullable()->comment('Available, Booked, Blocked');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seats');
    }
};

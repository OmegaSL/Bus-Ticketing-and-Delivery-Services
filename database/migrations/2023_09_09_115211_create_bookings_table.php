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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
			$table->foreignId('user_id')->constrained('users')->onDelete('cascade');
			$table->foreignId('bus_id')->constrained('buses')->onDelete('cascade');
			$table->foreignId('departure_station_id')->constrained('bus_stations')->onDelete('cascade');
			$table->foreignId('arrival_station_id')->constrained('bus_stations')->onDelete('cascade');
			$table->string('booking_from');
			$table->string('booking_to');
	        $table->float('booking_amount')->default(0);
	        $table->string('booking_type')->comment('1=online, 2=offline');
			$table->string('booking_status')->comment('1=booked, 2=cancelled, 3=completed');
	        $table->dateTime('departure_date_time')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};

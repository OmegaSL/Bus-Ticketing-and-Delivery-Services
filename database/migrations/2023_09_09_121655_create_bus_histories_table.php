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
        Schema::create('bus_histories', function (Blueprint $table) {
            $table->id();
	        $table->foreignId('bus_id')->constrained('buses')->onDelete('cascade');
	        $table->foreignId('bus_driver_id')->constrained('users')->onDelete('cascade');
	        $table->foreignId('current_station_id')->nullable()->constrained('bus_stations')->onDelete('set null');
	        $table->foreignId('last_station_id')->nullable()->constrained('bus_stations')->onDelete('set null');
	        $table->dateTime('departure_date_time')->nullable();
	        $table->dateTime('arrival_date_time')->nullable();
	        $table->string('departure_city')->nullable();
	        $table->string('arrival_city')->nullable();
	        $table->float('price')->nullable();
	        $table->integer('travel_duration')->default(0)->comment('In minutes');
	        $table->string('bus_status')->comment('Active or Inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bus_histories');
    }
};

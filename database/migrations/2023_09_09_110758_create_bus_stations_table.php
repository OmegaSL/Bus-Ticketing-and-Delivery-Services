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
        Schema::create('bus_stations', function (Blueprint $table) {
            $table->id();
			$table->string('bus_station_name')->unique();
			$table->string('bus_station_city');
			$table->string('bus_station_country')->default('Ghana');
			$table->string('bus_station_address')->nullable();
			$table->string('bus_station_phone_number')->nullable();
			$table->string('bus_station_email')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bus_stations');
    }
};

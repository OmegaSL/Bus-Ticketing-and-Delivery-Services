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
        Schema::create('buses', function (Blueprint $table) {
            $table->id();
			$table->string('bus_name')->comment('Name of the bus. Ex: VIP, STC, etc or bus number');
			$table->string('bus_number')->unique();
			$table->string('bus_type')->comment('AC or Non-AC');
			$table->string('bus_route_from')->comment('Bus route from source. Ex: Koforidua');
			$table->string('bus_route_to')->comment('Bus route to destination. Ex: Madina');
			$table->integer('bus_capacity')->comment('Total number of seats in the bus');
			$table->integer('bus_route_price')->default(0)->comment('Price of the bus route');
			$table->string('bus_status')->comment('Active or Inactive');
			$table->string('bus_image')->nullable();
			$table->text('bus_description')->nullable();
			$table->json('bus_amenities')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buses');
    }
};

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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
			$table->foreignId('package_id')->constrained('packages');
			$table->foreignId('driver_id')->constrained('users');
			$table->string('delivery_current_location')->nullable();
			$table->string('delivery_last_location')->nullable();
			$table->string('delivery_code')->nullable();
	        $table->string('delivery_status')->default('pending')->comment('pending, processing, delivered, cancelled');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};

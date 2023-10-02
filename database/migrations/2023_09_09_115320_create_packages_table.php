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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
			$table->string('package_name');
			$table->string('package_type')->default('basic')->comment('Document, Parcel, Food, Clothes, Electronics, Others');
			$table->string('package_size')->default('small')->comment('small, medium, large');
			$table->string('package_description')->nullable();
			$table->string('package_from');
			$table->string('package_to')->nullable();
			$table->string('package_sender_name')->nullable();
			$table->string('package_sender_phone')->nullable();
			$table->string('package_sender_address')->nullable();
			$table->string('package_receiver_name')->nullable();
			$table->string('package_receiver_phone')->nullable();
			$table->string('package_receiver_address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};

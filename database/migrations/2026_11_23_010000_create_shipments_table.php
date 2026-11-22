<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->string('tracking_number', 50)->unique();
            $table->string('transport_mode', 20)->default('SEA'); // SEA, AIR, LAND
            $table->string('container_or_awb', 60)->index();
            $table->string('vessel_or_flight', 120);
            $table->string('origin_port', 120);
            $table->string('destination_port', 120);
            $table->string('shipper_name', 150);
            $table->string('consignee_name', 150);
            $table->string('cargo_description', 255);
            $table->decimal('weight_kg', 10, 2)->default(0);
            $table->string('container_size', 60)->nullable();
            $table->string('current_stage', 40)->default('booked')->index();
            $table->timestamp('departed_at')->nullable();
            $table->timestamp('estimated_arrival')->nullable();
            $table->json('milestones')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};

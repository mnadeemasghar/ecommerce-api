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
        Schema::create('product_measurements', function (Blueprint $table) {
            $table->id();
            $table->decimal('width_in_cm');
            $table->decimal('depth_in_cm');
            $table->decimal('height_in_cm');
            $table->decimal('package_width_in_cm');
            $table->decimal('package_depth_in_cm');
            $table->decimal('package_height_in_cm');
            $table->decimal('package_weight_in_kg');
            $table->integer('package_nos');
            $table->string('image');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_measurements');
    }
};

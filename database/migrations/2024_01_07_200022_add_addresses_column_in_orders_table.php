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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('drop_lat')->nullable();
            $table->string('drop_lng')->nullable();
            $table->string('drop_address')->nullable();
            $table->string('note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('drop_lat');
            $table->dropColumn('drop_lng');
            $table->dropColumn('drop_address');
            $table->dropColumn('note');
        });
    }
};

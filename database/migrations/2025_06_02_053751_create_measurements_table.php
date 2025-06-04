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
        Schema::create('measurements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aquarium_id')->constrained()->onDelete('cascade');
            $table->date('measured_on');
            $table->float('temperature')->nullable();
            $table->float('ph')->nullable();
            $table->float('kh')->nullable();
            $table->float('gh')->nullable();
            $table->float('nh4')->nullable();
            $table->float('no2')->nullable();
            $table->float('no3')->nullable();
            $table->float('po4')->nullable();
            $table->float('o2')->nullable();
            $table->float('co2')->nullable();
            $table->timestamps(); // Add this line
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('measurements');
    }
};

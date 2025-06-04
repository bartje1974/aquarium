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
        Schema::create('aquaria', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('volume_liters');
            $table->enum('type', ['zoetwater', 'zoutwater']);
            $table->date('started_at');  // Add this line
            $table->text('description')->nullable();
            $table->json('custom_thresholds')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aquaria');
    }
};

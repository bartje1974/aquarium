<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('measurements', function (Blueprint $table) {
            $table->float('water_refresh_liters')->nullable();
        });
    }

    public function down()
    {
        Schema::table('measurements', function (Blueprint $table) {
            $table->dropColumn('water_refresh_liters');
        });
    }
};
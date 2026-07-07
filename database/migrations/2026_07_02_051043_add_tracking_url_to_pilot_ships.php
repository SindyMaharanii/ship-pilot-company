<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pilot_ships', function (Blueprint $table) {
            $table->string('tracking_url')->nullable()->after('description');
            $table->string('tracking_provider')->default('vesselfinder')->after('tracking_url');
            $table->string('tracking_identifier')->nullable()->after('tracking_provider');
        });
    }

    public function down()
    {
        Schema::table('pilot_ships', function (Blueprint $table) {
            $table->dropColumn(['tracking_url', 'tracking_provider', 'tracking_identifier']);
        });
    }
};
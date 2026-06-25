<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pilot_ships', function (Blueprint $table) {
            $table->string('pilot_name')->nullable()->after('name');
        });
    }

    public function down()
    {
        Schema::table('pilot_ships', function (Blueprint $table) {
            $table->dropColumn(['pilot_name', 'pilot_contact']);
        });
    }
};
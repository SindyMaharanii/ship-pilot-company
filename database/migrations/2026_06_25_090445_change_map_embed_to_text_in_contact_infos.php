<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('contact_infos', function (Blueprint $table) {
            $table->text('map_embed')->change();
        });
    }

    public function down()
    {
        Schema::table('contact_infos', function (Blueprint $table) {
            $table->string('map_embed', 255)->change();
        });
    }
};
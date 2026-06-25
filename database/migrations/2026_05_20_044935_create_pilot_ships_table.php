<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pilot_ships', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('call_sign')->unique();
            $table->string('registration_number');
            $table->string('type');
            $table->string('status')->default('available');
            $table->text('technical_specs')->nullable();
            $table->integer('capacity')->nullable();
            $table->decimal('length', 8, 2)->nullable();
            $table->decimal('width', 8, 2)->nullable();
            $table->decimal('draft', 8, 2)->nullable();
            $table->decimal('speed', 8, 2)->nullable();
            $table->decimal('current_latitude', 10, 8)->nullable();
            $table->decimal('current_longitude', 11, 8)->nullable();
            $table->timestamp('last_position_update')->nullable();
            $table->text('description')->nullable();
            $table->string('photo')->nullable();
            $table->json('gallery')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pilot_ships');
    }
};
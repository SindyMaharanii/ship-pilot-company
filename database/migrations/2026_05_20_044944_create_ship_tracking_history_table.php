<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ship_tracking_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pilot_ship_id')->constrained()->onDelete('cascade');
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->string('status');
            $table->decimal('speed', 8, 2)->nullable();
            $table->decimal('heading', 5, 2)->nullable();
            $table->timestamp('tracked_at');
            $table->timestamps();
            
            $table->index(['pilot_ship_id', 'tracked_at']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('ship_tracking_history');
    }
};
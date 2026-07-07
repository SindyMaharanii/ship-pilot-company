<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pilot_ships', function (Blueprint $table) {
            // Hanya drop kolom yang benar-benar ada
            $columns = ['current_latitude', 'current_longitude', 'last_position_update', 'speed'];
            
            foreach ($columns as $column) {
                if (Schema::hasColumn('pilot_ships', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }

    public function down()
    {
        Schema::table('pilot_ships', function (Blueprint $table) {
            $table->decimal('current_latitude', 10, 8)->nullable();
            $table->decimal('current_longitude', 11, 8)->nullable();
            $table->timestamp('last_position_update')->nullable();
            $table->decimal('speed', 8, 2)->nullable();
        });
    }
};
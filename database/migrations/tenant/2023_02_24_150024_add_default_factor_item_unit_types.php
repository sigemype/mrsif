<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDefaultFactorItemUnitTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_unit_types', function (Blueprint $table) {
            $table->boolean('factor_default')->default(false)->after('price3');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item_unit_types', function (Blueprint $table) {
            $table->dropColumn('factor_default');
        });
    }
}

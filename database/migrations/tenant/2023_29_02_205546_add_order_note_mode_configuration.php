<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrderNoteModeConfiguration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('configurations', function (Blueprint $table) {
            $table->boolean('order_note_mode')->default(false);
        });
  
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       

        Schema::table('configurations', function (Blueprint $table) {
            $table->dropColumn('order_note_mode');
        });
    }
}

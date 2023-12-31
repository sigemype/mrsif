<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaultFormatEstablishment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      

            Schema::table('establishments', function(Blueprint $table){
                $table->string('print_format',50)->default('ticket');
            });
         
     
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
                
        
                Schema::table('establishments', function(Blueprint $table){
                    $table->dropColumn('print_format');
                });
            
    

      
    }
}

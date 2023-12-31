<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TenantAddDataToPaymentMethodTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        DB::table('payment_method_types')->insert([
            ['id' => '08', 'description' => 'A 30 días', 'has_card' => false, 'number_days' => 30, 'charge' => null],
            ['id' => '09', 'description' => 'Crédito', 'has_card' => true, 'number_days' => null, 'charge' => null],
            ['id' => '10', 'description' => 'Contado', 'has_card' => false, 'number_days' => null, 'charge' => null], 
            ['id' => '11', 'description' => 'Factura a 15 días', 'has_card' => false, 'number_days' => 15, 'charge' => null], 
            ['id' => '12', 'description' => 'Factura a 45 días', 'has_card' => false, 'number_days' => 45, 'charge' => null], 
            ['id' => '13', 'description' => 'Factura a 60 días', 'has_card' => false, 'number_days' => 60, 'charge' => null], 
            ['id' => '14', 'description' => 'Yape', 'has_card' => false, 'number_days' => null, 'charge' => null], 
            ['id' => '15', 'description' => 'Plin', 'has_card' => false, 'number_days' => null, 'charge' => null], 
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        DB::table('payment_method_types')->whereIn('id',['08','09','10'])->delete();
    }
}

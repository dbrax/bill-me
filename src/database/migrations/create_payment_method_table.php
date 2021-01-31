<?php


/**
 * Author: Emmanuel Paul Mnzava
 * Twitter: @epmnzava
 * Github:https://github.com/dbrax/tigopesa-tanzania
 * Email: epmnzava@gmail.com
 * 
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentMethodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::create('payment_method', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pmethod'); //required attribute
            $table->string('apikey')->nullable(); //required attribute
            $table->string('apisecret')->nullable(); //required attribute
            $table->string('applicationid')->nullable(); //required attribute




            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}

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

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('orderid'); //required attribute
            $table->integer('amount'); //required attribute
            $table->string('firstname'); //required attribute
            $table->string('lastname')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('email'); // required attribute
            $table->string('status')->default('pending');
            $table->string('address')->nullable();
            $table->date("date");




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

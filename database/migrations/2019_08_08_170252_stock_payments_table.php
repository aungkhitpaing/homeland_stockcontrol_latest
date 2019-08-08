<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StockPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Account_head');
            $table->integer('stock_control_id');
            $table->string('project_name');
            $table->integer('total');
            $table->integer('currently_paid');
            $table->integer('left_amount');
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
        Schema::dropIfExists('bank_details');
    }
}

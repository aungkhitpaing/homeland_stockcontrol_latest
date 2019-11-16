<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payable', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('stock_id');
            $table->integer('supplier_id');
            $table->integer('project_id');
            $table->integer('quantity');
            $table->integer('account_head_id');
            $table->integer('total_amount');
            $table->integer('payback_amount')->nullable();
            $table->tinyInteger('delete_flag')->default(0);
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
        Schema::dropIfExists('payable');
    }
}

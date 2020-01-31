<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePettyCashItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('petty_cash_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pc_id');
            $table->string('explanation');
            $table->decimal('amount', 8, 2);
            
            $table->foreign('pc_id')->references('id')->on('petty_cashes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('petty_cash_items');
    }
}

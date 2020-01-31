<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('po_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('po_id');
            $table->integer('qty');
            $table->string('unit');
            $table->string('description');
            $table->decimal('price', 8, 2);
            $table->decimal('amount', 8, 2);

            $table->foreign('po_id')->references('id')->on('pos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('po_items');
    }
}

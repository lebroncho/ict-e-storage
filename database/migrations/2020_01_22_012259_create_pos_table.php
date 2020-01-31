<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('po_num');
            $table->string('po');
            $table->string('issuance_num');
            $table->date('po_date');
            $table->string('released_by');
            $table->string('supplier');
            $table->string('received_by');
            $table->string('endorsed_to')->nullable();
            $table->string('filename')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pos');
    }
}

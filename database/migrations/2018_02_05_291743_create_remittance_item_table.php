<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRemittanceItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('remittanceItems', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('remittances_id');
            $table->string('name');
            $table->decimal('amount',18,2);
            $table->foreign('remittances_id')->references('id')->on('remittances');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('remittanceItems');
    }
}

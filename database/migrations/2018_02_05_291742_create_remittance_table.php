<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRemittanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('remittances', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('projects_id');
            $table->string('remittanceNo',50);
            $table->string('landlords_id',50);
            $table->decimal('amount',18,2)->default('0.00');
            $table->text('note')->nullable();
            $table->date('entryDate');
            $table->unsignedInteger('users_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('projects_id')->references('id')->on('projects');
            $table->foreign('users_id')->references('id')->on('users');


        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('remittances');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticelogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noticeslog', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('notices_id');
            $table->string('email');
            $table->string('cellNo');
            $table->string('subject',100)->nullable();
            $table->string('message',5000)->nullable();
            $table->unsignedInteger('customers_id');
            $table->unsignedInteger('landlords_id');
            $table->enum('status',['Sent','Failed']);
            $table->date('entryDate');
            $table->unsignedInteger('users_id');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['users_id', 'entryDate']);
            $table->foreign('users_id')->references('id')->on('users');
            $table->foreign('notices_id')->references('id')->on('notices');
            $table->foreign('customers_id')->references('id')->on('customers');
            $table->foreign('landlords_id')->references('id')->on('landlords');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('noticeslog');
    }
}

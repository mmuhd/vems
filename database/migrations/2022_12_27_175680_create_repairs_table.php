<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repairs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('projects_id')->nullable();
            $table->string('flats_id')->nullable();
            $table->string('landlords_id')->nullable();
            $table->string('format',100)->nullable();
            $table->string('photo')->nullable();
            $table->string('subject',100)->nullable();
            
            $table->string('message',5000)->nullable();

            $table->enum('active',['Yes','No']);
            $table->enum('noticeType',['landlord','tenant']);
            $table->date('entryDate');
            $table->unsignedInteger('users_id');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['users_id', 'entryDate']);
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
        Schema::dropIfExists('repairs');
    }
}

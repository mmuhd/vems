<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('format',100)->nullable();
            
            $table->string('subject',100)->nullable();
            
            $table->string('message',5000)->nullable();

            $table->enum('active',['Yes','No']);
            $table->enum('noticeType',['landlord','tenant', 'all_landlords', 'all_tenants']);
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
        Schema::dropIfExists('notices');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payee', function(Blueprint $table){
          $table->engine = 'InnoDB';
          $table->increments('id');
          $table->string('payee_name')->nullable();
          $table->string('payee_account_number')->nullable();
          $table->string('payee_account_name')->nullable();
          $table->string('payee_bank')->nullable();
          $table->string('payee_phone_number')->nullable();
          $table->string('added_by')->references('id')->on('users')->nullable();
          $table->timestamps();
          $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};

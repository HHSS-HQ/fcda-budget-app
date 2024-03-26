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
        Schema::create('accounting_year', function(Blueprint $table){
          $table->engine = 'InnoDB';
          $table->increments('id');
          $table->string('accounting_year_name')->nullable();
          $table->string('start_date')->nullable();
          $table->string('end_date')->nullable();
          $table->string('status')->default('INACTIVE')->nullable();
          $table->string('comment')->nullable();
          $table->unsignedInteger('added_by')->references('id')->on('users')->nullable();
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

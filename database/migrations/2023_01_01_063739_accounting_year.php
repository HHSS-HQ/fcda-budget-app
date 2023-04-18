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
          $table->id();
          $table->string('accounting_year_name')->nullable();
          $table->string('start_month')->nullable();
          $table->string('end_month')->nullable();
          $table->string('status')->default('INACTIVE')->nullable();
          $table->string('comment')->nullable();
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

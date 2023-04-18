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
        Schema::create('project_funding', function(Blueprint $table){
          $table->engine = 'InnoDB';
          $table->increments('id');
          $table->string('project_id')->references('id')->on('project')->nullable();
          // $table->string('department_id', 32)->references('id')->on('department')->nullable();
          $table->string('amount')->nullable();
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

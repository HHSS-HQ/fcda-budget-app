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
        Schema::create('project_images', function(Blueprint $table){
          $table->engine = 'InnoDB';
          $table->increments('id');
          $table->string('project_id')->references('id')->on('project')->nullable();
          $table->string('image_name')->nullable();
          $table->string('image_location')->nullable();
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

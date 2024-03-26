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
      Schema::create('contractor', function(Blueprint $table){
        $table->engine = 'InnoDB';
        $table->increments('id');
        $table->string('company_name', 191)->unique();
        $table->string('contractor_name', 191)->nullable();
        $table->string('contractor_account_number', 191)->nullable();
        $table->string('contractor_account_name', 191)->nullable();
        $table->string('contractor_bank', 191)->nullable();
        $table->string('contractor_phone_number', 191)->nullable();
        $table->string('alternate_phone_number', 191)->nullable();
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

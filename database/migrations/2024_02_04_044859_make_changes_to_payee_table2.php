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
        // Schema::table('project', function (Blueprint $table) {
        //     $table->unsignedInteger('payee_id')->nullable();
        //     $table->foreign('payee_id')
        //  ->references('payee_id')->on('payee_new')
        //  ->onDelete('no action')
        //  ->onUpdate('no action');
        // });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('users', function (Blueprint $table) {
           
        //         $table->unsignedBigInteger('department_id')->nullable();
        // });

        // Schema::table('project', function (Blueprint $table) {
        //     Schema::dropColumn('payee_id');
        // });
    }
};

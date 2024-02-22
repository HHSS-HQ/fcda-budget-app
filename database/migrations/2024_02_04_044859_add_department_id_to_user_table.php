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
        Schema::table('users', function (Blueprint $table) {
            // $table->string('department_budget_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('role_id')->nullable();
            $table->string('username')->unique();
            // $table->index(["department_id"], 'fk_users_department_id_idx'); // Updated the index name
            // $table->foreign('department_id', 'fk_users_department_id_idx') // Updated the foreign key name
            //     ->references('id')->on('department')
            //     ->onDelete('no action')
            //     ->onUpdate('no action');

            $table->foreign('department_id')
                ->references('id')->on('department')
                ->onDelete('no action')
                ->onUpdate('no action');

                $table->foreign('role_id')
                ->references('id')->on('role')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
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
    }
};

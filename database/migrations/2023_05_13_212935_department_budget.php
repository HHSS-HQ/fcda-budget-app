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
        Schema::create('department_budget', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('parent_budget_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->string('budgetary_allocation')->nullable();
            $table->string('budget_utilization')->nullable();
            $table->string('remarks')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('parent_budget_id')
                ->references('id')->on('budget')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('department_id')
                ->references('id')->on('department')
                ->onDelete('no action')
                ->onUpdate('no action');

                $table->foreign('created_by')
                ->references('id')->on('users')
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
        //
    }
};

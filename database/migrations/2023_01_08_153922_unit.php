<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public $tableName = 'unit';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('department_id')->nullable();
            $table->string('unit_name')->nullable();
            $table->string('remarks')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(["department_id"], 'fk_department_id_1_idx');
            $table->index(["created_by"], 'fk_entered_by_id_2_idx');


            $table->foreign('department_id', 'fk_department_id_1_idx')
                ->references('id')->on('department')
                ->onDelete('no action')
                ->onUpdate('no action');

                $table->foreign('created_by', 'fk_entered_by_id_2_idx')
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

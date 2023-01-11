<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public $tableName = 'project_type';
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
            $table->string('project_type')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->string('remarks')->nullable();
            $table->string('status')->default('ACTIVE');
            $table->timestamps();
            $table->softDeletes();

            $table->index(["created_by"], 'fk_entered_by_id_7_idx');

            $table->foreign('created_by', 'fk_entered_by_id_7_idx')
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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public $tableName = 'subhead';
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
            $table->string('subhead_code')->nullable();
            $table->string('subhead_name')->nullable();
            $table->string('department_id', 32)->references('id')->on('department')->nullable();
            $table->string('approved_provision')->nullable();
            $table->string('revised_provision')->nullable();
            $table->string('remarks')->nullable();
            $table->string('status')->default('ACTIVE');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
            $table->softDeletes();


            $table->index(["created_by"], 'fk_entered_by_id_4_idx');

                $table->foreign('created_by', 'fk_entered_by_id_4_idx')
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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public $tableName = 'budget';
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
            $table->string('budget_year')->nullable();
            $table->string('code')->nullable();
            $table->string('remarks')->nullable();
            $table->double('appropriated_amount')->nullable();
            $table->string('status')->default('INACTIVE');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

           
            $table->index(["created_by"], 'fk_entered_by_id_3_idx');

                $table->foreign('created_by', 'fk_entered_by_id_3_idx')
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

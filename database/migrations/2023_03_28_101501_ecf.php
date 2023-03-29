<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public $tableName = 'ecf';
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
        // $table->string('department_id')->nullable();
        $table->string('department_id', 32)->references('id')->on('department')->nullable();
        $table->string('head_id')->nullable();
        $table->string('subhead_id')->nullable();
        $table->string('expenditure_item')->nullable();
        $table->string('payee_id')->nullable();
        $table->string('approved_provision')->nullable();
        $table->string('revised_provision')->nullable();
        $table->string('present_requisition')->nullable();

        // $table->string('subhead_id')->nullable();
        $table->string('status')->default('PENDING APPROVAL');
        $table->unsignedBigInteger('checked_by')->nullable();
        $table->unsignedBigInteger('prepared_by')->nullable();
        $table->timestamps();
        $table->softDeletes();


        $table->index(["prepared_by"], 'fk_prepared_by_id_4_idx');

            $table->foreign('prepared_by', 'fk_prepared_by_id_4_idx')
            ->references('id')->on('users')
            ->onDelete('no action')
            ->onUpdate('no action');

            $table->index(["checked_by"], 'fk_checked_by_id_4_idx');

            $table->foreign('checked_by', 'fk_checked_by_id_4_idx')
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

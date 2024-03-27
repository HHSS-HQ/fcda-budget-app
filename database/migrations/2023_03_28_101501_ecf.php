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
        // $table->string('ecf_id')->nullable();
        $table->string('ecf_id')->unique();
        $table->string('department_id')->references('id')->on('department')->nullable();
        $table->string('head_id')->nullable();
        $table->string('subhead_id')->nullable();
        $table->string('expenditure_item')->nullable();
        // $table->string('payee_id')->nullable();
        $table->string('payee_id')->references('id')->on('payee')->nullable();
        $table->string('approved_provision')->nullable();
        $table->string('revised_provision')->nullable();
        $table->string('present_requisition')->nullable();

        // $table->string('subhead_id')->nullable();
        $table->string('status')->default('PENDING APPROVAL');
        $table->unsignedInteger('checked_by')->nullable();
        $table->unsignedInteger('prepared_by')->nullable();
        $table->unsignedInteger('budget_id')->nullable();
        $table->unsignedInteger('department_budget_id')->references('id')->on('department_budget')->nullable();
        $table->dateTime('uploaded_date')->nullable();
        $table->timestamps();
        $table->softDeletes();


        $table->index(["prepared_by"], 'fk_prepared_by_id_4_idx');
        $table->foreign('prepared_by', 'fk_prepared_by_id_4_idx')
            ->references('id')->on('users')
            ->onDelete('no action')
            ->onUpdate('no action');

            // $table->index(["checked_by"], 'fk_checked_by_id_4_idx');
            $table->foreign('checked_by')
            ->references('id')->on('users')
            ->onDelete('no action')
            ->onUpdate('no action');

            // $table->index(["budget_id"]');
            $table->foreign('budget_id')
            ->references('id')->on('budget')
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

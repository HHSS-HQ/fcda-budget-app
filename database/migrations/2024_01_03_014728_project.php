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
        Schema::disableForeignKeyConstraints();
        Schema::create('project', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('project_type_id')->nullable();
            $table->string('project_id')->unique();
            // $table->morphs('tokenable');
            $table->string('project_title');
            $table->string('project_location');
            // $table->string('contractor_id')->references('id')->on('contractor')->nullable();
            $table->string('date_of_award')->nullable();
            $table->string('appropriation')->nullable();
            $table->string('contract_sum')->nullable();
            $table->string('commencement_date')->nullable();
            $table->string('completion_period')->nullable();
            $table->string('percentage_completion')->nullable();
            $table->string('amount_paid_till_date')->nullable();
            $table->string('outstanding_balance')->nullable();
            $table->string('certified_cv_not_paid')->nullable();
            $table->string('year_last_funded')->nullable();
            $table->string('last_funded_date')->nullable();
            $table->string('company_RC_number', 10)->nullable();
            $table->string('file_number')->nullable();
            $table->unsignedInteger('department_id')->nullable();
            $table->string('project_year')->references('id')->on('accounting_year')->nullable();
            $table->string('added_by')->references('id')->on('users')->nullable();
            $table->unsignedInteger('payee_id')->nullable();
            $table->timestamps();


      

         $table->foreign('project_type_id')
         ->references('id')->on('project_type')
         ->onDelete('no action')
         ->onUpdate('no action');

         $table->foreign('department_id')
         ->references('id')->on('department')
         ->onDelete('no action')
         ->onUpdate('no action');

         $table->foreign('payee_id')
         ->references('payee_id')->on('payee_new')
         ->onDelete('no action')
         ->onUpdate('no action');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project');
    }
};

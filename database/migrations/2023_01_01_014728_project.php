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
        Schema::create('project', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('project_type_id')->nullable();
            $table->string('project_id')->unique();
            // $table->morphs('tokenable');
            $table->string('project_title');
            $table->string('project_location');
            $table->string('contractor_id')->references('id')->on('contractor')->nullable();
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

            $table->string('project_year')->references('id')->on('accounting_year')->nullable();
            $table->string('added_by')->references('id')->on('users')->nullable();
            // $table->text('abilities')->nullable();
            $table->timestamps();


         $table->index(["project_type_id"], 'fk_project_type_id_1_idx');

         $table->foreign('project_type_id', 'fk_project_type_id_1_idx')
         ->references('id')->on('project_type')
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
        Schema::dropIfExists('project');
    }
};

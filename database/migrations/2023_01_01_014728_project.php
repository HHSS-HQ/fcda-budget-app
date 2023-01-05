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
            $table->string('project_id')->unique();
            // $table->morphs('tokenable');
            $table->string('project_title');
            $table->string('project_location');
            $table->string('contractor_name');
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
            $table->string('observations')->nullable();
            $table->string('challenges')->nullable();
            $table->string('recommendations')->nullable();
            $table->string('project_year')->nullable();
            $table->string('image_id')->nullable();
            // $table->text('abilities')->nullable();
            $table->timestamps();
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

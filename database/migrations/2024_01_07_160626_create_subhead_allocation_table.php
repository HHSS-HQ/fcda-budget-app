<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('subhead_allocation', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('allocation_ID')->index();
            $table->unsignedBigInteger('allocation_id')->references('allocation_id')->on('transactions')->nullable();
            $table->unsignedBigInteger('subhead_id')->nullable();
            // $table->foreign('subhead_code')->references('subhead_code')->on('subhead');
            $table->bigInteger('approved_provision')->nullable();
            $table->bigInteger('revised_provision')->nullable();

            
            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreign('department_id')->references('id')->on('department');
            // $table->unsignedBigInteger('year_id')->nullable();
            $table->unsignedBigInteger('year_id')->references('year_id')->on('budget_year')->nullable();
            $table->bigInteger('year_appropriated_sum')->nullable();
            $table->bigInteger('year_adjusted_sum')->nullable();
            $table->timestamps();
            $table->softDeletes();
            // $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('updated_by')->references('id')->on('users');
            $table->string('status')->default('ACTIVE');


            $table->index(["subhead_id"], 'fk_subhead_id_11_idx');
            $table->foreign('subhead_id', 'fk_subhead_id_11_idx')
            ->references('id')->on('subhead')
            ->onDelete('no action')
            ->onUpdate('no action');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subhead_allocation');
    }
};

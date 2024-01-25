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
            $table->unsignedBigInteger('allocation_ID')->references('allocation_ID')->on('transactions')->nullable();
            $table->unsignedBigInteger('subhead_id')->nullable();
            $table->foreign('subhead_id')->references('id')->on('subhead')->nullable();
            // $table->unsignedBigInteger('deptartment_id')->nullable();
            $table->unsignedBigInteger('deptartment_id')->references('id')->on('department')->nullable();
            // $table->unsignedBigInteger('year_id')->nullable();
            $table->unsignedBigInteger('year_id')->references('year_id')->on('budget_year')->nullable();
            $table->bigInteger('yearAppropriatedSum')->nullable();
            $table->bigInteger('yearAdjustedSum')->nullable();
            $table->timestamps();
            $table->softDeletes();
            // $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('updated_by')->references('id')->on('users');
            // $table->index(['department_id', 'subhead_id', 'year_id', 'allocation_ID']);
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

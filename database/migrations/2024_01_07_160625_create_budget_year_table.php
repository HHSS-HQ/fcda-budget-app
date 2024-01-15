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

        Schema::create('budget_year', function (Blueprint $table) {
            $table->id();
            // $table->string('sda_id', 20)->nullable();
            $table->string('sda_id')->references('sda_id')->on('sda')->nullable();
            $table->string('year')->nullable();
            $table->bigInteger('yearAppropriatedSum')->nullable();
            $table->bigInteger('yearAdjustedSum')->nullable();
            $table->boolean('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('updated_by');
            $table->foreign('updated_by')->references('id')->on('users');
            // Change the next line to use unsignedBigInteger
            $table->unsignedBigInteger('year_id');
            
            // $table->timestamp('updated_at');
        });
        

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budget_year');
    }
};

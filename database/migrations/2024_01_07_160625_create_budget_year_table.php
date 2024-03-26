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
            $table->increments('id');
            $table->unsignedInteger('sda_id')->nullable();
            // $table->foreign('sda_id')->references('sda_id')->on('sda')->nullable();
            $table->string('year')->nullable();
            $table->bigInteger('yearAppropriatedSum')->nullable();
            $table->bigInteger('yearAdjustedSum')->nullable();
            $table->boolean('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedInteger('updated_by');
            $table->foreign('updated_by')->references('id')->on('users');
            // Change the next line to use unsignedBigInteger
            $table->unsignedInteger('year_id');
        
            // $table->index(["sda_id"], 'fk_budget_year_sda_id_idx'); // Updated the index name
            $table->foreign('sda_id') // Updated the foreign key name
                ->references('sda_id')->on('sda')
                ->onDelete('no action')
                ->onUpdate('no action');
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

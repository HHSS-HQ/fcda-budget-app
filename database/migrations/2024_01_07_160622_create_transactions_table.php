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

        Schema::create('transactions', function (Blueprint $table) {
            // $table->id();
            $table->increments('allocation_id');
            // $table->unsignedBigInteger('allocation_id')->primary(); // Make it a primary key
            $table->string('transaction_type', 20)->nullable();
            $table->bigInteger('transaction_amount')->nullable();
            $table->unsignedBigInteger('payee_id')->nullable();
            $table->foreign('payee_id')->references('id')->on('users');
            $table->string('narration', 500)->nullable();
            $table->string('project_id', 255)->nullable();
            $table->date('transaction_date')->nullable();
            $table->string('payee_bank', 20)->nullable();
            $table->string('payee_account_number', 10)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users');
            $table->foreign('project_id')->references('project_id')->on('project');
            
            // $table->index(['payee_id', 'narration']);
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};

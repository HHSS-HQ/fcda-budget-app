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

        Schema::create('payee_new', function (Blueprint $table) {
            $table->increments('payee_id');
            $table->bigInteger('payee_type')->nullable();
            $table->string('payee_name')->nullable();
            $table->string('payee_phone', 11)->nullable();
            $table->string('payee_phone2', 11)->nullable();
            $table->string('payee_bank', 20)->nullable();
            $table->string('payee_account_name')->nullable();
            $table->string('payee_account_number', 10)->nullable();
            $table->string('payee_sortcode', 15)->nullable();
            $table->string('payee_email', 30)->nullable();
            $table->mediumText('remarks')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payee');
    }
};

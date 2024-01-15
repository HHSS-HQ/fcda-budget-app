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
            $table->bigInteger('payee_type');
            $table->bigInteger('payee_Name');
            $table->string('payee_phone', 11);
            $table->string('payee_phone2', 11);
            $table->string('payee_bank', 20);
            $table->string('payee_account_number', 10);
            $table->string('payee_sortcode', 15);
            $table->string('payee_email', 30);
            $table->mediumText('remarks');
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('updated_by');
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

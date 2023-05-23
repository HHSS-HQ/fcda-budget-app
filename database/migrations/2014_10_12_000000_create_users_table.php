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
      Schema::create('users', function (Blueprint $table) {
        $table->id();
        $table->string('name', 191);
        $table->char('email', 191)->unique();
        $table->string('username', 191)->unique();
        $table->timestamp('email_verified_at', 20)->nullable();
        $table->string('password', 191);
        $table->unsignedInteger('role_id', 20)->nullable();
        $table->rememberToken();
        $table->timestamps();


        $table->index(["role_id"], 'fk_user_1_idx');



        $table->foreign('role_id', 'fk_user_1_idx')
            ->references('id')->on('role')
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
        Schema::dropIfExists('users');
    }
};

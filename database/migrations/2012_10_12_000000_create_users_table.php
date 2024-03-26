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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();

            $table->unsignedInteger('department_id')->nullable();
            $table->unsignedInteger('role_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
          
            $table->boolean('status')->default(false);

            $table->foreign('department_id')
                ->references('id')->on('department')
                ->onDelete('no action')
                ->onUpdate('no action');

                $table->foreign('role_id')
                ->references('id')->on('role')
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
        Schema::dropIfExists('users');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public $tableName = 'budget';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('budget_year')->nullable();
            $table->string('code')->nullable();
            $table->string('remarks')->nullable();
            $table->double('appropriated_amount')->nullable();
            $table->double('budget_utlization')->nullable();
            $table->string('status')->default('INACTIVE');
            $table->unsignedInteger('created_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // $table->index(["budget_year"], 'fk_budget_year_id_4_idx');

            $table->foreign('budget_year')
            ->references('id')->on('accounting_year')
            ->onDelete('no action')
            ->onUpdate('no action');

            // $table->index(["created_by"], 'fk_entered_by_id_3_idx');

                $table->foreign('created_by')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');

            });

            Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};

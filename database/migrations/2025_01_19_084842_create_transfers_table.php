<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('old_branch_id');
            $table->unsignedBigInteger('new_branch_id');
            $table->unsignedBigInteger('vacancy_id')->nullable();
            $table->date('transfer_date');

            $table->timestamps();

            // Foreign key constraints
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('old_branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->foreign('new_branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->foreign('vacancy_id')->references('id')->on('vacancies')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transfers');
    }
}

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
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('branch_id')->nullable(); // Store the branch ID
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->string('job');
            $table->date('asked_date');
            $table->date('completed_date')->nullable();
            $table->string('status');
            $table->boolean('is_finished')->default(false);
            $table->unsignedBigInteger('employee_id')->nullable(); // Optional employee ID
            $table->foreign('employee_id')->references('id')->on('employee_info')->onDelete('cascade');
            $table->string('image_path')->nullable(); // Store image path as a plain string
            $table->string('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacancies');
    }
};

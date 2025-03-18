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
        Schema::create('evaluation_forms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('assigned_for');
            $table->unsignedBigInteger('dept_id')->nullable();
            $table->unsignedBigInteger('job')->nullable();
            $table->timestamps();

            $table->foreign('dept_id')->references('id')->on('departments');
            $table->foreign('job')->references('id')->on('jobs_work');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluation_forms');
    }
};

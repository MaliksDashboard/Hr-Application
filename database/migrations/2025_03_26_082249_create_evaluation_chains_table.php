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
        Schema::create('evaluation_chains', function (Blueprint $table) {
            $table->id();
            $table->string('evaluator_role');
            $table->string('target_role');
            $table->unsignedBigInteger('job_id')->nullable(); // Specific jobs
            $table->unsignedBigInteger('department_id')->nullable(); // Specific departments
            $table->integer('priority')->default(1); // 1 = highest
            $table->boolean('skip_if_done_by_higher')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluation_chains');
    }
};

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
        Schema::create('jobs_work', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('dept_id')->nullable()->change();
            $table->timestamps();
            $table->foreign('dept_id')->references('id')->on('departments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs_work');
    }
};

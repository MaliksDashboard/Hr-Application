<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('form_id');
            $table->decimal('total_score', 10, 2)->nullable();
            $table->integer('month');
            $table->integer('year');
            $table->timestamps();

            $table->foreign('form_id')->references('id')->on('evaluation_forms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};

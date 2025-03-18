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
        Schema::create('evaluation_form_questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('form_id');
            $table->string('question');
            $table->timestamps();

            $table->foreign('form_id')->references('id')->on('evaluation_forms');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluation_form_questions');
    }
};

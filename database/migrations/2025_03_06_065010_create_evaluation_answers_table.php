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
        Schema::create('evaluation_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('made_by');
            $table->unsignedBigInteger('form_id');
            $table->unsignedBigInteger('question_id');
            $table->decimal('answer',4,1);
            $table->string('remarks')->nullable();
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('employee_info')->onDelete('cascade');
            $table->foreign('made_by')->references('id')->on('employee_info')->onDelete('cascade');
            $table->foreign('form_id')->references('form_id')->on('evaluation_form_questions')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('evaluation_form_questions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluation_answers');
    }
};

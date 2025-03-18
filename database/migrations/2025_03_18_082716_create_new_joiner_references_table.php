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
        Schema::create('new_joiner_references', function (Blueprint $table) {
            $table->id();
            $table->string('new_joiner_id');
            $table->string('company_name');
            $table->string('contact_name');
            $table->string('phone');
            $table->string('position');
            $table->string('feedback');
            $table->boolean('have_recommendation_letter');
            $table->timestamps();

            $table->foreign('new_joiner_id')->references('id')->on('new_joiner');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('new_joiner_references');
    }
};

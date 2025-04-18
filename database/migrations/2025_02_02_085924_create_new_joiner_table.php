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
        Schema::create('new_joiner', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mode');
            $table->date('date_mode');
            $table->string('job');
            $table->string('current_branch');
            $table->string('remarks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('new_joiner');
    }
};

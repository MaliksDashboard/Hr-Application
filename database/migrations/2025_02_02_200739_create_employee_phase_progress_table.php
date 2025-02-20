<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('employee_phase_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('new_joiners')->onDelete('cascade');
            $table->string('phase');
            $table->date('completed_at')->nullable();
            $table->date('next_phase_start_at')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_phase_progress');
    }
};

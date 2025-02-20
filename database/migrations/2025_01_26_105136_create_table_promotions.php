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
        Schema::create('table_promotions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id'); // Foreign key to employee_info
            $table->string('old_title'); // Old title from employee_info
            $table->string('new_title'); // New title for promotion
            $table->date('promotion_date');
            $table->timestamps();

            // Set foreign key constraints
            $table->foreign('employee_id')->references('id')->on('employee_info')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_promotions');
    }
};

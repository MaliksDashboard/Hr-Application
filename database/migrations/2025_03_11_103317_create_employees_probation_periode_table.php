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
        Schema::create('employees_probation_period', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->date('probation_period_end');
            $table->boolean('is_checked')->default(0);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees_probation_period', function (Blueprint $table) {
            //
        });
    }
};

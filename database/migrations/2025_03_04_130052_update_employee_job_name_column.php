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
        Schema::table('employee_info', function (Blueprint $table) {
         // Rename column from `job` to `job_id`
         $table->renameColumn('job_id', 'job');        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employee_info', function (Blueprint $table) {
            //
        });
    }
};

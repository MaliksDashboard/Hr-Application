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
        Schema::table('employee_info', function (Blueprint $table) {
            $table->unsignedBigInteger('belongs_to')->nullable()->after('branch_id');
            $table->foreign('belongs_to')->references('id')->on('departments');
        });
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

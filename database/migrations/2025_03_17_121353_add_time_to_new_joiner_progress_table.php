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
        Schema::table('new_joiner_progress', function (Blueprint $table) {

            $table->string('interview_time')->nullable()->after('remarks');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('new_joiner_progress', function (Blueprint $table) {
            //
        });
    }
};

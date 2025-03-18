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
        Schema::table('evaluation_answers', function (Blueprint $table) {

            $table->unsignedBigInteger('evaluation_id')->after('form_id'); 
            $table->foreign('evaluation_id')->references('id')->on('evaluations')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('evaluation_answers', function (Blueprint $table) {
            //
        });
    }
};

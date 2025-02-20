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
        Schema::table('transfers', function (Blueprint $table) {

            $table->string('type')->after('transfer_date');
            $table->unsignedBigInteger('created_by')->nullable()->after('transfer_date');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trasnfers', function (Blueprint $table) {
            //
        });
    }
};

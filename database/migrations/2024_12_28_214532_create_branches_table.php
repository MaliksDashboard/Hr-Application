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
        Schema::create('branches', function (Blueprint $table) {
            $table->id(); // Equivalent to `bigint UNSIGNED AUTO_INCREMENT PRIMARY KEY`
            $table->string('branch_name', 191)->unique();
            $table->string('location', 191);
            $table->string('manager_email', 191)->unique();
            $table->string('services_gmail', 191)->unique();
            $table->timestamps(); // Adds `created_at` and `updated_at` columns
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};

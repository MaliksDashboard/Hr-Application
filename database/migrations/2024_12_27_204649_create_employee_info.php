<?php

namespace App\Http\Controllers;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

    public function up(): void
    {
        Schema::create('employee_info', function (Blueprint $table) {

            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->string('title');
            $table->boolean('status');
            $table->date('date_hired');
            $table->string('pin_code');
            $table->string('email');
            $table->string('phone');
            $table->string('image_path');
            $table->timestamps();

            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('employee_info');
    }
};

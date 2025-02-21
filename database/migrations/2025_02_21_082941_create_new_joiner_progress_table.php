<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('new_joiner_progress', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('new_joiner_id');
            $table->unsignedBigInteger('step_id');
            $table->enum('status', ['pending', 'completed'])->default('pending');
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('new_joiner_id')->references('id')->on('new_joiners')->onDelete('cascade');
            $table->foreign('step_id')->references('id')->on('training_steps')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('new_joiner_progress');
    }
};

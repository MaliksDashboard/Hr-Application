<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Who receives the notification
            $table->string('type'); // "rotation_reminder", "admin_alert", etc.
            $table->text('message'); // Notification content
            $table->timestamp('notified_at')->nullable(); // When the notification should be triggered
            $table->boolean('is_read')->default(false); // Track if the notification was read
            $table->timestamps();
    
            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};

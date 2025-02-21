<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('new_joiner', function (Blueprint $table) {
            // Remove unnecessary columns
            $table->dropColumn(['current_branch', 'remarks']);

            // Rename date_mode to start_date
            $table->renameColumn('date_mode', 'start_date');
        });
    }

    public function down()
    {
        Schema::table('new_joiner', function (Blueprint $table) {
            // Restore columns if rolling back
            $table->string('current_branch')->nullable();
            $table->text('remarks')->nullable();

            // Rename start_date back to date_mode
            $table->renameColumn('start_date', 'date_mode');
        });
    }
};

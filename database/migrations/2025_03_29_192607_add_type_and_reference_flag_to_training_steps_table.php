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
        Schema::table('training_steps', function (Blueprint $table) {
            $table->string('type')->nullable()->after('step_order'); // e.g., 'reference', 'form', etc.
            $table->boolean('is_reference_step')->default(false)->after('type');
        });
    }

    public function down()
    {
        Schema::table('training_steps', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('is_reference_step');
        });
    }
};

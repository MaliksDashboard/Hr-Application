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
            $table->string('color', 7)->default('#FFFFFF'); // Default white color
        });
    }

    public function down()
    {
        Schema::table('training_steps', function (Blueprint $table) {
            $table->dropColumn('color');
        });
    }
};

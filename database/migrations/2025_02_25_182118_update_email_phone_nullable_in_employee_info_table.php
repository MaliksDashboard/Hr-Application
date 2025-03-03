<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('employee_info', function (Blueprint $table) {
            $table->string('email', 255)->nullable()->change();
            $table->string('phone', 15)->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('employee_info', function (Blueprint $table) {
            $table->string('email', 255)->nullable(false)->change();
            $table->string('phone', 15)->nullable(false)->change();
        });
    }
};

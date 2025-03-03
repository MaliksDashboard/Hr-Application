<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('employee_info', function (Blueprint $table) {
            $table->string('car', 255)->nullable()->after('phone');
            $table->string('address', 255)->nullable()->after('car');
            $table->date('birthday')->nullable()->after('left_date');
        });
    }

    public function down()
    {
        Schema::table('employee_info', function (Blueprint $table) {
            $table->dropColumn(['car', 'address', 'birthday']);
        });
    }
};

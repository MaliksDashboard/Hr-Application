<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBranchIdAndEmployeeIdToEvaluationsTable extends Migration
{
    public function up()
    {
        Schema::table('evaluations', function (Blueprint $table) {
            $table->unsignedBigInteger('branch_id')->nullable()->after('id');
            $table->unsignedBigInteger('employee_id')->nullable()->after('branch_id');

            // Add foreign keys if necessary
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->foreign('employee_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('evaluations', function (Blueprint $table) {
            $table->dropForeign(['branch_id']);
            $table->dropForeign(['employee_id']);
            $table->dropColumn(['branch_id', 'employee_id']);
        });
    }
}

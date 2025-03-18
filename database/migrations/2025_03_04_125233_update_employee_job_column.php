<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('employee_info', function (Blueprint $table) {

            // Ensure it's an unsigned integer to match `jobs_work.id`
            $table->unsignedBigInteger('job_id')->nullable()->change();

            // Set foreign key constraint
            $table->foreign('job_id')->references('id')->on('jobs_work')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('employee_info', function (Blueprint $table) {
            $table->dropForeign(['job_id']);
            $table->renameColumn('job_id', 'job');
        });
    }
};

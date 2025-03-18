<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('employee_info', function (Blueprint $table) {

            if (!Schema::hasColumn('employee_info', 'blood_type')) {
                $table->string('blood_type')->nullable()->after('status');
            }
            if (!Schema::hasColumn('employee_info', 'marital_status')) {
                $table->string('marital_status')->nullable()->after('blood_type');
            }
            if (!Schema::hasColumn('employee_info', 'shift')) {
                $table->string('shift')->nullable()->after('marital_status');
            }
            if (!Schema::hasColumn('employee_info', 'whish_number')) {
                $table->string('whish_number')->nullable()->after('shift');
            }
            if (!Schema::hasColumn('employee_info', 'where_can_work')) {
                $table->text('where_can_work')->nullable()->after('whish_number');
            }
            if (!Schema::hasColumn('employee_info', 'job')) {
                $table->string('job')->nullable()->after('image_path');
            }
            if (!Schema::hasColumn('employee_info', 'left_date')) {
                $table->date('left_date')->nullable()->after('job');
            }
            if (!Schema::hasColumn('employee_info', 'birthday')) {
                $table->date('birthday')->nullable()->after('left_date');
            }
            if (!Schema::hasColumn('employee_info', 'left_reason')) {
                $table->string('left_reason')->nullable()->after('left_date');
            }
            if (!Schema::hasColumn('employee_info', 'give_notice')) {
                $table->boolean('give_notice')->nullable()->after('left_reason');
            }
            if (!Schema::hasColumn('employee_info', 'is_good_performer')) {
                $table->boolean('is_good_performer')->nullable()->after('give_notice');
            }
            if (!Schema::hasColumn('employee_info', 'is_positive_person')) {
                $table->boolean('is_positive_person')->nullable()->after('is_good_performer');
            }
            if (!Schema::hasColumn('employee_info', 'exit_interview_remarks')) {
                $table->string('exit_interview_remarks')->nullable()->after('is_positive_person');
            }
            if (!Schema::hasColumn('employee_info', 'is_recommended_to_back')) {
                $table->boolean('is_recommended_to_back')->nullable()->after('exit_interview_remarks');
            }

            // Ensure timestamps exist
            if (!Schema::hasColumn('employee_info', 'created_at') || !Schema::hasColumn('employee_info', 'updated_at')) {
                $table->timestamps();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employee_info', function (Blueprint $table) {
            //
        });
    }
};

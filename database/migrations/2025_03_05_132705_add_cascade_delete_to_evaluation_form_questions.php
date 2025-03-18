<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('evaluation_form_questions', function (Blueprint $table) {
            // First, drop the existing foreign key constraint
            $table->dropForeign(['form_id']);

            // Then, re-add it with cascade delete
            $table->foreign('form_id')
                ->references('id')
                ->on('evaluation_forms')
                ->onDelete('cascade'); // ✅ Automatically delete questions when form is deleted
        });
    }

    public function down()
    {
        Schema::table('evaluation_form_questions', function (Blueprint $table) {
            // Rollback: drop the foreign key with cascade delete
            $table->dropForeign(['form_id']);

            // Re-add the foreign key without cascade delete
            $table->foreign('form_id')->references('id')->on('evaluation_forms');
        });
    }
};

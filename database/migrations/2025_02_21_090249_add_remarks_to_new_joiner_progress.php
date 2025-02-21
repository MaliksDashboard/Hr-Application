<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('new_joiner_progress', function (Blueprint $table) {
            $table->text('remarks')->nullable()->after('status'); // Add remarks field
        });
    }

    public function down()
    {
        Schema::table('new_joiner_progress', function (Blueprint $table) {
            $table->dropColumn('remarks');
        });
    }
};

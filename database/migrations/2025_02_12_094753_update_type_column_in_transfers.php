<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('transfers', function (Blueprint $table) {
            $table->string('type', 50)->default('Transfer')->change(); // ✅ Add default value
        });
    }

    public function down()
    {
        Schema::table('transfers', function (Blueprint $table) {
            $table->string('type', 50)->nullable()->change(); // ✅ Revert change
        });
    }
};

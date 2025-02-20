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
        if (!Schema::hasColumn('transfers', 'transfer_start_date')) {
            Schema::table('transfers', function (Blueprint $table) {
                $table->date('transfer_start_date')->nullable()->after('vacancy_id');
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('transfers', 'transfer_start_date')) {
            Schema::table('transfers', function (Blueprint $table) {
                $table->dropColumn('transfer_start_date');
            });
        }
    }
};

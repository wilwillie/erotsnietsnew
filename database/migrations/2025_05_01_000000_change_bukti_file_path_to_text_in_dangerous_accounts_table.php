<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('dangerous_accounts', function (Blueprint $table) {
            $table->text('bukti_file_path')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('dangerous_accounts', function (Blueprint $table) {
            $table->string('bukti_file_path')->nullable()->change();
        });
    }
};

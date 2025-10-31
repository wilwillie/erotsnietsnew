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
            $table->string('header_picture_path')->nullable()->after('bukti_file_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('dangerous_accounts', function (Blueprint $table) {
            $table->dropColumn('header_picture_path');
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsAcceptedToDangerousAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dangerous_accounts', function (Blueprint $table) {
            $table->boolean('is_accepted')->default(false)->after('kronologi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dangerous_accounts', function (Blueprint $table) {
            $table->dropColumn('is_accepted');
        });
    }
}

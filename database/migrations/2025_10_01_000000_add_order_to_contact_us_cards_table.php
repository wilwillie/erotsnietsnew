<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderToContactUsCardsTable extends Migration
{
    public function up()
    {
        Schema::table('contact_us_cards', function (Blueprint $table) {
            $table->integer('order')->default(0)->after('link');
        });
    }

    public function down()
    {
        Schema::table('contact_us_cards', function (Blueprint $table) {
            $table->dropColumn('order');
        });
    }
}

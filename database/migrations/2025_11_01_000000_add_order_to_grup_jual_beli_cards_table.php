<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderToGrupJualBeliCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('grup_jual_beli_cards', function (Blueprint $table) {
            $table->integer('order')->default(0)->nullable()->after('link');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('grup_jual_beli_cards', function (Blueprint $table) {
            $table->dropColumn('order');
        });
    }
}

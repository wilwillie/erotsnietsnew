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
            Schema::create('dangerous_accounts', function (Blueprint $table) {
                $table->id();
                $table->string('ml_id');
                $table->string('server_id')->nullable();
                $table->string('pelaku_nickname')->nullable();
                $table->string('korban_nickname')->nullable();
                $table->date('tanggal_kejadian')->nullable();
                $table->string('bukti_file_path')->nullable();
                $table->text('kronologi')->nullable();
                $table->timestamps();
            });
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dangerous_accounts');
    }
};

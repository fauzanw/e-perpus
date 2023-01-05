<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesans', function (Blueprint $table) {
            $table->id('id_pesan');
            $table->string('penerima', 50);
            $table->string('pengirim', 50);
            $table->string('judul_pesan', 50);
            $table->text('isi_pesan');
            $table->string('status', 50);
            $table->string('tanggal_kirim', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesans');
    }
};

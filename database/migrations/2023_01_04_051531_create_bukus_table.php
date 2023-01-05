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
        Schema::create('bukus', function (Blueprint $table) {
            $table->id('id_buku');
            $table->string('judul_buku', 125);
            $table->string('kategori_buku', 125);
            $table->string('penerbit_buku', 125);
            $table->string('tahun_terbit', 125);
            $table->string('isbn', 50);
            $table->string('id_buku_baik', 50);
            $table->string('id_buku_rusak', 50);
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
        Schema::dropIfExists('bukus');
    }
};

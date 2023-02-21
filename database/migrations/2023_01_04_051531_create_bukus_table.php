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
            $table->unsignedBigInteger('kategori_id');
            $table->unsignedBigInteger('penerbit_id');
            $table->string('tahun_terbit', 125);
            $table->string('isbn', 50);
            $table->string('cover_buku', 200);
            $table->string('jumlah_buku_baik', 50);
            $table->string('jumlah_buku_rusak', 50);
            $table->timestamps();

            $table->foreign('kategori_id')->references('id_kategori')->on('kategoris')->onDelete('cascade');
            $table->foreign('penerbit_id')->references('id_penerbit')->on('penerbits')->onDelete('cascade');
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
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
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id('íd_peminjaman');
            $table->unsignedBigInteger('anggota_id');
            $table->unsignedBigInteger('buku_id');
            $table->string('tanggal_peminjaman', 125);
            $table->string('tanggal_pengembalian', 125);
            $table->enum('kondisi_buku_saat_dipinjam', ['baik', 'rusak'])->nullable();
            $table->enum('kondisi_buku_saat_dikembalikan', ['baik', 'rusak'])->nullable();
            $table->string('denda', 125);
            $table->timestamps();

            $table->foreign('anggota_id')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('buku_id')->references('id_buku')->on('bukus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peminjaman');
    }
};

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
        Schema::create('peminjamen', function (Blueprint $table) {
            $table->id('íd_peminjaman');
            $table->string('nama_anggota', 125);
            $table->string('judul_buku', 125);
            $table->string('tanggal_peminjaman', 125);
            $table->string('tanggal_pengembalian', 125);
            $table->enum('kondisi_buku_saat_dipinjam', ['baik', 'rusak']);
            $table->enum('kondisi_buku_saat_dikembalikan', ['baik', 'rusak']);
            $table->string('denda', 125);
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
        Schema::dropIfExists('peminjamen');
    }
};

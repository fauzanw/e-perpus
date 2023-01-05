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
        Schema::create('users', function (Blueprint $table) {
            $table->id('id_user');
            $table->string('kode_user', 25);
            $table->char('nis', 20)->nullable();
            $table->string('fullname', 125);
            $table->string('username', 50);
            $table->string('password', 50);
            $table->string('kelas', 50)->nullable();
            $table->string('alamat', 225)->nullable();
            $table->string('verif', 50)->nullable();
            $table->string('role', 50)->nullable();
            $table->string('join_date', 125)->nullable();
            $table->string('terakhir_login', 125)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};

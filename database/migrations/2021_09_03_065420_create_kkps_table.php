<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKkpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_kkp', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kkp')->constrained('users')->onDelete('cascade');
            $table->string('nama_penulis', 100);
            $table->string('judul', 150);
            $table->year('tahun_lulus');
            $table->string('prodi', 30);
            $table->text('abstrak');
            $table->string('bab1');
            $table->string('bab2');
            $table->string('bab3');
            $table->string('bab4');
            $table->string('bab5');
            $table->enum('status', ['Menunggu', 'Diterima', 'Ditolak']);
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
        Schema::dropIfExists('tbl_kkp');
    }
}

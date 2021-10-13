<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_prodi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_prodi')->constrained('users')->onDelete('cascade');
            $table->string('nidn', 12);
            $table->string('nama', 100);
            $table->string('prodi', 30);
            $table->enum('jenis_kelamin', ['l', 'p']);
            $table->string('no_hp', 15);
            $table->string('foto')->nullable();
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
        Schema::dropIfExists('tbl_prodi');
    }
}

<?php

// database/migrations/xxxx_xx_xx_create_kriterias_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKriteriasTable extends Migration
{
    public function up()
    {
        Schema::create('kriterias', function (Blueprint $table) {
            $table->id();
            $table->string('kode_kriteria');
            $table->string('nama_kriteria');
            $table->float('nilai_bobot'); // Bobot kriteria (misalnya 0.2, 0.3, dst.)
            $table->integer('persentase');
            $table->string('keterangan');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kriterias');
    }
}

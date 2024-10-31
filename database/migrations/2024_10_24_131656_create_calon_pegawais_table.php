<?php

// database/migrations/xxxx_xx_xx_create_calon_pegawais_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalonPegawaisTable extends Migration
{
  public function up()
  {
    Schema::create('calon_pegawais', function (Blueprint $table) {
      $table->id();
      $table->string('nama');
      $table->string('pendidikan');
      $table->integer('pengalaman'); // Tahun pengalaman kerja
      $table->integer('usia');
      $table->integer('kesehatan');
      $table->integer('nilai_test'); // Nilai hasil tes
      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('calon_pegawais');
  }
}

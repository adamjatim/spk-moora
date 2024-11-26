<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubKriteriasTable extends Migration
{
  public function up()
  {
    Schema::create('sub_kriterias', function (Blueprint $table) {
      $table->id(); // Primary key
      $table->string('kode_kriteria', 255); // Kode kriteria utama
      $table->string('tipe_penilaian', 255); // Tipe penilaian (string, nominal, range)
      $table->string('parameter', 255)->nullable(); // Parameter (string, nullable)
      $table->integer('parameter_nominal')->nullable(); // Nominal parameter (optional)
      $table->integer('parameter_min')->nullable(); // Minimum parameter value
      $table->integer('parameter_max')->nullable(); // Maximum parameter value
      $table->integer('nilai'); // Nilai sub kriteria
      $table->timestamps(); // Created at & Updated at

      // Optional: Tambahkan index jika diperlukan
      $table->index('kode_kriteria');
    });
  }

  public function down()
  {
    Schema::dropIfExists('sub_kriterias');
  }
}

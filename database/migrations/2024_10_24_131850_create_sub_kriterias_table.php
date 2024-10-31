<?php

// database/migrations/xxxx_xx_xx_create_sub_bkriterias_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubKriteriasTable extends Migration
{
    public function up()
    {
        Schema::create('sub_kriterias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kode_kriteria'); // ID kriteria utama
            $table->string('parameter');        // Nama sub kriteria
            $table->integer('nilai');                  // Nilai sub kriteria
            $table->timestamps();

            // $table->foreign('kode_kriteria')->references('kode_kriteria')->on('kriterias')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sub_kriterias');
    }
}

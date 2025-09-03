<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('calon_pegawais', function (Blueprint $table) {
            $table->id();
            $table->string('filter', 100)->default('true');
            $table->string('nama');
            $table->string('pendidikan');
            $table->integer('pengalaman');
            $table->integer('usia');
            $table->integer('kesehatan');
            $table->integer('nilai_test');
            $table->integer('tahun_daftar')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('calon_pegawais');
    }
};

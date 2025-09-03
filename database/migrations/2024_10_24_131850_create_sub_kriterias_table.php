<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sub_kriterias', function (Blueprint $table) {
            $table->id();
            $table->string('kode_kriteria');
            $table->string('tipe_penilaian')->nullable();
            $table->string('parameter');
            $table->integer('parameter_nominal');
            $table->integer('parameter_min');
            $table->integer('parameter_max');
            $table->integer('nilai');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sub_kriterias');
    }
};

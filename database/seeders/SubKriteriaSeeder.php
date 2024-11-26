<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubKriteria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;

class SubKriteriaSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $data = [
      ['kode_kriteria' => 'C1', 'tipe_penilaian' => 'string', 'parameter' => 'SMA', 'parameter_nominal' => 0, 'parameter_min' => 0, 'parameter_max' => 0, 'nilai' => 1],
      ['kode_kriteria' => 'C1', 'tipe_penilaian' => 'string', 'parameter' => 'SMK', 'parameter_nominal' => 0, 'parameter_min' => 0, 'parameter_max' => 0, 'nilai' => 1],
      ['kode_kriteria' => 'C1', 'tipe_penilaian' => 'string', 'parameter' => 'D3', 'parameter_nominal' => 0, 'parameter_min' => 0, 'parameter_max' => 0, 'nilai' => 2],
      ['kode_kriteria' => 'C1', 'tipe_penilaian' => 'string', 'parameter' => 'S1', 'parameter_nominal' => 0, 'parameter_min' => 0, 'parameter_max' => 0, 'nilai' => 3],
      ['kode_kriteria' => 'C2', 'tipe_penilaian' => 'range', 'parameter' => '0', 'parameter_nominal' => 0, 'parameter_min' => 1, 'parameter_max' => 1, 'nilai' => 1],
      ['kode_kriteria' => 'C2', 'tipe_penilaian' => 'range', 'parameter' => '0', 'parameter_nominal' => 0, 'parameter_min' => 2, 'parameter_max' => 3, 'nilai' => 2],
      ['kode_kriteria' => 'C2', 'tipe_penilaian' => 'range', 'parameter' => '0', 'parameter_nominal' => 0, 'parameter_min' => 4, 'parameter_max' => 5, 'nilai' => 3],
      ['kode_kriteria' => 'C2', 'tipe_penilaian' => 'range', 'parameter' => '0', 'parameter_nominal' => 0, 'parameter_min' => 6, 'parameter_max' => 7, 'nilai' => 4],
      ['kode_kriteria' => 'C3', 'tipe_penilaian' => 'range', 'parameter' => '0', 'parameter_nominal' => 0, 'parameter_min' => 45, 'parameter_max' => 60, 'nilai' => 1],
      ['kode_kriteria' => 'C3', 'tipe_penilaian' => 'range', 'parameter' => '0', 'parameter_nominal' => 0, 'parameter_min' => 38, 'parameter_max' => 44, 'nilai' => 2],
      ['kode_kriteria' => 'C3', 'tipe_penilaian' => 'range', 'parameter' => '0', 'parameter_nominal' => 0, 'parameter_min' => 32, 'parameter_max' => 37, 'nilai' => 3],
      ['kode_kriteria' => 'C3', 'tipe_penilaian' => 'range', 'parameter' => '0', 'parameter_nominal' => 0, 'parameter_min' => 1, 'parameter_max' => 31, 'nilai' => 4],
      ['kode_kriteria' => 'C4', 'tipe_penilaian' => 'nominal', 'parameter' => '0', 'parameter_nominal' => 1, 'parameter_min' => 0, 'parameter_max' => 0, 'nilai' => 1],
      ['kode_kriteria' => 'C4', 'tipe_penilaian' => 'nominal', 'parameter' => '0', 'parameter_nominal' => 2, 'parameter_min' => 0, 'parameter_max' => 0, 'nilai' => 2],
      ['kode_kriteria' => 'C4', 'tipe_penilaian' => 'nominal', 'parameter' => '0', 'parameter_nominal' => 3, 'parameter_min' => 0, 'parameter_max' => 0, 'nilai' => 3],
      ['kode_kriteria' => 'C4', 'tipe_penilaian' => 'nominal', 'parameter' => '0', 'parameter_nominal' => 4, 'parameter_min' => 0, 'parameter_max' => 0, 'nilai' => 4],
      ['kode_kriteria' => 'C4', 'tipe_penilaian' => 'nominal', 'parameter' => '0', 'parameter_nominal' => 5, 'parameter_min' => 0, 'parameter_max' => 0, 'nilai' => 5],
      ['kode_kriteria' => 'C5', 'tipe_penilaian' => 'range', 'parameter' => '0', 'parameter_nominal' => 0, 'parameter_min' => 0, 'parameter_max' => 69, 'nilai' => 1],
      ['kode_kriteria' => 'C5', 'tipe_penilaian' => 'range', 'parameter' => '0', 'parameter_nominal' => 0, 'parameter_min' => 70, 'parameter_max' => 89, 'nilai' => 2],
      ['kode_kriteria' => 'C5', 'tipe_penilaian' => 'range', 'parameter' => '0', 'parameter_nominal' => 0, 'parameter_min' => 90, 'parameter_max' => 100, 'nilai' => 3],
    ];

    DB::table('sub_kriterias')->insert($data);
  }
}

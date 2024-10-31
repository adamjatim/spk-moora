<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kriteria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KriteriaSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // Data calon pegawai
    $Kriterias = [
      [
        'kode_kriteria' => 'C1',
        'nama_kriteria' => 'Pendidikan',
        'nilai_bobot' => '0.2',
        'persentase' => 20,
        'keterangan' => 'Benefit',
      ],
      [
        'kode_kriteria' => 'C2',
        'nama_kriteria' => 'Pengalaman',
        'nilai_bobot' => '0.25',
        'persentase' => 25,
        'keterangan' => 'Benefit',
      ],
      [
        'kode_kriteria' => 'C3',
        'nama_kriteria' => 'Usia',
        'nilai_bobot' => '0.1',
        'persentase' => 10,
        'keterangan' => 'Cost',
      ],
      [
        'kode_kriteria' => 'C4',
        'nama_kriteria' => 'Kesehatan',
        'nilai_bobot' => '0.15',
        'persentase' => 15,
        'keterangan' => 'Cost',
      ],
      [
        'kode_kriteria' => 'C5',
        'nama_kriteria' => 'Nilai Test',
        'nilai_bobot' => '0.3',
        'persentase' => 30,
        'keterangan' => 'Benefit',
      ],
    ];

    // Insert data ke tabel calon pegawai
    foreach ($Kriterias as $kriteria) {
      Kriteria::create($kriteria);
    }
  }
}

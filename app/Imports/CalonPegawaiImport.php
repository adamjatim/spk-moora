<?php

namespace App\Imports;

use App\Models\CalonPegawai;
use Maatwebsite\Excel\Concerns\ToModel;

class CalonPegawaiImport implements ToModel
{
  /**
   * Setiap baris akan di-mapping ke model.
   *
   * @param array $row
   * @return \Illuminate\Database\Eloquent\Model|null
   */
  public function model(array $row)
  {
    return new CalonPegawai([
      'nama'          => $row[0],
      'usia'          => $row[1],
      'jenis_kelamin' => $row[2],
      'pendidikan'     => $row[3],
      'pengalaman'    => $row[4],
      'kesehatan'     => $row[5],
      'nilai_test'     => $row[6],
      'tahun_daftar'  => $row[7],
      // 'filter'         => $row[0],

      // Tambahkan kolom lainnya sesuai model
    ]);
  }
}

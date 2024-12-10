<?php

namespace App\Http\Livewire\CalonPegawai;

use Livewire\Component;
use App\Models\CalonPegawai;
use App\Imports\CalonPegawaiImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Import extends Component
{
  public function import(Request $request)
  {
    // Validasi file yang diunggah
    $request->validate([
      'file' => 'required|mimes:xlsx,xls,csv',
    ]);

    // Proses file menggunakan Laravel Excel
    $file = $request->file('file');
    $data = Excel::toArray([], $file);

    // Asumsikan data ada di sheet pertama
    $rows = $data[0];

    // Lewati baris pertama jika itu header
    unset($rows[0]);

    foreach ($rows as $row) {
      // Ambil data usia, pendidikan, pengalaman, dll.
      $usiaString = $row[1]; // Indeks sesuai kolom usia
      $pengalamanString = $row[4]; // Indeks sesuai kolom pengalaman

      // Bersihkan nilai usia dari teks dan pastikan menjadi integer
      $usia = (int) filter_var($usiaString, FILTER_SANITIZE_NUMBER_INT);

      // Bersihkan nilai pengalaman dari teks
      $pengalaman = (int) str_replace(' tahun', '', strtolower(trim($pengalamanString)));

      // Simpan ke database
      CalonPegawai::create([
        'nama' => $row[0],  // Sesuaikan dengan kolom lainnya
        'usia' => $usia,
        'pendidikan' => $row[3],
        'pengalaman' => $pengalaman,
        'kesehatan' => $row[5],
        'nilai_test' => $row[6],
        'tahun_daftar' => $row[7],
      ]);
    }

    return redirect()->route('calon-pegawai.index')->with('message', 'Data berhasil diimport!');
  }
}

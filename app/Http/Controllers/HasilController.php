<?php

namespace App\Http\Controllers;

use App\Models\DataHasil;
use Illuminate\Http\Request;

class HasilController extends Controller
{
  // Method untuk menyimpan data dari JavaScript
  public function store(Request $request)
  {

    // Validasi request
    $validated = $request->validate([
      'data' => 'required|array', // Data harus berupa array
      'data.*.0' => 'required|string', // Nama calon (string)
      'data.*.1' => 'required|numeric', // Nilai Yi (numeric)
      'data.*.2' => 'required|string', // Keterangan (string)
    ]);

    // Iterasi data dan simpan ke database
    foreach ($validated['data'] as $item) {
      DataHasil::create([
        'nama_calon' => $item[0],
        'nilai_yi' => $item[1],
        'keterangan' => $item[2],
      ]);
    }

    return response()->json(['message' => 'Data berhasil disimpan'], 200);
  }
}

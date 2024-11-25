<?php

namespace App\Http\Controllers;

use App\Models\DataHasil;
use Illuminate\Http\Request;

class DataHasilController extends Controller
{
    public function resetAndInsert(Request $request)
    {
        // Data baru dari request
        $data = $request->input('MatrixYi'); // Pastikan data diterima dari frontend

        // Reset tabel
        DataHasil::truncate();

        // Simpan data baru
        foreach ($data as $row) {
            DataHasil::create([
                'nama_calon' => $row[0],
                'nilai_yi' => $row[1],
                'keterangan' => $row[2],
            ]);
        }

        return response()->json(['message' => 'Data berhasil disimpan dan direset.']);
    }
}

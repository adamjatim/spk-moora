<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CalonPegawai;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use App\Http\Controllers\Controller;
use App\Models\DataHasil;

class DashboardController extends Controller
{
  public function index()
  {
    $role = auth()->user()->role;
    return view('owner.dashboard', [
      // dd($this->calonPegawais),
      'calonPegawais' => CalonPegawai::all(),
      'kriterias' => Kriteria::orderBy('kode_kriteria', 'asc')->get(),
      'subKriterias' => SubKriteria::all(),
      'dataHasils' => DataHasil::all(),
    ]);

    // Jika role tidak valid, tampilkan error
    abort(403, 'Unauthorized access');
  }
}

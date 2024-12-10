<?php

namespace App\Http\Controllers;

use App\Models\CalonPegawai;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use App\Http\Controllers\Controller;
use App\Models\DataHasil;
// use Barryvdh\DomPDF\Facade\Pdf;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf;
// use  Mccarlosen\LaravelMpdf\Facades\LaravelMpdf;

class PDFController extends Controller
{
  public function generatePDF()
  {

    $totalPegawai = DataHasil::count();
    $totalLayak = DataHasil::where('keterangan', 'Layak')->count();
    $totalTidakLayak = DataHasil::where('keterangan', 'Tidak Layak')->count();

    $data = [
      'title' => 'Data Calon Pegawai',
      'calonPegawais' => CalonPegawai::all(),
      'kriterias' => Kriteria::orderBy('kode_kriteria', 'asc')->get(),
      'subKriterias' => SubKriteria::all(),
      'dataHasils' => DataHasil::all(),
      'totals' => [
        'totalPegawai' => $totalPegawai,
        'totalLayak' => $totalLayak,
        'totalTidakLayak' => $totalTidakLayak,
      ],
    ];

    $pdf = LaravelMpdf::loadView('pdf.document', $data);
    return $pdf->download('document.pdf');
    // return view('pdf.document', $data);
  }
}

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\CalonPegawai\Index as CalonPegawaiIndex;
use App\Http\Livewire\CalonPegawai\Create as CalonPegawaiCreate;
use App\Http\Livewire\CalonPegawai\Import as CalonPegawaiImport;
use App\Http\Livewire\CalonPegawai\Edit as CalonPegawaiEdit;

use App\Http\Livewire\Kriteria\Index as KriteriaIndex;
use App\Http\Livewire\Kriteria\Create as KriteriaCreate;
use App\Http\Livewire\Kriteria\Edit as KriteriaEdit;

use App\Http\Livewire\Subkriteria\Index as SubkriteriaIndex;
use App\Http\Livewire\Subkriteria\Create as SubkriteriaCreate;
use App\Http\Livewire\Subkriteria\Edit as SubkriteriaEdit;

use App\Http\Livewire\Penilaian\Index as PenilaianIndex;
use App\Http\Livewire\Penilaian\Edit as PenilaianEdit;

use App\Http\Livewire\Proses\Index as ProsesIndex;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HasilController;
use App\Http\Controllers\DataHasilController;
use App\Http\Controllers\Kejutan;

use App\Http\Controllers\PDFController;

Route::get('/generate-pdf', [PDFController::class, 'generatePDF'])->name('generatePDF');


// BAGIAN ROUTE YANG TIDAK BUTUH AKSES LOGIN
Route::get('/', function () {
  // return view('welcome');
  return redirect()->route('login');
});

// BAGIAN ROUTE YANG HARUS LOGIN TERLEBIH DAHULU
Route::middleware([
  'auth:sanctum',
  config('jetstream.auth_session'),
  'verified'
])->group(function () {
  // MULAI DARI SINI, ROUTE BUTUH AUTENTIKASI LOGIN

  // route halaman dashboard
  // Route::get('/dashboard', function () {
  //   $role = auth()->user()->role;

  //   if ($role === 'admin') {
  //     return view('dashboard');
  //   } elseif ($role === 'owner') {
  //     return view('owner.dashboard');
  //   }

  //   abort(403, 'Unauthorized access');
  // })->name('dashboard');
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

  // route data alternatif index
  // Route::get('/calon-pegawai', CalonPegawaiIndex::class)->name('calon-pegawai.index');
  // route data alternatif create
  Route::get('/calon-pegawai/create', CalonPegawaiCreate::class)->name('calon-pegawai.create');
  // route data alternatif import
  Route::post('/calon-pegawai/import', [CalonPegawaiImport::class, 'import'])->name('calon-pegawai.import');
  // route data alternatif edit
  Route::get('/calon-pegawai/{id}/edit', CalonPegawaiEdit::class)->name('calon-pegawai.edit');
  // route data alternatif index
  Route::get('/calon-pegawai/{tahun_filter?}', CalonPegawaiIndex::class)->name('calon-pegawai.index');

  // route data kriteria
  Route::get('/kriteria', KriteriaIndex::class)->name('kriteria.index');
  Route::get('/kriteria/create', KriteriaCreate::class)->name('kriteria.create');
  Route::get('/kriteria/{id}/edit', KriteriaEdit::class)->name('kriteria.edit');

  // route data sub kriteria
  Route::get('/subkriteria', SubKriteriaIndex::class)->name('subkriteria.index');
  Route::get('/subkriteria/create', SubKriteriaCreate::class)->name('subkriteria.create');
  Route::get('/subkriteria/edit/{id}', SubKriteriaEdit::class)->name('subkriteria.edit');

  // route penilaian
  Route::get('/penilaian', PenilaianIndex::class)->name('penilaian.index');
  Route::get('/penilaian/{altId}/edit', PenilaianEdit::class)->name('penilaian.edit');
  Route::get('/penilaian/proses', ProsesIndex::class)->name('penilaian.proses');

  Route::post('/data-hasil', [HasilController::class, 'store'])->name('data-hasil.store');
  Route::post('/reset-data-hasil', [DataHasilController::class, 'resetAndInsert']);

});

Route::get('/kejutan', [Kejutan::class, 'kejutan']);

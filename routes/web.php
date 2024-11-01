<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\CalonPegawai\Index as CalonPegawaiIndex;
use App\Http\Livewire\CalonPegawai\Create as CalonPegawaiCreate;
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
  Route::get('/dashboard', function () {
    return view('dashboard');
  })->name('dashboard');

  // route data alternatif index
  Route::get('/calon-pegawai', CalonPegawaiIndex::class)->name('calon-pegawai.index');
  // route data alternatif create
  Route::get('/calon-pegawai/create', CalonPegawaiCreate::class)->name('calon-pegawai.create');
  // route data alternatif edit
  Route::get('/calon-pegawai/{id}/edit', CalonPegawaiEdit::class)->name('calon-pegawai.edit');

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
});

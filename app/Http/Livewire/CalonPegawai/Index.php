<?php

namespace App\Http\Livewire\CalonPegawai;

use Livewire\Component;
use App\Models\CalonPegawai;

class Index extends Component
{
  public $calonPegawais; // Data calon pegawai
  public $selectedPegawai = []; // Menyimpan ID pegawai yang dipilih
  public $tahun_filter; // Properti untuk filter tahun
  public $tahun_tersedia = []; // Daftar tahun yang tersedia
  public $confirmingDelete = false;
  public $dataToDelete = [];
  public $importingExcel = false;

  public function mount($tahun_filter = null)
  {
    // Ambil data dari database saat pertama kali komponen dimuat
    // $this->calonPegawais = CalonPegawai::all();

    $this->tahun_filter = $tahun_filter; // Ambil filter dari URL jika ada

    // Ambil semua data calon pegawai
    $this->calonPegawais = CalonPegawai::when($tahun_filter, function ($query) {
      $query->where('tahun_daftar', $this->tahun_filter);
    })->get();

    // Ambil daftar tahun unik
    $this->tahun_tersedia = CalonPegawai::select('tahun_daftar')
      ->distinct()
      ->orderBy('tahun_daftar', 'asc')
      ->pluck('tahun_daftar')
      ->toArray();
  }

  public function filterByYear($tahun)
  {
    $this->tahun_filter = $tahun;
    // Redirect ke rute dengan parameter tahun_filter
    return redirect()->route('calon-pegawai.index', ['tahun_filter' => $tahun]);
  }

  public function toggleFilter($id, $tahun)
  {
    $pegawai = CalonPegawai::find($id);

    if ($pegawai) {
      // Ganti nilai antara 'true' dan 'false'
      $pegawai->filter = $pegawai->filter === 'true' ? 'false' : 'true';
      $pegawai->save();
    }

    // Refresh data
    $this->calonPegawais = CalonPegawai::all();

    if (!$tahun) {
      return;
    }
    // Redirect ke rute dengan parameter tahun_filter
    return redirect()->route('calon-pegawai.index', ['tahun_filter' => $tahun]);
  }

  public function render()
  {
    return view('livewire.calon-pegawai.index', [
      'calonPegawais' => $this->calonPegawais,
    ]);
  }

  // Fungsi untuk menghapus calon pegawai
  public function confirmDelete($id)
  {
    $this->dataToDelete = CalonPegawai::find($id)->toArray();
    $this->confirmingDelete = true;
  }

  // Fungsi untuk menghapus calon pegawai
  public function deleteData($id)
  {
    CalonPegawai::findOrFail($id)->delete();
    session()->flash('message', 'Data berhasil dihapus.');
    $this->confirmingDelete = false;
    return redirect()->route('calon-pegawai.index');
  }

  // Fungsi untuk modal Import Excel
  public function importExcel()
  {
    $this->importingExcel = true;
  }

  // Fungsi untuk menerapkan filter
  public function applyFilter()
  {
    if (empty($this->selectedPegawai)) {
      session()->flash('message', 'Data telah di filter.');
      session()->flash('filterSuccess', 'Pergi ke Penilaian');
      return;
    }

    // Update kolom filter untuk ID yang dipilih
    CalonPegawai::whereIn('id', $this->selectedPegawai)->update(['filter' => 'false']);

    // Refresh data calon pegawai
    $this->calonPegawais = CalonPegawai::all();

    session()->flash('message', 'Data telah di filter.');
    session()->flash('filterSuccess', 'Pergi ke Penilaian');
  }
}

<?php

namespace App\Http\Livewire\CalonPegawai;

use Livewire\Component;
use App\Models\CalonPegawai;

class Index extends Component
{
  public $calonPegawais; // Data calon pegawai
  public $selectedPegawai = []; // Menyimpan ID pegawai yang dipilih

  public function mount()
  {
    // Ambil data dari database saat pertama kali komponen dimuat
    $this->calonPegawais = CalonPegawai::all();
  }

  public function toggleFilter($id)
  {
    $pegawai = CalonPegawai::find($id);

    if ($pegawai) {
      // Ganti nilai antara 'true' dan 'false'
      $pegawai->filter = $pegawai->filter === 'true' ? 'false' : 'true';
      $pegawai->save();
    }

    // Refresh data
    $this->calonPegawais = CalonPegawai::all();
  }

  public function render()
  {
    return view('livewire.calon-pegawai.index', [
      'calonPegawais' => $this->calonPegawais,
    ]);
  }

  // Fungsi untuk menghapus calon pegawai
  public function delete($id)
  {
    $calonPegawai = CalonPegawai::find($id);
    $calonPegawai->delete();

    session()->flash('message', 'Data calon pegawai berhasil dihapus.');
  }

  // Fungsi untuk menerapkan filter
  public function applyFilter()
  {
    if (empty($this->selectedPegawai)) {
      session()->flash('message', 'Filter berhasil diterapkan.');
      return;
    }

    // Update kolom filter untuk ID yang dipilih
    CalonPegawai::whereIn('id', $this->selectedPegawai)->update(['filter' => 'false']);

    // Refresh data calon pegawai
    $this->calonPegawais = CalonPegawai::all();

    session()->flash('message', 'Filter berhasil diterapkan.');
  }
}

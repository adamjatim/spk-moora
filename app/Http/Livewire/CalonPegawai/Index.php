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
  public $allSelected = false;

  // public function toggleSelectAll($tahun)
  // {
  //   // Ambil semua data
  //   $query = CalonPegawai::all();

  //   // Jika tahun tidak null, filter data berdasarkan tahun_daftar
  //   if ($tahun !== 'null') {
  //     $query = CalonPegawai::where('tahun_daftar', $tahun)->get();
  //   }

  //   // Cek apakah semua data yang diambil sudah terseleksi (filter = 1)
  //   $allSelected = $query->every(fn($pegawai) => $pegawai->filter == "true");
  //   dd($allSelected);

  //   // Ubah status filter untuk semua data yang sesuai
  //   $query->each(function ($pegawai) use ($allSelected) {
  //     $pegawai->filter = $allSelected ? "false" : "true"; // Toggle nilai filter (1 menjadi 0, atau 0 menjadi 1)
  //     $pegawai->save();

  //   });

  //   // Perbarui properti $allSelected untuk mencerminkan status terbaru
  //   $this->allSelected = !$allSelected;
  //   return redirect()->route('calon-pegawai.index', ['tahun_filter' => $tahun]);
  // }


  public function toggleSelectAll($tahun)
  {
    $query = CalonPegawai::all(); // Ambil semua data jika tahun bernilai null
    // dd($query);

    if ($tahun !== 0) {
      $query = CalonPegawai::where('tahun_daftar', $tahun)->get(); // Filter berdasarkan tahun
    }

    // dd($query);

    // Pastikan semua data memiliki format konsisten pada kolom filter
    $allSelected = $query->every(fn($pegawai) => $pegawai->filter == "true" || $pegawai->filter == 1);

    // Ubah status filter untuk semua data yang sesuai
    $query->each(function ($pegawai) use ($allSelected) {
      $pegawai->filter = $allSelected ? "false" : "true"; // Toggle nilai filter
      $pegawai->save();
    });

    // Perbarui properti $allSelected untuk mencerminkan status terbaru
    $this->allSelected = !$allSelected;

    // Redirect ke route calon-pegawai.index dengan filter tahun yang sama
    return redirect()->route('calon-pegawai.index', ['tahun_filter' => $tahun]);
  }


  public function redirectIndex()
  {
    return redirect()->route('calon-pegawai.index');
  }

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
    // return redirect()->route('calon-pegawai.index');
  }

  // Fungsi untuk menerapkan filter
  public function applyFilter()
  {
    // Cek apakah jumlah kandidat yang terseleksi kurang dari 10
    // if (count($this->selectedPegawai) < 10) {
    //   session()->flash('error', 'Terjadi kesalahan, data yang dipilih minimal 10 Alternatif. Alternatif terpilih saat ini : ' . count($this->selectedPegawai));
    //   return;
    // }
    $selected = CalonPegawai::where('filter', 'true')->count();

    if ($selected < 10) {
        session()->flash('error', 'Terjadi kesalahan, data yang dipilih minimal 10 Alternatif. Alternatif terpilih saat ini : ' . $selected);
        return redirect()->route('calon-pegawai.index');
    }

    if (empty($this->selectedPegawai)) {
      session()->flash('message', 'Data telah di filter.');
      session()->flash('filterSuccess', 'Pergi ke Penilaian');
      return redirect()->route('calon-pegawai.index');
    }

    // Update kolom filter untuk ID yang dipilih
    CalonPegawai::whereIn('id', $this->selectedPegawai)->update(['filter' => 'false']);

    // Refresh data calon pegawai
    $this->calonPegawais = CalonPegawai::all();

    session()->flash('message', 'Data telah di filter.');
    session()->flash('filterSuccess', 'Pergi ke Penilaian');
    return redirect()->route('calon-pegawai.index');
  }
}

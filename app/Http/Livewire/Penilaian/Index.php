<?php

namespace App\Http\Livewire\Penilaian;

use Livewire\Component;
use App\Models\CalonPegawai;
use App\Models\Kriteria;
use App\Models\SubKriteria;

class Index extends Component
{
  public $calonPegawais;
  public $kriterias;
  public $subKriterias;

  public function mount()
  {
    // Ambil semua data calon pegawai
    $this->calonPegawais = CalonPegawai::all();

    // Ambil semua kriteria urut berdasarkan kode_kriteria
    $this->kriterias = Kriteria::orderBy('kode_kriteria', 'asc')->get();

    // Ambil data sub kriteria untuk mapping nilai
    $this->subKriterias = SubKriteria::all();
  }

  public function render()
  {
    return view('livewire.penilaian.index', [
      'calonPegawais' => $this->calonPegawais,
      'kriterias' => $this->kriterias,
      'subKriterias' => $this->subKriterias,
    ]);
  }
}



// namespace App\Http\Livewire\Penilaian;

// use App\Models\CalonPegawai;
// use App\Models\Kriteria;
// use App\Models\SubKriteria;
// use Livewire\Component;

// class Index extends Component
// {
// 	public function render()
// 	{
// 		$alternatifs = CalonPegawai::all();
// 		$kriterias = Kriteria::all();
//     $subKriteria = SubKriteria::all();

// 		return view('livewire.penilaian.index', compact('alternatifs', 'kriterias', 'subKriteria'));
// 	}
// }

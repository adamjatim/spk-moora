<?php

namespace App\Http\Livewire\Subkriteria;

use App\Models\SubKriteria;
use App\Models\Kriteria;
use Livewire\Component;

class Index extends Component
{
  public $subKriteria;

  protected $listeners = ['subKriteriaUpdated' => '$refresh'];

  public function mount()
  {
    // Mengambil data SubKriteria beserta data terkait dari tabel Kriteria
    $this->subKriteria = SubKriteria::with('kriteria')->get();

  }

  public function render()
  {
    return view('livewire.sub-kriteria.index', [
      'subKriteria' => $this->subKriteria,
    ]);
  }

  public function delete($id)
  {
    SubKriteria::findOrFail($id)->delete();
    $this->emit('subKriteriaUpdated');
    session()->flash('message', 'Sub-kriteria berhasil dihapus.');
  }
}


// namespace App\Http\Livewire\SubKriteria;

// use App\Models\SubKriteria;
// use Livewire\Component;

// class Index extends Component
// {
//   public function delete($id)
//   {
//     SubKriteria::find($id)->delete();

//     session()->flash('message', 'Sub Kriteria berhasil dihapus.');
//   }

//   public function render()
//   {
//     return view('livewire.sub-kriteria.index', [
//       // Menggunakan eager loading untuk memuat kriteria terkait
//       'subKriterias' => SubKriteria::with('kriteria')->get()
//       // 'subKriterias' => SubKriteria::all()
//     ]);
//   }
// }

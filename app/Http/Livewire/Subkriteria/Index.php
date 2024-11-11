<?php

namespace App\Http\Livewire\Subkriteria;

use App\Models\SubKriteria;
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
      // 'subKriteria' => $this->subKriteria
      'subKriterias' => SubKriteria::all()
    ]);
  }

  public function delete($id)
  {
    SubKriteria::findOrFail($id)->delete();
    $this->emit('subKriteriaUpdated');
    session()->flash('message', 'Sub-kriteria berhasil dihapus.');
  }
}

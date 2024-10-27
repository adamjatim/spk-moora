<?php

namespace App\Http\Livewire\Kriteria;

use App\Models\Kriteria;
use Livewire\Component;

class Index extends Component
{
  public function delete($id)
  {
    Kriteria::find($id)->delete();

    session()->flash('message', 'Kriteria berhasil dihapus.');
  }

  public function render()
  {
    return view('livewire.kriteria.index', [
      'kriterias' => Kriteria::all()
    ]);
  }
}

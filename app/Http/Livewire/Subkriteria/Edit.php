<?php

namespace App\Http\Livewire\Subkriteria;

use App\Models\Kriteria;
use App\Models\SubKriteria;
use Livewire\Component;

class Edit extends Component
{
  public $subKriteriaId, $kode_kriteria, $nama_kriteria, $tipe_penilaian, $parameter_type, $parameter_min, $parameter_max, $parameter_values, $parameter_nominal, $nilai;

  public $kriteriaList = [];

  public function mount($id)
  {
    $this->kriteriaList = Kriteria::all();
    $subKriteria = SubKriteria::findOrFail($id);

    $this->subKriteriaId = $subKriteria->id;
    $this->kode_kriteria = $subKriteria->kode_kriteria;
    $this->nama_kriteria = $subKriteria->kriteria->nama_kriteria ?? '';
    $this->tipe_penilaian = $subKriteria->tipe_penilaian;
    $this->parameter_type = $subKriteria->parameter_type;
    $this->parameter_nominal = $subKriteria->parameter_nominal;
    $this->parameter_min = $subKriteria->parameter_min;
    $this->parameter_max = $subKriteria->parameter_max;

    // Pastikan ini adalah array sebelum menggunakan implode
    $this->nilai = $subKriteria->nilai; // Ini harus sudah dalam format string
    $this->parameter_values = $subKriteria->parameter;
  }

  // public function update()
  // {
  //   $subKriteria = SubKriteria::findOrFail($this->subKriteriaId);

  //   if ($this->parameter_type === 'string') {
  //     $subKriteria->parameter_values = array_map('trim', explode(',', $this->parameter_values));
  //   } elseif ($this->parameter_type === 'nominal') {
  //     $subKriteria->parameter_nominal = $this->parameter_nominal;
  //   } elseif ($this->parameter_type === 'range') {
  //     $subKriteria->parameter_min = $this->parameter_min;
  //     $subKriteria->parameter_max = $this->parameter_max;
  //   }

  //   // Pastikan nilai adalah array sebelum menyimpannya
  //   $subKriteria->nilai = implode(',', array_map('trim', explode(',', $this->nilai)));
  //   $subKriteria->save();

  //   session()->flash('message', 'Sub Kriteria berhasil diperbarui');
  //   return redirect()->route('subkriteria.index');
  // }


  public function update()
{
    $subKriteria = SubKriteria::findOrFail($this->subKriteriaId);

    if ($this->parameter_type === 'string') {
        $subKriteria->parameter = $this->parameter_values;
    } elseif ($this->parameter_type === 'nominal') {
        $subKriteria->parameter_nominal = $this->parameter_nominal;
    } elseif ($this->parameter_type === 'range') {
        $subKriteria->parameter_min = $this->parameter_min;
        $subKriteria->parameter_max = $this->parameter_max;
    }

    // Pastikan nilai adalah array sebelum menyimpannya
    $subKriteria->nilai = $this->nilai;
    $subKriteria->save();

    session()->flash('message', 'Sub Kriteria berhasil diperbarui');
    return redirect()->route('subkriteria.index');
}

  public function render()
  {
    return view('livewire.sub-kriteria.edit');
  }
}

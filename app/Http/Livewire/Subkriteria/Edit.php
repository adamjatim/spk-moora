<?php

namespace App\Http\Livewire\Subkriteria;

use App\Models\Kriteria;
use App\Models\SubKriteria;
use Livewire\Component;

class Edit extends Component
{
  public $subKriteriaId;
  public $kode_kriteria;
  public $nama_kriteria;
  public $parameter_type;
  public $parameter_min;
  public $parameter_max;
  public $parameter_values;
  public $nilai;

  public $kriteriaList = [];

  public function mount($id)
  {
    $this->kriteriaList = Kriteria::all();
    $subKriteria = SubKriteria::findOrFail($id);

    $this->subKriteriaId = $subKriteria->id;
    $this->kode_kriteria = $subKriteria->kode_kriteria;
    $this->nama_kriteria = $subKriteria->kriteria->nama_kriteria ?? '';
    $this->parameter_type = $subKriteria->parameter_type;
    $this->parameter_min = $subKriteria->parameter_min;
    $this->parameter_max = $subKriteria->parameter_max;
    $this->nilai = $subKriteria->nilai;
    $this->parameter_values = $subKriteria->parameter;

    // Memastikan nilai adalah array sebelum menggunakan implode
    // $this->nilai = is_array($subKriteria->nilai)
    //   ? implode(', ', $subKriteria->nilai)
    //   : $subKriteria->nilai;

    // Memastikan parameter_values adalah array sebelum menggunakan implode
    // $this->parameter_values = is_array($subKriteria->parameter_values)
    //   ? implode(', ', $subKriteria->parameter_values)
    //   : $subKriteria->parameter_values;
  }


  // public function mount($id)
  // {
  //     $this->kriteriaList = Kriteria::all();
  //     $subKriteria = SubKriteria::findOrFail($id);

  //     $this->subKriteriaId = $subKriteria->id;
  //     $this->kode_kriteria = $subKriteria->kode_kriteria;
  //     $this->nama_kriteria = $subKriteria->kriteria->nama_kriteria ?? '';
  //     $this->parameter_type = $subKriteria->parameter_type;
  //     $this->parameter_min = $subKriteria->parameter_min;
  //     $this->parameter_max = $subKriteria->parameter_max;
  //     $this->parameter_values = $subKriteria->parameter_type === 'string'
  //         ? implode(', ', $subKriteria->parameter_values)
  //         : null;
  //     $this->nilai = implode(', ', $subKriteria->nilai);
  // }

  public function update()
  {
    $subKriteria = SubKriteria::findOrFail($this->subKriteriaId);

    if ($this->parameter_type === 'string') {
      $subKriteria->parameter_values = array_map('trim', explode(',', $this->parameter_values));
    } elseif ($this->parameter_type === 'nominal') {
      $subKriteria->parameter_min = $this->parameter_min;
      $subKriteria->parameter_max = $this->parameter_max;
    }

    $subKriteria->nilai = array_map('trim', explode(',', $this->nilai));
    $subKriteria->save();

    session()->flash('message', 'Sub Kriteria berhasil diperbarui');
    return redirect()->route('subkriteria.index');
  }

  public function render()
  {
    return view('livewire.sub-kriteria.edit');
  }
}

// <?php

// namespace App\Http\Livewire\Subkriteria;

// use App\Models\SubKriteria;
// use Livewire\Component;

// class Edit extends Component
// {
//   public $subKriteria;
//   public $kode_kriteria, $parameter, $nilai;

//   protected $rules = [
//     'kode_kriteria' => 'required|string|max:10',
//     'parameter' => 'required|string|max:50',
//     'nilai' => 'required|integer|min:1',
//   ];

//   public function mount($id)
//   {
//     $this->subKriteria = SubKriteria::findOrFail($id);
//     $this->kode_kriteria = $this->subKriteria->kode_kriteria;
//     $this->parameter = $this->subKriteria->parameter;
//     $this->nilai = $this->subKriteria->nilai;
//   }

//   public function update()
//   {
//     $this->validate();

//     $this->subKriteria->update([
//       'kode_kriteria' => $this->kode_kriteria,
//       'parameter' => $this->parameter,
//       'nilai' => $this->nilai,
//     ]);

//     $this->emit('subKriteriaUpdated');
//     session()->flash('message', 'Sub-kriteria berhasil diupdate.');
//   }

//   public function render()
//   {
//     return view('livewire.sub-kriteria.edit');
//   }
// }

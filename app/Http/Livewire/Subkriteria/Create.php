<?php

namespace App\Http\Livewire\Subkriteria;

use App\Models\Kriteria;
use App\Models\SubKriteria;
use Livewire\Component;

class Create extends Component
{
  public $kode_kriteria;
  public $nama_kriteria;
  public $parameter_type;
  public $parameter_min;
  public $parameter_max;
  public $parameter_values;
  public $nilai;

  public $kriteriaList = []; // Menyimpan data kriteria untuk dropdown

  public function mount()
  {
    // Mengambil data kriteria untuk dropdown
    $this->kriteriaList = Kriteria::all();
  }

  // Method untuk mengupdate nama_kriteria ketika kode_kriteria berubah
  public function updatedKodeKriteria($value)
  {
    $kriteria = Kriteria::where('kode_kriteria', $value)->first();
    $this->nama_kriteria = $kriteria ? $kriteria->nama_kriteria : '';
  }

  public function store()
  {
    if ($this->parameter_type == 'string') {
      // Pisahkan parameter values dan nilai menggunakan koma
      $parameters = explode(',', $this->parameter_values);
      $nilaiArray = array_map('trim', explode(',', $this->nilai));

      foreach ($parameters as $index => $param) {
        SubKriteria::create([
          'kode_kriteria' => $this->kode_kriteria,
          'parameter' => trim($param),
          'parameter_min' => 0,
          'parameter_max' => 0,
          'nilai' => $nilaiArray[$index] ?? null, // Menggunakan nilai yang sesuai
        ]);
      }
    } elseif ($this->parameter_type == 'nominal') {
      // Pisahkan parameter_min, parameter_max, dan nilai menggunakan koma
      $parameterMinArray = array_map('trim', explode(',', $this->parameter_min));
      $parameterMaxArray = array_map('trim', explode(',', $this->parameter_max));
      $nilaiArray = array_map('trim', explode(',', $this->nilai));

      // Iterasi melalui setiap elemen dalam array dan buat entri baru untuk setiap set
      foreach ($parameterMinArray as $index => $paramMin) {
        SubKriteria::create([
          'kode_kriteria' => $this->kode_kriteria,
          'parameter' => 0,
          'parameter_min' => $paramMin,
          'parameter_max' => $parameterMaxArray[$index] ?? $paramMin + 1, // Menggunakan parameter_max jika ada, jika tidak, default
          'nilai' => $nilaiArray[$index] ?? null, // Menggunakan nilai yang sesuai
        ]);
      }
    }

    session()->flash('message', 'Sub Kriteria berhasil ditambahkan');
    $this->reset(); // Mengosongkan input
    return redirect()->route('subkriteria.index');
  }

  public function render()
  {
    return view('livewire.sub-kriteria.create');
  }
}

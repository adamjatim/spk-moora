<?php

namespace App\Http\Livewire\Subkriteria;

use App\Models\Kriteria;
use App\Models\SubKriteria;
use Livewire\Component;

class Create extends Component
{
  public $kode_kriteria, $nama_kriteria, $parameter_type, $parameter_nominal, $parameter_min, $parameter_max, $parameter_values, $nilai;
  public $showModal = false; // Properti untuk mengontrol modal
  public $kriteriaList = []; // Menyimpan data kriteria untuk dropdown

  protected $rules = [
    'kode_kriteria' => 'required',
    'parameter_type' => 'required',
    'parameter_values' => 'nullable|string',
    'parameter_nominal' => 'nullable|string',
    'parameter_min' => 'nullable|numeric',
    'parameter_max' => 'nullable|numeric',
    'nilai' => 'nullable|string',
  ];

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
      $parameters = array_map('trim', explode(',', $this->parameter_values));
      $nilaiArray = array_map('trim', explode(',', $this->nilai));

      foreach ($parameters as $index => $param) {
        SubKriteria::create([
          'kode_kriteria' => $this->kode_kriteria,
          'tipe_penilaian' => $this->parameter_type, // Masukkan nilai parameter_type ke tipe_penilaian
          'parameter' => trim($param),
          'parameter_nominal' => 0,
          'parameter_min' => 0,
          'parameter_max' => 0,
          'nilai' => $nilaiArray[$index] ?? null, // Menggunakan nilai yang sesuai
        ]);
      }
    } elseif ($this->parameter_type == 'nominal') {
      // Pisahkan parameter values dan nilai menggunakan koma
      $parameters = array_map('trim', explode(',', $this->parameter_nominal));
      $nilaiArray = array_map('trim', explode(',', $this->nilai));

      // Iterasi melalui setiap elemen dalam array dan buat entri baru untuk setiap set
      foreach ($parameters as $index => $param) {
        SubKriteria::create([
          'kode_kriteria' => $this->kode_kriteria,
          'tipe_penilaian' => $this->parameter_type, // Masukkan nilai parameter_type ke tipe_penilaian
          'parameter' => 0,
          'parameter_nominal' => trim($param),
          'parameter_min' => 0,
          'parameter_max' => 0,
          'nilai' => $nilaiArray[$index] ?? null, // Menggunakan nilai yang sesuai
        ]);
      }
    } elseif ($this->parameter_type == 'range') {
      // Pisahkan parameter_min, parameter_max, dan nilai menggunakan koma
      $parameterMinArray = array_map('trim', explode(',', $this->parameter_min));
      $parameterMaxArray = array_map('trim', explode(',', $this->parameter_max));
      $nilaiArray = array_map('trim', explode(',', $this->nilai));

      // Iterasi melalui setiap elemen dalam array dan buat entri baru untuk setiap set
      foreach ($parameterMinArray as $index => $paramMin) {
        SubKriteria::create([
          'kode_kriteria' => $this->kode_kriteria,
          'tipe_penilaian' => $this->parameter_type, // Masukkan nilai parameter_type ke tipe_penilaian
          'parameter' => 0,
          'parameter_nominal' => 0,
          'parameter_min' => $paramMin,
          'parameter_max' => $parameterMaxArray[$index] ?? $paramMin + 1, // Menggunakan parameter_max jika ada, jika tidak, default
          'nilai' => $nilaiArray[$index] ?? null, // Menggunakan nilai yang sesuai
        ]);
      }
    }

    $this->reset(); // Mengosongkan input
    return redirect()->route('subkriteria.index')->with('message', 'Sub Kriteria berhasil ditambahkan');
  }

  public function render()
  {
    return view('livewire.sub-kriteria.create');
  }
}

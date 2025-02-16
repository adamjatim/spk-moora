<?php

namespace App\Http\Livewire\Kriteria;

use App\Models\Kriteria;
use Livewire\Component;

class Create extends Component
{
  public $kode_kriteria, $nama_kriteria, $nilai_bobot, $persentase, $keterangan;

  protected $rules = [
    'kode_kriteria' => 'required|string',
    'nama_kriteria' => 'required|string',
    'nilai_bobot' => 'required|numeric',
    'persentase' => 'required|numeric|min:0|max:100',
    'keterangan' => 'nullable|string',
  ];

  protected $messages = [
    'kode_kriteria.required'  => 'Kode kriteria wajib diisi.',
    'kode_kriteria.string'    => 'Kode kriteria harus berupa string.',
    'nama_kriteria.required'  => 'Nama kriteria wajib diisi.',
    'nilai_bobot.required'    => 'Bobot kriteria wajib diisi. (format: 0.<angka>)',
    'persentase.required'     => 'Persentase wajib diisi.',
    'persentase.integer'      => 'Persentase harus berupa angka.',
    'keterangan.required'     => 'Keterangan wajib dipilih.',
  ];

  public function updatedPersentase($value)
  {
    // Handle null atau empty value
    if ($value === null || $value === '') {
      $value = 0;
    }

    // Cast ke int
    $value = (int)$value;
    $totalPersen = (int)Kriteria::sum('persentase') + $value;

    if ($totalPersen > 100) {
      $this->addError('persentase', 'Total persentase melebihi 100%.');
    } else {
      $this->resetErrorBag('persentase');
    }

    // Konversi persentase ke nilai bobot
    $this->nilai_bobot = $value / 100;
  }

  public function store()
  {
    $this->validate();

    // Hitung total persentase
    $totalPersen = Kriteria::sum('persentase') + $this->persentase;

    // Validasi total persentase
    if ($totalPersen > 100) {
      session()->flash('error', 'Total persentase melebihi 100%. Silakan kurangi nilai persentase.');
      return;
    }


    Kriteria::create([
      'kode_kriteria' => $this->kode_kriteria,
      'nama_kriteria' => $this->nama_kriteria,
      'nilai_bobot' => $this->nilai_bobot,
      'persentase' => $this->persentase,
      'keterangan' => $this->keterangan,
    ]);

    return redirect()->route('kriteria.index')->with('message', 'Kriteria berhasil ditambahkan.');
  }

  public function render()
  {
    return view('livewire.kriteria.create');
  }
}

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
    'persentase' => 'required|numeric',
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

  public function store()
  {
    $this->validate();

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

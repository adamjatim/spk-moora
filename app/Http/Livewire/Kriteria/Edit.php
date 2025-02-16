<?php

namespace App\Http\Livewire\Kriteria;

use App\Models\Kriteria;
use Livewire\Component;

class Edit extends Component
{
  public $kriteria;
  public $kode_kriteria, $nama_kriteria, $nilai_bobot, $persentase, $keterangan;

  public function mount($id)
  {
    $this->kriteria = Kriteria::find($id);
    $this->kode_kriteria = $this->kriteria->kode_kriteria;
    $this->nama_kriteria = $this->kriteria->nama_kriteria;
    $this->nilai_bobot = $this->kriteria->nilai_bobot;
    $this->persentase = $this->kriteria->persentase;
    $this->keterangan = $this->kriteria->keterangan;
  }

  public function updatedPersentase($value)
  {
    // Handle null atau empty value
    if ($value === null || $value === '') {
      $value = 0;
    }

    // Cast ke int
    $value = (int)$value;
    $totalPersen = (int)Kriteria::sum('persentase') - $this->kriteria->persentase + $value;

    if ($totalPersen > 100) {
      $this->addError('persentase', 'Total persentase melebihi 100%.');
    } else {
      $this->resetErrorBag('persentase');
    }

    // Konversi persentase ke nilai bobot
    $this->nilai_bobot = $value / 100;
  }

  public function update()
  {
    $this->validate([
      'kode_kriteria' => 'required|string',
      'nama_kriteria' => 'required',
      'nilai_bobot' => 'required',
      'persentase' => 'required|numeric|min:0|max:100',
      'keterangan' => 'required',
    ], [
      'kode.required'           => 'Kode kriteria wajib diisi.',
      'kode.string'             => 'Kode kriteria harus berupa string.',
      'nama.required'           => 'Nama kriteria wajib diisi.',
      'bobot.required'          => 'Bobot kriteria wajib diisi. (format: 0.<angka>)',
      'persen.required'         => 'Persentase wajib diisi.',
      'persen.integer'          => 'Persentase harus berupa angka.',
      'keterangan.required'     => 'Keterangan wajib dipilih.',
    ]);

    // Hitung total persentase
    $totalPersen = (int)Kriteria::sum('persentase') - $this->kriteria->persentase + $this->persentase;

    // Validasi total persentase
    if ($totalPersen > 100) {
      session()->flash('error', 'Total persentase melebihi 100%. Silakan kurangi nilai persentase.');
      return;
    }

    $this->kriteria->update([
      'kode_kriteria' => $this->kode_kriteria,
      'nama_kriteria' => $this->nama_kriteria,
      'nilai_bobot' => $this->nilai_bobot,
      'persentase' => $this->persentase,
      'keterangan' => $this->keterangan,
    ]);

    return redirect()->route('kriteria.index')->with('message', 'Kriteria berhasil diubah.');
  }

  public function render()
  {
    return view('livewire.kriteria.edit');
  }
}

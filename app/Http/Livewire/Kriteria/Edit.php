<?php

namespace App\Http\Livewire\Kriteria;

use App\Models\Kriteria;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Edit extends Component
{
	public $kriteria, $kode, $nama, $bobot, $persen, $keterangan;

	public function mount($id)
	{
		$this->kriteria = Kriteria::find($id);

    $this->kode = $this->kriteria->kode_kriteria;
    $this->nama = $this->kriteria->nama_kriteria;
    $this->bobot = $this->kriteria->nilai_bobot;
    $this->persen = $this->kriteria->persentase;
    $this->keterangan = $this->kriteria->keterangan;
	}

  protected $rules = [
    'kode'        => 'required|string',
    'nama'        => 'required',
    'bobot'       => 'required',
    'persen'      => 'required|integer',
    'keterangan'  => 'required',
  ];

  protected $messages = [
    'kode.required'       => 'Kode kriteria wajib diisi.',
    'kode.string'         => 'Kode kriteria harus berupa string.',
    'nama.required'       => 'Nama kriteria wajib diisi.',
    'bobot.required'      => 'Bobot kriteria wajib diisi. (format: 0.<angka>)',
    'persen.required'     => 'Persentase wajib diisi.',
    'persen.integer'      => 'Persentase harus berupa angka.',
    'keterangan.required' => 'Keterangan wajib dipilih.',
  ];



	public function render()
	{
		return view('livewire.kriteria.edit');
	}

	public function update()
	{
    // Validasi input
    $this->validate();

		$this->kriteria->update([
      'kode_kriteria' => $this->kode,
      'nama_kriteria' => $this->nama,
      'nilai_bobot' => $this->bobot,
      'persentase' => $this->persen,
      'keterangan' => $this->keterangan,
    ]);

		return redirect()->route('kriteria.index');
	}
}

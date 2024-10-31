<?php

namespace App\Http\Livewire\Kriteria;

use App\Models\Kriteria;
use Livewire\Component;

class Create extends Component
{
	public $kode, $nama, $bobot, $persen, $keterangan;

  // Aturan validasi untuk form
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

	public function store()
	{
    $this->validate();

		Kriteria::create([
			'kode_kriteria'	=> $this->kode,
			'nama_kriteria'	=> $this->nama,
			'nilai_bobot'	  => $this->bobot,
			'persentase'	  => $this->persen,
      'keterangan'	  => $this->keterangan
		]);

		$this->reset();
		$this->emit('saved');

    session()->flash('message', 'Data kriteria berhasil ditambahkan.');

    return redirect()->route('kriteria.index');
	}

  public function render()
	{
		return view('livewire.kriteria.create');
	}
}

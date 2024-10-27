<?php

namespace App\Http\Livewire\CalonPegawai;

use App\Models\CalonPegawai;
use Livewire\Component;

class Create extends Component
{
  public $nama, $pendidikan, $pengalaman, $usia, $kesehatan, $nilai_test;

  // Aturan validasi untuk form
  protected $rules = [
    'nama'        => 'required|string',
    'pendidikan'  => 'required|in:SMA,SMK,D3,S1',
    'pengalaman'  => 'required|integer',
    'usia'        => 'required|integer',
    'kesehatan'   => 'required',
    'nilai_test'  => 'required|integer',
  ];

  protected $messages = [
    'nama.required'       => 'Nama calon pegawai wajib diisi.',
    'nama.string'         => 'Nama calon pegawai harus berupa string.',
    'pendidikan.required' => 'Pendidikan calon pegawai wajib dipilih.',
    'pendidikan.integer'  => 'Pendidikan calon pegawai harus dipilih antara SMA,SMK, D3, S1.',
    'pengalaman.required' => 'Pengalaman calon pegawai wajib diisi.',
    'pengalaman.integer'  => 'Pengalaman calon pegawai har',
    'usia.required'       => 'Usia calon pegawai wajib diisi.',
    'usia.integer'        => 'Usia calon pegawai harus berupa angka.',
    'kesehatan.required'  => 'Kesehatan calon pegawai wajib dipilih.',
    'nilai_test.required' => 'Nilai test calon pegawai harus diisi.',
  ];

  public function store()
  {
    $this->validate();

    CalonPegawai::create([
      'nama'        => $this->nama,
      'pendidikan'  => $this->pendidikan,
      'pengalaman'  => $this->pengalaman,
      'usia'        => $this->usia,
      'kesehatan'   => $this->kesehatan,
      'nilai_test'  => $this->nilai_test,
    ]);

    session()->flash('message', 'Data calon pegawai berhasil ditambahkan.');

    return redirect()->route('calon-pegawai.index');
  }

  public function render()
  {
    return view('livewire.calon-pegawai.create');
  }
}

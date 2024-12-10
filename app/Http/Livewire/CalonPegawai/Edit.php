<?php

namespace App\Http\Livewire\CalonPegawai;

use App\Models\CalonPegawai;
use Livewire\Component;

class Edit extends Component
{
  public $calonPegawai;
  public $nama, $pendidikan, $pengalaman, $usia, $kesehatan, $nilai_test, $tahun_daftar, $tahunDaftarFinal;


  // Memuat data calon pegawai ke dalam form ketika komponen di-mount
  public function mount($id)
  {
    $this->calonPegawai = CalonPegawai::find($id);

    // Mengisi properti dari data yang ada
    $this->nama = $this->calonPegawai->nama;
    $this->pendidikan = $this->calonPegawai->pendidikan;
    $this->pengalaman = $this->calonPegawai->pengalaman;
    $this->usia = $this->calonPegawai->usia;
    $this->kesehatan = $this->calonPegawai->kesehatan;
    $this->nilai_test = $this->calonPegawai->nilai_test;
    $this->tahun_daftar = $this->calonPegawai->tahun_daftar;
  }

  // Validasi data yang diinput
  protected $rules = [
    'nama'        => 'required|string',
    'pendidikan'  => 'required',
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

  // Fungsi untuk menyimpan perubahan
  public function update()
  {
    // Validasi input
    $this->validate();

    // Jika tahun_daftar kosong, gunakan tahun sekarang
    $tahunDaftarFinal = $this->tahun_daftar ?: now()->year;

    // Memperbarui data di database
    $this->calonPegawai->update([
      'nama' => $this->nama,
      'pendidikan' => $this->pendidikan,
      'pengalaman' => $this->pengalaman,
      'usia' => $this->usia,
      'kesehatan' => $this->kesehatan,
      'nilai_test' => $this->nilai_test,
      'tahun_daftar' => $tahunDaftarFinal,
    ]);

    // Mengirimkan pesan sukses
    session()->flash('message', 'Data calon pegawai berhasil diperbarui.');

    // Redirect ke halaman index atau halaman lain
    return redirect()->route('calon-pegawai.index');
  }

  public function render()
  {
    return view('livewire.calon-pegawai.edit');
  }
}

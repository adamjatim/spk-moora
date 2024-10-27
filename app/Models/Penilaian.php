<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
  use HasFactory;

  // lepaskan proteksi mass assignment
  protected $guarded = [];

  // Tentukan kolom yang dapat diisi
  protected $fillable = [
    'calon_pegawai_id',
    'kriteria_id',
    'nilai',
  ];

  /**
   * Relasi dengan model Calon Pegawai
   * Satu penilaian milik satu calon pegawai
   */
  public function calonPegawai()
  {
    return $this->belongsTo(CalonPegawai::class);
  }

  /**
   * Relasi dengan model Kriteria
   * Satu penilaian memiliki satu kriteria
   */
  public function kriteria()
  {
    return $this->belongsTo(Kriteria::class);
  }
}

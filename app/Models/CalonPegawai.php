<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalonPegawai extends Model
{
  use HasFactory;

  // lepaskan proteksi mass assignment
  protected $guarded = [];

  // Tentukan kolom yang dapat diisi
  protected $fillable = [
    'filter',
    'nama',
    'pendidikan',
    'pengalaman',
    'usia',
    'kesehatan',
    'nilai_test',
  ];

  /**
   * Relasi dengan model Penilaian
   * Calon Pegawai bisa memiliki banyak penilaian
   */
  public function penilaians()
  {
    return $this->hasMany(Penilaian::class);
  }
}

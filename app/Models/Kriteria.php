<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
  use HasFactory;

  protected $guarded = [];

  // Tentukan kolom yang dapat diisi
  protected $fillable = [
    'kode_kriteria',
    'nama_kriteria',
    'nilai_bobot',
    'persentase',
    'keterangan'
  ];

  /**
   * Relasi dengan model Penilaian
   * Satu kriteria dapat digunakan dalam banyak penilaian
   */
  public function penilaians()
  {
    return $this->hasMany(Penilaian::class);
  }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKriteria extends Model
{
  use HasFactory;

  protected $guarded = [];

  // Tentukan kolom yang dapat diisi
  protected $fillable = [
    'kode_kriteria',
    'parameter',
    'parameter_min',
    'parameter_max',
    'nilai',
  ];

  /**
   * Relasi dengan model Penilaian
   * Satu kriteria dapat digunakan dalam banyak penilaian
   */
  public function kriteria()
  {
    return $this->belongsTo(Kriteria::class, 'kode_kriteria', 'kode_kriteria');
  }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataHasil extends Model
{
    use HasFactory;

    protected $table = 'data_hasil';

    protected $fillable = [
        'nama_calon',
        'nilai_yi',
        'keterangan',
    ];
}
